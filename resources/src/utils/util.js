/**
 * 从指定的最小最大值中获取一个随机数
 * @param min
 * @param max
 * @returns {number}
 */
function getRandomInt (min, max) {
  return Math.floor(Math.random() * (max - min + 1) + min)
}

/**
 * @param arr
 * @returns {Blob|ArrayBuffer|Array.<T>|string|*}
 */
export function shuffle (arr) {
  let _arr = arr.slice()
  for (let i = 0; i < _arr.length; i++) {
    let j = getRandomInt(0, i)
    let t = _arr[i]
    _arr[i] = _arr[j]
    _arr[j] = t
  }
  return _arr
}

export function debounce (func, delay) {
  let timer

  return function (...args) {
    if (timer) {
      clearTimeout(timer)
    }
    timer = setTimeout(() => {
      func.apply(this, args)
    }, delay)
  }
}

/**
 * 判断两个数组是否相同
 * @param arr1
 * @param arr2
 * @returns {boolean}
 */
export function arrayEqual (arr1, arr2) {
  if (arr1 === arr2) return true
  if (arr1.length !== arr2.length) return false
  for (var i = 0; i < arr1.length; ++i) {
    if (arr1[i] !== arr2[i]) return false
  }

  return true
}

/**
 *
 * @desc 获取操作系统类型
 * @return {String}
 */
/*
export function getOS () {
  var userAgent = 'navigator' in window && 'userAgent' in navigator && navigator.userAgent.toLowerCase() || ''
  // var vendor = 'navigator' in window && 'vendor' in navigator && navigator.vendor.toLowerCase() || ''
  var appVersion = 'navigator' in window && 'appVersion' in navigator && navigator.appVersion.toLowerCase() || ''

  if (/mac/i.test(appVersion)) return 'MacOSX'
  if (/win/i.test(appVersion)) return 'windows'
  if (/linux/i.test(appVersion)) return 'linux'
  if (/iphone/i.test(userAgent) || /ipad/i.test(userAgent) || /ipod/i.test(userAgent)) return 'ios'
  if (/android/i.test(userAgent)) return 'android'
  if (/win/i.test(appVersion) && /phone/i.test(userAgent)) return 'windowsPhone'
} */
/**
 *
 * @desc 获取浏览器类型和版本
 * @return {String}
 */

/*
export function getExplore () {
  let sys = {}
  let ua = navigator.userAgent.toLowerCase()
  let s
  (s = ua.match(/rv:([\d.]+)\) like gecko/)) ? sys.ie = s[1] : (s = ua.match(/msie ([\d.]+)/)) ? sys.ie = s[1] : (s = ua.match(/edge\/([\d.]+)/)) ? sys.edge = s[1] : (s = ua.match(/firefox\/([\d.]+)/)) ? sys.firefox = s[1] : (s = ua.match(/(?:opera|opr).([\d.]+)/)) ? sys.opera = s[1] : (s = ua.match(/chrome\/([\d.]+)/)) ? sys.chrome = s[1] : (s = ua.match(/version\/([\d.]+).*safari/)) ? sys.safari = s[1] : 0
  // 根据关系进行判断
  if (sys.ie) return ('IE: ' + sys.ie)
  if (sys.edge) return ('EDGE: ' + sys.edge)
  if (sys.firefox) return ('Firefox: ' + sys.firefox)
  if (sys.chrome) return ('Chrome: ' + sys.chrome)
  if (sys.opera) return ('Opera: ' + sys.opera)
  if (sys.safari) return ('Safari: ' + sys.safari)
  return 'Unkonwn'
} */

/**
 *
 * @desc   现金额转大写
 * @param  {Number} n
 * @return {String}
 */
