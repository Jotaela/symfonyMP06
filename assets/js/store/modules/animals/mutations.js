import * as types from '../../mutation-types'

export default {
  [ types.SET_ANIMALS_STATE ] (state, newState) {
    Object.keys(newState).forEach((key) => {
      state[key] = newState[key]
    })
  },
  [ types.ANIMALS_INDEX ] (state, animals) {
    state.list = animals
  },
  [ types.ANIMAL_DESTROY ] (state, animal) {
    state.list.splice(state.list.indexOf(animal), 1)
  },
  [ types.ANIMAL_STORE ] (state, animal) {
    state.list.push(animal)
  },
  [ types.ANIMAL_UPDATE ] (state, props) {
    state.list.splice(state.list.indexOf(props.animal), 1, props.newAnimal)
  }
}
