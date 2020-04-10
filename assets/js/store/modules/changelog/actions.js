import * as mutations from '../../mutation-types'
import * as actions from '../../action-types'
import api from './api'

export default {
  async [ actions.CHANGELOG_INDEX ] (context) {
    const response = await api.index()
    context.commit(mutations.CHANGELOG_INDEX, response.data)
  }
}
