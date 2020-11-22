<template>
  <Widget :name="name" :error="data.error">
    <a
      class="twitter-timeline"
      data-height="1500"
      data-dnt="true"
      href="https://twitter.com/5m5v_en?ref_src=twsrc%5Etfw"
    >
      Tweets by 5m5v_en
    </a>
    <a
      href="https://5minutes5vegans.org/"
      target="_blank"
      rel="noopener"
      class="btn btn-primary"
    >
      Help others go vegan!
    </a>
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
      const twitterScript = document.createElement('script')
      twitterScript.src = 'https://platform.twitter.com/widgets.js'
      twitterScript.async = true
      twitterScript.crossOrigin = true
      document.head.appendChild(twitterScript)
    },
  }
</script>


