<template>
  <div class="container">
    <div class="card">
      <div class="card-header text-white bg-success"> Department s</div>
      <div class="card-body">
        <table class="table table-hover table-sm">
          <tr>
            <th> No</th>
            <th> Department</th>
            <th colspan="2"> Actions</th>
          </tr>
          <tbody>
          <tr v-for="(document_type, index) in document_types" :key="index">
            <td> {{ index + 1}}</td>
            <td> {{ document_type.name}}</td>
            <td>
              <router-link :to="{name: 'document_types.edit', params: {id: document_type.id} }"
                           class="btn btn-info btn-sm">
                Edit
              </router-link>
            </td>
            <td>
              <button @click="deleteDepartment(document_type.id, index)" class="btn btn-danger btn-sm"> Delete</button>
            </td>
          </tr>
          </tbody>
        </table>

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

    computed: {
      ...mapGetters({
        document_types: 'document_type/all_document_types',
        loading: 'document_type/loading',
        loaded: 'document_type/loaded'
      })
    },

    methods: {
      deleteDepartment (id, index) {
        let $this = this
        axios.delete('/api/document_types/' + id)
          .then(function (response) {
            $this.$delete($this.document_types, index)
            console.log('Deleted: ', response)
          })
          .catch(function (errors) {
            console.log(errors)
          })
      }
    },

    mounted () {
      if (!this.loaded) {
        this.$store.dispatch('document_type/getDocumentTypes')
      }
    }
  }
</script>

<style scoped>

</style>
