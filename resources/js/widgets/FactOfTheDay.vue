<template>
  <Widget :name="name" :error="data.error">
    <blockquote class="blockquote">
      <ReadMore more-str="More" :text="factText" less-str="Less" :max-chars="150"></ReadMore>
    </blockquote>
    <ShareUs :title="shareTitle"></ShareUs>
  </Widget>
</template>

<script>
import Widget from '../components/Widget'
import ReadMore from '../components/ReadMore'
import ShareUs from '../components/ShareUs'

export default {
  name: 'fact-of-the-day',
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
    ReadMore,
    ShareUs
  },
  computed: {
    factText() {
      return `${this.data.text}`
    },
    shareTitle() {
      return `${this.factText} - find more vegan facts at ${window.location.protocol + '//' + window.location.hostname}!`
    }
  },
  methods: {
    share() {
      alert('not yet implemented')
    },
  },
}
</script>
