require('./bootstrap')
const Vue = require('vue')

// Register the global widget-overview component
Vue.component(
  'widget-overview',
  require('./components/WidgetOverview.vue').default,
)

// Create the Vue instance
new Vue({ el: '#app' })
