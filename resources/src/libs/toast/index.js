import './toast.css'
import { toast, loading } from './toast'

class Toast {
  static install (Vue, options) {
    Vue.prototype.$toast = toast
    Vue.prototype.$loading = loading
  }
}

export default Toast
