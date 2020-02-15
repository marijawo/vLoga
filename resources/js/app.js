import Vue from 'vue'

// import VueTimeago from 'vue-timeago';
import { VueCsvImport } from 'vue-csv-import';
Vue.use(VueCsvImport);

import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'

// Bootstrap-Vue
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import BootstrapVue from 'bootstrap-vue'


// Vue Search select CSS
import 'vue-search-select/dist/VueSearchSelect.css'

import { ModalPlugin } from 'bootstrap-vue'
Vue.use(ModalPlugin)
Vue.use(BootstrapVue)


// Global filters

/*Vue.filter('checkedOut', function (value) {
  return `$${value}`;
});*/


import 'vuetify/dist/vuetify.min.css'

import '~/plugins'
import '~/components'

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  router,
  ...App
})