export function digitUppercase (n) {
  let fraction = ['角', '分']
  let digit = [
    '零', '壹', '贰', '叁', '肆',
    '伍', '陆', '柒', '捌', '玖'
  ]
  let unit = [
    ['元', '万', '亿'],
    ['', '拾', '佰', '仟']
  ]
  let head = n < 0 ? '欠' : ''
  n = Math.abs(n)
  let s = ''
  for (let i = 0; i < fraction.length; i++) {
    s += (digit[Math.floor(n * 10 * Math.pow(10, i)) % 10] + fraction[i]).replace(/零./, '')
  }
  s = s || '整'
  n = Math.floor(n)
  for (let i = 0; i < unit[0].length && n > 0; i++) {
    let p = ''
    for (let j = 0; j < unit[1].length && n > 0; j++) {
      p = digit[n % 10] + unit[1][j] + p
      n = Math.floor(n / 10)
    }
    s = p.replace(/(零.)*零$/, '').replace(/^$/, '零') + unit[0][i] + s
  }
  return head + s.replace(/(零.)*零元/, '元').replace(/(零.)+/g, '零').replace(/^整$/, '零元整')
}

/**
 * @desc   格式化${startTime}距现在的已过时间
 * @param  {Date} startTime
 * @return {String}
 */
export function formatPassTime (startTime) {
  const currentTime = Date.parse(new Date())
  let time = currentTime - startTime
  let day = parseInt(time / (1000 * 60 * 60 * 24))
  let hour = parseInt(time / (1000 * 60 * 60))
  let min = parseInt(time / (1000 * 60))
  let month = parseInt(day / 30)
  let year = parseInt(month / 12)
  if (year) return year + '年前'
  if (month) return month + '个月前'
  if (day) return day + '天前'
  if (hour) return hour + '小时前'
  if (min) {
    return min + '分钟前'
  } else {
    return '刚刚'
  }
}

/**
 * @desc   格式化现在距${endTime}的剩余时间
 * @param  {Date} endTime
 * @return {String}
 */
export function formatRemainTime (endTime) {
  let startDate = new Date() // 开始时间
  let endDate = new Date(endTime) // 结束时间
  let t = endDate.getTime() - startDate.getTime() // 时间差
  let d = 0
  let h = 0
  let m = 0
  let s = 0
  if (t >= 0) {
    d = Math.floor(t / 1000 / 3600 / 24)
    h = Math.floor(t / 1000 / 60 / 60 % 24)
    m = Math.floor(t / 1000 / 60 % 60)
    s = Math.floor(t / 1000 % 60)
  }

  return d + '天 ' + h + '小时 ' + m + '分钟 ' + s + '秒'
}

/**
 * 通过秒数,获取剩余的天时分秒
 * @param endTime  剩余的秒数, 注意,单位是秒  秒 秒
 * @returns {string}
 */
export function countDownTime (endTime) {
  let days = 0
  let hours = 0
  let minutes = 0
  let seconds = 0
  if (endTime > 0) {
    days = parseInt(endTime / 60 / 60 / 24, 10) // 计算剩余的天数
    hours = parseInt(endTime / 60 / 60 % 24, 10) // 计算剩余的小时
    minutes = parseInt(endTime / 60 % 60, 10)// 计算剩余的分钟
    seconds = parseInt(endTime % 60, 10) // 计算剩余的秒数
  }
  days = days < 10 ? '0' + days : days
  hours = hours < 10 ? '0' + hours : hours
  minutes = minutes < 10 ? '0' + minutes : minutes
  seconds = seconds < 10 ? '0' + seconds : seconds

  return `${days}天${hours}时${minutes}分${seconds}秒`
}

export function patternTime (time, fmt = 'yyyy-MM-dd') {
  const date = new Date(time)
  var o = {
    'M+': date.getMonth() + 1, // 月份
    'd+': date.getDate(), // 日
    'h+': date.getHours() % 12 === 0 ? 12 : date.getHours() % 12, // 小时
    'H+': date.getHours(), // 小时
    'm+': date.getMinutes(), // 分
    's+': date.getSeconds(), // 秒
    'q+': Math.floor((date.getMonth() + 3) / 3), // 季度
    'S': date.getMilliseconds() // 毫秒
  }
  var week = {
    '0': '/u65e5',
    '1': '/u4e00',
    '2': '/u4e8c',
    '3': '/u4e09',
    '4': '/u56db',
    '5': '/u4e94',
    '6': '/u516d'
  }
  if (/(y+)/.test(fmt)) {
    fmt = fmt.replace(RegExp.$1, (date.getFullYear() + '').substr(4 - RegExp.$1.length))
  }
  if (/(E+)/.test(fmt)) {
    fmt = fmt.replace(RegExp.$1, ((RegExp.$1.length > 1) ? (RegExp.$1.length > 2 ? '/u661f/u671f' : '/u5468') : '') + week[date.getDay() + ''])
  }
  for (var k in o) {
    if (new RegExp('(' + k + ')').test(fmt)) {
      fmt = fmt.replace(RegExp.$1, (RegExp.$1.length === 1) ? (o[k]) : (('00' + o[k]).substr(('' + o[k]).length)))
    }
  }
  return fmt
}

