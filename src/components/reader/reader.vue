<template>
  <div class="ebook">
    <!-- <router-link to='/'><h1> <span class="icon-back"></span> {{ msg }}</h1></router-link> -->
    <title-bar 
        :ifTitleAndMenu="ifTitleAndMenu"
        @backHome='backHome'
        ref="titleBar"></title-bar>
    <div class="read-wrapper">
      <div id="read">
        <div class="loading" v-show="!bookAvailable"></div>
      </div>
      <div class="mask">
        <div class="left" @click="lastPre" title="向上翻页"></div>
        <div class="center" @click="toggleMeunAndTitle" title="呼出菜单"></div>
        <div class="right" @click="nextPre" title="向下翻页"></div>
      </div>
    </div>
    <menu-bar 
        :ifTitleAndMenu="ifTitleAndMenu"
        :fontSizeList="fontSizeList"
        :defaultFontSize='defaultFontSize'
        @setFontSize='setFontSize'
        :themesList="themesList"
        :defaultTheme = 'defaultTheme'
        @setTheme = "setTheme"
        :bookAvailable="bookAvailable"
        @onSliderChange="onSliderChange"
        @jumpTo="jumpTo"
        :navigation='navigation'
        ref="menuBar"></menu-bar>
  </div>
</template>

<script>
import Epub from 'epubjs'
global.ePub = Epub
import titleBar from'@/components/reader/titleBar'
import menuBar from'@/components/reader/menuBar'
export default {
  data (){
    return{
      defaultData: (localStorage.reader !==undefined)?JSON.parse(localStorage.reader):{},
      ifTitleAndMenu:false,
      fontSizeList: [
        {fontSize: 13},
        {fontSize: 16},
        {fontSize: 18},
        {fontSize: 20},
        {fontSize: 23},
        {fontSize: 26},
        {fontSize: 29}
      ],
      defaultFontSize:16,
      themesList: [
        {
          name: 'default',
          style: {
            body: {
              'color': "#262626", 'background': '#fff'
            }
          }
        },
        {
          name: 'novel',
          style: {
            body: {
              'color': "#262626", 'background': '#f3e9c6'
            }
          }
        },
        {
          name: 'eye',
          style: {
            body: {
              'color': "#444", 'background': '#ceeaba'
            }
          }
        },
        {
          name: 'night',
          style: {
            body: {
              'color': "#999", 'background': '#000'
            }
          }
        }
      ],
      defaultTheme:0,
      bookAvailable:false
    }
  },
  methods: {
    jumpTo(href){
      this.hideTitleAndMenu()
      this.rendition.display(href)
    },
    hideTitleAndMenu(){
      this.ifTitleAndMenu = false
      this.$refs.menuBar.hideSetting()
      //this.$refs.titleBar.hideSetting()
    },
    backHome() {
      this.$router.back(-1)
      this.$router.push({name:'index'})
    },
    setTheme(index) {
      this.defaultTheme = index
      this.themes.select(this.themesList[index].name)
      this.defaultData.defaultTheme = index
      localStorage.reader = JSON.stringify(this.defaultData)
    },
    registerTheme() {
      this.themesList.forEach(theme =>{
        this.themes.register(theme.name , theme.style)
      })
    },
    //解析渲染
    showEpub (){
      // 获取传入的书籍地址
      if(!this.$route.params.adders == undefined || !this.$route.params.adders == ''){
        this.DOWNLOAD_URL = this.$route.params.adders
        this.defaultData.DOWNLOAD_URL = this.DOWNLOAD_URL
        localStorage.reader = JSON.stringify(this.defaultData)
      }else if("DOWNLOAD_URL" in this.defaultData){
        this.DOWNLOAD_URL = this.defaultData.DOWNLOAD_URL
      }else{
        alert('书籍打开失败，请返回重试')
        this.$router.push({name:'index'})
        return false
      }
      //生成book对象
      this.book = new Epub(this.DOWNLOAD_URL)
      //生成Rendtion,book.renderTo
      this.rendition = this.book.renderTo('read', {
        width: window.innerWidth,
        height: window.innerHeight
      })
      //通过Rendtion.display渲染电子书
      this.rendition.display()
      // 获取themes
      this.themes = this.rendition.themes
      // 获取本地保存字体 设置默认字体
      this.defaultFontSize = ("fontSize" in this.defaultData)?this.defaultData.fontSize:this.defaultFontSize
      this.setFontSize(this.defaultFontSize)
      // 遍历主题
      this.registerTheme()
      // 本地保存主题
      this.defaultTheme = ("defaultTheme" in this.defaultData)?this.defaultData.defaultTheme:this.defaultTheme
      // 设置默认主题
      this.setTheme(this.defaultTheme)
      // 获取location对象
      this.book.ready.then(()=>{
        // 获取目录信息
        this.navigation = this.book.navigation
        return this.book.locations.generate()
      }).then(()=>{
        this.locations = this.book.locations
        this.bookAvailable = true
      })
    },
    // progress 进度值 0-100
    onSliderChange(progress){
      const percentage = progress / 100
      const location = percentage > 0 ? this.locations.cfiFromPercentage(percentage) : 0
      this.rendition.display(location)
    },
    nextPre(){
      //code
      if(this.rendition){
        this.rendition.next()
      }
      //console.log(this.book.locations)
      this.hideTitleAndMenu()
    },
    lastPre(){
      //code
      if(this.rendition){
        this.rendition.prev()
      }
      this.hideTitleAndMenu()
    },
    toggleMeunAndTitle(){
      //code
      this.ifTitleAndMenu = !this.ifTitleAndMenu
      if(!this.ifTitleAndMenu) {
        this.$refs.menuBar.hideSetting()
      }
    },
    setFontSize(fontSize){
      this.defaultFontSize = fontSize
      this.defaultData.fontSize = fontSize
      localStorage.reader = JSON.stringify(this.defaultData)
      this.themes.fontSize(fontSize + 'px')
    }
  },
  mounted (){
    this.showEpub()
  },
  components:{
    titleBar,
    menuBar
  }
}
</script>
<style scoped>
.ebook{position: relative; }
.read-wrapper>.mask{position: absolute;top: 0; left: 0; width: 100%; height: 100%;z-index: 100;display: flex;}
.mask>.left,.mask>.right{flex:0 0 30%;}
.mask>.center{ flex:1;}

.loading{position: fixed; top: calc(50% - 50px);left: calc(50% - 50px); z-index: 8;}
</style>