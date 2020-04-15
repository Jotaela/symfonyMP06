import axios from 'axios'
const api = {
  index: () => {
    return axios.get('/api/habitats')
  },
  show: (id) => {
    return axios.get('/api/habitats/' + id)
  },
  store: (newHabitat) => {
    return axios.post('/api/habitats', newHabitat)
  },
  put: (id, newHabitat) => {
    return axios.put('/api/habitats/' + id, newHabitat)
  },
  delete: (id) => {
    return axios.delete('api/habitats/' + id)
  }
}

export default api
