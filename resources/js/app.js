require('./bootstrap')
const Vue = require('vue')

// Register the global widget-overview component
Vue.component(
  'widget-overview',
  require('./components/WidgetOverview.vue').default,
)

// Create the Vue instance
new Vue({ el: '#app' })

jQuery(initBookmarkThis)

function initBookmarkThis($) {
  $('#bookmark-this').click(function (e) {
    var bookmarkTitle = document.title
    var bookmarkUrl = window.location.href

    if ('addToHomescreen' in window && addToHomescreen.isCompatible) {
      // Mobile browsers
      addToHomescreen({ autostart: false, startDelay: 0 }).show(true)
    } else if (/CriOS\//.test(navigator.userAgent)) {
      // Chrome for iOS
      alert(
        'To add to Home Screen, launch this website in Safari, then tap the Share button and select "Add to Home Screen".',
      )
    } else if (window.sidebar && window.sidebar.addPanel) {
      // Firefox <=22
      window.sidebar.addPanel(bookmarkTitle, bookmarkUrl, '')
    } else if (
      (window.sidebar &&
        /Firefox/i.test(navigator.userAgent) &&
        !Object.fromEntries) ||
      (window.opera && window.print)
    ) {
      // Firefox 23-62 and Opera <=14
      $(this)
        .attr({
          href: bookmarkUrl,
          title: bookmarkTitle,
          rel: 'sidebar',
        })
        .off(e)
      return true
    } else if (window.external && 'AddFavorite' in window.external) {
      // IE Favorites
      window.external.AddFavorite(bookmarkUrl, bookmarkTitle)
    } else {
      // Other browsers (Chrome, Safari, Firefox 63+, Opera 15+)
      alert(
        'Press ' +
          (/Mac/i.test(navigator.platform) ? 'Cmd' : 'Ctrl') +
          '+D to bookmark this page.',
      )
    }

    return false
  })
}
