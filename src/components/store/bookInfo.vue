<template>
  <div class="book-info">
    <header>
      <div class="top-nav">
        <div class="left">
          <div class="icon-wrapper" @click="back" title="退出阅读">
            <span class="icon-back icon"></span>
          </div>
        </div>
        <div class="right">
          <div class="icon-wrapper">
            <span class="icon-more icon dropdown"></span>
          </div>
        </div>
      </div>
      <div class="book-coer">
        <img v-if="bookInfo.coer" :src="'../../'+bookInfo.coer" :alt="bookInfo.name" height="100%">
        <span class="icon-book" v-else></span>
      </div>
      <h2>{{ bookInfo.name }}</h2>
    </header>
    <footer class="fix-footer">
      <div class="wrapper" :class="{'disabled':isExist}" @click="addShelf">
        <span class="icon icon-done"></span>{{ isExist?'已在书架':'加入书架' }}
      </div>
      <div class="wrapper" @click="read">
        <span class="icon icon-read"></span>立即阅读
      </div>
    </footer>
  </div>
</template>

<script>
export default {
  data() {
    return{
      bookInfo:'',
      bookList: (localStorage.bookList !==undefined)?JSON.parse(localStorage.bookList):[{
          id:6,
          coer: false,
          name: 'HTTP权威指南',
          adders: './book/HTTPAuthoritativeGuide.epub'
        }],
      defaultData: (localStorage.reader !==undefined)?JSON.parse(localStorage.reader):{},
      isExist: false
    }
  },
  methods: {
    showInfo(){
      if(!this.$route.params.info == undefined || !this.$route.params.info == ''){
        this.bookInfo = this.$route.params.info
      }else if("bookInfo" in this.defaultData){
        this.bookInfo = this.defaultData.bookInfo
      }else{
        alert('书籍信息获取失败，请返回重试')
        this.$router.push({name:'index'})
        return false
      }
      let i=0,j=this.bookList.length
      for(i; i<j; i++){
        if(this.bookList[i].id === this.bookInfo.id){
          this.isExist = true
        }
      }
      this.defaultData.bookInfo = this.bookInfo
      localStorage.reader = JSON.stringify(this.defaultData)
    },
    read(){
      this.$router.push({name:'reader',
        params: {
          adders: this.bookInfo.adders
        }
      })
    },
    addShelf() {
      if(this.isExist){
        return false
      }
      this.bookList.push(this.bookInfo)
      localStorage.bookList = JSON.stringify(this.bookList)
      this.isExist = true
    },
    back() {
      this.$router.back(-1)
      this.$router.push({name:'index'})
    },
  },
  mounted() {
    this.showInfo()
  }
}
</script>
<style scoped>
header{
  background-image:linear-gradient(to bottom,#576173,#eee);
  background-position: 50% top;
  background-size: 50% 100%;
  background-color: #f1f1f1;
  padding-top: 50px;
}
.disabled{    background-color: #FBFBFB;color: #C9C9C9;cursor: not-allowed;opacity: 1;}
.top-nav{position: fixed;top: 0; left: 0; width: 100%;height: 48px;display: flex;}
.icon{color: #333;font-size: 20px;}
.left{flex:0 0 60px; display: flex; justify-content: flex-start;}
.right{flex:1; display: flex; justify-content: flex-end;}
.icon-wrapper{flex: 0 0 40px; display: flex;justify-content: center;align-items: center; cursor: pointer;}
.book-coer>span{font-size: 200px;}
.book-coer>img{height: 240px;}
header>h2{line-height: 42px;font-size: 24px;}
.fix-footer{border-top: 1px solid rgba(15, 15, 15, .15); position: fixed;background-color: white; bottom: 0px;line-height: 48px; height: 48px;display: flex;width: 100%;}
.fix-footer>.wrapper{flex:1;}
.fix-footer>.wrapper:hover{background-color: rgba(15, 15, 15, .15);}
.fix-footer>.wrapper{border-right: 1px solid rgba(15, 15, 15, .15);}
.fix-footer>.wrapper>.icon{font-size: 14px;}
.fix-footer>.wrapper:last-child{border-right: none;}
</style>