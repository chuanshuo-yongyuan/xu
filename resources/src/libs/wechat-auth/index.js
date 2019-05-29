import WeChatAuth from './wechat-auth'
import url from 'url'
import querystring from 'querystring'
/*
* const config = {
  appid: '', // your wechat appid,
  scope: 'snsapi_userinfo', // snsapi_base or snsapi_userinfo
  getCodeCallback (code, next) {
    return axios.post('http://337.ccwb.cn/cwlive/auth/authorization', {wxcode: code}).then(function (res) {
      console.log('getCodeCallback', res)
      var data = (res && res.data) || {} // response data should at least contain openid
      next()
      return data
    })
  }
}
* */
export default {
  install (Vue, options) {
    let weChatAuth = new WeChatAuth(options)

    let query = querystring.parse(url.parse(window.location.href).query)
    let code = query.code
    urlCodeQueryFilter(code)
    if (!code) {
      Vue.prototype.$wechatAuth = checkRouterAuth
      Vue.$wechatAuth = checkRouterAuth
    }
    // if (!code && !checkRouterAuth()) {
    //   return false
    // }

    function urlCodeQueryFilter (code) {
      if (code) {
        weChatAuth.setAuthCode(code)
        weChatAuth.removeUrlCodeQuery()
      }
    }

    function checkRouterAuth () {
      let authCode = weChatAuth.getAuthCode()
      if (!authCode && !weChatAuth.getAccessToken()) {
        weChatAuth.openAuthPage(encodeURIComponent(window.location.href))
        return false
      } else if (authCode && !weChatAuth.getAccessToken()) {
        weChatAuth.getCodeCallback()
        return false
      }
      return true
    }
  }
}
