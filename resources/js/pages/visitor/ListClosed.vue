<template>
  <div class="col-md-12">

    <div class="card">
      <div class="card-header bg-danger text-white text-center"><h4> Closed Visits </h4>

      </div>
      <div class="card-body">
        <table class="table table-hover table-sm">
          <tr class="bg-warning">
            <th> No</th>
            <th> First Name</th>
            <th> M. Name</th>
            <th> Last Name</th>
            <th>Gender</th>
            <th>Phone</th>
            <th> Nationality</th>
            <th> Doc Type</th>
            <th> Doc Number</th>
            <th> Visiting</th>
            <th> Institute</th>
            <th> Purpose</th>
            <th> Card</th>
            <th> Time In</th>
            <th> Time Out</th>
            <th> Duration</th>
            <th colspan="3">
              Actions
            </th>
          </tr>
          <tbody>
          <tr v-for="(visitor, index) in visitors" :key="index">

            <td> {{ index + 1 }}</td>
            <td> {{ visitor.first_name }}</td>
            <td>{{ visitor.middle_name}}</td>

            <td> {{ visitor.last_name }}</td>
            <td> {{ visitor.gender }}</td>
            <td>{{ visitor.phone}}</td>

            <td>
              {{ visitor.nationality.name}}
            </td>
            <td>
              {{ visitor.document_type.name}}
            </td>

            <td>
              {{ visitor.document_number}}
            </td>

            <td>
              <span v-if="visitor.employee">
                {{ visitor.employee.first_name }}
                {{ visitor.employee.middle_name}}
                {{ visitor.employee.last_name}}
              </span>

              <span v-else>
                {{ visitor.visiting }}
              </span>
            </td>
            <td>
              {{ visitor.institution.name}}
            </td>

            <td> {{ visitor.purpose }}</td>
            <td>

              {{ visitor.visitor_card.name }}

            </td>
            <td> {{ visitor.time_in }}</td>
            <td> {{ visitor.time_out }} </td>
            <td>

<!--              Duration: {{ visitor.time_out.getTime() - visitor.time_in.getTime() }}-->


            </td>

            <td>Duratoin</td>


            <td>
              <router-link :to="{name: 'visitors.edit', params: {id: visitor.id} }" class="btn btn-info btn-sm"> Edit
              </router-link>

            </td>
            <td>
              <button class="btn btn-danger btn-sm" @click="deleteVisitor(visitor.id, index)">
                Delete
              </button>
            </td>
          </tr>
          </tbody>
        </table>

        <div class="card-footer">

        </div>

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
        clock_in: visitors[time_in],
        clock_out: visitors[time_out],
      }
    },

    computed: {
      ...mapGetters({
        visitors: 'visitor/all_visitors',
        loading: 'visitor/loading',
        loaded: 'visitor/loaded',

        /*institutions: 'institution/all_institution',
        ins_loading: 'institute/loading',
        ins_loaded: 'institute/loaded',*/
      })
    },

    mounted () {
      if (!this.loaded) {
        this.$store.dispatch('visitor/getVisitors')
      }

      /*if (!this.ins_loaded) {
        this.$store.dispatch('institute/loaded')
      }*/

    },

    computed: {
      timeDiff(clock_in, clock_out) {
        return this.clock_out.getTime() - this.clock_in.getTime();
      }
    },

    methods: {
      deleteVisitor (id, index) {
        let $this = this
        axios.delete('/api/visitors/' + id)
          .then(function (response) {
            console.log(response)
            $this.$delete($this.visitors.index)
          })
          .catch(function (errors) {
            console.log(errors)
          })
      },

      updateVisitor (visitor) {
        let $this = this
        axios.put('/api/visitors/' + visitor.id)
          .then(function (response) {
            // $this.$router.push('/visitors/list')
            $this.$store.dispatch('visitor/addVisitorItem', response['data'])
            console.log('Update: Clock out visitor')
          })
          .catch(function (errors) {
            console.log(errors)
          })
      },

      timeDiff(clock_in, clock_out) {
        return clock_in.getTime() - clock_out.getTime();
      }
    }

  }
</script>

<style scoped>

</style>
