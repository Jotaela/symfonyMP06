import axios from 'axios'
const api = {
  index: () => {
    return axios.get('/api/v1/changelogs')
  },
  users: () => {
    return axios.get('/api/v1/users')
  }
}

export default api
