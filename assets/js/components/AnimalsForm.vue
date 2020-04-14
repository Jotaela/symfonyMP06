<template>
  <app-animals-form
    :animal="animal"
    :updatedAnimal="updatedAnimal"
    :show="show"
    :loading="loading"
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
          pes: ''
        }
      }
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
        pes: this.animal.pes
      }
    }
  },
  methods: {
    async submit (animal, newAnimal) {
      try {
        this.loading = true
        if (animal.id === 0) {
          await this.$store.dispatch('animals/' + types.ANIMAL_STORE, newAnimal)
        } else {
          const props = {
            animal,
            newAnimal
          }
          await this.$store.dispatch('animals/' + types.ANIMAL_UPDATE, props)
        }
        this.toggle()
        this.initAnimal()
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
        id: this.animal.id,
        name: this.animal.name,
        especie: this.animal.especie,
        altura: this.animal.altura,
        pes: this.animal.pes
      }
    }
  }
}
</script>
