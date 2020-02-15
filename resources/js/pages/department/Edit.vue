<template>
  <div class="container">
    <div class="card">
      <div class="card-header bg-info">
        Edit Department
      </div>
      <div class="card-body">
        <form @submit.prevent="editDepartment">
          <div class="form-group" v-if="currentDepartment != undefined">

            <input v-model="currentDepartment.name" name="name" type="text" class="form-control"
                   placeholder="Department Name">

          </div>

          <!-- <div class="form-group">
             <input v-model="currentDepartment.institution.name" name="description" type="text" class="form-control"
                    placeholder="Institute">
           </div>-->

          <div class="form-group">
            <select v-model="form.institution_id" class="custom-select" required>
              <option value=""> --Department--</option>

              <option v-for="(institution, index) in institutions" :value="institution.id" :key="institution.id">
                {{institution.name }}
              </option>
            </select>
          </div>

          <!--          Current Institute:  {{currentInstitute.description }}-->

          <div class="form-group">
            <button type="submit" class="btn btn-primary"> Update Department</button>
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
          institution_id: ''
        }
      }
    },

    created() {
      if (this.currentDepartment && this.currentDepartment.institution && this.currentDepartment.institution.id) {
        this.form.institution_id = this.currentDepartment.institution.id
      }

    },


    computed: {
      ...mapGetters({
        departments: 'department/all_departments',
        loading: 'department/loading',
        loaded: 'department/loaded',

        institutions: 'institute/all_institutes',
        institute_loading: 'institute/loading',
        institute_loaded: 'institute/loaded'
      }),

      currentDepartment: function () {
        return this.departments.find(dept => dept.id == this.$route.params.id)
      },

    },

    methods: {
      editDepartment () {
        let $this = this
        axios.put('/api/departments/' + $this.$route.params.id, $this.currentDepartment)
          .then(function (response) {
            $this.$router.push('/departments/list')
            // console.log('Data response is: ', response)
          })
          .catch(function (errors) {
            console.log(errors)
          })
      }
    },

    mounted () {
      if (!this.loaded) {
        this.$store.dispatch('department/getDepartments')
      }
      if (!this.institute_loading) {
        this.$store.dispatch('institute/getInstitutions')
      }
    }

  }

</script>

<style scoped>

</style>
