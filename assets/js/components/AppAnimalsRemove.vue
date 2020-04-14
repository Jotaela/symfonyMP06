<template>
  <v-btn :loading="loading" @click="$emit('removed', animal)" icon color="error">
    <v-icon>delete</v-icon>
  </v-btn>
</template>
<script>
export default {
  name: 'AppAnimalsRemove',
  props: {
    'animal': {
      type: Object,
      required: true
    },
    loading: {
      type: Boolean,
      required: true
    }
  }
}
</script>
