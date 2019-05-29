// import { toast, loading, close } from '../toast/toast'
import { Toast } from 'vant'
import apiUrlMap from './apiUrlMap'
import AxiosInit from './api'
import store from '@/store'
import { getDevice } from '../../utils/util'
import { toCWLogin } from '../../utils/ccwbApp'

/**
 * 通用请求,需要提前定义请求参数 即apiUrlMap文件
 * @param method 请求发配置名称
 * @param opts ,请求的参数
 * @param toast 是否开启 toast
 * @returns {*}
 */
export function request (method, opts, toast = true) {
  // 如果有给 toast 参数则显示 loading 加载数据
  if (toast && typeof (toast) === 'boolean') {
    loading('加载中...')
  } else if (toast && typeof (toast) === 'string') {
    loading(toast)
  }
  let m = apiUrlMap[method]
  if (m) {
    let optsType = typeof (opts)
    if (optsType == null || optsType !== 'object') {
      opts = {}
    }
    if (m.method === 'get') {
      return apiGet(m.url, opts)
    } else if (m.method === 'post') {
      return apiPost(m.url, opts)
    } else {
      return '非法请求'
    }
  } else {
    closeLoading()
    console.log(method, m)
    console.log('url 错误', '返回结果：err = ', '无法请求，无效的请求！', '\n')
  }
}

/**
 * post 请求
 * @param url 请求地址
 * @param data 请求参数
 * @param toast 是够开启请求 toast
 * @returns {Promise<any>}
 */
export function apiPost (url, data, toast = true) {
  if (toast && typeof (toast) === 'boolean') {
    loading('加载中...')
  } else if (toast && typeof (toast) === 'string') {
    loading(toast)
  }

  return new Promise((resolve, reject) => {
    AxiosInit.post(url, data).then((responses) => {
      response(responses.data)
      resolve(responses.data)
    }).catch((response) => {
      console.log('Customize Notice', response)
      closeLoading()
      reject(response)
    })
  })
}

/**
 * get 求情方法
 * @param url
 * @param data
 * @param toast
 * @returns {Promise<any>}
 */
export function apiGet (url, data, toast = true) {
  if (toast && typeof (toast) === 'boolean') {
    loading('加载中...')
  } else if (toast && typeof (toast) === 'string') {
    loading(toast)
  }
  return new Promise((resolve, reject) => {
    AxiosInit.get(url, {
      params: data
    }).then((responses) => {
      response(responses.data)
      resolve(responses.data)
    }).catch((response) => {
      console.log('Customize Notice', response)
      closeLoading()
      reject(response)
    })
  })
}

/**
 * 数据相应处理方法
 * @param data
 * @returns {boolean}
 */
export function response (data) {
  if (data == null) {
    setTimeout(() => closeLoading(), 800)
    return false
  }
  // 商户端错误码
  if (data.code === 200 && data.status === false) {
    setTimeout(() => closeLoading(), 800)
    return false
  }

  if (data.code === 401 || data.success === 40403) {
    if (getDevice().isCwApp) {
      toCWLogin()
    } else {
      toast('请先绑定手机')
      store.commit('SET_SHOW_LOGIN', true)
      setTimeout(() => closeLoading(), 800)
      return false
    }
  }
  setTimeout(() => closeLoading(), 800)
}

/**
 * 关闭 loading
 */
export function closeLoading () {
  close()
}
export function toast (msg) {
  Toast(msg)
}
export function loading () {
  Toast.loading({
    forbidClick: true, // 禁用背景点击
    loadingType: 'spinner',
    duration: 0,
    message: '加载中...'
  })
}
export function close () {
  Toast.clear()
}
