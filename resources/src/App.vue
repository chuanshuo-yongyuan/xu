<template>
  <div id="app">
    <transition :name="'router-' + (direction === 'forward' ? 'in' : 'out')">
      <div>
        <keep-alive>
          <router-view v-if="$route.meta.keepAlive"></router-view>
        </keep-alive>
        <router-view v-if="!$route.meta.keepAlive"></router-view>
      </div>
    </transition>
    <loading type="spinner" class="loading" v-show="isLoading"/>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import { Loading } from 'vant'

export default {
  name: 'app',
  components: {
    Loading
  },
  computed: {
    ...mapState([
      'isLoading',
      'direction',
      'showLogin'
    ])
  },
  mounted () {
    // this.$post('https://appkp.ccwb.cn/api/v1/news/getNewsDetailRelated', { cw_news_id: '201903291754091CKMIV' })
    // this.$post('https://appkp.ccwb.cn/api/v1/news/getNewsCommentLists', { cw_news_id: '201903291754091CKMIV' })
    // this.$post('https://appkp.ccwb.cn/api/v1/news/getNewsDetail', { cw_news_id: '201903291754091CKMIV' })
    this.$toast('vant  toast')
  }
}
</script>
<style>
  body {
    background-color: #fbf9fe;
  }

  .router-out-enter-active,
  .router-out-leave-active,
  .router-in-enter-active,
  .router-in-leave-active {
    will-change: transform;
    transition: all 500ms;
    height: 100%;
    position: absolute;
    backface-visibility: hidden;
    perspective: 1000;
  }

  .router-out-enter {
    opacity: 0;
    transform: translate3d(-100%, 0, 0);
  }

  .router-out-leave-active {
    opacity: 0;
    transform: translate3d(100%, 0, 0);
  }

  .router-in-enter {
    opacity: 0;
    transform: translate3d(100%, 0, 0);
  }

  .router-in-leave-active {
    opacity: 0;
    transform: translate3d(-100%, 0, 0);
  }

  .slide-enter-active,
  .slide-leave-active {
    transition: all 0.3s;
  }

  .slide-enter,
  .slide-leave-to {
    transform: translate3d(100%, 0, 0);
  }

  .loading {
    position: fixed;
    margin-top: -15px;
    margin-left: -15px;
    top: 50%;
    left: 50%
  }
</style>
