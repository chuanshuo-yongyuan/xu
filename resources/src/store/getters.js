/**
 * 获取用户登录状态
 * @param state
 * @returns {boolean}
 */
export const showLogin = state => state.showLogin

/**
 * 获取用户登录信息
 * @param state
 * @returns {*}
 */
export const userInfo = state => state.userInfo

/**
 * 获取用户微信信息
 * @param state
 * @returns {string}
 */
export const userWechatInfo = state => state.userWechatInfo
