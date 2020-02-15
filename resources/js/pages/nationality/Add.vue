<template>
  <div class="container">
    <div class="card">
      <div class="card-header bg-info">
        Add Nationality
      </div>
      <div class="card-body">
        <form @submit.prevent="addNationality">
          <div class="form-group">
            <input v-model="form.name" name="name" type="text" class="form-control" placeholder="Nationality">
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary"> Add Nationality</button>
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

    name: 'Add',

    data () {
      return {
        form: {
          name: ''
        }
      }
    },

    methods: {
      addNationality() {
        let $this = this
        axios.post('/api/nationalities', $this.form)
          .then(function (response) {
            console.log(response)
            $this.$store.dispatch('nationality/addNationalityItem', response.data.data)
            $this.$router.push('/nationalities')
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
