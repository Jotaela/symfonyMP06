<template>
  <app-animals-form
    :animal="animal"
    :updatedAnimal="updatedAnimal"
    :show="show"
    :loading="loading"
    :habitats="habitats"
    @submited="submit"
    @toggled="toggle"
  />
</template>
<script>
import * as types from '../store/action-types'
import AppAnimalsForm from './AppAnimalsForm'

export default {
  name: 'AnimalsForm',
  components: {
    'app-animals-form': AppAnimalsForm
  },
  props: {
    animal: {
      type: Object,
      default: () => {
        return {
          id: 0,
          name: '',
          especie: '',
          altura: '',
          pes: '',
          habitats: []
        }
      }
    }
  },
  computed: {
    habitats() {
      return this.$store.getters['habitats/list']
    }
  },
  data () {
    return {
      loading: false,
      show: false,
      updatedAnimal: {
        id: this.animal.id,
        name: this.animal.name,
        especie: this.animal.especie,
        altura: this.animal.altura,
        pes: this.animal.pes,
        habitats: this.animal.habitats
      }
    }
  },
  methods: {
    async submit (animal, newAnimal) {
      try {
        this.loading = true
        if (animal.id === 0) {
          await this.$store.dispatch('animals/' + types.ANIMAL_STORE, newAnimal)
          this.initAnimal()
        } else {
          const props = {
            animal,
            newAnimal
          }
          await this.$store.dispatch('animals/' + types.ANIMAL_UPDATE, props)
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
    initAnimal () {
      this.updatedAnimal = {
        id: 0,
        name: '',
        especie: '',
        altura: '',
        pes: '',
        habitats: []
      }
    }
  }
}
</script>
