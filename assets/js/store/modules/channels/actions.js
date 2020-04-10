import axios from 'axios'
import * as mutations from '../../mutation-types'
import * as actions from '../../action-types'
import api from './api'
// import permissions from '../../../api/permissions'

export default {
  [actions.CHANNELS_SEARCH] ({ commit }, textToSearch) {
    return new Promise(async (resolve, reject) => {
      try {
        const channels = await api.search(textToSearch)
        commit(mutations.CHANNELS_SET_FOUND, channels)
        resolve(channels)
      } catch (error) {
        reject(error)
      }
    })
  },
  [ actions.CHANNELS_INDEX ] (context) {
    return api.index()
  },
  async [ actions.CHANNELS_REFRESH ] (context) {
    const channels = await axios.get('/api/v1/channels')
    context.commit(mutations.CHANNELS_INDEX, channels.data)
  },
  async [ actions.CHANNEL_STORE ] (context, channel) {
    const nouCanal = await api.store(channel)
    context.commit(mutations.CHANNEL_STORE, nouCanal.data)
  },
  async [ actions.CHANNEL_UPDATE ] (context, param) {
    const nouCanal = await api.put(param.channel.id, param.newChannel)
    param.newChannel = nouCanal.data
    context.commit(mutations.CHANNEL_UPDATE, param)
  },
  async [ actions.CHANNEL_DESTROY ] (context, channel) {
    await api.delete(channel.id)
    context.commit(mutations.CHANNEL_DESTROY, channel)
  },
  async [ actions.CHANNEL_PUBLISHED_INDEX ] (context) {
    const channels = await api.publishChannels.index()
    context.commit(mutations.CHANNEL_PUBLISHED_INDEX, channels.data)
  },
  async [ actions.CHANNEL_PUBLISH ] (context, channel) {
    const channelNew = await api.publishChannels.store(channel)
    const props = {
      newChannel: channelNew.data,
      oldChannel: channel
    }
    context.commit(mutations.CHANNEL_UNPUBLISH, props)
  },
  async [ actions.CHANNEL_UNPUBLISH ] (context, channel) {
    const channelNew = await api.publishChannels.remove(channel)
    const props = {
      newChannel: channelNew.data,
      oldChannel: channel
    }
    context.commit(mutations.CHANNEL_PUBLISH, props)
  }
}
