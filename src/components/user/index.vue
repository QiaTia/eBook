<template>
  <div>
    <header>
      <div class="background"></div>
      <img src="user.jpg" alt="favicon">
      <h1>{{ msg }}</h1>
    </header>
  </div>
</template>

<script>
export default {
  name: 'user',
  data() {
    return{
      msg: '作者还在努力中~请期待'
      }
  }
}
</script>
<style scoped>
header{margin-top: -48px;}
header>.background{
  background-image:linear-gradient(to bottom,#576173,#eee);
  background-position: 50% top;
  background-size: 50% 100%;
  background-color: #f1f1f1;
  padding-top: 50px;
  height: 150px;
}
header>img{
  width: 120px;
  height: 120px;
  margin-top: -80px;
  border-radius: 50%;
  border: 3px solid #f1f1f1; 
}
h1{color: #42b983;}
</style>