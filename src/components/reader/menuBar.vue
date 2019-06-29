<template>
  <div>
    <transition name="slide-up">
      <div class="menu-wrapper" v-show='ifTitleAndMenu'>
        <div class="icon-wrapper" @click="showSetting(3)" title="目录查看">
          <span class="icon-menu icon"></span>
        </div>
        <div class="icon-wrapper" @click="showSetting(2)" title="进度跳转">
          <span class="icon-progress icon"></span>
        </div>
        <div class="icon-wrapper"  @click="showSetting(1)" title="主题设置">
          <span class="icon-bright icon"></span>
        </div>
        <div class="icon-wrapper" @click="showSetting(0)" title="字体设置">
          <span class="icon-a icon">A</span>
        </div>
      </div>
    </transition>
    <transition name="slide-up">
      <div class="setting-wrapper" v-show="ifSettingShow">
        <div class="setting-font-size" v-if="showTag === 0">
          <div class="preview" :style="{fontSize:fontSizeList[0].fontSize + 'px'}">A</div>
          <div class="font-wrapper">
            <div class="select-wrapper" 
                  v-for="(item ,index) in fontSizeList" 
                  @click="setFontSize(item.fontSize)"
                  :key='index'>
              <div class="line"></div>
              <div class="point-wrapper">
                <div class="point" v-show="defaultFontSize  === item.fontSize">
                  <div class="small-point"></div>
                </div>
              </div>
              <div class="line"></div>
            </div>
          </div>
          <div class="preview" :style="{fontSize:fontSizeList[fontSizeList.length-1].fontSize + 'px'}">A</div>
        </div>
        <div class="setting-theme"  v-else-if="showTag === 1">
          <div class="setting-theme-item" 
              v-for="(item, index) in themesList" 
              :key="index" 
              @click="setTheme(index)"
              :class="{'border': item.name=='default'}">
            <div class="preview" 
                :style="{backgroundColor: item.style.body.background}"
                :class="{'select': defaultTheme === index}">
              <div class="text" :style="{color: item.style.body.color}">{{item.name}}</div>
            </div>
          </div>
        </div>
        <div class="setting-slider"  v-else-if="showTag === 2">
          <div class="slider-range">
            <input type="range"  step="1" min="0" max="100" 
                @change="onSliderChange($event.target.value)"
                @input="onSliderInput($event.target.value)"
                :value="progress" :disabled="!bookAvailable" ref="progress">
          </div>
          <div class="slider-text">{{ !bookAvailable ? '加载中~' : progress+' %' }}</div>
        </div>
      </div>
    </transition>
        <div class="menu-list" v-if="showTag === 3">
          <menu-list
              :bookAvailable="bookAvailable"
              :navigation="navigation"
              :ifMenuList="ifMenuList"
              @jumpTo="jumpTo"></menu-list>
          <transition name="mask-up">
            <div class="mask-box" v-show="ifMenuList" @click="hideSetting"></div>
          </transition>
        </div>
  </div>
</template>

<script>
import menuList from '@/components/reader/meunList'
export default {
  data (){
    return{
      ifSettingShow:false,
      showTag:0,
      progress:0,
      ifMenuList:false
    }
  },
  props: {
    ifTitleAndMenu: {
      type:Boolean,
      default:false
    },
    fontSizeList: Array,
    defaultFontSize:Number,
    themesList: Array,
    defaultTheme: Number,
    bookAvailable:Boolean,
    navigation:Object
  },
  methods: {
    jumpTo(href){
      this.$emit('jumpTo', href)
    },
    onSliderChange(progress){
      this.$emit('onSliderChange', progress)
    },
    onSliderInput(progress){
      this.progress = progress
      this.$refs.progress.style.backgroundSize = progress+'% 100%'
    },
    setTheme(index) {
      this.$emit('setTheme', index)
    },
    showSetting(tag) {
      this.showTag = tag
      if(tag === 3){
        this.ifSettingShow = false
        this.ifMenuList = true
        return false
      }
      this.ifSettingShow = true
    },
    hideSetting() {
      this.ifSettingShow = false
      this.ifMenuList = false
    },
    setFontSize(fontSize) {
      this.$emit('setFontSize', fontSize)
    }
  },
  components: {
    menuList
  }
};
</script>
<style scoped>
.slide-up-enter-to,.slide-up-leave{transform: translate3d(0, 0, 0)}
  .slide-up-enter-active, .slide-up-leave-active{transition: all .3s linear;}
  .slide-up-enter,.slide-up-leave-to{transform:translate3d(0, 108px, 0)}
