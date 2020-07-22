<template>
  <Widget :name="name">
    <blockquote class="blockquote">
      <ReadMore more-str="More" :text="quoteText" less-str="Less" :max-chars="150"></ReadMore>
      <p>
        <em>&mdash;{{ data.author }}</em>
      </p>
    </blockquote>
    <button class="btn btn-primary" @click="share">Share</button>
  </Widget>
</template>

<script>
import Widget from '../components/Widget'
import ReadMore from '../components/ReadMore'

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
    ReadMore
  },
  computed: {
    quoteText() {
      return `“${this.data.text}”`
    }
  },
  methods: {
    share() {
      alert('not yet implemented')
    },
  },
}
</script>
