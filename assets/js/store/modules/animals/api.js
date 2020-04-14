import axios from 'axios'
const api = {
  index: () => {
    return axios.get('/api/animals')
  },
  show: (id) => {
    return axios.get('/api/animals/' + id)
  },
  store: (newAnimal) => {
    return axios.post('/api/animals', newAnimal)
  },
  put: (id, newAnimal) => {
    return axios.put('/api/animals/' + id, newAnimal)
  },
  delete: (id) => {
    return axios.delete('api/animals/' + id)
  }
}

export default api