.icon{color: #333;font-size: 20px;}
  .menu-wrapper{position: absolute;z-index: 101; left: 0; bottom: 0;width: 100%; height: 48px; display: flex; box-shadow: 0 -8px 8px rgba(0,0,0,.15); background-color: white;}
  .menu-wrapper>.icon-wrapper{flex:1; display: flex;justify-content: center;align-items: center; cursor: pointer;}
  .icon-wrapper>.icon-bright{font-size: 24px;}
  .icon-wrapper>.icon-progress{font-size: 28px;}

.setting-wrapper{position: absolute; z-index: 101; left: 0; bottom: 48px;height: 60px;width: 100%; background-color: white;box-shadow: 0 -8px 8px rgba(0, 0, 0,.15)}
  .setting-font-size{display: flex; height: 100%;}
  .setting-font-size>.preview{flex:0 0 40px; display: flex; justify-content: center;align-items: center; cursor: pointer;}
  .setting-font-size>.font-wrapper{flex:1;display: flex;}
  .setting-font-size>.font-wrapper>.select-wrapper{flex: 1;display: flex;align-items: center;}
  .select-wrapper>.line{flex:1;height: 0; border-top: 1px solid #ccc;}
  .select-wrapper>.point-wrapper{flex: 0 0 0; width: 0; height: 10px; border-left: 1px solid #ccc;}
  .font-wrapper>.select-wrapper:first-child>.line:first-child{border-top: none;}
  .font-wrapper>.select-wrapper:last-child>.line:last-child{border-top:none;}
  .point-wrapper{position: relative;}
  .point{position: absolute;top: -8px;left: -10px;height: 20px;width: 20px; border-radius: 50%;background-color: white;border: #eee solid 1px; box-shadow: 0 4px 4px rgba(0, 0, 0, .15);display: flex; justify-content: center;align-items: center; cursor: pointer;}
  .small-point{height: 5px; width: 5px; border-radius: 50%;background-color: black;}
  .setting-theme{width: 100%;height: 100%;display: flex;}
  .setting-theme-item{flex:1; display: flex; flex-direction: column;font-size: 18px;padding: 3px; cursor: pointer;}
  .preview{flex:1;border-radius: 5px;display: flex; justify-content: center;align-items: center; opacity: .55;}
  .select{opacity: 1;}
  .border>.preview{border: #eee solid 1px;}

.setting-slider>.slider-range{box-sizing: border-box;width: 100%;height: 100%;}
  .setting-slider>.slider-range>input{ width: 94%; height: 2px; -webkit-appearance: none; background: -webkit-linear-gradient(#999, #999) no-repeat,#ddd;background-size: 0% 100%;}
  .slider-range>input:focus{outline: none;}
  .slider-range>input::-webkit-slider-thumb{-webkit-appearance: none;height: 20px;width: 20px; border-radius: 50%;background-color: white; box-shadow: 0 4px 4px rgba(0, 0, 0, .15);border: 1px solid #ddd; cursor: pointer;}
  .setting-slider>.slider-text{font-size: 14px;line-height: 19px;}
.mask-box{position: fixed; top: 0;left: 0; width: 100%;height: 100%; z-index: 101; background-color: rgba(51, 51, 51, .77);}
  .mask-up-to,.mask-up-leave{opacity: 1;}
  .mask-up-enter-active, .mask-up-leave-active{transition: all .3s linear;}
  .mask-up-enter, .mask-up-leave-to{opacity: 0;}
</style>