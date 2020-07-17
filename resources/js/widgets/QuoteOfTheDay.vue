<template>
  <Widget :name="name">
    <blockquote class="blockquote quote">
      &#8220;{{ data.text }}&#8221;
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
  methods: {
    share() {
      alert('not yet implemented')
    },
  },
}
</script>
