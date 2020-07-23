<template>
  <Widget :name="name">
    <blockquote class="blockquote">
      <ReadMore more-str="More" :text="quoteText" less-str="Less" :max-chars="150"></ReadMore>
      <p>
        <em>&mdash;{{ data.author }}</em>
      </p>
    </blockquote>
    <ShareUs :title="shareTitle"></ShareUs>
  </Widget>
</template>

<script>
import Widget from '../components/Widget'
import ReadMore from '../components/ReadMore'
import ShareUs from '../components/ShareUs'

export default {
  name: 'quote-of-the-day',
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
    quoteText() {
      return `“${this.data.text}”`
    },
    shareTitle() {
      return `${this.quoteText} - find more vegan quotes at vDashboard.org!`
    }
  },
  methods: {
    share() {
      alert('not yet implemented')
    },
  },
}
</script>
