<template>
  <Widget :name="name">
    <p v-for="thread of data.slice(0, 10)" :key="thread.url">
      {{ thread.title }}
    </p>
  </Widget>
</template>

<script>
import Widget from '../components/Widget'

export default {
  name: 'reddit-threads',
  props: {
    data: {
      type: Array,
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
