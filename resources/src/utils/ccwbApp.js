import { getDevice } from './util'

const deviceInfo = getDevice()

/**
 * 打开APP登陆
 */
export function toCWLogin () {
  try {
    if (deviceInfo.isCwAppAndroid) {
      window.Android.toCWLogin()
    } else if (deviceInfo.isCwAppIos) {
      const redirectUrl = window.location.href
      window.prompt('toCWLogin', JSON.stringify({ redirect_url: redirectUrl }))
    }
  } catch (e) {
    console.log('toCWLogin error')
  }
}

/**
 * 获取APP用户地理位置
 * @returns {*}
 */
export function getUserPosition () {
  try {
    let position = {}
    if (deviceInfo.isCwAppAndroid) {
      position = window.Android.getCWLocationInfo()
    } else if (deviceInfo.isCwAppIos) {
      position = window.prompt('getCWLocationInfo', '')
    }
    position = JSON.parse(position)
    return {
      province: position.cw_province,
      city: position.cw_city,
      district: position.cw_district,
      latitude: position.cw_latitude,
      longitude: position.cw_longitude,
      address: position.cw_address
    }
  } catch (e) {
  }
}

/**
 * 获取用户的经纬度
 * @returns {{latitude: *, longitude: *}}
 */
export function getUserLatAndLon () {
  try {
    const userPosition = getUserPosition()
    let position = {
      latitude: userPosition.latitude,
      longitude: userPosition.longitude
    }
    return position
  } catch (e) {
  }
}

/**
 * 获取春晚APP用户信息
 * @returns {*}
 */
export function getCWUserInfo () {
  try {
    let userInfo = {}
    if (deviceInfo.isCwAppAndroid) {
      userInfo = window.Android.getCWUserInfo()
    } else if (deviceInfo.isCwAppIos) {
      userInfo = window.prompt('getCWUserInfo', '')
    }
    return JSON.parse(userInfo)
  } catch (e) {
    console.log('getCWUserInfo error')
  }
}

/**
 * 获取 APP 登陆的用户信息 token
 */
export function getAppLoginToken () {
  try {
    let userInfo = getCWUserInfo()
    const token = userInfo.token
    return token
  } catch (e) {
    return window.localStorage.getItem('ccwb_user_new_token')
  }
}

/**
 * 获取APP设备信息
 * @returns {string}
 * {
    “cw_device”: “RedMi4X”,
    “cw_device_height”: “1920”,
    “cw_device_width”: “1080”,
    “cw_machine_id”: “867455030065971”,
    “cw_verstion”: “1.0.0”
    }
 */
export function getDeviceInfo () {
  try {
    if (deviceInfo.isCwAppAndroid) {
      return window.Android.getCWDeviceInfo()
    } else if (deviceInfo.isCwAppIos) {
      return window.prompt('getCWDeviceInfo', '')
    }
  } catch (e) {
    console.log('getDeviceInfo error')
  }
}

/**
 * 设置 APP 登陆 token
 * @param token
 */
export function setAppLoginToken (token) {
  if (deviceInfo.isCwAppAndroid) {
    window.Android.insertCWUser(token)
  } else if (deviceInfo.isCwAppIos) {
    window.prompt('insertCWUser', JSON.stringify({ token: token }))
  } else {
    window.localStorage.setItem('ccwb_user_new_token', token)
  }
}

/**
 * 打开APP导航
 * @param position {startLon,startLat,startAddress,endLon,endLat,endAddress}
 * startLon  起始位置的 经度  String
 * startLat  起始位置的纬度  String
 * startAddress  起始位置的 地址  String
 * endLon  结束位置的 经度  String
 * endLat  结束位置的 纬度  String
 * endAddress  结束位置的地址  String
 */
export function openMapNavigation (position) {
  try {
    position = JSON.stringify(position)
    if (deviceInfo.isCwAppAndroid) {
      window.Android.toCWNavigation(position)
    } else if (deviceInfo.isCwAppIos) {
      window.prompt('toCWNavigation', position)
    }
  } catch (e) {
    console.log('openMapNavigation error')
  }
}

/**
 * 打开APP的分享
 * @param shareContent 值参照下面,如果没有的时候,留空即可
 * {
    “newsId”: “10086”,
    “picPath”: “https://www.baidu.png“,
    “redirect_url”: “https://www.ccwb.com“,
    “summary”: “这个地方是分享的描述”,
    “title”: “分享的title”,
    “type”: “news”,
    “url”: “https://www.baidu.com“
  }
 */
export function openShare (shareContentJson) {
  try {
    shareContentJson = JSON.stringify(shareContentJson)
    if (deviceInfo.isCwAppAndroid) {
      window.Android.toCWShare(shareContentJson)
    } else if (deviceInfo.isCwAppIos) {
      window.prompt('toCWShare', JSON.stringify(shareContentJson))
    }
  } catch (e) {
    console.log('openShare error')
  }
}

/**
 * 唤起APP支付
 * @param pay
 * @param backUrl
 * @returns {*}
 */
export function openAppWechatPay (pay, backUrl) {
  const payOptions = {
    pay: pay,
    url: backUrl
  }
  try {
    if (deviceInfo.isCwAppAndroid) {
      window.Android.payWX(JSON.stringify(payOptions))
    } else if (deviceInfo.isCwAppIos) {
      window.prompt('payWX', JSON.stringify(payOptions))
    } else {
      throw new Error('不支持支付,请升级您的APP')
    }
  } catch (e) {
    throw new Error('不支持支付,请升级您的APP')
  }
}
