<template>
  <div class="container">
    <div class="card">
      <div class="card-header text-white bg-success">Institutions
        <router-link :to="{ name: 'institutions.add' }" class="btn btn-warning btn-sm float-right"> Add</router-link>
      </div>
      <div class="card-body">
        <table class="table table-hover table-sm">
          <tr>
            <th> No</th>
            <th> First Name</th>
            <th> Last Name</th>
            <th>Logo</th>
            <th colspan="2">
              Actions
            </th>
          </tr>
          <tbody>
          <tr v-for="(institute, index) in institutions" :key="index">
            <td> {{ index + 1 }}</td>
            <td> {{ institute.name }}</td>
            <td> {{ institute.description }}</td>
            <td> {{ institute.logo }}</td>
            <td>
              <router-link :to="{name: 'institutions.edit', params: {id: institute.id} }" class="btn btn-info btn-sm">
                Edit
              </router-link>
            </td>
            <td>
              <!--              <button @click="deletePerson(person.id, index)" class="btn btn-danger btn-sm"> Delete</button>-->
              <button class="btn btn-danger btn-sm" @click="deleteInstitution(institute.id, index)">
                Delete
              </button>
            </td>
          </tr>
          </tbody>
        </table>

        <hr>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios'
  import { mapGetters } from 'vuex'

  export default {
    middleware: 'auth',

    computed: {
      ...mapGetters({
        institutions: 'institute/all_institutes',
        loading: 'institute/loading',
        loaded: 'institute/loaded'
      })
    },

    methods: {
      deleteInstitution (id, index) {
        let $this = this
        axios.delete('/api/institutions/' + id)
          .then(function (response) {
            $this.$delete($this.institutions, index)
          })
          .catch(function (error) {
            console.log(error)
          })
      }
    },

    mounted () {
      if (!this.loaded) {
        this.$store.dispatch('institute/getInstitutions')
      }
    },
  }
</script>

<style scoped>

</style>
