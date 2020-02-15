<template>
  <div class="container-fluid">

    <card :title="$t('home')">
      <router-link to="/institutions"> Institutions | </router-link>
      <router-link to="/visitor_cards"> Visitor Cards | </router-link>
      <router-link to="/departments"> Departments</router-link>

      <p>
        {{ $t('you_are_logged_in') }}

      </p>

    </card>
  </div>
</template>

<script>
  export default {
    middleware: 'auth',

    metaInfo () {
      return { title: this.$t('home') }
    }
  }
</script>
