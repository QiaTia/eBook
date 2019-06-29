<template>
  <div id="app">
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: 'app'
}
/* document.addEventListener('DOMContentLoaded',()=>{
  const html = document.querySelector('html')
  let fontSize = window.innerWidth / 10
  fontSize = (fontSize>50)?50:fontSize
  html.style.fontSize = fontSize +'px'
}) */
</script>

<style>
#app {
  font-family: PingFangSC-Regular,HelveticaNeue-Light,'Helvetica Neue Light','Microsoft YaHei',sans-serif;;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
.loading{width: 100px;height: 100px; margin: auto; border-radius: 50%;background-color: rgba(0, 0, 0, 0); box-shadow: 2px 2px 2px #ff4081; animation:loading 3s infinite}
  @keyframes loading{ from {transform: rotate(0deg)} to {transform: rotate(360deg)} }
</style>
