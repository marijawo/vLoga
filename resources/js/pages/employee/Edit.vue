<template>
  <div class="container">
    <div class="card">
      <div class="card-header bg-info">
        <h4 class="card-title">Edit Employee</h4>
      </div>
      <div class="card-body">

        <form @submit.prevent="editEmployee">

          <div class="form-group">
            <input v-model="selectedEmployee.emp_code" disabled name="emp_code" type="text" class="form-control"
                   placeholder="Employee Code">
          </div>

          <div class="row form-group">
            <div class="form-group col-md-4">
              <input v-model="selectedEmployee.first_name" name="first_name" type="text" class="form-control"
                     placeholder="First Name">
            </div>

            <div class="form-group col-md-4">
              <input v-model="selectedEmployee.middle_name" name="middle_name" type="text" class="form-control"
                     placeholder="Middle Name">
            </div>

            <div class="form-group col-md-4">
              <input v-model="selectedEmployee.last_name" name="last_name" type="text" class="form-control"
                     placeholder="Last Name">
            </div>
          </div>

          <div class="row">
            <div class="form-group col-md-4">
              <input v-model="selectedEmployee.job_title" name="job_title" type="text" class="form-control"
                     placeholder="Job Title">
            </div>

            <div class="form-group col-md-4">
              <select v-model="selectedEmployee.department_id" class="custom-select" required>
                <option value="">-Department-</option>
                <option v-for="(department, index) in departments" :value="department.id" :key="department.id">
                  {{department.name }}
                </option>
              </select>
            </div>

            <div class="form-group col-md-4">
              <input v-model="selectedEmployee.phone" name="phone" type="text" class="form-control" placeholder="Phone">
            </div>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary"> Update Employee</button>
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
        // assign selectedEmployee object to form object
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
        employees: 'employee/all_employees',
        loading: 'employee/loading',
        loaded: 'employee/loaded',

        departments: 'department/all_departments',
        dept_loading: 'department/loading',
        dept_loaded: 'department/loaded'
      }),

      selectedEmployee () {
        return this.employees.find(emp => emp.id == this.$route.params.id)
      }
    },

    methods: {
      editEmployee () {
        let $this = this
        axios.put('/api/employees/' + $this.$route.params.id, $this.selectedEmployee)
          .then(function (response) {
            $this.$router.push('/employees/list')
            console.log('get data for update: ', response)
          })
          .catch(function (error) {
            console.log(error)
          })
      }
    },

    mounted () {
      if (!this.loaded) {
        this.$store.dispatch('employee/getEmployees')
      }
      if (!this.dept_loaded) {
        this.$store.dispatch('department/getDepartments')
      }
    },

    created () {
      if (this.selectedEmployee && this.selectedEmployee.department && this.selectedEmployee.department.id) {
        this.form.department_id = this.selectedEmployee.department.id
      }
    }
  }
</script>

<style scoped>

</style>
