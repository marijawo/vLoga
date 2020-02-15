<template>
  <div class="container">
    <div class="card">
    <div class="card-header bg-info">
      Add Visitor Card
    </div>
    <div class="card-body">
      <form @submit.prevent="addVisitorCard">
        <div class="form-group">
          <input v-model="form.name" name="name" type="text" class="form-control" placeholder="Name">
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary"> Add Visitor Card </button>
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
        }
      }
    },

    methods: {
      addVisitorCard () {
        let $this = this
        axios.post('/api/visitor_cards', $this.form)
          .then(function (response) {
            // console.log("added ", response)
            $this.$store.dispatch('visitor_card/addVisitorCardItem', response.data.data)
            // $this.form = { name: '', description: '', logo: ''}
            // alert('add success')
            $this.$router.push('/visitor_cards')
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
