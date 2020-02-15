<template>
  <div class="container-fluid">
    <div class="card">
      <div class="card-header text-white bg-success"> Employees
        <div class="float-right">
          <router-link class="btn btn-sm btn-warning" :to="{ name: 'employees.add' }"><i class="fa fa-pulse"> </i> Add
          </router-link>
        </div>
      </div>

      <div class="card-body">
        <table class="table table-striped table-sm">
          <thead>
          <tr class="bg-green-light">
            <th> No</th>
            <th> Employee Code</th>
            <th> First Name</th>
            <th> Middle Name</th>
            <th> Last Name</th>
            <th> Job Title</th>
            <th> Department</th>
            <th> Phone</th>
            <th colspan="2"> Actions</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="(employee, index) in employees" :key="index">
            <td>{{ index + 1 }}</td>
            <td>{{ employee.emp_code }}</td>
            <td>{{ employee.first_name }}</td>
            <td>{{ employee.middle_name }}</td>
            <td>{{ employee.last_name }}</td>
            <td>{{ employee.job_title }}</td>
            <td > {{ ((employee.department) ? employee.department.name : '' )}} </td>
            <td>{{ employee.phone }}</td>
            <td>
              <router-link :to="{name: 'employees.edit', params: {id: employee.id} }" class="btn btn-info btn-sm">
                Edit
              </router-link>
            </td>
            <td>
              <button @click="deleteEmployee(employee.id, index)" class="btn btn-danger btn-sm"> Delete</button>

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
        employees: 'employee/all_employees',
        loading: 'employee/loading',
        loaded: 'employee/loaded'
      })
    },

    methods: {
      deleteEmployee (id, index) {
        let $this = this
        axios.delete('/api/employees/' + id)
          .then(function (response) {
            $this.$delete($this.employees, index)
            console.log('Deleted: ', response)
          })
          .catch(function (errors) {
            console.log(errors)
          })
      }
    },

    mounted () {
      if (!this.loaded) {
        this.$store.dispatch('employee/getEmployees')
      }
    }

  }

</script>


<style scoped>


</style>
