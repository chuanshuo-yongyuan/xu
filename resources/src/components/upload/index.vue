<template>
  <div class="upload">
    <vue-file-upload :url='uploadUrl'
                     ref='vueFileUploader'
                     :filters='uploadFilters'
                     :events='uploadCbFun'
                     :autoUpload='true'
                     :max='1'>
      <div slot='label'>
        <slot>

        </slot>
      </div>
    </vue-file-upload>
  </div>
</template>

<script>
import VueFileUpload from '../vue-file-upload/vue-file-upload'
import { BASE_UPLOAD_URL } from '@/config/'

export default {
  name: 'upload',
  data () {
    return {}
  },
  props: {
    /**
     * 是否支持支图片上传
     */
    onlyImg: {
      type: Boolean,
      default: false
    }
  },
  computed: {
    /**
     * 图片上传地址
     * @returns {string}
     */
    uploadUrl () {
      return BASE_UPLOAD_URL
    },
    /**
     * 图片上传过滤
     */
    uploadFilters () {
      const _this = this
      return [{
        name: 'imageFilter',
        fn (file) {
          var type = '|' + file.type.slice(file.type.lastIndexOf('/') + 1) + '|'
          if (this.onlyImg) {
            if (!('|jpg|png|jpeg|bmp|gif|webp|'.indexOf(type) !== -1)) {
              _this.$toast.fail('只能上传图片')
            }
            return '|jpg|png|jpeg|bmp|gif|webp|'.indexOf(type) !== -1
          }
          return true
        }
      }]
    },
    /**
     * 图片上传回调
     * onCompleteUpload: function(*=, *, *, *),
     * onAddFileSuccess: function(*=),
     * onProgressUpload: function(*, *)
     */
    uploadCbFun () {
      return {
        /**
         * 上传完成回调，不论成功或失败都调用
         * @param file
         * @param response
         * @param status
         * @param header
         */
        onCompleteUpload: (file, response, status, header) => {
          this.$toast.clear()
          if (response.success !== 'true') {
            this.$toast.fail(response.message)
          }
        },
        /**
         * 上传成功以后的回调
         * @param file
         * @param response
         * @param status
         * @param headers
         */
        onSuccessUpload: (file, response, status, headers) => {
          this.$refs.vueFileUploader.clearAll()// 清空队列文件
          this.$toast.success('上传成功')
          const uploadData = {
            file: file,
            data: response
          }
          this.$emit('upload', uploadData)
        },
        /**
         * 上传失败的回调
         * @param file
         * @param response
         * @param status
         * @param headers
         */
        onErrorUpload: (file, response, status, headers) => {
          this.$toast.fail('上传失败,请重新上传')
        },
        onAddFileSuccess: (file) => {
          this.$toast.loading({
            duration: 0, // 持续展示 toast
            forbidClick: true, // 禁用背景点击
            loadingType: 'spinner',
            message: '上传中...'
          })
        },
        onProgressUpload: (file, progress) => {
        },
        onAbortUpload: (file, response, status, headers) => {
          this.$toast.clear()
        },
        onAddFileFail: (file, failFilter) => {
        }
      }
    }
  },
  components: {
    VueFileUpload
  }
}
</script>

<style lang="less">
  .vue-file-upload {
    position: relative;
    overflow: hidden;
    display: inline-block;
    color: #fff;
    padding: 6px 12px;
    /*background-color:#5cb85c;*/
    /*border-color: #4cae4c;*/
    margin: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    cursor: pointer;
  }

  .vue-file-upload input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    opacity: 0;
    -ms-filter: alpha(opacity=0);
    font-size: 100px;
    direction: ltr;
    cursor: pointer;
  }
</style>
