<template>
  <div class="container">
    <div class="card">
      <div class="card-header bg-info">
        <h4 class="card-title">Edit Visitor Card</h4>
      </div>

      <div class="card-body">
        <form @submit.prevent="editVisitorCard">
          <div class="form-group">
            <input v-model="currentVisitorCard.name" name="name" type="text" class="form-control" placeholder="Name">
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary"> Update Visitor Card</button>
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
          name: ''
        }
      }
    },

    computed: {
      ...mapGetters({
        all_visitor_cards: 'visitor_card/all_visitor_cards',
        loading: 'visitor_card/loading',
        loaded: 'visitor_card/loaded',
      }),

      currentVisitorCard: function () {
        return this.all_visitor_cards.find(card => card.id == this.$route.params.id)
      }
    },

    methods: {
      editVisitorCard () {
        let $this = this

        axios.put('/api/visitor_cards/' + this.$route.params.id, this.currentVisitorCard)
          .then(function (response) {
            $this.$router.push('/visitor_cards/list')
          })
          .catch(function (errors) {
            console.log(errors)
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