/**
 *
 * @desc 根据name读取cookie
 * @param  {String} name
 * @return {String}
 */
export function getCookie (name) {
  let arr = document.cookie.replace(/\s/g, '').split(';')
  for (let i = 0; i < arr.length; i++) {
    let tempArr = arr[i].split('=')
    if (tempArr[0] === name) {
      return decodeURIComponent(tempArr[1])
    }
  }
  return ''
}

/**
 *
 * @desc  设置Cookie
 * @param {String} name
 * @param {String} value
 * @param {Number} days
 */
export function setCookie (name, value, days) {
  let date = new Date()
  date.setDate(date.getDate() + days)
  document.cookie = name + '=' + value + ';expires=' + date
}

/**
 *
 * @desc 根据name删除cookie
 * @param  {String} name
 */
export function removeCookie (name) {
  // 设置已过期，系统会立刻删除cookie
  setCookie(name, '1', -1)
}

const keyCodeMap = {
  8: 'Backspace',
  9: 'Tab',
  13: 'Enter',
  16: 'Shift',
  17: 'Ctrl',
  18: 'Alt',
  19: 'Pause',
  20: 'Caps Lock',
  27: 'Escape',
  32: 'Space',
  33: 'Page Up',
  34: 'Page Down',
  35: 'End',
  36: 'Home',
  37: 'Left',
  38: 'Up',
  39: 'Right',
  40: 'Down',
  42: 'Print Screen',
  45: 'Insert',
  46: 'Delete',

  48: '0',
  49: '1',
  50: '2',
  51: '3',
  52: '4',
  53: '5',
  54: '6',
  55: '7',
  56: '8',
  57: '9',

  65: 'A',
  66: 'B',
  67: 'C',
  68: 'D',
  69: 'E',
  70: 'F',
  71: 'G',
  72: 'H',
  73: 'I',
  74: 'J',
  75: 'K',
  76: 'L',
  77: 'M',
  78: 'N',
  79: 'O',
  80: 'P',
  81: 'Q',
  82: 'R',
  83: 'S',
  84: 'T',
  85: 'U',
  86: 'V',
  87: 'W',
  88: 'X',
  89: 'Y',
  90: 'Z',
  91: 'Windows',
  93: 'Right Click',
  96: 'Numpad 0',
  97: 'Numpad 1',
  98: 'Numpad 2',
  99: 'Numpad 3',
  100: 'Numpad 4',
  101: 'Numpad 5',
  102: 'Numpad 6',
  103: 'Numpad 7',
  104: 'Numpad 8',
  105: 'Numpad 9',
  106: 'Numpad *',
  107: 'Numpad +',
  109: 'Numpad -',
  110: 'Numpad .',
  111: 'Numpad /',
  112: 'F1',
  113: 'F2',
  114: 'F3',
  115: 'F4',
  116: 'F5',
  117: 'F6',
  118: 'F7',
  119: 'F8',
  120: 'F9',
  121: 'F10',
  122: 'F11',
  123: 'F12',
  144: 'Num Lock',
  145: 'Scroll Lock',
  182: 'My Computer',
  183: 'My Calculator',
  186: ';',
  187: '=',
  188: ',',
  189: '-',
  190: '.',
  191: '/',
  192: '`',
  219: '[',
  220: '\\',
  221: ']',
  222: '\''
}

/**
 * @desc 根据keycode获得键名
 * @param  {Number} keycode
 * @return {String}
 */
export function getKeyName (keycode) {
  if (keyCodeMap[keycode]) {
    return keyCodeMap[keycode]
  } else {
    console.log('Unknow Key(Key Code:' + keycode + ')')

    return ''
  }
}

/**
 *
 * @desc   判断`obj`是否为空
 * @param  {Object} obj
 * @return {Boolean}
 */
