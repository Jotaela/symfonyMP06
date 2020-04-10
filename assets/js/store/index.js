import Vue from 'vue'
import Vuex from 'vuex'
import channels from './modules/channels'
import messages from './modules/messages'
import changelog from './modules/changelog'

import state from './state'
import mutations from './mutations'
import getters from './getters'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  strict: debug,
  modules: {
    channels,
    messages,
    changelog
  },
  state,
  mutations,
  getters
})
