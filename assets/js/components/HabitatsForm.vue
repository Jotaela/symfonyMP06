<template>
  <app-habitats-form
    :habitat="habitat"
    :updatedHabitat="updatedHabitat"
    :show="show"
    :loading="loading"
    @submited="submit"
    @toggled="toggle"
  />
</template>
<script>
import * as types from '../store/action-types'
import AppHabitatsForm from './AppHabitatsForm'

export default {
  name: 'HabitatsForm',
  components: {
    'app-habitats-form': AppHabitatsForm
  },
  props: {
    habitat: {
      type: Object,
      default: () => {
        return {
          id: 0,
          nom: '',
          descripcio: ''
        }
      }
    }
  },
  data () {
    return {
      loading: false,
      show: false,
      updatedHabitat: {
        id: this.habitat.id,
        nom: this.habitat.nom,
        descripcio: this.habitat.descripcio,
      }
    }
  },
  methods: {
    async submit (habitat, newHabitat) {
      try {
        this.loading = true
        if (habitat.id === 0) {
          await this.$store.dispatch('habitats/' + types.HABITAT_STORE, newHabitat)
        } else {
          const props = {
            habitat,
            newHabitat
          }
          await this.$store.dispatch('habitats/' + types.HABITAT_UPDATE, props)
        }
        this.toggle()
        this.initHabitat()
      } catch (error) {
        console.log(error)
      }
      this.loading = false
    },
    toggle () {
      this.show = !this.show
    },
    initHabitat () {
      this.updatedHabitat = {
        id: this.habitat.id,
        name: this.habitat.name,
        descripcio: this.habitat.descripcio
      }
    }
  }
}
</script>
