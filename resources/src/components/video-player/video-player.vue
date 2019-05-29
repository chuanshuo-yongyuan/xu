<template>
  <div>
    <div ref="videoPlayer"></div>
  </div>
</template>

<script>
import 'dplayer/dist/DPlayer.min.css'
import Hls from 'hls.js'
import flvjs from 'flv.js'
import DPlayer from 'dplayer'

/**
 * 一些说明
 * 当调用播放器的时候,一个必填参数,video 播放属性
 * { quality, defaultQuality, url, pic, thumbnails}
 * 其中 url 为必填参数,其他的选填
 * 在 video.quality 里设置不同清晰度的视频链接和类型，video.defaultQuality 设置默认清晰度
 *
 * 注意 : 当视频为直播的时候,视频只能为单视频,不能为多视频,需要做多视频请自行扩展
 *
 * demo:
 * 当视频为多视频的时候,参数传递方式如下:
 * video: {
        quality: [{
            name: 'HD',
            url: 'demo.m3u8',
            type: 'hls'
        }, {
            name: 'SD',
            url: 'demo.mp4',
            type: 'normal'
        }],
        defaultQuality: 0,  需要播放第几个视频
        pic: 'demo.png',
        thumbnails: 'thumbnails.jpg',
        url:'demo.m3u8'  注意:多视频的时候,必须传递默认的播放 URL  以防止切换的时候错处
    }

 quality的说明:quality的视频列表中,为防止视频格式不一样引起的冲突,当出现视频清晰度切换的时候,列表中不能同时出现 m3u8 和 flv
 只能出出现的情况为: 1,全部 m3u8 2, 全 mp4 3,全 flv 4,m3u8 和 mp4 5,flv 和 mp4

 当视频为单视频的时候,参数传递方始如下:
 video: {
        url: 'http://liverecord.ccwb.cn/qukan/user/1544507371779975/upload/83271472-883e-4b53-bf83-3441ffa02a75.mp4',
        pic: 'http://streaming.ccwb.cn/vod/rkn0Cb5K4/snap.jpg',
        thumbnails: 'http://streaming.ccwb.cn/vod/rkn0Cb5K4/snap.jpg'
      },

 参数 isLive 为是否为直播,当为直播的时候  传递 true 就行
 */

export default {
  name: 'video-player',
  data () {
    return {
      videoPlayer: '',
      videoOptions: {
        autoplay: false,
        danmaku: false,
        lang: 'zh-cn',
        playsinline: 'true',
        'x-webkit-airplay': 'allow',
        'x5-video-player-type': 'h5',
        'x5-video-player-fullscreen': 'true',
        'x5-video-orientation': 'portraint'
      }
    }
  },
  props: {
    video: {
      required: true,
      type: Object
    },
    isLive: {
      type: Boolean,
      default () {
        return false
      }
    },
    options: {
      type: Object
    }
  },
  computed: {
    /**
     * 播放器播放配置
     * @returns {any}
     */
    playerOptions () {
      return Object.assign({}, this.videoOptions, this.options, { live: this.isLive }, this.videoInfo)
    },
    /**
     * 播放信息组装
     * @returns {{video: any | ({} & default.props.video & {customType, type}) | ({} & default.props.video & {}) | ({} & {type, required} & {customType, type}) | ({} & {type, required} & {})}}
     */
    videoInfo () {
      // 单视频的时候
      let videoInfoTemp = this.video
      let videoInfo = {}
      if (videoInfoTemp.url) {
        let customType = this.getCustomType(videoInfoTemp.url)
        videoInfo = { video: Object.assign({}, videoInfoTemp, customType) }
      }
      if (videoInfoTemp.quality) {
        videoInfoTemp.quality.map((item, index) => {
          let customType = this.getCustomType(item.url)
          videoInfoTemp.quality[index] = Object.assign({}, item, customType)
        })
        videoInfo.video.quality = videoInfoTemp.quality
      }
      return videoInfo
    }
  },
  mounted () {
    this.initPlayer()
  },
  methods: {
    /**
     * 初始化播放器
     */
    initPlayer () {
      this.playerOptions.container = this.$refs.videoPlayer
      this.videoPlayer = new DPlayer(this.playerOptions) // eslint-disable-line
      this.bindEvent()
    },
    /**
     * 播放器时间绑定
     */
    bindEvent () {
      const events = [
        'durationchange', 'emptied', 'ended', 'error', 'pause', 'play', 'playing',
        'seeked', 'seeking', 'timeupdate', 'volumechange',
        'notice_show', 'notice_hide', 'quality_start', 'quality_end', 'destroy', 'resize',
        'fullscreen', 'fullscreen_cancel', 'webfullscreen', 'webfullscreen_cancel'
      ]
      events.map((item, index) => {
        this.videoPlayer.on(item, (e) => {
          if (item === 'quality_start') {
            console.log(e)
          }
          this.emitPlayer(item)
        })
      })
    },
    /**
     * 获取播放类型并且处理对呀的播放类型
     * @param type
     * @returns {{customType: {customFlv(*=, *): void}, type: string}|{customType: {customHls(*=, *): void}, type: string}|{}}
     */
    getCustomType (url) {
      let type = this.getUrlPostf(url)
      switch (type) {
        case '.m3u8':
          return {
            type: 'customHls',
            customType: {
              customHls (video, player) {
                const hls = new Hls() // eslint-disable-line
                hls.loadSource(video.src)
                hls.attachMedia(video)
              }
            }
          }
        case '.flv':
          return {
            type: 'customFlv',
            customType: {
              customFlv (video, player) {
                const flvPlayer = flvjs.createPlayer({ // eslint-disable-line
                  type: 'flv',
                  url: video.src
                })
                flvPlayer.attachMediaElement(video)
                flvPlayer.load()
              }
            }
          }
        default:
          return {
            type: 'auto'
          }
      }
    },
    /**
     * 派发播放器事件,当前事件主要派发播放器的播放时间
     * @param type
     */
    emitPlayer (type) {
      this.$emit('event', type, this.videoPlayer.video.currentTime)
    },
    getUrlPostf (url) {
      const filename = url.substring(0, url.indexOf('?')) ? url.substring(0, url.indexOf('?')) : url
      let postf = filename.substring(filename.lastIndexOf('.'), filename.length)
      return postf
    }
  },
  destroyed () {
    this.videoPlayer.destroy()
  }
}
</script>

<style>
  .dplayer .dplayer-menu.dplayer-menu-show {
    display: none;
  }
</style>
