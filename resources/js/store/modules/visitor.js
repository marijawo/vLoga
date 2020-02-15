import axios from 'axios'
import common from 'vue-search-select/src/lib/common'

export const state = {
  visitors: [],
  loading: false,
  loaded: false
}

export const actions = {
  getVisitors ({ commit }) {
    commit('initGetVisitors')
    axios.get('/api/visitors')
      .then(function (response) {
        // console.log('get my institutions', response.data.data)
        commit('successGetVisitors', response.data.data)
      })
      .catch(function (errors) {
        commit('failureGetVisitors')
        console.log(errors)
      })
  },

  addVisitorItem ({ commit }, visitor) {
    commit('addVisitor', visitor)
  },

  updateCheckout ({ commit }, updatedVisitor) {
    commit('updateVisitor', updatedVisitor)
  }
}

export const getters = {
  all_visitors: state => state.visitors,
  loading: state => state.loading,
  loaded: state => state.loaded
}

export const mutations = {
  deleteVisitor (state, visitor) {
    state.visitors.pop(visitor)
  },

  addVisitor (state, visitor) {
    // console.log("unshift visitor to list", visitor)
    state.visitors.unshift(visitor)
  },

  initGetVisitors (state) {
    state.loading = true
  },

  successGetVisitors (state, visitors) {
    state.loading = false
    state.loaded = true
    state.visitors = visitors

  },

  failureGetVisitors (state) {
    state.loaded = false
    state.loading = false
    // state.visitors = []
  },

  updateVisitor (state, updatedVisitor) {
    let foundVisitor = state.visitors.find(item => item.id == updatedVisitor.id)
    Object.assign(foundVisitor, updatedVisitor)
    // console.log('updateVisitor - visitor.js', foundVisitor)
  }

}
