<template>
  <span>
    <slot />
  </span>
</template>

<script>
import * as mutationTypes from '../store/mutation-types'
export default {
  name: 'Page',
  props: {
    state: {
      type: Object,
      required: true
    }
  },
  created () {
    // GUARDAR state a l'estate de Vuex
    const module = this.state.module.toLowerCase()
    this.$store.commit(mutationTypes.SET_MODULE, module)
    const mutation = module + '/SET_' + this.state.module.toUpperCase() + '_STATE'
    this.$store.commit(mutation, this.state.state)
  }
}
</script>

<style>

</style>
