<template>
  <div class="container">
    <div class="card">
      <div class="card-header bg-info">
        Edit DocumentType
      </div>
      <div class="card-body">
        <form @submit.prevent="editDocumentType">
          <div class="form-group">
            <input v-model="currentDocumentType.name" name="name" type="text" class="form-control"
                   placeholder="DocumentType Name">
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary"> Update Document Type</button>
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

    data () {
      return {
        form: {
          name: '',
          document_type_id: ''
        }
      }
    },
    computed: {
      ...mapGetters({
        document_types: 'document_type/all_document_types',
        loading: 'document_type/loading',
        loaded: 'document_type/loaded',
      }),

      currentDocumentType: function () {
        return this.document_types.find(dept => dept.id == this.$route.params.id)
      }
    },

    methods: {
      editDocumentType () {
        let $this = this
        axios.put('/api/document_types/' + $this.$route.params.id, $this.currentDocumentType)
          .then(function (response) {
            $this.$router.push('/document_types/list')
            console.log('Data response is: ', response)
          })
          .catch(function (errors) {
            console.log(errors)
          })
      },

      mounted () {
        if (!this.loaded) {
          this.$store.dispatch('document_type/getDocumentTypes')
        }
      }
    }

  }

</script>

<style scoped>

</style>
