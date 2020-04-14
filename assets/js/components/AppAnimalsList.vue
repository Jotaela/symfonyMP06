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
    <span slot="title">Animals</span>
    <v-card-title>
      <v-spacer />
      <v-text-field :value="search" @input="search=arguments[0]" label="Buscar" append-icon="search" />
    </v-card-title>
    <v-data-table :headers="headers" :items="animals" :search="search">
      <template v-slot:item.actions="{ item }">
        <animals-form :animal="item" class="mx-2" />
        <animals-remove :animal="item" class="mx-2" />
      </template>
    </v-data-table>
  </app-card-with-toolbar>
</template>
<script>
import AppCardWithToolbar from './AppCardWithToolbar'
import AnimalsForm from './AnimalsForm'
import AnimalsRemove from './AnimalsRemove'

export default {
  name: 'AppAnimalsList',
  components: {
    'app-card-with-toolbar': AppCardWithToolbar,
    'animals-form': AnimalsForm,
    'animals-remove': AnimalsRemove,
  },
  props: {
    animals: {
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
          value: 'name'
        },
        {
          text: 'Especie',
          value: 'especie'
        },
        {
          text: 'Altura',
          value: 'altura'
        },
        {
          text: 'Pes',
          value: 'pes'
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
