<template>
  <v-container>
    <app-habitats-list
      @removed="remove"
      @edited="edit"
      @refreshed="refresh"
      :loadingList="loadingList"
      :habitats="habitats"
    />
  </v-container>
</template>
<script>
import * as actions from '../store/action-types'
import AppHabitatsList from './AppHabitatsList'
export default {
  name: 'HabitatsList',
  components: {
    'app-habitats-list': AppHabitatsList
  },
  data () {
    return {
      habitat: {},
      loadingList: false
    }
  },
  computed: {
    habitats () {
      return this.$store.getters['habitats/list']
    }
  },
  methods: {
    remove (habitat) {
      this.habitats.splice(this.habitats.indexOf(habitat), 1)
    },
    edit (habitat, habitatNou) {
      this.habitat = habitat
    },
    async refresh () {
      try {
        this.loadingList = true
        await this.$store.dispatch('habitats/' + actions.HABITATS_REFRESH)
      } catch (error) {
        console.log('No s\'han pogut carregar els missatges: ' + error)
      }
      this.loadingList = false
    }
  }
}
</script>
