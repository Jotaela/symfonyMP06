import * as types from '../../mutation-types'

export default {
  [ types.SET_HABITATS_STATE ] (state, newState) {
    Object.keys(newState).forEach((key) => {
      state[key] = newState[key]
    })
  },
  [ types.HABITATS_INDEX ] (state, habitats) {
    state.list = habitats
  },
  [ types.HABITAT_DESTROY ] (state, habitat) {
    state.list.splice(state.list.indexOf(habitat), 1)
  },
  [ types.HABITAT_STORE ] (state, habitat) {
    state.list.push(habitat)
  },
  [ types.HABITAT_UPDATE ] (state, props) {
    state.list.splice(state.list.indexOf(props.habitat), 1, props.newHabitat)
  }
}
