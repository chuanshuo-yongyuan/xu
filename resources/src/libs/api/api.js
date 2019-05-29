import store from '@/store'
import axios from 'axios'
import ApiConfig from './config'

/**
 * 初始化 axios 的一些配置
 * @type {{baseUrl: *, timeout: number, headers: {"Content-Type": string, "X-Requested-With": string}, transformRequest: *[], responseType: string}}
 */
const config = {
  baseURL: ApiConfig.domain,
  timeout: 200000,
  headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'X-Requested-With': 'XMLHttpRequest' },
  transformRequest: [function (data) {
    // 这里可以在发送请求之前对请求数据做处理，比如form-data格式化等，这里可以使用开头引入的Qs（这个模块在安装axios的时候就已经安装了，不需要另外安装）
    let ret = ''
    for (let it in data) {
      ret += encodeURIComponent(it) + '=' + encodeURIComponent(data[it]) + '&'
    }
    return ret
  }],
  responseType: 'json'
}
/**
 * 花开不同赏，花落不同悲.欲问相思处，花开花落时.
 * @type {AxiosInstance}
 */
const AxiosInit = axios.create(config)

/**
 * axios 请求拦截器,目前主要用户传递api 请求头
 */
AxiosInit.interceptors.request.use((config) => {
  const authToken = store.state.userInfo
  if (authToken) {
    config.headers.Authorization = authToken
  }
  return config
}, (err) => {
  return Promise.reject(err)
})

/**
 * axios 相应拦截器
 */
AxiosInit.interceptors.response.use((response) => {
  return response
}, (error) => {
  return Promise.reject(error)
})
export default AxiosInit
