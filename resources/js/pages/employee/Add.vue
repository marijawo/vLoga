<template>
  <div class="container-fluid">
    <div class="card">
      <div class="card-header bg-info">
        Add Employee
      </div>
      <div class="card-body">
        <form @submit.prevent="addEmployee">

          <div class="form-group">
            <input v-model="form.emp_code" name="emp_code" type="text" class="form-control" placeholder="Employee Code">
          </div>

          <div class="row form-group">
            <div class="form-group col-md-4">
              <input v-model="form.first_name" name="first_name" type="text" class="form-control" placeholder="First Name">
            </div>

            <div class="form-group col-md-4">
              <input v-model="form.middle_name" name="middle_name" type="text" class="form-control" placeholder="Middle Name">
            </div>

            <div class="form-group col-md-4">
              <input v-model="form.last_name" name="last_name" type="text" class="form-control" placeholder="Last Name">
            </div>
          </div>

          <div class="row">
            <div class="form-group col-md-4">
              <input v-model="form.job_title" name="job_title" type="text" class="form-control" placeholder="Job Title">
            </div>

           <!-- <div class="form-group col-md-4">
              <input v-model="form.department_id" name="department_id" type="text" class="form-control"
                     placeholder="Department">
            </div>-->

            <div class="form-group col-md-4">
              <select v-model="form.department_id" class="custom-select" required>
                <option value="">-Department-</option>
                <option v-for="(department, index) in departments" :value="department.id" :key="department.id">
                  {{department.name }}
                </option>
              </select>
            </div>

            <div class="form-group col-md-4">
              <input v-model="form.phone" name="phone" type="text" class="form-control" placeholder="Phone">
            </div>


          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary"> Add Employee</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios'
  import {mapGetters} from 'vuex'

  export default {
    middleware: 'auth',

    data () {
      return {
        form: {
          emp_code: '',
          first_name: '',
          middle_name: '',
          last_name: '',
          job_title: '',
          department_id: '',
          phone: ''
        }
      }
    },

    computed: {
      ...mapGetters({
        departments: 'department/all_departments',
        loading: 'department/loading',
        loaded: 'department/loaded'
      })
    },

    methods: {
      addEmployee () {
        let $this = this
        axios.post('/api/employees', $this.form)
          .then(function (response) {
            // console.log("added ", response)
            $this.$store.dispatch('employee/addEmployeeItem', response.data.data)
            // $this.form = { name: '', description: '', logo: ''}
            // alert('add success')
            $this.$router.push('/employees')
            console.log(response)
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
    }
  }
</script>

<style scoped>

</style>
