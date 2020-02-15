<template>
  <div class="container-fluid">
<!--    <h4> Visitors </h4>-->
   <!-- <router-link :to="{ name: 'visitors.add' }"> Add</router-link>  |
    <router-link :to="{ name: 'visitors.list' }"> List </router-link>  |
    <router-link :to="{ name: 'visitors.list_closed' }"> Checked Out </router-link>  |
    <router-link :to="{name: 'visitors.edit'}"> Edit | </router-link>-->

    <router-view></router-view>
  </div>
</template>
<script>
  export default {
    middleware: 'auth',

    name: 'Index'
  }
</script>

<style scoped>

</style>
