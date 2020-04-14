import axios from 'axios'
import * as mutations from '../../mutation-types'
import * as actions from '../../action-types'
import api from './api'
// import permissions from '../../../api/permissions'

export default {
  [actions.ANIMALS_SEARCH] ({ commit }, textToSearch) {
    return new Promise(async (resolve, reject) => {
      try {
        const channels = await api.search(textToSearch)
        commit(mutations.ANIMALS_SET_FOUND, channels)
        resolve(channels)
      } catch (error) {
        reject(error)
      }
    })
  },
  [ actions.ANIMALS_INDEX ] (context) {
    return api.index()
  },
  async [ actions.ANIMALS_REFRESH ] (context) {
    const channels = await api.index()
    context.commit(mutations.ANIMALS_INDEX, channels.data)
  },
  async [ actions.ANIMAL_STORE ] (context, channel) {
    const nouCanal = await api.store(channel)
    context.commit(mutations.ANIMAL_STORE, nouCanal.data)
  },
  async [ actions.ANIMAL_UPDATE ] (context, param) {
    const nouCanal = await api.put(param.channel.id, param.newChannel)
    param.newChannel = nouCanal.data
    context.commit(mutations.ANIMAL_UPDATE, param)
  },
  async [ actions.ANIMAL_DESTROY ] (context, channel) {
    await api.delete(channel.id)
    context.commit(mutations.ANIMAL_DESTROY, channel)
  },
  async [ actions.ANIMAL_PUBLISHED_INDEX ] (context) {
    const channels = await api.publishChannels.index()
    context.commit(mutations.ANIMAL_PUBLISHED_INDEX, channels.data)
  }
}