export function isEmptyObject (obj) {
  if (!obj || typeof obj !== 'object' || Array.isArray(obj)) {
    return false
  }
  return !Object.keys(obj).length
}

/**
 * @desc 深拷贝，支持常见类型
 * @param {Any} values
 */
export function deepClone (values) {
  let copy
  // Handle the 3 simple types, and null or undefined
  if (typeof values !== 'object' || values == null) return values
  // Handle Date
  if (values instanceof Date) {
    copy = new Date()
    copy.setTime(values.getTime())
    return copy
  }
  // Handle Array
  if (values instanceof Array) {
    copy = []
    for (var i = 0, len = values.length; i < len; i++) {
      copy[i] = deepClone(values[i])
    }
    return copy
  }

  // Handle Object
  if (values instanceof Object) {
    copy = {}
    for (var attr in values) {
      if (values.hasOwnProperty(attr)) copy[attr] = deepClone(values[attr])
    }
    return copy
  }

  throw new Error('Unable to copy values! Its type isn\'t supported.')
}

/**
 *
 * @desc 随机生成颜色
 * @return {String}
 */
export function randomColor () {
  return '#' + ('00000' + (Math.random() * 0x1000000 << 0).toString(16)).slice(-6)
}

/**
 *
 * @desc 生成指定范围[min, max]的随机数
 * @param  {Number} min
 * @param  {Number} max
 * @return {Number}
 */
export function randomNum (min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min
}

/**
 * @desc 随机生成指定长度的字符串
 * @param length
 * @returns {string}
 */
export function randomStr (length) {
  let str = Math.random().toString(36).substr(2)
  if (str.length >= length) {
    return str.substr(0, length)
  }
  str += randomStr(length - str.length)
  return str
}

/**
 * @desc 检测字符串类型
 * @param str
 * @param type
 */
export function checkType (str, type) {
  switch (type) {
    // 判断是否为邮箱
    case 'email':
      return /^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/.test(str)
    // 判断是否为手机
    case 'phone':
      return /^1[3|4|5|7|8|9][0-9]{9}$/.test(str)
    // 判断是否为电话
    case 'tel':
      return /^(0\d{2,3}-\d{7,8})(-\d{1,4})?$/.test(str)
    // 判断是否为身份证
    case 'idCard':
      return /^(^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$)|(^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])((\d{4})|\d{3}[Xx])$)$/.test(str)
    // 判断是否为数字
    case 'number':
      return /^[0-9]+$/.test(str)
    // 判断是否为英文
    case 'english':
      return /^[a-zA-Z]+$/.test(str)
    // 判断是否为文本
    case 'text':
      return /^\w+$/.test(str)
    // 判断是否为中文
    case 'chinese':
      return /^[\u4E00-\u9FA5]+$/.test(str)
    // 判断是否为小写字母
    case 'lower':
      return /^[a-z]+$/.test(str)
    // 判断是否为大写字母
    case 'upper':
      return /^[A-Z]+$/.test(str)
    // 判断是否为Url 地址
    case 'url':
      return /[-a-zA-Z0-9@:%._+~#=]{2,256}.[a-z]{2,6}\b([-a-zA-Z0-9@:%_+.~#?&//=]*)/i.test(str)
    default:
      return true
  }
}

/**
 * @desc 判断浏览器是否支持webP格式图片
 * @return {Boolean}
 */
export function isSupportWebP () {
  return !![].map && document.createElement('canvas').toDataURL('image/webp').indexOf('data:image/webp') === 0
}

/**
 *
 * @desc   url参数转对象
 * @param  {String} url  default: window.location.href
 * @return {Object}
 */
export function parseQueryString (url) {
  url = url == null ? window.location.href : url
  var search = url.substring(url.lastIndexOf('?') + 1)
  if (!search) {
    return {}
  }
  return JSON.parse('{"' + decodeURIComponent(search).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g, '":"') + '"}')
}

/**
 *
 * @desc   对象序列化
 * @param  {Object} obj
 * @return {String}
 */
