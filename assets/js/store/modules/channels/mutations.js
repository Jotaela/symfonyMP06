import * as types from '../../mutation-types'

export default {
  [ types.CHANNELS_INDEX ] (state, channels) {
    state.list = channels
  },
  [ types.SET_CHANNELS_STATE ] (state, newState) {
    Object.keys(newState).forEach((key) => {
      state[key] = newState[key]
    })
  },
  [ types.CHANNEL_DESTROY ] (state, channel) {
    state.list.splice(state.list.indexOf(channel), 1)
  },
  [ types.CHANNEL_STORE ] (state, channel) {
    state.list.push(channel)
  },
  [ types.CHANNEL_UPDATE ] (state, props) {
    state.list.splice(state.list.indexOf(props.channel), 1, props.newChannel)
  },
  [ types.CHANNELS_SET_FOUND ] (state, channels) {
    state.found = channels
  },
  [ types.CHANNEL_PUBLISH ] (state, props) {
    state.list.splice(state.list.indexOf(props.oldChannel), 1, props.newChannel)
  },
  [ types.CHANNEL_UNPUBLISH ] (state, props) {
    state.list.splice(state.list.indexOf(props.oldChannel), 1, props.newChannel)
  }
}
