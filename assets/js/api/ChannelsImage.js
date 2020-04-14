const instance = window.axios

export default {
  updateChannelImage (channel, image) {
    // TODO ->
    //   image.append()
    //   image.append()
    return instance.put('/api/v1/images', image)
  }
}
