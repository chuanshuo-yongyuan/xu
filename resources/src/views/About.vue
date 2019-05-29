<template>
  <div class="about">
    <h1>This is an about page</h1>
    <router-link to="/">home</router-link>

        <van-button type="default">默认按钮</van-button>
        <van-button type="primary">主要按钮</van-button>
        <van-button type="info">信息按钮</van-button>
        <van-button type="warning">警告按钮</van-button>
        <van-button type="danger">危险按钮</van-button>

    <cell-group>
      <cell title="单元格" value="内容"/>
      <cell title="单元格" value="内容" label="描述信息"/>
    </cell-group>
  </div>
</template>
<script>
// @ is an alias to /src
import { Button, Cell, CellGroup } from 'vant'

const VanButton = Button
export default {
  name: 'home',
  components: {
    VanButton,
    Cell,
    CellGroup
  },
  methods: {
    redirect () {
      console.log(123)
      this.$router.push('/about')
    }
  }
}
</script>
