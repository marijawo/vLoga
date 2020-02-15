<template>
  <div class="container">
    <div class="card">

      <div class="card-header bg-info">
        <h4 class="card-title">Edit Institution</h4>
      </div>
      <div class="card-body">
        <form @submit.prevent="editInstitution">
          <div class="form-group">
            <input v-model="selectedInstitute.name" name="name" type="text" class="form-control" placeholder="Name">
          </div>

          <div class="form-group">
            <input v-model="selectedInstitute.description" name="description" type="text" class="form-control" placeholder="Description">
          </div>

        <!--  <div class="form-group">
            <input v-model="selectedInstitute.logo" name="description" type="text" class="form-control" placeholder="Logo">
          </div>-->

          <div class="form-group">
            <button type="submit" class="btn btn-primary"> Update Institute</button>
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
    data () {
      return {
        form: {
          name: '',
          description: '',
          // logo: ''
        }
      }
    },

    computed: {
      ...mapGetters({
        institutions: 'institute/all_institutes',
        loading: 'institute/loading',
        loaded: 'institute/loaded'
      }),

      selectedInstitute() {
        return this.institutions.find(item => item.id == this.$route.params.id)
      }
    },

    methods: {
      editInstitution () {
        let $this = this
        axios.put('/api/institutions/' + $this.$route.params.id, $this.selectedInstitute)
          .then(function (response) {
            $this.$router.push("/institutions/list");
            console.log("get data for update: ", response)
          })
          .catch(function (error) {
            console.log(error);
          });
      }
    },

    mounted () {
      if (!this.loaded) {
        this.$store.dispatch('institute/getInstitutions')
      }
    }
  }
</script>

<style scoped>

</style>
