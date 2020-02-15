<template>
  <div class="container">
    <!--<h4>Departments</h4>
    <router-link :to="{ name: 'departments.add' }"> Add</router-link>
    <router-link :to="{ name: 'departments.list' }"> List</router-link>
    <router-link :to="{ name: 'departments.edit' }"> Edit</router-link>-->

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
