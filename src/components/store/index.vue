<template>
  <div class="shelf">
    <ul class="list">
        <li v-for="(item, index) in bookList" :key="index" @click="open(item)">
          <div class="book-coer">
            <img v-if="item.coer" :src="item.coer" :alt="item.name" height="100%">
            <span class="icon-book" v-else></span>
          </div>
          <div class="book-info">
            <p class="book-name">{{ item.name }}</p>
          </div>
        </li>
      </ul>
  </div>
</template>

<script>
export default {
  name: 'store',
  data (){
    return{
      bookList: [
        {id:1,coer: './coer/94a6f109-940a-4329-a3df-dacceed921b6.jpg',name:'AgileProcessesInSoftwareEngine',adders:'./book/2018_Book_AgileProcessesInSoftwareEngine.epub'},
        {id:2,coer: './coer/c1347988-0bca-4142-b065-a93fb36a4784.jpg',name: '姐姐有妖气',adders: './book/1012826273.epub'},
        {id:3,coer: './coer/d0663ed7-3f5a-4f53-9f02-e0bfc9c84cb7.jpg',name: '重生之跨国巨头',adders: './book/1011587607.epub'},
        {id:5,coer: './coer/39b03706-9466-41d1-94b8-b2c045a9fb05.jpg',name: '我要出租自己',adders: './book/1012447094.epub'},
        {id:6,coer: false,name: 'HTTP权威指南',adders: './book/HTTPAuthoritativeGuide.epub'},
        {id:7,coer: './coer/JavaScriptCode.png',name: '超实用的JavaScript代码片段',adders: './book/JavaScriptCode.epub'},
      ]
    }
  },
  methods: {
    open(info){
      this.$router.push({name:'bookInfo',
        params: {
          info: info
        }
      })
    },
    getBookList(){
      this.axios.get('./api/').then((response)=>{
        this.bookList = response.data
      })
      .catch(function (error) {
        // handle error
        console.log(error);
      })
    }
  },
  mounted() {
    this.getBookList()
  }
}
</script>
<style scoped>
ul {list-style-type: none;padding: 0;text-align: left;box-sizing: border-box;}
.list>li{padding: 8px 5px;display: flex; font-size: 18px;line-height: 38px;cursor: pointer;border-bottom: 1px solid rgba(15, 15, 15, .15);}
.list>li:hover{background-color: rgba(15, 15, 15, .05);}
.list>li>.book-coer{flex:0 0 53px; height: 71px;}
.list>li>.book-coer>span{font-size: 50px}
.list>li>.book-info{flex: 1; padding-left: 10px;}
.list>li:last-child{border-bottom:none;}
.book-coer>span{font-size: 50px}
.book-name{color: #262626;font-size: 18px;}
.msg-info{color: #999;font-size: 14px;}
</style>