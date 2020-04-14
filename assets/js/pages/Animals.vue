<template>
  <div>
    <channels-form/>
    <animals-list />
  </div>
</template>
<script>
import AnimalsList from '../components/AnimalsList'
import AnimalsForm from '../components/AnimalsForm'
export default {
  name: 'Animals',
  components: {
    'animals-list': AnimalsList,
    'channels-form': AnimalsForm
  }
}
</script>

<style>

</style>
