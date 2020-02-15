<template>
  <div class="container">
    <div class="card">
      <div class="card-header bg-info">
        Add Document Type
      </div>
      <div class="card-body">
        <form @submit.prevent="addDocumentType">
          <div class="form-group">
            <input v-model="form.name" name="name" type="text" class="form-control" placeholder="Name">
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary"> Add DocumentType</button>
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

    name: 'Add',

    data () {
      return {
        form: {
          name: '',
        }
      }
    },

    computed: {
      ...mapGetters({
        document_types: 'document_type/all_document_types',
        loading: 'document_type/loading',
        loaded: 'document_type/loaded'
      })
    },

    methods: {
      addDocumentType () {
        let $this = this
        axios.post('/api/document_types', $this.form)
          .then(function (response) {
            $this.$store.dispatch('document_type/addDocumentTypeItem', response.data.data)
            // $this.form = { name: '', description: '', logo: ''}
            $this.$router.push('/document_types')
            console.log(response)
          })
          .catch(function (errors) {
            console.log(errors)
          })
      },
    },

    mounted () {
      if (!this.loaded) {
        // load document_types to show in the dropdowm menu
        this.$store.dispatch('document_type/getDocumentTypes')
      }
    },

  }
</script>

<style scoped>

</style>
