<template>
  <div>
    <!-- <h4>Employees </h4>
    -<router-link :to="{ name: 'employees.add' }"> Add</router-link>  |
     <router-link :to="{ name: 'employees.list' }"> List </router-link>  |
     <router-link :to="{name: 'employees.edit'}"> Edit | </router-link>-->

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
