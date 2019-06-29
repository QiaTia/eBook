<template>
  <div class="shelf">
    <ul class="list">
        <li v-for="(item, index) in bookList" :key="index" @click="read(item.adders)">
          <div class="book-coer">
            <img v-if="item.coer" :src="item.coer" :alt="item.name" height="100%">
            <span class="icon-book" v-else></span>
          </div>
          <div class="book-info">
            <p class="book-name">{{ item.name }}</p>
            <p class="msg-info">未读</p>
          </div>
          <span class="icon-more icon-left icon" title='操作' @click="option(index)" @click.stop></span>
        </li>
      </ul>
  </div>
</template>

<script>
export default {
  name: 'shelf',
  data (){
    return{
      bookList: (localStorage.bookList !==undefined)?JSON.parse(localStorage.bookList):[{
          id:6,
          coer: false,
          name: 'HTTP权威指南',
          adders: './book/HTTPAuthoritativeGuide.epub'
        }]
    }
  },
  methods: {
    read(adders){
      this.$router.push({name:'reader',
        params: {
          adders: adders
        }
      })
    },
    option(index){
      this.bookList.splice(index, 1)
      localStorage.bookList = JSON.stringify(this.bookList)
    }
  },
}
</script>
<style scoped>
ul {list-style-type: none;padding: 0;text-align: left;box-sizing: border-box;}
.list>li{padding: 8px 5px;display: flex; font-size: 18px;line-height: 38px;cursor: pointer; position: relative;}
.list>li>.icon-left{position: absolute; /* bottom: 0px; */ right: 0px;font-size: 28px;transform: rotateZ(90deg);}
.list>li:hover{background-color: rgba(15, 15, 15, .05);}
.list>li>.book-coer{flex:0 0 53px; height: 71px;}
.list>li>.book-coer>span{font-size: 50px}
.list>li>.book-info{flex: 1; padding-left: 10px;border-bottom: 1px solid rgba(15, 15, 15, .15);}
.list>li:last-child>.book-info{border-bottom:none;}
.flex>li{display: inline-block;margin: 0 10px;font-size: 18px;line-height: 38px;cursor: pointer;}
.flex>li>.book-coer{flex:0 0 106px; height: 142px;}
.book-coer>span{font-size: 50px}
.book-name{color: #262626;font-size: 18px;}
.msg-info{color: #999;font-size: 14px;}
</style>