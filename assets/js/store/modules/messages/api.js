import axios from 'axios'
const api = {
  index: () => {
    return axios.get('/api/v1/messages')
  },
  store: (message) => {
    return axios.post('/api/v1/messages', message)
  },
  put: (id, newMessage) => {
    return axios.put('/api/v1/messages/' + id, newMessage)
  },
  delete: (id) => {
    return axios.delete('api/v1/messages/' + id)
  },
  publishMessages: {
    index: () => {
      return axios.get('api/v1/published_messages')
    },
    store (message) {
      return axios.post('api/v1/published_messages/' + message.id)
    },
    remove (message) {
      return axios.delete('api/v1/published_messages/' + message.id)
    }
  },
  users: {
    index: (users) => {
      return axios.get('/api/v1/users')
    }
  }
}

export default api
