import * as types from './mutation-types'
// import { setAppLoginToken } from '@/utils/ccwbApp'

const mutations = {
  /**
   * 设置全局loading状态
   * @param state
   * @param payload
   */
  [types.SET_ISLOADING] (state, payload) {
    state.isLoading = payload.isLoading
  },
  /**
   * 修改页面切换状态
   * @param state
   * @param payload
   */
  [types.SET_DIRECTIION] (state, payload) {
    state.direction = payload.direction
  },
  /**
   * 修改登录状态
   * @param state
   * @param payload
   */
  [types.SET_SHOW_LOGIN] (state, payload) {
    state.showLogin = payload
  },
  /**
   * 设置用户信息
   * @param state
   * @param paylod
   */
  [types.SET_USER_INFO] (state, paylod) {
    // setAppLoginToken(paylod)
    state.userInfo = paylod
    window.localStorage.setItem('ccwb_user_new_token', paylod)
    return state.userInfo
  },
  /**
   * 设置微信用户信息
   * @param state
   * @param payload
   */
  [types.SET_USER_WECHAT_INFO] (state, payload) {
    window.sessionStorage.setItem('USER_WECHAT_INFO', payload)
    state.userWechatInfo = payload
  },
  /**
   * 设置用户地理位置信息
   * @param state
   * @param payload
   */
  [types.SET_USER_POSITION] (state, payload) {
    state.userPosition = payload
  },
  /**
   * 设置用户地理位置经纬度信息
   * @param state
   * @param payload
   */
  [types.SET_USER_LAT_AND_LON] (state, payload) {
    state.userLatAndLon = payload
  }
}

export default mutations
