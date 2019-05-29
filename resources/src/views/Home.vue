<template>
  <div class="home">
    <div>
      <span class="iconfont icon-int"></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </div>

    <div>
      <i class="remixicon-admin-line"></i>
      <i class="remixicon-admin-fill"></i>
    </div>

    <!-- 上边框 -->
    <div class="van-hairline--top"></div>

    <!-- 下边框 -->
    <div class="van-hairline--bottom"></div>

    <!-- 左边框 -->
    <div class="van-hairline--left"></div>

    <!-- 右边框 -->
    <div class="van-hairline--right"></div>

    <!-- 上下边框 -->
    <div class="van-hairline--top-bottom"></div>

    <!-- 全边框 -->
    <div class="van-hairline--surround"></div>

    <router-link to="about">about</router-link>
    <!--    <video-player :video="video1" :isLive="isLive" @event="eventPlayerTime"/>-->
    <div class="upload-area">
      <upload style="text-align: center" @upload="uploadImgSuccess">
        <img src="http://streaming.ccwb.cn/vod/rkn0Cb5K4/snap.jpg" alt="">
      </upload>
    </div>
  </div>
</template>

<script>
// import videoPlayer from '@/components/video-player/video-player'
import Upload from '@/components/upload'

export default {
  name: 'home',
  components: {
    // videoPlayer
    Upload
  },
  data () {
    return {
      isLive: false,
      video: {
        url: 'http://livebroadcast.ccwb.cn/live/a1556008805128920.flv?auth_key=1587544805-7c7fb73bc7ce4f9599e8d4c6d59defba-0-737aff49bb65805522211527cce8268c',
        pic: 'http://streaming.ccwb.cn/vod/rkn0Cb5K4/snap.jpg',
        thumbnails: 'http://streaming.ccwb.cn/vod/rkn0Cb5K4/snap.jpg'
      },
      video1: {
        quality: [
          {
            name: '点播1',
            url: 'http://liverecord.ccwb.cn/qukan/user/1546848211090974/record/1555047030491955/record.m3u8'
          }, {
            name: '点播2',
            url: 'http://liverecord.ccwb.cn/qukan/user/1544507371779975/upload/353f4679-e59a-4722-b6f7-ab6d873ec771.mp4'
          }, {
            name: '点播3',
            url: 'http://streaming.ccwb.cn/vod/rkxUO16km/video.m3u8'
          }
        ],
        defaultQuality: 0,
        pic: 'http://streaming.ccwb.cn/vod/rkn0Cb5K4/snap.jpg',
        url: 'http://liverecord.ccwb.cn/qukan/user/1546848211090974/record/1555047030491955/record.m3u8',
        thumbnails: 'http://streaming.ccwb.cn/vod/rkn0Cb5K4/snap.jpg'
      }
    }
  },
  methods: {
    redirect () {
      console.log(123)
      this.$router.push('/about')
    },
    eventPlayerTime (type, time) {
      console.log(type, time)
    },
    uploadImgSuccess (e) {
      console.log(e)
    }
  }
}
</script>
<style lang="less">
  .upload-area {
    margin: 20px 0;

    img {
      display: block;
      margin: 0 auto;
      max-height: 90px;
    }
  }
</style>
