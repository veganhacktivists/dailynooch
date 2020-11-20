<template>
  <Widget :name="name" :error="data.error">
    <a class="twitter-timeline" href="https://twitter.com/5m5v_en?ref_src=twsrc%5Etfw">Tweets by 5m5v_en</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
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


