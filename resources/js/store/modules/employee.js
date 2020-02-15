import axios from 'axios'

export const state = {
  employees: [],
  loading: false,
  loaded: false
}

export const actions = {
  uploadEmployee() {

  },


  getEmployees ({ commit }) {
    commit('initGetEmployees')
    axios.get('/api/employees')
      .then(function (response) {
        commit('successGetEmployees', response.data.data)
      })
      .catch(function (errors) {
        console.log(errors)
        commit('failureGetEmployees')
      })
  },

  addEmployeeItem ({ commit }, employee) {
    commit('addEmployee', employee)
  }
}

// Getters
export const getters = {
  all_employees: state => state.employees,
  loading: state => state.loading,
  loaded: state => state.loaded
}

// Mutations
export const mutations = {

  // Delete employeeed
  deleteEmployee (state, employee) {
    state.employees.pop(employee)
  },

  addEmployee (state, employee) {
    state.employees.unshift(employee)
  },

  initGetEmployees (state) {
    state.loading = true
  },

  successGetEmployees (state, employees) {
    state.loading = false
    state.loaded = false
    state.employees = employees
    console.log('console log', employees)
  },

  failureGetEmployees (state) {
    state.loading = false
    state.loaded = false
    state.employees = []
  }

}
