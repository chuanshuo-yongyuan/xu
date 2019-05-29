import { request, apiGet, apiPost, response } from './request'

class Http {
  static install (Vue) {
    Vue.prototype.$request = request
    Vue.prototype.$post = apiPost
    Vue.prototype.$get = apiGet
    Vue.prototype.$response = response
    Vue.http = {
      $request: request,
      $post: apiPost,
      $get: apiGet,
      $response: response
    }
  }
}

export default Http
