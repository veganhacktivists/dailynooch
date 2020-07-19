<template>
  <Widget :name="name">
    <blockquote class="blockquote">
      <read-more more-str="More" :text="quoteText" link="#" less-str="Less" :max-chars="150"></read-more>
      <p>
        <em>&mdash;{{ data.author }}</em>
      </p>
    </blockquote>
    <button class="btn btn-primary" @click="share">Share</button>
  </Widget>
</template>

<script>
import Widget from '../components/Widget'

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
  },
  computed: {
    quoteText: {
        get(){
            return `“${this.data.text}”`
        }
    }
  },
  methods: {
    share() {
      alert('not yet implemented')
    },
  },
}
</script>
