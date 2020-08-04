<template>
  <Widget :name="name">
    <p v-for="thread of data" :key="thread.url">
      <a :href="thread.url" target="_blank">{{ thread.title }}</a>
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
