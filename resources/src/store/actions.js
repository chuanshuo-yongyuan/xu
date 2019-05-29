import { request } from '@/libs/api/request'
import { getUserLatAndLon, getUserPosition, getAppLoginToken } from '@/utils/ccwbApp'
import { getDevice } from '../utils/util'

/**
 * 获取用户地址列表
 * @param commit
 * @param state
 */
export function getAddressList ({ commit, state }) {
  // 当用户没有登录的时候,就不获取
  if (state.userInfo) {
    // 在这做异步操作
    request('addressList').then(res => {
      commit('SET_USER_ADDRESS', res.data)
    })
  }
  return false
}

export function getUserPositionInfo ({ commit, state }) {
  if (!state.userPosition || !state.position) {
    if (getDevice().isCwApp) {
      let position = getUserLatAndLon()
      let positionInfo = getUserPosition()
      commit('SET_USER_POSITION', positionInfo)
      commit('SET_USER_LAT_AND_LON', position)
    } else {
      //  如果通过APP获取不到地图信息,则调用百度地图API获取
      const geolocation = new BMap.Geolocation({    // eslint-disable-line
        maximumAge: 10 // 清除缓存
      })
      geolocation.getCurrentPosition(function (r) {
        if (this.getStatus() == BMAP_STATUS_SUCCESS) { // eslint-disable-line
          let position = {
            latitude: r.point.lat,
            longitude: r.point.lng
          }
          let positionInfo = {
            province: r.address.province,
            city: r.address.city,
            district: r.address.district,
            latitude: r.latitude,
            longitude: r.longitude,
            address: r.address.street ? r.address.street : '我的位置'
          }
          commit('SET_USER_POSITION', positionInfo)
          commit('SET_USER_LAT_AND_LON', position)
        }
      })
    }
  }
}

export function getUserInfo ({ commit, state }) {
  return new Promise(resolve => {
    const token = getAppLoginToken()
    commit('SET_USER_INFO', token)
    resolve(state.userInfo)
  })
}
