<template>
  <Widget :name="name">
    {{ data.testData }}
    <button class="btn btn-primary" @click="share">Share</button>
  </Widget>
</template>

<script>
import Widget from '../components/Widget'

export default {
  name: 'reddit-threads',
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
