<template>
  <div class="nav">
    <h2>{{title}}</h2>
  </div>
</template>

<script>
export default {
  name: 'topNav',
  props: {
    title: String
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.nav{position: fixed; display: flex;top: 0; height: 48px;width: 100%;}
  h2{line-height: 48px;font-size: 24px;margin: 0 auto;}
</style>
