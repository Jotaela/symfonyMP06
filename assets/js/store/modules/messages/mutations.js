import * as types from '../../mutation-types'

export default {
  [ types.MESSAGES_INDEX ] (state, messages) {
    state.list = messages
  },
  [ types.SET_MESSAGES_STATE ] (state, newState) {
    Object.keys(newState).forEach((key) => {
      state[key] = newState[key]
    })
  },
  [ types.MESSAGE_DESTROY ] (state, message) {
    state.list.splice(state.list.indexOf(message), 1)
  },
  [ types.MESSAGE_STORE ] (state, message) {
    state.list.push(message)
  },
  [ types.MESSAGE_UPDATE ] (state, props) {
    state.list.splice(state.list.indexOf(props.message), 1, props.newMessage)
  },
  [ types.MESSAGE_PUBLISH ] (state, props) {
    state.list.splice(state.list.indexOf(props.oldMessage), 1, props.newMessage)
  },
  [ types.MESSAGE_UNPUBLISH ] (state, props) {
    state.list.splice(state.list.indexOf(props.oldMessage), 1, props.newMessage)
  },
  [ types.USERS_INDEX ] (state, users) {
    state.list = users
  }
}
