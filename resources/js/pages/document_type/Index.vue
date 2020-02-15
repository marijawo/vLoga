<template>
<div class="container">
<!--<h4> Document Types </h4>

  <router-link :to="{ name: 'document_types.add' }"> Add </router-link>
  <router-link :to="{ name: 'document_types.list' }"> List </router-link>
  <router-link :to="{ name: 'document_types.edit' }"> Edit </router-link>-->
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
