<template>
  <app-habitats-remove :habitat="habitat" @removed="remove(habitat)" :loading="loading" />
</template>
<script>
import * as types from '../store/action-types'
import AppHabitatsRemove from './AppHabitatsRemove.vue'
export default {
  name: 'HabitatsRemove',
  components: {
    'app-habitats-remove': AppHabitatsRemove
  },
  props: {
    habitat: {
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
    async remove (habitat) {
      const result = await this.$confirm('Si confirmes la operació s\'esborrarà el missatge per sempre', {
        title: 'Estas segur?',
        buttonTrueText: 'Esborrar',
        buttonFalseText: 'Mantenir'
      })
      if (result) {
        try {
          this.loading = true
          await this.$store.dispatch('habitats/' + types.HABITAT_DESTROY, habitat)
        } catch (error) {
          console.log('Hem tingut un problema eliminant el canal :,(')
        }
        this.loading = false
      }
    }
  }
}
</script>
