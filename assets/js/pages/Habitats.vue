<template>
  <div>
    <habitats-form/>
    <habitats-list />
  </div>
</template>
<script>
import HabitatsList from '../components/HabitatsList'
import HabitatsForm from '../components/HabitatsForm'
import * as actions from '../store/action-types'
export default {
  name: 'Habitats',
  components: {
    'habitats-list': HabitatsList,
    'habitats-form': HabitatsForm
  },
  created() {
    this.$store.dispatch('habitats/' + actions.HABITATS_REFRESH)
  }
}
</script>

<style>

</style>
