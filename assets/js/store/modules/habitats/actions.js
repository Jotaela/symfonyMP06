import axios from 'axios'
import * as mutations from '../../mutation-types'
import * as actions from '../../action-types'
import api from './api'
// import permissions from '../../../api/permissions'

export default {
  async [ actions.HABITATS_REFRESH ] (context) {
    const habitats = await api.index()
    context.commit(mutations.HABITATS_INDEX, habitats.data)
  },
  async [ actions.HABITAT_STORE ] (context, habitat) {
    const nouCanal = await api.store(habitat)
    context.commit(mutations.HABITAT_STORE, nouCanal.data)
  },
  async [ actions.HABITAT_UPDATE ] (context, param) {
    const nouCanal = await api.put(param.habitat.id, param.newHabitat)
    param.newHabitat = nouCanal.data
    context.commit(mutations.HABITAT_UPDATE, param)
  },
  async [ actions.HABITAT_DESTROY ] (context, habitat) {
    await api.delete(habitat.id)
    context.commit(mutations.HABITAT_DESTROY, habitat)
  }
}
