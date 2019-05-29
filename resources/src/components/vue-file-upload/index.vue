<template>
<span class="vue-file-upload">
  <slot name="label">上传文件</slot>
  <input ref="fileInput" type="file" name="file" @change="upladIImage">
</span>
</template>
<script>
export default {
  props: {
    url: {
      type: String,
      required: true
    }
  },
  data () {
  },
  methods: {
    upladIImage (e) {
      let files = e.target.files || e.dataTransfer.files
      this.UploadFile(files[0], this.url)
    }
  }
}
</script>
