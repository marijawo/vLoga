import axios from 'axios'

export const state = {
  nationalities: [],
  loading: false,
  loaded: false
}

export const actions = {
  getNationalities ({ commit }) {
    commit('initGetNationalities')
    axios.get('/api/nationalities')
      .then(function (response) {
        commit('initGetNationalitiesSuccess', response.data.data)
        console.log('all nationalities', response.data.data)
      })
      .catch(function (errors) {
        commit('initGetNationalitiesFailure')
        console.log(errors)
      })
  },

  addNationalityItem ({ commit }, nationality) {
    commit('addNationality', nationality)
  }
}



export const getters = {
  all_nationalities: state => state.nationalities,
  loading: state => state.loading,
  loaded: state => state.loaded
}

export const mutations = {

  deleteNationality(state, nationality) {
    state.nationalities.pop(nationality)
  },


  addNationality (state, nationality) {
    state.nationalities.unshift(nationality)
  },

  initGetNationalities (state) {
    state.loading = false
  },

  initGetNationalitiesSuccess (state, nationalities) {
    state.loading = false
    state.loaded = true
    state.nationalities = nationalities
    console.log(nationalities)
  },

  initGetNationalitiesFailure (state) {
    state.loading = false
    state.loaded = false
    state.nationalities = []
  },

}
