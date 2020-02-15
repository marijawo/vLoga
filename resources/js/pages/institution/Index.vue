<template>
  <div>
<!--    <h4> Institutions </h4>-->
    <!--<router-link :to="{ name: 'institutions.add' }"> Add</router-link>  |
    <router-link :to="{ name: 'institutions.list' }"> List </router-link>  |
    <router-link :to="{name: 'institutions.edit'}"> Edit | </router-link>-->
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
