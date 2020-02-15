<template>
  <div class="container-fluid">
    <!--<h4> Nationalities </h4>
    <router-link :to="{ name: 'nationalities.add' }"> Add</router-link>  |
    <router-link :to="{ name: 'nationalities.list' }"> List </router-link>  |
    <router-link :to="{name: 'nationalities.edit'}"> Edit | </router-link>-->
    <router-view></router-view>
  </div>
</template>

<script>

  export default {
    middleware: 'auth',

  }

</script>

<style scoped>

</style>
