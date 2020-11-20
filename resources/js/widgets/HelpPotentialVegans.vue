<template>
  <Widget :name="name" :error="data.error">
    <iframe
      id="twitter-widget-0"
      scrolling="no"
      frameborder="0"
      allowtransparency="true"
      allowfullscreen="true"
      class="twitter-timeline twitter-timeline-rendered"
      style="position: static; visibility: visible; display: inline-block; width: 100%; padding: 0px; border: none; max-width: 100%; min-width: 180px; margin-top: 0px; margin-bottom: 0px; min-height: 200px; height: 5661.98px;"
      data-widget-id="profile:5m5v_en"
      title="Twitter Timeline"
    ></iframe>
  </Widget>
</template>

<script>
import Widget from '../components/Widget'

export default {
  name: 'help-potential-vegans',
  props: {
    data: {
      type: Object,
      required: true,
    },
    name: {
      type: String,
      required: true,
    },
  },
  components: {
    Widget,
  },
  mounted() {
      let twitterScript = document.createElement('script');
      twitterScript.async = true;
      twitterScript.src = 'https://platform.twitter.com/widgets.js';
      twitterScript.setAttribute('charset', 'utf-8');
      twitterScript.crossOrigin = 'anonymous';
      twitterScript.onload = () => document.getElementById('timeline-loading')?.remove()
      document.head.appendChild(twitterScript);
      // this.$nextTick(function () { twttr.widgets.load(); });
  },
}
</script>


