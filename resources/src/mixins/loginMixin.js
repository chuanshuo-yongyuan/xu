import { mapMutations, mapGetters } from 'vuex'

export default {
  created () {
  },
  computed: {
    ...mapGetters([
      'userInfo'
    ])
  },
  methods: {
    checkLogin () {
      if (!this.userInfo) {
        this.showLogin(true)
        return false
      }
      return true
    },
    ...mapMutations({
      showLogin: 'SET_SHOW_LOGIN'
    })
  }
}
