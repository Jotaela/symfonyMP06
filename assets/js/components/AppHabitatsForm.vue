<template>
  <span>
    <v-dialog v-model="show">
      <v-card>
        <v-toolbar color="primary" class="white--text">
          <v-toolbar-title>Edita el canal {{ habitat.nom }}</v-toolbar-title>
          <v-spacer />
          <v-btn @click="$emit('toggled')" icon>
            <v-icon>close</v-icon>
          </v-btn>
        </v-toolbar>
        <v-container>
          <v-form ref="form" v-model="valid">
            <v-text-field
              v-model="updatedHabitat.nom"
              :rules="nomRules"
              label="Nom de l'habitat"
            />
            <v-text-field
              v-model="updatedHabitat.descripcio"
              label="Descripció de l'habitat"
            />
            <v-autocomplete
              v-model="updatedHabitat.animals"
              :items="animals"
              return-object
              :item-text="text"
              dense
              chips
              label="Animals"
              multiple
            />
          </v-form>
        </v-container>
        <v-card-actions>
          <v-btn :loading="loading" @click="submit(habitat, updatedHabitat)" :disabled="!valid" color="primary">
            <v-icon>edit</v-icon>
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-btn
      @click="$emit('toggled')"
      v-if="habitat.id == 0"
      :loading="loading"
      color="primary"
      class="mb-10"
      fab
      dark
      absolute
      bottom
      right
    >
      <v-icon v-if="habitat.id == 0">add</v-icon>
      <v-icon v-else>edit</v-icon>
    </v-btn>
    <v-btn @click="$emit('toggled')" v-else icon>
      <v-icon>edit</v-icon>
    </v-btn>
  </span>
</template>
<script>
export default {
  name: 'AppHabitatsForm',
  props: {
    habitat: {
      type: Object,
      required: true
    },
    updatedHabitat: {
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
    animals: {
      type: Array,
      required: true
    }
  },
  data () {
    return {
      nomRules: [
        value => !!value || 'El nom és requerit'
      ],
      valid: false,
    }
  },
  methods: {
    submit (habitat, updatedHabitat) {
      this.$emit('submited', habitat, updatedHabitat)
    },
    text: item => item.id + ' — ' + item.name
  }
}
</script>
