import { getAppLoginToken, getUserLatAndLon, getUserPosition } from '@/utils/ccwbApp'

const state = {
  userWechatInfo: window.sessionStorage.getItem('USER_WECHAT_INFO') || '',
  userInfo: getAppLoginToken(), // 获取用户 token
  userPosition: getUserPosition(),
  userLatAndLon: getUserLatAndLon(),
  showLogin: false,
  isLoading: false, // loading状态
  direction: 'forward' // 页面切换状态
}

export default state
