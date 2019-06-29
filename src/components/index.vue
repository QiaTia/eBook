<template>
  <div class="index">
    <top-nav :title="title"></top-nav>
    <router-view style="margin-top:48px"></router-view>
    <bottom-nav @nav="nav"></bottom-nav>
  </div>
</template>
<script>
import bottomNav from '@/components/bottomNav'
import topNav from '@/components/topNav'
export default {
  name: 'app',
  data (){
    return{
      title:'Ebook'
    }
  },
  methods: {
    nav(name){
      this.title = name
      this.$router.push({name:name})
    }
  },
  components: {
    bottomNav,
    topNav
  }
}
</script>

<style scoped>
</style>