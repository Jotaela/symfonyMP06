import axios from 'axios'
import * as mutations from '../../mutation-types'
import * as actions from '../../action-types'
import api from './api'
// import permissions from '../../../api/permissions'

export default {
  [ actions.ANIMALS_INDEX ] (context) {
    return api.index()
  },
  async [ actions.ANIMALS_REFRESH ] (context) {
    const animals = await api.index()
    context.commit(mutations.ANIMALS_INDEX, animals.data)
  },
  async [ actions.ANIMAL_STORE ] (context, animal) {
    const nouCanal = await api.store(animal)
    context.commit(mutations.ANIMAL_STORE, nouCanal.data)
  },
  async [ actions.ANIMAL_UPDATE ] (context, param) {
    const nouCanal = await api.put(param.animal.id, param.newAnimal)
    param.newAnimal = nouCanal.data
    context.commit(mutations.ANIMAL_UPDATE, param)
  },
  async [ actions.ANIMAL_DESTROY ] (context, animal) {
    await api.delete(animal.id)
    context.commit(mutations.ANIMAL_DESTROY, animal)
  }
}
