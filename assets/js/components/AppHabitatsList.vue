<template>
  <app-card-with-toolbar
    :loading="loadingList"
    @toggled="toggle"
    @minimization="minimization"
    @refreshed="$emit('refreshed')"
    :minimize="minimize"
    :maximize="maximize"
    :show="show"
  >
    <span slot="title">Habitats</span>
    <v-card-title>
      <v-spacer />
      <v-text-field :value="search" @input="search=arguments[0]" label="Buscar" append-icon="search" />
    </v-card-title>
    <v-data-table :headers="headers" :items="habitats" :search="search">
      <template v-slot:item.actions="{ item }">
        <habitats-form :habitat="item" class="mx-2" />
        <habitats-remove :habitat="item" class="mx-2" />
      </template>
    </v-data-table>
  </app-card-with-toolbar>
</template>
<script>
import AppCardWithToolbar from './AppCardWithToolbar'
import HabitatsForm from './HabitatsForm'
import HabitatsRemove from './HabitatsRemove'

export default {
  name: 'AppHabitatsList',
  components: {
    'app-card-with-toolbar': AppCardWithToolbar,
    'habitats-form': HabitatsForm,
    'habitats-remove': HabitatsRemove,
  },
  props: {
    habitats: {
      type: Array,
      required: true
    },
    loadingList: {
      type: Boolean,
      required: true
    }
  },
  data () {
    return {
      show: true,
      minimize: false,
      maximize: true,
      headers: [
        {
          text: 'Id',
          value: 'id'
        },
        {
          text: 'Nom',
          value: 'nom'
        },
        {
          text: 'Descripció',
          value: 'descripcio'
        },
        {
          text: 'Accions',
          value: 'actions',
          sortable: false
        }
      ],
      search: ''
    }
  },
  methods: {
    minimization () {
      this.minimize = !this.minimize
    },
    toggle () {
      this.show = !this.show
    }
  }
}
</script>
