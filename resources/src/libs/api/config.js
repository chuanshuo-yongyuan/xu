import { BASE_REQUEST_URL, BASE_REQUEST_TEST_URL } from '@/config'

const ApiConfig = window.ApiConfig || {}

/** 主请求域名**/
ApiConfig.domain = process.env.NODE_ENV === 'production' ? BASE_REQUEST_URL : BASE_REQUEST_TEST_URL

export default ApiConfig
