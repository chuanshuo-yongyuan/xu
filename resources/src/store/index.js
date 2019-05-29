import Vue from 'vue'
import Vuex from 'vuex'
import state from './state' // 状态管理
import * as actions from './actions'
import * as getters from './getters' // 获取 state 的值
import mutations from './mutations' // 修改 state 的值
import createLogger from 'vuex/dist/logger'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  actions,
  getters,
  state,
  mutations,
  strict: debug,
  plugins: debug ? [createLogger()] : []
})
