<template>
  <div class="container">
    <div class="card">
      <div class="card-header text-white bg-success"> Departments
        <router-link :to="{ name: 'departments.add' }" class="btn btn-warning btn-sm float-right"> Add</router-link>
      </div>
      <div class="card-body">
        <table class="table table-hover table-sm">
          <tr>
            <th> No</th>
            <th> Department</th>
            <th> Institute</th>
            <th colspan="2"> Actions</th>
          </tr>
          <tbody>
          <tr v-for="(department, index) in departments" :key="index">
            <td> {{ index + 1}}</td>
            <td> {{ department.name}}</td>
            <td> {{ department.description }}</td>
            <td>
              <router-link :to="{name: 'departments.edit', params: {id: department.id} }" class="btn btn-info btn-sm">
                Edit
              </router-link>
            </td>
            <td>
              <button @click="deleteDepartment(department.id, index)" class="btn btn-danger btn-sm"> Delete</button>
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
        departments: 'department/all_departments',
        loading: 'department/loading',
        loaded: 'department/loaded'
      })
    },

    methods: {
      deleteDepartment (id, index) {
        let $this = this
        axios.delete('/api/departments/' + id)
          .then(function (response) {
            $this.$delete($this.departments, index)
            console.log('Deleted: ', response)
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
    },

    created () {
      console.log('Description created', this.description)
    }
  }
</script>

<style scoped>

</style>
