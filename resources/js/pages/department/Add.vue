<template>
  <div class="container">
    <div class="card">
      <div class="card-header">
        Add Department
      </div>
      <div class="card-body">
        <form @submit.prevent="addDepartment">
          <div class="form-group">
            <input v-model="form.name" name="name" type="text" class="form-control" placeholder="Name">
          </div>

          <div class="form-group">
            <select v-model="form.institution_id" class="custom-select" required>
              <option value="">Open this select menu</option>
              <option v-for="(institution, index) in institutions" :value="institution.id" :key="institution.id">
                {{institution.description }}
              </option>
            </select>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary"> Add Department</button>
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
        // institutions: [],
        selectedInstitution: null,

        form: {
          name: '',
          institution_id: ''
        }
      }
    },

    computed: {
      ...mapGetters({
        institutions: 'institute/all_institutes',
        loading: 'institute/loading',
        loaded: 'institute/loaded'
      })
    },

    methods: {
      addDepartment () {
        let $this = this
        axios.post('/api/departments', $this.form)
          .then(function (response) {
            $this.$store.dispatch('department/addDepartmentItem', response.data.data)
            // $this.form = { name: '', description: '', logo: ''}
            $this.$router.push('/departments')
            console.log(response)
          })
          .catch(function (errors) {
            console.log(errors)
          })
      },
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
