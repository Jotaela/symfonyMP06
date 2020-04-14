import Vue from 'vue'
import Vuex from 'vuex'
import animals from './modules/animals'
import messages from './modules/messages'

import state from './state'
import mutations from './mutations'
import getters from './getters'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  strict: debug,
  modules: {
    animals,
    messages
  },
  state,
  mutations,
  getters
})