export function stringfyQueryString (obj) {
  if (!obj) return ''
  let pairs = []

  for (let key in obj) {
    let value = obj[key]

    if (value instanceof Array) {
      for (let i = 0; i < value.length; ++i) {
        pairs.push(encodeURIComponent(key + '[' + i + ']') + '=' + encodeURIComponent(value[i]))
      }
      continue
    }

    pairs.push(encodeURIComponent(key) + '=' + encodeURIComponent(obj[key]))
  }

  return pairs.join('&')
}

/**
 * @desc 去除空格的方法
 * @param str
 * @param type
 * all-所有空格,
 * lr-前后空格
 * l-前面空格,
 * r-后面空格
 */
export function trim (str, type) {
  switch (type) {
    case 'all':
      return str.replace(/\s+/g, '')
    case 'lr':
      return str.replace(/(^\s*)|(\s*$)/g, '')
    case 'l':
      return str.replace(/(^\s*)/g, '')
    case 'r':
      return str.replace(/(\s*$)/g, '')
    default:
      return str
  }
}

/**
 * @desc 字母大小写切换
 * @param str
 * @param type
 * FirstUpper - 首字母大写
 * FirstLower - 首字母小写
 * AllToggle - 全部大小写转换
 * AllUpper - 全部大写
 * AllLower - 全部小写
 */
export function changeCase (str, type) {
  function ToggleCase (str) {
    let itemText = ''
    str.split('').forEach((item) => {
      if (/^([a-z]+)/.test(item)) {
        itemText += item.toUpperCase()
      } else if (/^([A-Z]+)/.test(item)) {
        itemText += item.toLowerCase()
      } else {
        itemText += item
      }
    })
    return itemText
  }

  switch (type) {
    case 'FirstUpper':
      return str.replace(/\b\w+\b/g, (word) => {
        return word.substring(0, 1).toUpperCase() + word.substring(1)
      })
    case 'FirstLower':
      return str.replace(/\b\w+\b/g, (word) => {
        return word.substring(0, 1).toLowerCase() + word.substring(1)
      })
    case 'AllToggle':
      return ToggleCase(str)
    case 'AllUpper':
      return str.toUpperCase()
    case 'AllLower':
      return str.toLowerCase()
    default:
      return str
  }
}

/**
 * 检测密码强度
 * @param str
 * @returns {number}
 */
export function checkPwd (str) {
  let nowLv = 0
  if (str.length < 6) {
    return nowLv
  }
  if (/[0-9]/.test(str)) {
    nowLv++
  }
  if (/[a-z]/.test(str)) {
    nowLv++
  }
  if (/[A-Z]/.test(str)) {
    nowLv++
  }
  if (/[.|-|_]/.test(str)) {
    nowLv++
  }
  return nowLv
}

/**
 * 统计给定字符串中,目标字符串出现的次数
 * @param str
 */
export function countStr (str, target) {
  return str.split(target).length - 1
}

/**
 * 设备检测
 * isAndroid: boolean,
 * isIpad: boolean,
 * isIpod: boolean,
 * isIphone: boolean,
 * isWechat: boolean,
 * isAlipay: boolean,
 * isCwApp: boolean
 */
export function getDevice () {
  const ua = navigator.userAgent
  const isAndroid = /(Android);?[\s/]+([\d.]+)?/.test(ua)
  const isIpad = /(iPad).*OS\s([\d_]+)/.test(ua)
  const isIpod = /(iPod)(.*OS\s([\d_]+))?/.test(ua)
  const isIphone = !isIpad && /(iPhone\sOS)\s([\d_]+)/.test(ua)
  const isWechat = /micromessenger/i.test(ua)
  const isAlipay = /alipayclient/i.test(ua)
  const isCwApp = /ccwb_app/i.test(ua)
  const isCwAppAndroid = /ccwb_app\/android/i.test(ua)
  const isCwAppIos = /ccwb_app\/ios/i.test(ua)
  return {
    isAndroid,
    isIpad,
    isIpod,
    isIphone,
    isWechat,
    isAlipay,
    isCwApp,
    isCwAppAndroid,
    isCwAppIos
  }
}

export function hideCwAppHeader () {
  try {
    window.Android.setHeadBarVisible('false')
  } catch (e) {
    try {
      window.webkit.messageHandlers.setHeadBarVisible.postMessage('false')
    } catch (e) {
    }
  }
}
