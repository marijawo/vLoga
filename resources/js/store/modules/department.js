import axios from 'axios'

export const state = {
  departments: [],
  loading: false,
  loaded: false
}

export const actions = {
  getDepartments ({ commit }) {
    commit('initGetDepartments')
    axios.get('/api/departments')
      .then(function (response) {
        commit('successGetDepartments', response.data.data)
      })
      .catch(function (errors) {
        console.log(errors)
        commit('failureGetDepartments')
      })
  },

  addDepartmentItem ({ commit }, department) {
    commit('addDepartment', department)
  }
}

// Getters
export const getters = {
  all_departments: state => state.departments,
  loading: state => state.loading,
  loaded: state => state.loaded
}

// Mutations
export const mutations = {

  // Delete departmented
  deleteDepartment (state, department) {
    state.departments.pop(department)
  },

  addDepartment (state, department) {
    state.departments.unshift(department)
  },

  initGetDepartments (state) {
    state.loading = true
  },

  successGetDepartments (state, departments) {
    state.loading = false
    state.loaded = false
    state.departments = departments
    console.log('console log', departments)
  },

  failureGetDepartments (state) {
    state.loading = false
    state.loaded = false
    state.departments = []
  }

}
