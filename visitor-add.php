<template>
  <div class="container-fluid">
    <div class="card">
      <div class="card-header bg-info">
        Add Visitor
      </div>
      <div class="card-body">
        <form @submit.prevent="addVisitor">
          <div class="row">
            <div class="col-md-12">
              <div class="row form-group">
                <div class="form-group col-md-2">
                  <input v-model="form.first_name" name="first_name" type="text" class="form-control" placeholder="First Name">
                </div>

                <div class="form-group col-md-2">
                  <input v-model="form.middle_name" name="middle_name" type="text" class="form-control" placeholder="Middle Name">
                </div>

                <div class="form-group col-md-2">
                  <input v-model="form.last_name" name="last_name" type="text" class="form-control" placeholder="Last Name">
                </div>

                <div class="form-group col-md-2">
                  <select v-model="form.gender" class="custom-select">
                    <option selected disabled> -Gender-</option>
                    <option value="Male"> Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>

                <div class="form-group col-md-2">
                  <select v-model="form.nationality_id" class="custom-select" required>
                    <option value="">-Nationality-</option>
                    <option v-for="(nationality, index) in nationalities" :value="nationality.id" :key="nationality.id">
                      {{nationality.name }}
                    </option>
                  </select>
                </div>

                <div class="form-group col-md-2">
                  <input v-model="form.phone" name="phone" type="text" class="form-control" placeholder="Phone">
                </div>
              </div>
            </div>

            <div class="row mx-2">
              <div class="row form-group">
                <div class="form-group col-md-2">
                  <select v-model="form.document_type_id" class="custom-select" required>
                    <option value="" disabled>-Document-</option>
                    <option v-for="(document_type, index) in document_types" :value="document_type.id"
                            :key="document_type.id">
                      {{document_type.name }}
                    </option>
                  </select>

                </div>

                <div class="form-group col-md-2">
                  <input v-model="form.document_number" name="document_number" type="text" class="form-control" placeholder="Document Number">
                </div>

                <div class="form-group col-md-4">
                  <select v-model="form.employee_id" class="custom-select" required>
                    <option value="" disabled> Visiting</option>
                    <option v-for="(employee, index) in employees" :value="employee.id" :key="employee.id">
                      {{ employee.first_name}} {{ employee.last_name}} | {{ employee.department.name}} | {{
                      employee.phone}}
                    </option>
                  </select>
                </div>


                <div class="form-group col-md-2">
                  <select v-model="form.purpose" name="purpose" id="" class="custom-select">
                    <option disabled selected>-Purpose-</option>
                    <option value="Official">Official</option>
                    <option value="Personal">Personal</option>
                  </select>
                </div>

                <div class="form-group col-md-1">
                  <select v-model="form.visitor_card_id" class="custom-select" required>
                    <option selected disabled>-Card #-</option>
                    <option v-for="(visitor_card, index) in visitor_cards" :value="visitor_card.id"
                            :key="visitor_card.id">
                      {{ visitor_card.name}}
                    </option>
                  </select>
                </div>

                <div class="col-md-1">
                  <input v-model="form.time_in" type="time" name="time_in" class="form-control">
                </div>
              </div>
            </div>

          </div>


          <div class="form-group">
            <button type="submit" class="btn btn-primary"> Add Visitor</button>
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
    name: 'Add',

    data () {
      return {
        form: {
          first_name: '',
          middle_name: '',
          last_name: '',
          gender: '',
          nationality_id: '',
          phone: '',
          document_type_id: '',
          document_number: '',
          employee_id: '',
          // department_id: '',
          purpose: '',
          visitor_card_id: '',
          time_in: '',
          time_out: ''
        }
      }
    },

    methods: {
      addVisitor() {
        let $this = this
        axios.post('/api/visitors', $this.form)
          .then(function (response) {
            $this.$store.dispatch('visitor/addVisitorItem', response.data.data)



            // $this.$router.push('/visitors')
          })
          .catch(function (errors) {
            console.log(errors)
          })
      }
    },

    computed: {
      ...mapGetters({
        institutions: 'institute/all_institutes',
        loading: 'institute/loading',
        loaded: 'institute/loaded',

        nationalities: 'nationality/all_nationalities',
        nat_loading: 'nationality/loading',
        nat_loaded: 'nationality/loaded',

        employees: 'employee/all_employees',
        emp_loading: 'employee/loading',
        emp_loaded: 'employee/loaded',

        departments: 'department/all_departments',
        dept_loading: 'department/loading',
        dept_loaded: 'department/loaded',

        visitor_cards: 'visitor_card/all_visitor_cards',
        vis_loading: 'visitor_card/loading',
        vis_loaded: 'visitor_card/loaded',

        document_types: 'document_type/all_document_types',
        doc_loading: 'document_type/loading',
        doc_loaded: 'document_type/loaded'
      })
    },

    mounted () {
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
