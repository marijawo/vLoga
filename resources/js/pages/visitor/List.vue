<template>
  <div class="container-fluid">
    <p>
      <router-link :to="{ name: 'visitors.add' }" class="btn btn-warning btn-lg float-right">
        <fa fixed-width icon="plus" style="color:#00c853"/>
        Add Visitor
      </router-link>

      <!--<router-link :to="{ name: '' }" class="btn btn-outline-primary btn-sm">
        <fa fixed-width icon="cog" style="color: #00b0ff"/>
        Refresh
      </router-link>-->

      <button @click="reLoadData" class="btn btn-outline-primary btn-lg">
        <fa fixed-width icon="cog" style="color: #00b0ff"/>
        Refresh
      </button>

      <!--<span v-if="loading">
        <fa icon="spinner" style="color: #f50057"/>
      </span>-->


    </p>

    <!-- <span class="title"> List of Visitors </span>
     <br/> <br/>-->
    <span v-if="!loading">
    <div>
      <b-tabs content-class="mx-3">
        <!-- Active Visitors -->
        <b-tab active title="Active Visitors">
          <!--        <b-tab active title="Active Visitors" title-item-class="bg-success">-->
          <template class="bg-danger" slot='title'>
            <fa fixed-width icon="door-open" style="color:#00c853"/>
            Active Visitors
          </template>
          <!--          <span class="success">Active Visitors</span>-->
          <div class="col-md-12">

            <div class="card">
              <!--<div class="card-header bg-success text-black-50 text-white">
                <router-link class="btn btn-sm btn-warning float-right" :to="{ name: 'visitors.add' }">
                  <span class="oi oi-plus"></span>
                  Add
                </router-link>
              </div>-->
              <div class="card-body">
                <table class="table table-hover table-sm">
                  <tr class="bg-success text-white">
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
                    <th> Institution</th>
                    <th> Purpose</th>
                    <th> Card</th>
                    <th> Time In</th>
                    <th> Time Out</th>
                    <th colspan="3">
                      Actions
                    </th>
                  </tr>
                  <tbody>
                  <tr :key="index" v-for="(visitor, index) in activeVisitors">
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
                    <td> {{ visitor.institution.name }}</td>
                    <td> {{ visitor.purpose }}</td>
                    <td>
                      {{ visitor.visitor_card.name }}
                    </td>
                    <td> {{ visitor.time_in }}</td>
                    <td> {{ visitor.time_out }}</td>
                    <!--<td>
                      <b-button @click="confirmClockOutVisitor(visitor)" class="btn btn-danger btn-sm disabled">
                      &lt;!&ndash;<span class="oi oi-clock disabled"></span>
                        <fa icon="clock" fixed-width/>&ndash;&gt;
                    </b-button>
                    </td>-->
                    <td>
                      <b-button @click="confirmClockOutVisitor(visitor)" class="btn btn-danger btn-sm">
                        <span class="oi oi-clock disabled"></span>
                      </b-button>
                    </td>
                    <td>
                      <router-link :to="{name: 'visitors.edit', params: {id: visitor.id} }" class="btn btn-info btn-sm">
                        Edit
                      </router-link>
                    </td>
                    <td>
                      <button @click="deleteVisitor(visitor.id, index)" class="btn btn-danger btn-sm">
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
        </b-tab>

        <!-- Inactive Visitors -->
        <b-tab title="Active Visitors">
          <template slot='title'>
            <fa fixed-width icon="door-closed" style="color:#f50057"/>
            Inactive Visitors
          </template>
          <!--          <span class="success">Active Visitors</span>-->
          <div class="col-md-12">
            <div class="card">
              <!--<div class="card-header bg-success text-black-50 text-white">
                <router-link class="btn btn-sm btn-warning float-right" :to="{ name: 'visitors.add' }">
                  <span class="oi oi-plus"></span>
                  Add
                </router-link>
              </div>-->
              <div class="card-body">
                <table class="table table-hover table-sm">
                  <tr class="bg-danger text-white">
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
                    <th> Institution</th>
                    <th> Purpose</th>
                    <th> Card</th>
                    <th> Time In</th>
                    <!--                    <th> Time Out</th>-->
                    <!--<th colspan="3">
                      Actions
                    </th>-->
                  </tr>
                  <tbody>
                  <tr :key="index" v-for="(visitor, index) in inActiveVisitors">
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
                    <td> {{ visitor.institution.name }}</td>
                    <td> {{ visitor.purpose }}</td>
                    <td>
                      {{ visitor.visitor_card.name }}
                    </td>
                    <td> ---</td>
                    <!--                    <td> {{ visitor.time_out }}</td>-->
                    <!--<td>
                      <b-button @click="confirmClockOutVisitor(visitor)" class="btn btn-danger btn-sm disabled">
                      &lt;!&ndash;<span class="oi oi-clock disabled"></span>
                        <fa icon="clock" fixed-width/>&ndash;&gt;
                    </b-button>
                    </td>-->
                    <!--<td>
                      <b-button @click="confirmClockOutVisitor(visitor)" class="btn btn-danger btn-sm">
                        <span class="oi oi-clock disabled"></span>
                      </b-button>
                    </td>
                    <td>
                      <router-link :to="{name: 'visitors.edit', params: {id: visitor.id} }" class="btn btn-info btn-sm">
                        Edit
                      </router-link>
                    </td>
                    <td>
                      <button class="btn btn-danger btn-sm" @click="deleteVisitor(visitor.id, index)">
                        Delete
                      </button>
                    </td>-->
                  </tr>
                  </tbody>
                </table>
                <div class="card-footer">
                </div>

              </div>
            </div>
          </div>
        </b-tab>

        <b-tab title="GNPC Visitors">
          <template slot='title'>
            <img alt="GNPC Visitors" src="/img/gnpc_visitors.png">
            <!-- <fa icon="door-open" style="color:#ffea00" fixed-width/>-->
            GNPC Visitors
          </template>

          <!--          <span class="success">Active Visitors</span>-->
          <div class="col-md-12">

            <div class="card">
              <!--<div class="card-header bg-success text-black-50 text-white">
                <router-link class="btn btn-sm btn-warning float-right" :to="{ name: 'visitors.add' }">
                  <span class="oi oi-plus"></span>
                  Add
                </router-link>
              </div>-->
              <div class="card-body">
                <table class="table table-hover table-sm">
                  <tr class="gnpc-header text--black">
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
                    <th> Institution</th>
                    <th> Purpose</th>
                    <th> Card</th>
                    <th> Time In</th>
                    <th> Time Out</th>
                    <th colspan="3">
                      Actions
                    </th>
                  </tr>
                  <tbody>
                  <tr :key="index" v-for="(visitor, index) in gnpcVisitors">
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
                    <td> {{ visitor.institution.name }}</td>
                    <td> {{ visitor.purpose }}</td>
                    <td>
                      {{ visitor.visitor_card.name }}
                    </td>
                    <td> {{ visitor.time_in }}</td>
                    <td> {{ visitor.time_out }}</td>
                    <!--<td>
                      <b-button @click="confirmClockOutVisitor(visitor)" class="btn btn-danger btn-sm disabled">
                      &lt;!&ndash;<span class="oi oi-clock disabled"></span>
                        <fa icon="clock" fixed-width/>&ndash;&gt;
                    </b-button>
                    </td>-->
                    <td>
                      <b-button @click="confirmClockOutVisitor(visitor)" class="btn btn-danger btn-sm">
                        <span class="oi oi-clock disabled"></span>
                      </b-button>
                    </td>
                    <td>
                      <router-link :to="{name: 'visitors.edit', params: {id: visitor.id} }" class="btn btn-info btn-sm">
                        Edit
                      </router-link>
                    </td>
                    <td>
                      <button @click="deleteVisitor(visitor.id, index)" class="btn btn-danger btn-sm">
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
        </b-tab>

        <b-tab title="MoPE Visitors">
          <template slot='title'>

            <img src="/img/mope_visitors.png" alt="MoPE">
            <!--            <fa fixed-width icon="door-open" style="color:#00b0ff"/>-->
            MoPE Visitors
          </template>

          <!--          <span class="success">Active Visitors</span>-->
          <div class="col-md-12">

            <div class="card">
              <!--<div class="card-header bg-success text-black-50 text-white">
                <router-link class="btn btn-sm btn-warning float-right" :to="{ name: 'visitors.add' }">
                  <span class="oi oi-plus"></span>
                  Add
                </router-link>
              </div>-->
              <div class="card-body">
                <table class="table table-hover table-sm">
                  <tr class="mope-header text-white">
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
                    <th> Institution</th>
                    <th> Purpose</th>
                    <th> Card</th>
                    <!--<th> Time In</th>
                    <th> Time Out</th>-->
                    <th>
                      Duration
                    </th>
                  </tr>
                  <tbody>
                  <tr :key="index" v-for="(visitor, index) in mopeVisitors">
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
                    <td> {{ visitor.institution.name }}</td>
                    <td> {{ visitor.purpose }}</td>
                    <td>
                      {{ visitor.visitor_card.name }}
                    </td>
                    <td> time</td>
                  </tr>
                  </tbody>
                </table>
                <div class="card-footer">
                </div>
              </div>
            </div>
          </div>
        </b-tab>

        <b-tab title="OIC Visitors">
          <template slot='title'>
            <!--            <fa fixed-width icon="door-open" style="color:#00b0ff"/>-->

            <img alt="GNPC Visitors" src="/img/oic_visitors.png">

            OIC Visitors
          </template>

          <!--          <span class="success">Active Visitors</span>-->
          <div class="col-md-12">

            <div class="card">
              <!--<div class="card-header bg-success text-black-50 text-white">
                <router-link class="btn btn-sm btn-warning float-right" :to="{ name: 'visitors.add' }">
                  <span class="oi oi-plus"></span>
                  Add
                </router-link>
              </div>-->
              <div class="card-body">
                <table class="table table-hover table-sm">
                  <tr class="oic-header text-white">
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
                    <th> Institution</th>
                    <th> Purpose</th>
                    <th> Card</th>
                    <th>
                      Duration
                    </th>
                  </tr>
                  <tbody>
                  <tr :key="index" v-for="(visitor, index) in oicVisitors">
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
                    <td> {{ visitor.institution.name }}</td>
                    <td> {{ visitor.purpose }}</td>
                    <td>
                      {{ visitor.visitor_card.name }}
                    </td>
                    <td> Time</td>

                  </tr>
                  </tbody>
                </table>
                <div class="card-footer">
                </div>
              </div>
            </div>
          </div>
        </b-tab>

      </b-tabs>
    </div>
    </span>

    <b-modal auto-focus-button="ok" cancel-title="NO" cancel-variant="danger" header-class="bg-warning"
             hide-footer
             id="confirmClockOut"
             ok-title="YES"
             ok-variant="success"
             ref="confirmClockOutModal"
             title=" ClockOut Visitor">

      <div class="col-md-12" v-if="selectedVisitor != null">
        <div class="col-md-12">
          <h6> Are you sure to ClockOut the visitor below </h6>
          <b> {{ selectedVisitor.first_name }} {{ selectedVisitor.last_name }} </b> Clock In: <b> {{
          selectedVisitor.time_in }} </b>
        </div>

        <div class="row">
          <div class="col-md-6">
            <button @click="updateVisitor" class="btn btn-warning d-block float-left"> YES</button>

          </div>

          <div class="col-md-6">
            <button @click="hideConfirmClockOutModal" class="btn btn-danger float-right"> Cancel</button>
          </div>
        </div>
      </div>
    </b-modal>
  </div>
