<template>
  <Widget :name="name">
    <div
      v-for="(thread,index) in data"
      :key="thread.permalink"
    >
      <img :src="thread.url" />
    </div>
  </Widget>
</template>

<script>
import Widget from '../components/Widget'

export default {
  name: 'reddit-rveganart',
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
}
</script>
