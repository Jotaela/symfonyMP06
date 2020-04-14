<template>
  <app-animals-remove :animal="animal" @removed="remove(animal)" :loading="loading" />
</template>
<script>
import * as types from '../store/action-types'
import AppAnimalsRemove from './AppAnimalsRemove.vue'
export default {
  name: 'AnimalsRemove',
  components: {
    'app-animals-remove': AppAnimalsRemove
  },
  props: {
    animal: {
      type: Object,
      required: true
    }
  },
  data () {
    return {
      loading: false
    }
  },
  methods: {
    async remove (animal) {
      const result = await this.$confirm('Si confirmes la operació s\'esborrarà el missatge per sempre', {
        title: 'Estas segur?',
        buttonTrueText: 'Esborrar',
        buttonFalseText: 'Mantenir'
      })
      if (result) {
        try {
          this.loading = true
          await this.$store.dispatch('animals/' + types.ANIMAL_DESTROY, animal)
        } catch (error) {
          console.log('Hem tingut un problema eliminant el canal :,(')
        }
        this.loading = false
      }
    }
  }
}
</script>
