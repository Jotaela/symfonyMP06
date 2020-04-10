import axios from 'axios'
import * as mutations from '../../mutation-types'
import * as actions from '../../action-types'
import api from './api'
import apiPublish from './'
// import permissions from '../../../api/permissions'

export default {
  async [ actions.MESSAGES_INDEX ] (context) {
    const messages = await api.index()
    context.commit(mutations.MESSAGES_INDEX, messages.data)
  },
  async [ actions.MESSAGES_REFRESH ] (context) {
    const messages = await api.index()
    context.commit(mutations.MESSAGES_INDEX, messages.data)
  },
  async [ actions.MESSAGE_STORE ] (context, message) {
    const nouMissatge = await api.store(message)
    context.commit(mutations.MESSAGE_STORE, nouMissatge.data)
  },
  async [ actions.MESSAGE_UPDATE ] (context, param) {
    const nouMissatge = await api.put(param.message.id, param.newMessage)
    param.newMessage = nouMissatge.data
    context.commit(mutations.MESSAGE_UPDATE, param)
  },
  async [ actions.MESSAGE_DESTROY ] (context, message) {
    await api.delete(message.id)
    context.commit(mutations.MESSAGE_DESTROY, message)
  },
  async [ actions.MESSAGE_PUBLISHED_INDEX ] (context) {
    const messages = await api.publishMessages.index()
    context.commit(mutations.MESSAGE_PUBLISHED_INDEX, messages.data)
  },
  async [ actions.MESSAGE_PUBLISH ] (context, message) {
    const messageNew = await api.publishMessages.store(message)
    const props = {
      newMessage: messageNew.data,
      oldMessage: message
    }
    context.commit(mutations.MESSAGE_PUBLISH, props)
  },
  async [ actions.MESSAGE_UNPUBLISH ] (context, message) {
    const messageNew = await api.publishMessages.remove(message)
    const props = {
      newMessage: messageNew.data,
      oldMessage: message
    }
    context.commit(mutations.MESSAGE_UNPUBLISH, props)
  }
}
