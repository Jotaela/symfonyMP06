<template>
  <v-btn :loading="loading" @click="$emit('removed', habitat)" icon color="error">
    <v-icon>delete</v-icon>
  </v-btn>
</template>
<script>
export default {
  name: 'AppHabitatsRemove',
  props: {
    'habitat': {
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
