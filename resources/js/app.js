require('./bootstrap')
const Vue = require('vue')

// Register our global components
Vue.component(
  'widget-overview',
  require('./components/WidgetOverview.vue').default,
)

// Create the Vue instance
new Vue({ el: '#app' })
