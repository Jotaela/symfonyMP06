<template>
  <v-app>
    <v-app-bar
      app
      clipped-left
      clipped-right
      color="primary"
    >
      <v-btn @click="drawerLeft = !drawerLeft" icon>
        <v-icon>menu</v-icon>
      </v-btn>
      <span class="title ml-3 mr-5">Moixonet&nbsp;<span class="font-weight-light">Backend</span></span>
      <v-text-field
        solo-inverted
        flat
        hide-details
        label="Search"
        prepend-inner-icon="search"
      />
      <v-spacer />
    </v-app-bar>
    <v-navigation-drawer
      v-model="drawerLeft"
      app
      clipped
      color="grey lighten-4"
    >
      <v-list
        dense
        class="grey lighten-4"
      >
        <template v-for="(item, i) in leftItems">
          <v-divider
            v-if="item.divider"
            :key="i"
            dark
            class="my-4"
          />
          <v-list-item
            :key="i"
            :href="item.to"
            link
          >
            <v-list-item-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title class="grey--text">
                {{ item.text }}
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </template>
      </v-list>
    </v-navigation-drawer>
    <v-content>
      <slot />
    </v-content>
  </v-app>
</template>

<script>
export default {
  name: 'App',
  props: {
    source: String
  },
  data: () => {
    return {
      drawerLeft: true,
      drawerRight: false,
      leftItems: [
        { icon: 'list', text: 'Animals', to: '/animals'},
        { icon: 'list', text: 'Habitats', to: '/habitats'},
      ],
      users: []
    }
  },
  computed: {
    user () {
      return window.user
    }
  }
}
</script>

<style>
</style>
