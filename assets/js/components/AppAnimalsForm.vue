<template>
  <span>
    <v-dialog v-model="show">
      <v-card>
        <v-toolbar color="primary" class="white--text">
          <v-toolbar-title>Edita el canal {{ animal.name }}</v-toolbar-title>
          <v-spacer />
          <v-btn @click="$emit('toggled')" icon>
            <v-icon>close</v-icon>
          </v-btn>
        </v-toolbar>
        <v-container>
          <v-form ref="form" v-model="valid">
            <v-text-field
              v-model="updatedAnimal.name"
              :rules="nameRules"
              label="Nom de l'animal"
            />
            <v-text-field
              v-model="updatedAnimal.especie"
              label="Especie de l'animal"
            />
            <v-text-field
              v-model="updatedAnimal.altura"
              label="Altura de l'animal"
            />
            <v-text-field
              v-model="updatedAnimal.pes"
              label="Pes de l'animal"
            />
            <v-autocomplete
              v-model="updatedAnimal.habitats"
              :items="habitats"
              item-text="nom"
              dense
              chips
              label="Habitats"
              multiple
            />
          </v-form>
        </v-container>
        <v-card-actions>
          <v-btn :loading="loading" @click="submit(animal, updatedAnimal)" :disabled="!valid" color="primary">
            <v-icon v-if="animal.id == 0">add</v-icon>
            <v-icon v-else>edit</v-icon>
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-btn
      @click="$emit('toggled')"
      v-if="animal.id == 0"
      :loading="loading"
      color="primary"
      class="mb-10"
      fab
      dark
      absolute
      bottom
      right
    >
      <v-icon>add</v-icon>
    </v-btn>
    <v-btn @click="$emit('toggled')" v-else icon>
      <v-icon>edit</v-icon>
    </v-btn>
  </span>
</template>
<script>
import AppChipsHabitats from './AppChipsHabitats'
export default {
  name: 'AppAnimalsForm',
  components: {
    'app-chips-habitats': AppChipsHabitats
  },
  props: {
    animal: {
      type: Object,
      required: true
    },
    updatedAnimal: {
      type: Object,
      required: true
    },
    loading: {
      type: Boolean,
      required: true
    },
    show: {
      type: Boolean,
      required: true
    },
    habitats: {
      type: Array,
      required: true
    }
  },
  data () {
    return {
      nameRules: [
        value => !!value || 'El nom és requerit'
      ],
      valid: false,
    }
  },
  methods: {
    submit (animal, updatedAnimal) {
      this.$emit('submited', animal, updatedAnimal)
    },
    eliminar (habitat) {
      this.updatedAnimal.habitat.splice(this.updatedAnimal.habitat.indexOf(habitat), 1)
    }

  }
}
</script>
