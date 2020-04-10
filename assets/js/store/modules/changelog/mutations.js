import * as types from '../../mutation-types'

export default {
  [ types.SET_CHANGELOG_STATE ] (state, newState) {
    Object.keys(newState).forEach((key) => {
      state[key] = newState[key]
    })
  },
  [ types.CHANGELOG_INDEX ] (state, log) {
    state.list = log
  }
}