</template>

<script>

  import axios from 'axios'
  import { mapGetters } from 'vuex'

  export default {
    middleware: 'auth',
    // name: 'List',

    data () {
      return {
        selectedVisitor: null,
      }
    },

    computed: {
      ...mapGetters({
        visitors: 'visitor/all_visitors',
        loading: 'visitor/loading',
        loaded: 'visitor/loaded',

        /*institutions: 'institution/all_institutions',
        ins_loaded: 'institution/loaded',
        ins_loading: 'institution/loading'*/

      }),

      activeVisitors () {
        return this.visitors.filter(item => item.time_out == null)
      },

      inActiveVisitors () {
        return this.visitors.filter(item => item.time_out != null)
      },

      gnpcVisitors () {
        return this.visitors.filter(item => item.institution_id == 1)
      },

      mopeVisitors () {
        return this.visitors.filter(item => item.institution_id == 4)
      },

      oicVisitors () {
        return this.visitors.filter(item => item.institution_id == 5)
      }

    },

    mounted () {
      if (!this.loaded) {
        this.$store.dispatch('visitor/getVisitors')
      }

      /* if (!this.ins_loaded) {
         this.$store.dispatch('institution/getInstitutions')
       }*/

    },

    methods: {
      reLoadData () {
        this.$store.dispatch('visitor/getVisitors')
      },

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

      updateVisitor () {
        let $this = this
        axios.put('/api/visitors/' + this.selectedVisitor.id)
          .then(function (response) {
            // console.log('Update: Clock out visitor', response['data']['data'])
            // $this.$router.push('/visitors/list')
            $this.$store.dispatch('visitor/updateCheckout', response['data']['data'])
            // console.log('Update: Clock out visitor')
            $this.$refs['confirmClockOutModal'].hide()
          })
          .catch(function (errors) {
            console.log(errors)
          })
      },

      confirmClockOutVisitor (visitor) {
        this.selectedVisitor = visitor
        this.$refs['confirmClockOutModal'].show()
      },

      hideConfirmClockOutModal () {
        this.$refs['confirmClockOutModal'].hide()
      }

    },

  }
</script>

<style scoped>

  .mope-header {
    background: #97171c;
  }

  .oic-header {
    background: #4ac1ca;
  }

  .gnpc-header {
    background: #cedb25;
  }


</style>
