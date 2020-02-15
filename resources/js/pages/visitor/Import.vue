<template>
  <div class="container">

    <h1>Import Visitor </h1>
    <!--<vue-csv-import url="/api/employees-import"
                    :map-fields="[ 'emp_code', 'first_name', 'middle_name', 'last_name', 'job_title', 'phone' ]">
    </vue-csv-import>-->


    <vue-csv-import url="/api/visitors-import"
                    :map-fields="[ 'id', 'first_name', 'middle_name', 'last_name', 'gender', 'phone', 'nationality_id', 'document_type_id', 'document_number',
                     'employee_id', 'institution_id', 'visiting', 'purpose', 'visitor_card_id', 'time_in', 'time_out']">
    </vue-csv-import>

  </div>
</template>

<script>
  import { VueCsvImport } from 'vue-csv-import';


  export default {
    name: 'Import',
    components: {
      VueCsvImport
    }
  }
</script>

<style scoped>

</style>
