const instance = window.axios

export default {
  index () {
    return instance.get('/api/v1/users')
  }
}
