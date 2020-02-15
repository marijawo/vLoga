<template>
  <div class="container">
    <div class="card">
      <div class="card-header text-white bg-success">Nationalities</div>
      <div class="card-body">
        <table class="table table-hover table-sm">
          <tr>
            <th> No</th>
            <th> Nationality</th>

            <th colspan="2">
              Actions
            </th>
          </tr>
          <tbody>
          <tr v-for="(nationality, index) in nationalities" :key="index">
            <td> {{ index + 1 }}</td>
            <td> {{ nationality.name }}</td>

            <td>
              <router-link :to="{name: 'nationalities.edit', params: {id: nationality.id} }"
                           class="btn btn-info btn-sm">
                Edit
              </router-link>
            </td>
            <td>
              <!--              <button @click="deletePerson(person.id, index)" class="btn btn-danger btn-sm"> Delete</button>-->
              <button class="btn btn-danger btn-sm" @click="deleteNationality(nationality.id, index)">
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

    name: 'List',

    data () {
      return {}
    },

    computed: {
      ...mapGetters({
        nationalities: 'nationality/all_nationalities',
        loading: 'nationality/loading',
        loaded: 'nationality/loaded'
      })
    },

    methods: {
      deleteNationality (id, index) {
        let $this = this
        axios.delete('/api/nationalities/' + id)
          .then(function (response) {
            $this.$delete($this.nationalities, index)
          })
          .catch(function (error) {
            console.log(error)
          })
      }
     },

    mounted () {
      if (!this.loaded) {
        this.$store.dispatch('nationality/getNationalities')
      }
    },

  }
</script>

<style scoped>

</style>
