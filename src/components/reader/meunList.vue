<template>
  <div class="meunList">
    <transition name="slide-show">
      <div class="list"  v-show="ifMenuList">
        <div class="loading"></div>
        <ul v-if="bookAvailable">
          <li v-for="(item, index) in navigation.toc" :key="index" @click="jumpTo(item.href)">{{ item.label }}</li>
        </ul>
        <h3 v-else> 加载中~请稍等 </h3>
      </div>
    </transition>
  </div>
</template>

<script>
export default {
  props: {
    bookAvailable:Boolean,
    navigation:Object,
    ifMenuList:Boolean
  },
  methods: {
    jumpTo(href){
      this.$emit('jumpTo', href)
    }
  }
}
</script>
<style scoped>
  .slide-show-enter, .slide-show-leave-to{transform: translate3d(-100%, 0 , 0);}
  .slide-show-to,.slide-show-leave{transform: translate3d(0, 0 , 0);}
  .slide-show-enter-active, .slide-show-leave-active{transition: all .3s linear;}
  .list{position: fixed; top: 0;left: 0; width: 73%;height: 100%; max-width: 500px;background-color: white;z-index: 102;box-shadow: 8px 0 8px rgba(0, 0, 0,.15); overflow-y: auto;}
  ul{width: 100%;padding: 8px 16px; box-sizing: border-box;}
  li{font-size: 16px; text-align: left;padding: 12px 0; cursor: pointer; border-bottom: 1px solid #ccc; box-sizing: border-box;}
  li:hover{background-color: #eee;}
  li:last-child{border: none;}
  .loading{position: static; margin: 16px auto;}
</style>