<template>
  <div class="home">
    <van-cell-group>
      <van-cell :title="item.step" :value="item.create_time" :label="item.message" v-for="(item,index) in lists"
                :key="index"/>
    </van-cell-group>

    <van-button type="primary" size="small" @click="show = true">新增</van-button>
    <van-button type="info" size="small" @click="showTime = true">选择时间</van-button>

    <van-dialog
      v-model="show"
      title="录入"
      show-cancel-button
      @confirm="confirm" size="small"
    >
      <van-field clearable  number="number" v-model="step" placeholder="请输入新的步数~"/>
      <van-field clearable  number="textarea" v-model="message" placeholder="当是的消息描述~"
                 :autosize="{ maxHeight: 100, minHeight: 50 }"/>
    </van-dialog>

    <van-datetime-picker
      v-show="showTime"
      v-model="currentDate"
      type="date"
      @confirm="confirmTime"
      @cancel="cancelTime"
      :min-date="minDate"
      :max-date="maxDate"
      class="datetime-picker"
    />

  </div>
</template>

<script>
import { patternTime } from '../utils/util'

export default {
  name: 'home',
  data () {
    return {
      lists: [],
      step: '',
      message: '',
      time: '',
      showTime: false,
      show: false,
      minDate: new Date(2019, 1, 30),
      maxDate: new Date(2025, 12, 31),
      currentDate: new Date()
    }
  },
  computed: {},
  created () {
    this.getLists()
  },
  methods: {
    confirm () {
      this.$request('add', { step: this.step, message: this.message }).then(res => {
        if (res.code === 200) {
          this.getLists()
        } else {
          this.$toast(res.message)
        }
      })
    },
    getLists () {
      this.$request('lists', {
        time: this.time
      }).then(res => {
        this.lists = res.data
      })
    },
    confirmTime (e) {
      this.time = patternTime(e)
      this.getLists()
      this.showTime = false
    },
    cancelTime () {
      this.showTime = false
    }
  }
}
</script>
<style lang="less">
  .datetime-picker {
    position: fixed;
    width: 100%;
    bottom: 0;
    left: 0;
  }

  .van-col {
    margin-bottom: 10px;
    font-size: 13px;
    line-height: 30px;
    text-align: center;
    background-clip: content-box;

    &:nth-child(odd) {
      background-color: #39a9ed;
    }

    &:nth-child(even) {
      background-color: #66c6f2;
    }
  }
</style>
