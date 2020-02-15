<template>
  <div class="container-fluid">
    <div class="card">
      <div class="card-header bg-info">
        Edit Nationality
      </div>
      <div class="card-body">
        <form @submit.prevent="editNationality">
          <div class="form-group">
            <input v-model="selectedNationality.name" name="name" type="text" class="form-control" placeholder="Nationality">
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary"> Update Nationality</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios'
  import { mapGetters } from 'vuex'

  export default {
    middleware: 'auth',

    name: 'Edit',

    computed: {
      ...mapGetters({
        nationalities: 'nationality/all_nationalities',
        loading: 'nationality/loading',
        loaded: 'nationality/loaded'
      }),

      selectedNationality() {
        return this.nationalities.find(item => item.id == this.$route.params.id)
      }
    },

    methods: {
      editNationality() {
        let $this = this
        axios.put('/api/nationalities/' + $this.$route.params.id, $this.selectedNationality)
          .then(function (response) {
            $this.$router.push("/nationalities/list");
            console.log("Update data", response)
          })
          .catch(function (errors) {
            console.log()
          })
      }
    },

    mounted () {
      if (!this.loaded) {
        this.$store.dispatch('nationality/getNationalities')

      }
    }
  }
</script>

<style scoped>

</style>
