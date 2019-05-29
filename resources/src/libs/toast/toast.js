import './toast.css'
import Vue from 'vue'

/**
 * 显示 toast 框
 * @param tips
 * @param type
 */
export function toast (tips, type, options) {
  const opt = {
    defaultType: 'center',
    duration: '2500'
  }
  for (let property in options) {
    opt[property] = options[property]
  }
  const curType = type || opt.defaultType
  if (document.querySelector('.lx-toast')) {
    // 如果toast还在，则不再执行
    return
  }
  const ToastTpl = Vue.extend({
    template: '<div class="lx-toast lx-toast-' + curType + '">' + tips + '</div>'
  })

  /* eslint-disable no-new */
  const tpl = new ToastTpl().$mount().$el

  document.body.appendChild(tpl)

  setTimeout(() => {
    document.body.removeChild(tpl)
  }, opt.duration)
}

/**
 * 显示加载框
 * @param tips
 * @param type
 */
export function loading (tips, type) {
  const load = document.querySelector('.lx-load-mark')
  if (type === 'close') {
    load && document.body.removeChild(load)
  } else {
    if (load) {
      // 如果loading还在，则不再执行
      return
    }
    var LoadTpl = Vue.extend({
      template: '<div class="lx-load-mark"><div class="lx-load-box"><div class="lx-loading"><div class="loading_leaf loading_leaf_0"></div><div class="loading_leaf loading_leaf_1"></div><div class="loading_leaf loading_leaf_3"></div><div class="loading_leaf loading_leaf_4"></div><div class="loading_leaf loading_leaf_5"></div><div class="loading_leaf loading_leaf_6"></div><div class="loading_leaf loading_leaf_7"></div><div class="loading_leaf loading_leaf_8"></div><div class="loading_leaf loading_leaf_9"></div><div class="loading_leaf loading_leaf_10"></div><div class="loading_leaf loading_leaf_11"></div></div><div class="lx-load-content">' + tips + '</div></div></div>'
    })
    var tpl = new LoadTpl().$mount().$el
    document.body.appendChild(tpl)
  }
}

/**
 * 打开加载提示
 * @param msg
 */
export function open (msg) {
  loading(msg, 'open')
}

/**
 * 关闭加载提示
 */
export function close () {
  loading('', 'close')
}
