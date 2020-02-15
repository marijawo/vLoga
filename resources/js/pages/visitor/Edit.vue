<template>
  <div class="container-fluid">

<!--    {{ currentVisitor }}-->
    <div class="card">
      <div class="card-header bg-info text-white">
        List Visitor
      </div>
      <div class="card-body">
        <form @submit.prevent="updateVisitor">

          <div class="row">
            <div class="form-group col-md-2">
              <input v-model="currentVisitor.first_name" name="first_name" type="text" class="form-control"
                     placeholder="First Name">
            </div>

            <div class="form-group col-md-2">
              <input v-model="currentVisitor.middle_name" name="middle_name" type="text" class="form-control"
                     placeholder="Middle">
            </div>

            <div class="form-group col-md-2">
              <input v-model="currentVisitor.last_name" name="last_name" type="text" class="form-control"
                     placeholder="Last Name">
            </div>

            <div class="form-group col-md-2">
              <select v-model="currentVisitor.gender" class="custom-select">
                <option disabled> -Gender-</option>
                <option value="Male"> Male</option>
                <option value="Female">Female</option>
              </select>
            </div>

            <div class="form-group col-md-2">
              <select v-model="currentVisitor.nationality_id" class="custom-select" required>
                <option value="" disabled selected>-Nationality-</option>
                <option v-for="(nationality, index) in nationalities" :value="nationality.id" :key="nationality.id">
                  {{nationality.name }}
                </option>
              </select>
            </div>

            <div class="form-group col-md-2">
              <input v-model="currentVisitor.phone" name="phone" type="text" class="form-control" placeholder="Phone">
            </div>
          </div> <!-- END ROW 1 -->

          <div class="row">

            <div class="form-group col-md-2">
              <select v-model="currentVisitor.document_type_id" class="custom-select" required>
                <option disabled>-Document-</option>
                <option v-for="(document_type, index) in document_types" :value="document_type.id"
                        :key="document_type.id"> {{document_type.name }}
                </option>
              </select>
            </div>

            <div class="form-group col-md-2">
              <input type="text" v-model="currentVisitor.document_number" class="form-control"
                     placeholder="Document Number">
            </div>

            <div class="form-group col-md-2">
              <select v-model="currentVisitor.institution_id" class="custom-select">
                <option selected disabled> -Institute-</option>
                <option v-for="(institution, index) in institutions" :value="institution.id" :key="institution.id">
                  {{ institution.name }}
                </option>
              </select>
            </div>

           <!-- <div v-if="currentVisitor.employee_id != null">
              {{ currentVisitor.employee.first_name}}
            </div>-->

            <div class="form-group col-md-2" v-if="currentVisitor.institution_id === 1 ">
              <select v-model="currentVisitor.department_id" class="custom-select">
                <option selected> -Institute-</option>
                <option v-for="(department, index) in departments" :value="department.id" :key="department.id">
                  {{ department.name }}
                </option>
              </select>
            </div>

            <div class="form-group col-md-3" v-if="currentVisitor.institution_id === 1">
              <select v-model="form.employee_id" class="custom-select" required>
                <option value="" disabled> Visiting</option>
                <option v-for="(employee, index) in employees" :value="employee.id" :key="employee.id">
                  {{ employee.first_name}} {{ employee.last_name}} {{ employee.department.name}} {{
                  employee.phone}}
                </option>
              </select>
            </div>

            <div class="col-md-3" v-if="currentVisitor.institution_id === 1">
              <model-list-select input-class="form-control" :list="employees"
                                 v-model="currentVisitor.employee_id"
                                 option-value="id"
                                 :custom-text="makeFullName"
                                 placeholder="select item">
              </model-list-select>
            </div>



            <div class="col-md-3" v-else>
              <input v-model="currentVisitor.visiting" type="text" class="form-control" placeholder="Visiting">
            </div>


            <!--<div>
              <label class="typo__label">Select with search</label>
              <multiselect v-model="currentVisitor.employee_id" :options="employees" placeholder="Select one" label="name" track-by="name"></multiselect>
              <pre class="language-json"><code>{{ value  }}</code></pre>
            </div>-->


          </div> <!--- END ROW 2 -->

          <div class="row">
            <div class="form-group col-md-2">
              <select v-model="currentVisitor.purpose" name="purpose" id="" class="custom-select">
                <option disabled selected>-Purpose-</option>
                <option value="Official">Official</option>
                <option value="Personal">Personal</option>
              </select>
            </div>


            <div class="form-group col-md-2">
              <select v-model="currentVisitor.visitor_card_id" class="custom-select" required>
                <option disabled selected>-Card #-</option>
                <option v-for="(visitor_card, index) in visitor_cards" :value="visitor_card.id"
                        :key="visitor_card.id">
                  {{ visitor_card.name}}
                </option>
              </select>
            </div>


            <!--<div class="col-md-2">
              <input v-model="currentVisitor.time_in" type="time" name="time_in" class="form-control">
            </div>-->

          </div> <!-- END ROW 3 -->

          <div class="form-group">
            <button type="submit" class="btn btn-primary"> Update Visitor</button>
          </div>
        </form>

      </div>

    </div>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import axios from 'axios'

  export default {
    middleware: 'auth',

    name: 'Edit',

    data () {
      return {
        form: {
          visor_card: ''
        }
      }
    },

    computed: {
      ...mapGetters({
        visitors: 'visitor/all_visitors',
        loading: 'visitor/loading',
        loaded: 'visitor/loaded',

        visitor_cards: 'visitor_card/all_visitor_cards',
        vis_loading: 'visitor_card/loading',
        vis_loaded: 'visitor_card/loaded',

        institutions: 'institute/all_institutes',
        ins_loading: 'institute/loading',
        ins_loaded: 'institute/loaded',

        nationalities: 'nationality/all_nationalities',
        nat_loading: 'nationality/loading',
        nat_loaded: 'nationality/loaded',

        employees: 'employee/all_employees',
        emp_loading: 'employee/loading',
        emp_loaded: 'employee/loaded',

        departments: 'department/all_departments',
        dept_loading: 'department/loading',
        dept_loaded: 'department/loaded',

        document_types: 'document_type/all_document_types',
        doc_loading: 'document_type/loading',
        doc_loaded: 'document_type/loaded'
      }),

      currentVisitor () {
        return this.visitors.find(item => item.id == this.$route.params.id)
      }
    },

    methods: {
      updateVisitor () {
        let $this = this
        axios.put('/api/visitors/' + $this.$route.params.id, $this.currentVisitor)
          .then(function (response) {
            $this.$router.push('/visitors/list')
            console.log('Update: Clock out visitor')
          })
          .catch(function (errors) {
            console.log(errors)
          })
      }
    },

    mounted () {
      if (!this.loaded) {
        this.$store.dispatch('institute/getVisitors')
      }

      if (!this.ins_loaded) {
        this.$store.dispatch('institute/getInstitutions')
      }
      if (!this.nat_loaded) {
        this.$store.dispatch('nationality/getNationalities')
      }
      if (!this.emp_loaded) {
        this.$store.dispatch('employee/getEmployees')
      }
      if (!this.vis_loaded) {
        this.$store.dispatch('visitor_card/getVisitorCards')
      }
      if (!this.dept_loaded) {
        this.$store.dispatch('department/getDepartments')
      }
      if (!this.doc_loaded) {
        this.$store.dispatch('document_type/getDocumentTypes')
      }
    }

  }
</script>

<style scoped>

</style>
