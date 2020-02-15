<template>
  <div>
    <!--<h4> Visitor Cards </h4>
    <router-link :to="{ name: 'visitor_cards.add' }"> Add</router-link>  |
    <router-link :to="{ name: 'visitor_cards.list' }"> List </router-link>  |
    <router-link :to="{name: 'visitor_cards.edit'}"> Edit | </router-link>-->

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
