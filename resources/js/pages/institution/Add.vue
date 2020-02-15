<template>
  <div class="container">
    <div class="card">
      <div class="card-header bg-info">
        Add Institution
      </div>
      <div class="card-body">
        <form @submit.prevent="addInstitution">
          <div class="form-group">

            <input v-model="form.name" name="name" type="text" class="form-control" placeholder="Name">
          </div>

          <div class="form-group">
            <input v-model="form.description" name="description" type="text" class="form-control" placeholder="Description">
          </div>

          <!--<div class="form-group">
            <input v-model="form.logo" name="description" type="text" class="form-control" placeholder="Logo">
          </div>-->

          <div class="form-group">
            <button type="submit" class="btn btn-primary"> Add Institute</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios'

  export default {
    middleware: 'auth',

    data () {
      return {
        form: {
          name: '',
          description: '',
          logo: ''
        }
      }
    },

    methods: {
      addInstitution () {
        let $this = this
        axios.post('/api/institutions', $this.form)
          .then(function (response) {
            // console.log("added ", response)
            $this.$store.dispatch('institute/addInstitutionItem', response.data.data)
            // $this.form = { name: '', description: '', logo: ''}
            // alert('add success')
            $this.$router.push('/institutions')
            console.log(response)
          })
          .catch(function (errors) {
            console.log(errors)
          })
      }
    }
  }
</script>

<style scoped>

</style>
