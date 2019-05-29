/**
 * @desc 判断标签是否有class
 * @param el 需要操作的节点
 * @param className 需要操作的类名
 * @returns {boolean}
 */
export function hasClass (el, className) {
  let reg = new RegExp('(^|\\s)' + className + '(\\s|$)')
  return reg.test(el.className)
}

/**
 * @desc 给指定标签添加class
 * @param el
 * @param className
 */
export function addClass (el, className) {
  if (hasClass(el, className)) {
    return
  }

  let newClass = el.className.split(' ')
  newClass.push(className)
  el.className = newClass.join(' ')
}

/**
 * @desc 移除标签指定 class
 * @param el
 * @param className
 */
export function removeClass (el, className) {
  if (hasClass(el, className)) {
    let reg = new RegExp('(^|\\s)' + className + '(\\s|$)')
    el.className = el.className.replace(reg, ' ')
  }
}

/**
 * @desc 获取标签指定data的值{或者设置指定data的值}
 * @param el
 * @param name
 * @param val
 * @returns {*}
 */
export function getData (el, name, val) {
  const prefix = 'data-'
  if (val) {
    return el.setAttribute(prefix + name, val)
  }
  return el.getAttribute(prefix + name)
}

let elementStyle = document.createElement('div').style

let vendor = (() => {
  let transformNames = {
    webkit: 'webkitTransform',
    Moz: 'MozTransform',
    O: 'OTransform',
    ms: 'msTransform',
    standard: 'transform'
  }

  for (let key in transformNames) {
    if (elementStyle[transformNames[key]] !== undefined) {
      return key
    }
  }

  return false
})()

/**
 * @desc 统一处理css前缀  能力判断
 * @param style
 * @returns {*}
 */
export function prefixStyle (style) {
  if (vendor === false) {
    return false
  }

  if (vendor === 'standard') {
    return style
  }

  return vendor + style.charAt(0).toUpperCase() + style.substr(1)
}

/**
 * @desc 获取滚动条距顶部的距离
 * @returns {HTMLElement | number}
 */
export function getScrollTop () {
  return (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop
}

/**
 *
 * @desc  获取一个元素的距离文档(document)的位置，类似jQ中的offset()
 * @param {HTMLElement} ele
 * @returns { {left: number, top: number} }
 */
export function offset (ele) {
  let pos = {
    left: 0,
    top: 0
  }
  while (ele) {
    pos.left += ele.offsetLeft
    pos.top += ele.offsetTop
    ele = ele.offsetParent
  }

  return pos
}

/**
 *
 * @desc 设置滚动条距顶部的距离
 */
export function setScrollTop (value) {
  window.scrollTo(0, value)

  return value
}

/**
 *
 * @desc H5软键盘缩回、弹起回调
 * 当软件键盘弹起会改变当前 window.innerHeight，监听这个值变化
 * @param {Function} downCb 当软键盘弹起后，缩回的回调
 * @param {Function} upCb 当软键盘弹起的回调
 */
export function windowResize (downCb, upCb) {
  let clientHeight = window.innerHeight
  downCb = typeof downCb === 'function' ? downCb : function () {
  }
  upCb = typeof upCb === 'function' ? upCb : function () {
  }
  window.addEventListener('resize', () => {
    let height = window.innerHeight
    if (height === clientHeight) {
      downCb()
    }
    if (height < clientHeight) {
      upCb()
    }
  })
}

/*
let requestAnimFrame = (() => {
  return window.requestAnimationFrame ||
    window.webkitRequestAnimationFrame ||
    window.mozRequestAnimationFrame ||
    function (callback) {
      window.setTimeout(callback, 1000 / 60)
    }
})()
*/

/**
 * @desc  在${duration}时间内，滚动条平滑滚动到${to}指定位置
 * @param {Number} to
 * @param {Number} duration
 */
export function scrollTo (to, duration) {
  if (duration < 0) {
    setScrollTop(to)
    return
  }
  let diff = to - getScrollTop()
  if (diff === 0) return
  let step = diff / duration * 10
  requestAnimationFrame(
    function () {
      if (Math.abs(step) > Math.abs(diff)) {
        setScrollTop(getScrollTop() + diff)
        return
      }
      setScrollTop(getScrollTop() + step)
      // eslint-disable-line
      if ((diff > 0 && getScrollTop() >= to) || (diff < 0 && getScrollTop() <= to)) { /* eslint-disable-line */
        return
      }
      scrollTo(to, duration - 16)
    })
}
