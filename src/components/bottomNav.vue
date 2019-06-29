<template>
  <div class="nav">
    <div class="nav-wrapper" @click="nav('shelf')">
      <span class="icon-book icon"></span>
      <p>书架</p>
    </div>
    <div class="nav-wrapper" @click="nav('store')">
      <span class="icon-cart icon"></span>
      <p>Online</p>
    </div>
    <div class="nav-wrapper" @click="nav('user')">
      <span class="icon-person icon"></span>
      <p>我</p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'bottomNav',
  methods: {
    nav(name){
      this.$emit('nav', name)
    }
  },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.nav{position: fixed; display: flex;bottom: 0; height: 48px;width: 100%;background-color: #eee; border-top: 1px solid #999;}
  .nav-wrapper{flex:1;font-size: 26px; line-height: 30px; justify-content: center;align-items: center; cursor: pointer;}
  .nav-wrapper>p{font-size: 15px;line-height: 18px;}
  .nav-wrapper:hover{background-color: rgba(0, 0, 0, .15);color: #ff4081;}
  .nav>.nav-wrapper{border-right: 1px solid rgba(15, 15, 15, .15);}
  .nav>.nav-wrapper:last-child{border-right: none;}
</style>
