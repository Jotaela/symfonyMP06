<template>
  <v-container>
    <app-animals-list
      @removed="remove"
      @edited="edit"
      @refreshed="refresh"
      :loadingList="loadingList"
      :animals="animals"
    />
  </v-container>
</template>
<script>
import * as actions from '../store/action-types'
import AppAnimalsList from './AppAnimalsList'
export default {
  name: 'AnimalsList',
  components: {
    'app-animals-list': AppAnimalsList
  },
  data () {
    return {
      animal: {},
      loadingList: false
    }
  },
  computed: {
    animals () {
      return this.$store.getters['animals/list']
    }
  },
  methods: {
    remove (animal) {
      this.animals.splice(this.animals.indexOf(animal), 1)
    },
    edit (animal, animalNou) {
      this.animal = animal
    },
    async refresh () {
      try {
        this.loadingList = true
        await this.$store.dispatch('animals/' + actions.ANIMALS_REFRESH)
      } catch (error) {
        console.log('No s\'han pogut carregar els missatges: ' + error)
      }
      this.loadingList = false
    }
  }
}
</script>
