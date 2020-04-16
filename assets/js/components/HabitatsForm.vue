<template>
  <app-habitats-form
    :habitat="habitat"
    :updatedHabitat="updatedHabitat"
    :show="show"
    :loading="loading"
    :animals="animals"
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
          name: '',
          descripcio: '',
          animals: []
        }
      }
    }
  },
  computed: {
    animals() {
      return this.$store.getters['animals/list']
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
        animals: this.habitat.animals
      }
    }
  },
  methods: {
    async submit (habitat, newHabitat) {
      try {
        this.loading = true
        if (habitat.id === 0) {
          await this.$store.dispatch('habitats/' + types.HABITAT_STORE, newHabitat)
          this.initHabitat()
        } else {
          const props = {
            habitat,
            newHabitat
          }
          await this.$store.dispatch('habitats/' + types.HABITAT_UPDATE, props)
        }
        this.toggle()
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
        id: 0,
        name: '',
        descripcio: '',
        animals: []
      }
    }
  }
}
</script>
