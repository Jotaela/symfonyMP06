import axios from 'axios'
const api = {
  search (text) {
    return axios.get('/api/v1/channels/search/' + text).then(result => result.data)
  },
  index: () => {
    return axios.get('/api/v1/channels')
  },
  store: (channel) => {
    return axios.post('/api/v1/channels', channel)
  },
  put: (id, newChannel) => {
    return axios.put('/api/v1/channels/' + id, newChannel)
  },
  delete: (id) => {
    return axios.delete('api/v1/channels/' + id)
  },
  publishChannels: {
    index: () => {
      return axios.get('api/v1/published_channels')
    },
    store (channel) {
      return axios.post('api/v1/published_channels/' + channel.id)
    },
    remove (channel) {
      return axios.delete('api/v1/published_channels/' + channel.id)
    }
  },
  users: (users) => {
    return axios.get('/api/v1/users')
  }
}

export default api
