// import 'babel-polyfill'
import Vue from 'vue'
import App from './App'
import router from './router/router'
import { sync } from 'vuex-router-sync'
import fastclick from 'fastclick'
import VueLazyload from 'vue-lazyload'
import store from './store'
import Http from './libs/api/http'
// import WechatAuth from './libs/wechat-auth'
import { getDevice } from './utils/util'
import { toCWLogin } from './utils/ccwbApp'
import { Toast } from 'vant'

if (process.env.NODE_ENV !== 'production') {
  import('vconsole').then(VConsole => {
    // new VConsole.default() // eslint-disable-line
  })
}

// 处理移动端点击300毫秒延迟
fastclick.attach(document.body)

Vue.use(Http)
Vue.use(Toast)
// 处理图片懒加载
Vue.use(VueLazyload, {
  loading: require('./assets/ccwb_common_default_normal.png'),
  preLoad: 1.3,
  error: require('./assets/ccwb_common_default_normal.png')
})
require('normalize.css')
// 引入阿里图标样式库
require('./assets/css/iconfont/iconfont.css')
// 引入 remixicon 图标样式库,详情请参照 https://remixicon.com/
require('remixicon/fonts/remixicon.css')

// 由于服务器端没有做 https 跳转,所以为了微信支付,此处需要做强行跳转 HTTPS

// const debug = process.env.NODE_ENV !== 'production'
// if (!debug && window.location.protocol === 'http:') {
//   window.location.href = window.location.href.replace('http:', 'https:')
// }
// 微信自动获取用户信息
/*
const wechatConfig = {
  router,
  appid: '', // your wechat appid
  scope: 'snsapi_userinfo', // snsapi_base or snsapi_userinfo
  getCodeCallback (code, next) {
    return Vue.http.$request('authAuthorization', { wxcode: code }).then(function (res) {
      // var data = (res && res.data) || {} // response data should at least contain openid
      if (res.success === 200) {
        store.commit('SET_USER_WECHAT_INFO', res.data.Authopen)
        store.commit('SET_USER_INFO', res.data.token)
      }
      next()
    })
  }
}
Vue.use(WechatAuth, wechatConfig)

const wechatUserInfo = store.state.userWechatInfo
if (getDevice().isWechat && !wechatUserInfo) { // 如果是微信段,并且微信信息为空,则获取微信用户信息
  Vue.$wechatAuth()
}
*/

// 为了兼容其他平台,进来以后,无条件获取地理位置一词
store.dispatch('getUserPositionInfo')

// 验证路由权限(是否登陆)
router.beforeEach((to, from, next) => {
  if (to.meta.title) {
    document.title = to.meta.title
  }

  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!store.state.userInfo) { // 判断用户是否登陆
      if (getDevice().isCwApp) {
        // 不要问我为什么这样写,解决操蛋APP登陆跳转的问题,神奇的APP webview
        store.dispatch('getUserInfo').then(res => {
          if (!res) {
            toCWLogin()
          }
        })
      } else {
        store.commit('SET_SHOW_LOGIN', true)
        next({
          path: from.fullPath,
          query: { redirect: to.fullPath }
        })
      }
    }
  }
  next() // 确保一定要调用 next()
})

// 简单的记录一下路由日志,方便处理页面切换效果
sync(store, router)
const history = window.sessionStorage
history.clear()
let historyCount = history.getItem('count') * 1 || 0
history.setItem('/', 0)

// 路由跳转以后记录跳转的值
router.beforeEach(function (to, from, next) {
  store.commit('SET_ISLOADING', { isLoading: true })

  const toIndex = history.getItem(to.path)
  const fromIndex = history.getItem(from.path)

  if (toIndex) {
    if (!fromIndex || parseInt(toIndex, 10) > parseInt(fromIndex, 10) || (toIndex === '0' && fromIndex === '0')) {
      store.commit('SET_DIRRECTION', { direction: 'forward' })
    } else {
      store.commit('SET_DIRRECTION', { direction: 'reverse' })
    }
  } else {
    ++historyCount
    history.setItem('count', historyCount)
    to.path !== '/' && history.setItem(to.path, historyCount)
    store.commit('SET_DIRRECTION', { direction: 'forward' })
  }
  if (/\/http/.test(to.path)) {
    let url = to.path.split('http')[1]
    window.location.href = `http${url}`
  } else {
    next()
  }
})

router.afterEach(function (to) {
  setTimeout(() => {
    store.commit('SET_ISLOADING', { isLoading: false })
  }, 200)
})
Vue.config.productionTip = false
Vue.config.devtools = true

new Vue({
  store,
  router,
  render: h => h(App)
}).$mount('#app-box')
