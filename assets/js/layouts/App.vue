<template>
  <v-app id="keep">
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
      <template v-if="$isImpersonated">
        <v-badge
          left
          bottom
          overlap
          color="warning"
          class="ml-3 mr-2"
        >
          <template slot="badge">
            <v-icon>warning</v-icon>
          </template>
          <gravatar-avatar @click="drawerRight = !drawerRight" :user="user" />
        </v-badge>
      </template>
      <template v-else>
        <gravatar-avatar id="gravatar_menu" @click="drawerRight = !drawerRight" :user="user" :size="'50'" />
      </template>
    </v-app-bar>
    <v-navigation-drawer
      v-model="drawerRight"
      app
      fixed
      clipped
      right
      color="grey lighten-4"
    >
      <v-list
        dense
        class="grey lighten-4"
      >
        <v-list-item>
          <gravatar-avatar :user="user" :size="'50'" />
          <div class="mx-auto">
            {{ user.name }}
          </div>
        </v-list-item>
        <v-divider
          dark
          class="my-4"
        />
        <template v-if="$isImpersonated">
          <v-container>
            <app-leave-impersonation />
          </v-container>
        </template>
        <template v-else>
          <template v-if="$admin">
            <v-toolbar color="amber">
              <v-toolbar-title class="mx-auto text-center">
                <span class="d-block">Greek God</span><span>(admin)</span>
              </v-toolbar-title>
            </v-toolbar>
            <v-container>
              <impersonate-user :users="users" />
            </v-container>
          </template>
        </template>
        <template v-for="(item, i) in rightItems">
          <v-divider
            v-if="item.divider"
            :key="i"
            dark
            class="my-4"
          />
          <v-list-item
            v-else
            :key="i"
          >
            <v-list-item-content>
              <v-list-item-title>{{ item.text }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <template v-for="arrayItem in item.array">
            <v-chip
              :key="arrayItem"
              dark
              color="primary"
              class="mx-1 my-1"
            >
              {{ arrayItem }}
            </v-chip>
          </template>
        </template>
        <logout-list-item />
      </v-list>
    </v-navigation-drawer>
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
            v-else-if="rol(item.rol)"
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
      <app-snackbar v-model="snackbar" :message="message" :color="color" />
      <slot />
    </v-content>
  </v-app>
</template>

<script>
import LogoutListItem from '../components/LogoutListItem.vue'
import { HasSnackbar } from '../mixins/HasSnackbar'
import AppSnackbar from '../components/AppSnackbar'
import GravatarAvatar from '../components/GravatarAvatar'
import ImpersonateUser from '../components/ImpersonateUser'
import AppLeaveImpersonation from '../components/AppLeaveImpersonation'
import api from '../api/users'
export default {
  name: 'App',
  components: {
    'app-snackbar': AppSnackbar,
    'logout-list-item': LogoutListItem,
    'gravatar-avatar': GravatarAvatar,
    'impersonate-user': ImpersonateUser,
    'app-leave-impersonation': AppLeaveImpersonation
  },
  mixins: [HasSnackbar],
  props: {
    source: String
  },
  data: () => {
    return {
      drawerLeft: true,
      drawerRight: false,
      leftItems: [
        { icon: 'home', text: 'Home', to: '/home', rol: null },
        { icon: 'list', text: 'Channels', to: '/channels', rol: 'ChannelsViewer' },
        { icon: 'list', text: 'Channels DT', to: '/channels_dt', rol: 'ChannelsViewer' },
        { icon: 'list', text: 'Messages', to: '/messages', rol: 'MessagesViewer' },
        { icon: 'list', text: 'Messages DT', to: '/messages_dt', rol: 'MessagesViewer' },
        { icon: 'list', text: 'Changelog', to: '/changelog', rol: 'ChangelogsManager' },
        { icon: 'list', text: 'Cercar Canals', to: '/channelSearch', rol: 'ChannelsViewer' }
      ],
      rightItems: [
        { text: 'ID: ' + window.user.id },
        { text: 'Nom: ' + window.user.name },
        { text: 'Correu: ' + window.user.email },
        { text: 'Rols: ', array: window.user.roles },
        { text: 'Permisos: ', array: window.user.permissions },
        { divider: true },
        { text: 'Opcions: ' }
      ],
      users: []
    }
  },
  computed: {
    user () {
      return window.user
    }
  },
  created () {
    api.index().then(
      (response) => {
        this.users = response.data
      }
    )
  },
  methods: {
    rol (rol) {
      return this.$hasRole(rol)
    }
  }
}
</script>

<style>
    #keep .v-navigation-drawer__border {
        display: none
    }
    #gravatar_menu:hover {
        cursor: pointer
    }
</style>
