import * as types from '../../mutation-types'

export default {
  [ types.SET_ANIMALS_STATE ] (state, newState) {
    Object.keys(newState).forEach((key) => {
      state[key] = newState[key]
    })
  },
  [ types.ANIMALS_INDEX ] (state, channels) {
    state.list = channels
  },
  [ types.ANIMAL_DESTROY ] (state, channel) {
    state.list.splice(state.list.indexOf(channel), 1)
  },
  [ types.ANIMAL_STORE ] (state, channel) {
    state.list.push(channel)
  },
  [ types.ANIMAL_UPDATE ] (state, props) {
    state.list.splice(state.list.indexOf(props.channel), 1, props.newChannel)
  }
}
