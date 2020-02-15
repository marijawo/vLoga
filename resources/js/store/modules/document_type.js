import axios from 'axios'

export const state = {
  document_types: [],
  loading: false,
  loaded: false
}

export const actions = {
  getDocumentTypes ({ commit }) {
    commit('initGetDocumentTypes')
    axios.get('/api/document_types')
      .then(function (response) {
        commit('initGetDocumentTypesSuccess', response.data.data)
        console.log('all document_types', response.data.data)
      })
      .catch(function (errors) {
        commit('initGetDocumentTypesFailure')
        console.log(errors)
      })
  },

  addDocumentTypeItem ({ commit }, document_type) {
    commit('addDocumentType', document_type)
  }
}

export const getters = {
  all_document_types: state => state.document_types,
  loading: state => state.loading,
  loaded: state => state.loaded
}

export const mutations = {

  deleteDocumentType(state, document_type) {
    state.document_types.pop(document_type)
  },


  addDocumentType (state, document_type) {
    state.document_types.unshift(document_type)
  },

  initGetDocumentTypes (state) {
    state.loading = false
  },

  initGetDocumentTypesSuccess (state, document_types) {
    state.loading = false
    state.loaded = true
    state.document_types = document_types
    console.log(document_types)
  },

  initGetDocumentTypesFailure (state) {
    state.loading = false
    state.loaded = false
    state.document_types = []
  },

}
