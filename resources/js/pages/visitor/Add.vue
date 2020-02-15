<template>
  <div class="container-fluid">

    <div class="card">
      <div class="card-header bg-success text-white">
        Add Visitor
      </div>

      <div class="card-body">
        <form @submit.prevent="addVisitor">

          <div class="row">
            <div class="form-group col-md-2">
              <input :class="{ 'is-invalid': form.errors.has('first_name') }" v-model="form.first_name" name="first_name" type="text" class="form-control"
                     placeholder="First Name">
              <has-error :form="form" field="first_name" />
            </div>

            <div class="form-group col-md-2">
              <input v-model="form.middle_name" name="middle_name" type="text" class="form-control"
                     placeholder="Middle">
            </div>

            <div class="form-group col-md-2">
              <input :class="{ 'is-invalid': form.errors.has('last_name') }"  v-model="form.last_name" name="last_name" type="text" class="form-control"
                     placeholder="Last Name">
              <has-error :form="form" field="last_name" />

            </div>

            <div class="form-group col-md-2">
              <select :class="{ 'is-invalid': form.errors.has('gender') }"  v-model="form.gender" class="custom-select">
                <option :disabled="true" class="custom-select" :value="null"> -Gender-</option>
                <option value="Male"> Male</option>
                <option value="Female">Female</option>
              </select>
              <has-error :form="form" field="gender" />

            </div>

            <div class="form-group col-md-2">
              <select :class="{ 'is-invalid': form.errors.has('nationality_id') }"  v-model="form.nationality_id" class="custom-select">
                <option :value="null" :disabled="true">-Nationality-</option>
                <option v-for="(nationality, index) in nationalities" :value="nationality.id" :key="nationality.id">
                  {{nationality.name }}
                </option>
              </select>
              <has-error :form="form" field="nationality_id" />

            </div>

            <div class="form-group col-md-2">
              <input :class="{ 'is-invalid': form.errors.has('phone') }"  v-model="form.phone" name="phone" type="text" class="form-control" placeholder="Phone">
              <has-error :form="form" field="phone" />

            </div>
          </div> <!-- END ROW 1 -->

          <div class="row">

            <div class="form-group col-md-2">
              <select :class="{ 'is-invalid': form.errors.has('document_type_id') }"  v-model="form.document_type_id" class="custom-select">
                <option :value="null" :disabled="true">-Document-</option>
                <option v-for="(document_type, index) in document_types" :value="document_type.id"
                        :key="document_type.id"> {{document_type.name }}
                </option>
              </select>
              <has-error :form="form" field="document_type_id" />

            </div>

            <div class="form-group col-md-2">
              <input :class="{ 'is-invalid': form.errors.has('document_number') }"  type="text" v-model="form.document_number" class="form-control" placeholder="Document Number">
              <has-error :form="form" field="document_number" />
            </div>

            <div class="form-group col-md-2">
              <select :class="{ 'is-invalid': form.errors.has('institution_id') }"  v-model="form.institution_id" class="custom-select">
                <option :value="null" :disabled="true"> -Institute-</option>
                <option v-for="(institution, index) in institutions" :value="institution.id" :key="institution.id">
                  {{ institution.name }}
                </option>
              </select>
              <has-error :form="form" field="institution_id" />

            </div>

            <div class="form-group col-md-2" v-if="form.institution_id === 1">
              <select :class="{ 'is-invalid': form.errors.has('department_id') }"  v-model="form.department_id " class="custom-select">
                <option :value="null" :disabled="true"> -Department-</option>
                <option v-for="(department, index) in departments" :value="department.id" :key="department.id">
                  {{ department.name }}
                </option>
              </select>
              <has-error :form="form" field="department_id" />

            </div>.
            <!--<div class="form-group col-md-3" v-if="form.institution_id === 1">
              <select v-model="form.employee_id" class="custom-select" required>
                <option value="" disabled> Visiting</option>
                <option v-for="(employee, index) in employees" :value="employee.id" :key="employee.id">
                  {{ employee.first_name}} {{ employee.last_name}} {{ employee.department.name}} {{
                  employee.phone}}
                </option>
              </select>
            </div>-->

            <div class="col-md-3"  v-if="form.institution_id === 1">
              <model-list-select :class="{ 'is-invalid': form.errors.has('institution_id') }"  input-class="form-control" :list="employees"
                                 v-model="form.employee_id"
                                 option-value="id"
                                 :custom-text="makeFullName"
                                 placeholder="select item"
                                  :value="null"
                                 :disabled="true"
              >
              </model-list-select>
              <has-error :form="form" field="institution_id" />

            </div>

            <div class="col-md-3" v-else>
              <input :class="{ 'is-invalid': form.errors.has('visiting') }"  v-model="form.visiting" type="text" class="form-control" placeholder="Visiting">
              <has-error :form="form" field="visiting" />

            </div>

            <!--<div>
              <label class="typo__label">Select with search</label>
              <multiselect v-model="form.employee_id" :options="employees" placeholder="Select one" label="name" track-by="name"></multiselect>
              <pre class="language-json"><code>{{ value  }}</code></pre>
            </div>-->

          </div> <!--- END ROW 2 -->

          <div class="row">
            <div class="form-group col-md-2">
              <select :class="{ 'is-invalid': form.errors.has('purpose') }"  v-model="form.purpose" name="purpose" class="custom-select">
                <option :value="null" :disabled="true">-Purpose-</option>
                <option value="Official">Official</option>
                <option value="Personal">Personal</option>
              </select>
              <has-error :form="form" field="purpose" />

            </div>


            <div class="form-group col-md-2">
              <select :class="{ 'is-invalid': form.errors.has('visitor_card_id') }"  v-model="form.visitor_card_id" class="custom-select">
                <option :value="null" :disabled="true">-Visitor Card Number-</option>
                <option v-for="(visitor_card, index) in visitor_cards" :value="visitor_card.id"
                        :key="visitor_card.id">
                  {{ visitor_card.name}}
                </option>
              </select>
              <has-error :form="form" field="visitor_card_id" />

            </div>


            <!--<div class="col-md-2">
              <input v-model="form.time_in" type="time" name="time_in" class="form-control">
            </div>-->

          </div> <!-- END ROW 3 -->

          <div class="form-group">
            <button type="submit" class="btn btn-primary"> Add Visitor</button>
          </div>
        </form>
      </div>
      </div>

    </div>
</template>


<script>
  import Form from 'vform'
  import { ModelListSelect } from 'vue-search-select'
  import axios from 'axios'
  import { mapGetters } from 'vuex'

  export default {
    middleware: 'auth',

    name: 'Add',
    components: {
      ModelListSelect
    },

    data () {
      return {
        form: new Form({
          first_name: '',
          middle_name: '',
          last_name: '',
          gender: null,
          nationality_id: null,
          phone: '',
          document_type_id: null,
          document_number: null,
          employee_id: null,
          department_id: null,
          visiting: '',
          purpose: null,
          visitor_card_id: null,
          time_in: '',
          time_out: '',
          institution_id: null,
        })
      }
    },

    methods: {
      addVisitor () {
        let $this = this
        this.form.post('/api/visitors')
        // axios.post('/api/visitors')
        // axios.post('/api/visitors', $this.form)
          .then(function (response) {
            $this.$store.dispatch('visitor/addVisitorItem', response.data.data)
            $this.$router.push('/visitors')
          })
          .catch(function (errors) {
            console.log(errors)
          })
      },

      makeFullName (item) {
        return `${item.first_name}  ${item.middle_name ? item.middle_name : '' }    ${item.last_name}`
      },

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
      if (!this.loaded) {
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
