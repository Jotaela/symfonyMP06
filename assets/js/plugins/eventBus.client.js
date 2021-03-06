import Vue from 'vue'
import { EventBus } from './event-bus.js'

// this helps WebStorm with autocompletion, otherwise it's not needed
Vue.prototype.$eventBus = EventBus

export default {
  install (Vue, options) {
    Vue.prototype.$eventBus = EventBus
  }
}
