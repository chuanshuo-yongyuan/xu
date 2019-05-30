import user from './urlMap/user'

const apiUrlMap = {
  ...user,
  add: { url: 'add', method: 'post' },
  lists: { url: 'lists', method: 'get' }
}

export default apiUrlMap
