<template> 
  <div>
    <transition name="slide-down">
      <div class="title-wrapper" v-show='ifTitleAndMenu'>
        <div class="left">
          <div class="icon-wrapper" @click="backHome" title="退出阅读">
            <span class="icon-back icon"></span>
          </div>
        </div>
        <div class="right">
          <!-- <div class="icon-wrapper">
            <span class="icon-cart icon"></span>
          </div>
          <div class="icon-wrapper">
            <span class="icon-person icon" title="个人中心"></span>
          </div> -->
          <div class="icon-wrapper">
            <span class="icon-more icon dropdown">
              <ul class="dropdown-meun">
                <li><a href="javascript:;">更多信息</a></li>
                <li><a href="javascript:;">全文搜索</a></li>
                <li><a href="javascript:;">退出阅读</a></li>
              </ul>
            </span>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
export default {
  props: {
    ifTitleAndMenu: {
      type:Boolean,
      default:false
    }
  },
  methods: {
    backHome() {
      this.$emit('backHome')
    }
  }
}
</script>
<style scoped>
.dropdown:hover>.dropdown-meun{display: block;}
.dropdown-meun{position: relative;z-index: 102; box-sizing: border-box; width: 200%;margin-left: -100%;border: solid 1px rgba(15,15,15,.15); box-shadow:-1px 1px 8px rgba(15,15,15,.15); display: none;margin-top: 66px;background-color: white;line-height: 2rem;font-size: 16px;}
.dropdown-meun>li{padding: 2px 5px; border-bottom:1px solid rgba(15,15,15,.15);}
.dropdown-meun>li:hover{background-color: rgba(15,15,15,.15)}
.dropdown-meun>li:last-child{border-bottom:none;}
.dropdown-meun>li>a{color: #555; text-decoration: none;}
.slide-down-enter,.slide-down-leave-to{transform:translate3d(0, -100%, 0)}
  .slide-down-enter-to, .slide-down-leave{transform: translate3d(0, 0, 0)}
  .slide-down-enter-active, .slide-down-leave-active{transition: all .3s linear;}

.title-wrapper{z-index: 101;position: absolute;top: 0; left: 0; width: 100%;height: 48px;display: flex;background-color: white;box-shadow: 0 8px 8px rgba(0,0,0,.15);}
.icon{color: #333;font-size: 20px;}
.left{flex:0 0 60px; display: flex; justify-content: flex-start;}
.right{flex:1; display: flex; justify-content: flex-end;}
.icon-wrapper{flex: 0 0 40px; display: flex;justify-content: center;align-items: center; cursor: pointer;}
.icon-cart{font-size: 22px;}

</style>