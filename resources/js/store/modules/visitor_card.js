// eslint-disable-next-line no-unused-vars
import axios from 'axios'

export const state = {
  visitor_cards: [],
  loading: false,
  loaded: false
}

// Getters
export const getters = {
  all_visitor_cards: state => state.visitor_cards,
  loading: state => state.loading,
  loaded: state => state.loaded
}

// actions

export const actions = {
  // get data using axios
  getVisitorCards ({ commit }) {
    commit('initGetVisitorCards')
    axios.get('/api/visitor_cards')
      .then(function (response) {
        // console.log('get my visitor_cards', response.data.data)
        commit('successGetVisitorCards', response.data.data)
      })
      .catch(function (errors) {
        commit('failureGetVisitorCards')
        console.log(errors)
      })
  },

  addVisitorCardItem ({ commit }, visitor_card) {
    commit('addVisitorCard', visitor_card)
  }
}



// Mutations
export const mutations = {
  // delete visitor_card from the front-end
  deleteInstitution(state, visitor_card) {
    state.visitor_cards.pop(visitor_card)
  },


  addVisitorCard (state, visitor_card) {
    state.visitor_cards.unshift(visitor_card)
  },

  initGetVisitorCards (state) {
    state.loading = true
  },

  successGetVisitorCards (state, visitor_cards) {
    state.loading = false
    state.loaded = true
    state.visitor_cards = visitor_cards
  },

  failureGetVisitorCards (state) {
    state.loading = false
    state.loaded = false
    state.visitor_cards = []
  }
}
