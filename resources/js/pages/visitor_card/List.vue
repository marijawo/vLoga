<template>
  <div class="container">
<!--    <h4> Visitor Cards </h4>-->
    <div class="card">
      <div class="card-header text-white bg-success"> Visitor Cards
        <router-link :to="{ name: 'visitor_cards.add' }" class="btn btn-warning btn-sm float-right"> Add </router-link>
      </div>
      <div class="card-body">
        <table class="table table-hover table-sm">
          <tr class="bg-success">
            <th> No</th>
            <th> Card Number </th>
            <th colspan="2"> Actions</th>
          </tr>
          <tbody>
          <tr v-for="(visitor_card, index) in visitor_cards" :key="index">
            <td> {{ index + 1}}</td>
            <td> {{ visitor_card.name}}</td>

            <td>
              <router-link :to="{name: 'visitor_cards.edit', params: {id: visitor_card.id} }" class="btn btn-info btn-sm"> Edit</router-link>
            </td>
            <td>
              <button @click="deleteVisitorCard(visitor_card.id, index)" class="btn btn-danger btn-sm"> Delete</button>
            </td>
          </tr>
          </tbody>
        </table>

        <hr>


      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios'

  import { mapGetters } from 'vuex'

  export default {
    middleware: 'auth',

    computed: {
      ...mapGetters({
        visitor_cards: 'visitor_card/all_visitor_cards',
        loading: 'visitor_card/loading',
        loaded: 'visitor_card/loaded'
      })
    },

    methods: {
      deleteVisitorCard(id, index) {
        let $this = this;
        axios.delete('/api/visitor_cards/' + id)
          .then(function (response) {
            $this.$delete($this.visitor_cards, index);
            console.log("deleted", $this.visitor_cards);
          })
          .catch(function (error) {
            console.log(error)
          })
      }
    },

    mounted () {
      if (!this.loaded) {
        this.$store.dispatch('visitor_card/getVisitorCards')
      }
    }
  }
</script>

<style scoped>

</style>
