class WeChatAuth {
  constructor (config) {
    let defaultConfig = {
      appid: '',
      responseType: 'code',
      scope: 'snsapi_base', // snsapi_userinfo || snsapi_base
      getCodeCallback: () => {
      }
    }
    this.config = Object.assign(defaultConfig, config)
  }

  openAuthPage (redirectUri = encodeURIComponent(window.location.href)) {
    this.removeAccessToken()
    this.removeAuthCode()
    let authPageBaseUri = 'https://open.weixin.qq.com/connect/oauth2/authorize'
    let authParams = `?appid=${this.config.appid}&redirect_uri=${redirectUri}&response_type=${this.config.responseType}&scope=${this.config.scope}&state=123#wechat_redirect`
    window.location.href = authPageBaseUri + authParams
  }

  setAuthCode (code) {
    if (!code) return false
    window.localStorage.setItem('auth_code', code)
    return true
  }

  getAuthCode () {
    let codeValue = window.localStorage.getItem('auth_code')
    if (!codeValue) return ''
    return codeValue
  }

  removeAuthCode () {
    window.localStorage.removeItem('auth_code')
  }

  removeUrlCodeQuery () {
    let location = window.location
    let search = location.search
    if (search) {
      search = search.substr(1)
    }
    let href = location.origin
    let pathName = location.pathname
    if (pathName) {
      href += pathName
    }
    let searchArr = search.split('&').filter(item => {
      if (item.indexOf('code=') < -1) {
        return false
      }
      if (item.indexOf('state=') < -1) {
        return false
      }
      return true
    })
    let hash = location.hash
    if (hash) {
      href += hash
    }
    if (searchArr.length > 0) {
      if (href.indexOf('?') > 0) {
        href += '&' + searchArr.join('&')
      } else {
        href += '?' + searchArr.join('&')
      }
    }
    console.log('最后的 HREF', href)
    window.location.href = href
  }

  setAccessToken (accessToken) {
    if (!accessToken) return false
    window.localStorage.setItem('access_token', accessToken)
    return true
  }

  getAccessToken () {
    return window.localStorage.getItem('access_token')
  }

  removeAccessToken () {
    window.localStorage.removeItem('access_token')
  }

  next () {
    let self = this
    return (accessToken) => {
      if (accessToken) {
        self.setAccessToken(accessToken)
      } else {
        self.removeAccessToken()
      }
      self.removeAuthCode()
    }
  }

  getCodeCallback () {
    return this.config.getCodeCallback(this.getAuthCode(), this.next())
  }
}

export default WeChatAuth
