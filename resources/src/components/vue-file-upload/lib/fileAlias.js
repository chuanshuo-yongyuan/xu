import _ from '../util/public.js'

export default class FileAlias {
  constructor (fileObject) {
    if (_.isFile(fileObject)) {
      this.createFile(fileObject)
    } else {
      this.createFileFromInput(fileObject.value)
    }
  }

  createFileFromInput (path) {
    this.lastModifiedDate = null
    this.size = null
    this.type = 'file/' + path.slice(path.lastIndexOf('.') + 1).toLowerCase()
    this.name = path.slice(path.lastIndexOf('/') + path.lastIndexOf('\\') + 2)
  }

  createFile (object) {
    this.lastModifiedDate = object.lastModifiedDate
    this.size = object.size
    this.type = object.type
    this.name = object.name
  }

  photoCompress (file, uploader, fileAlias, cb) {
    let ready = new FileReader()
    const self = this
    ready.readAsDataURL(file)
    ready.onload = function () {
      let path = this.result
      let img = new Image()
      img.src = path
      img.onload = function () {
        let that = this
        // 默认按比例压缩
        let w = that.width
        let h = that.height
        let scale = w / h
        h = (w / scale)
        // 默认图片质量为0.5
        let quality = 0.5
        // 生成canvas
        let canvas = document.createElement('canvas')
        let ctx = canvas.getContext('2d')
        // 创建属性节点
        let anw = document.createAttribute('width')
        anw.nodeValue = w
        let anh = document.createAttribute('height')
        anh.nodeValue = h
        canvas.setAttributeNode(anw)
        canvas.setAttributeNode(anh)
        ctx.drawImage(that, 0, 0, w, h)
        // quality值越小，所绘制出的图像越模糊
        let base64 = self.dataURLtoFile(canvas.toDataURL('image/jpeg', quality), name)
        cb(uploader, fileAlias, base64)
      }
    }
  }

  canvasDataURL (path, name) {
    const self = this
    let img = new Image()
    img.src = path
    img.onload = function () {
      let that = this
      // 默认按比例压缩
      let w = that.width
      let h = that.height
      let scale = w / h
      h = (w / scale)
      // 默认图片质量为0.5
      let quality = 0.5
      // 生成canvas
      let canvas = document.createElement('canvas')
      let ctx = canvas.getContext('2d')
      // 创建属性节点
      let anw = document.createAttribute('width')
      anw.nodeValue = w
      let anh = document.createAttribute('height')
      anh.nodeValue = h
      canvas.setAttributeNode(anw)
      canvas.setAttributeNode(anh)
      ctx.drawImage(that, 0, 0, w, h)
      // quality值越小，所绘制出的图像越模糊
      let base64 = self.dataURLtoFile(canvas.toDataURL('image/jpeg', quality), name)
      console.log(base64)
      self.newFile = base64
    }
  }

  convertBase64UrlToBlob (urlData) {
    let arr = urlData.split(',')
    let mime = arr[0].match(/:(.*?);/)[1]
    let bstr = atob(arr[1])
    let n = bstr.length
    let u8arr = new Uint8Array(n)
    while (n--) {
      u8arr[n] = bstr.charCodeAt(n)
    }
    return new Blob([u8arr], { type: mime })
  }

  dataURLtoFile (dataurl, filename) {
    let arr = dataurl.split(',')
    let mime = arr[0].match(/:(.*?);/)[1]
    let bstr = atob(arr[1])
    let n = bstr.length
    let u8arr = new Uint8Array(n)
    while (n--) {
      u8arr[n] = bstr.charCodeAt(n)
    }
    return new File([u8arr], filename, { type: mime })
  }
}
