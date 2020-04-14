<template>
  <v-container v-if="show">
    <v-toolbar dense color="primary">
      <v-btn @click="$emit('toggled')" icon color="accent">
        <v-icon>close</v-icon>
      </v-btn>
      <v-toolbar-title class="white--text">
        <slot name="title">PUTO YOUR TITLE HERE</slot>
      </v-toolbar-title>
      <v-spacer />
      <v-btn v-if="!minimize" @click="$emit('minimization')" icon color="accent">
        <v-icon>minimize</v-icon>
      </v-btn>
      <v-btn v-else @click="$emit('minimization')" icon color="accent">
        <v-icon>maximize</v-icon>
      </v-btn>
      <v-btn :loading="loading" @click="$emit('refreshed')" icon color="accent">
        <v-icon>refresh</v-icon>
      </v-btn>
    </v-toolbar>
    <v-card v-show="!minimize">
      <slot>PUT YOUR CONTENT HERE</slot>
    </v-card>
  </v-container>
</template>
<script>
export default {
  name: 'AppCardWithToolbar',
  props: {
    show: {
      type: Boolean,
      required: true
    },
    minimize: {
      type: Boolean,
      required: true
    },
    loading: {
      type: Boolean,
      required: true }
  }
}
</script>
