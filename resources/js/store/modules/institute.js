// eslint-disable-next-line no-unused-vars
import axios from 'axios'

export const state = {
  institutions: [],
  loading: false,
  loaded: false
}

// actions
export const actions = {
  // get data using axios
  getInstitutions ({ commit }) {
    commit('initGetInstitutions')
    axios.get('/api/institutions')
      .then(function (response) {
        // console.log('get my institutions', response.data.data)
        commit('successGetInstitutions', response.data.data)
      })
      .catch(function (errors) {
        commit('failureGetInstitutions')
        console.log(errors)
      })
  },

  addInstitutionItem ({ commit }, department) {
    commit('addInstitution', department)
  }
}

// Getters
export const getters = {
  all_institutes: state => state.institutions,
  loading: state => state.loading,
  loaded: state => state.loaded
}

// Mutations
export const mutations = {
  // delete department from the front-end
  deleteInstitution(state, institution) {
    state.institutions.pop(institution)
  },

  addInstitution (state, institution) {
    state.institutions.unshift(institution)
  },

  initGetInstitutions (state) {
    state.loading = true
  },

  successGetInstitutions (state, institutions) {
    state.loading = false
    state.loaded = true
    state.institutions = institutions
  },

  failureGetInstitutions (state) {
    state.loading = false
    state.loaded = false
    state.institutions = []
  }
}
