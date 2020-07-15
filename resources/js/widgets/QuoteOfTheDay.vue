<template>
  <Widget :name="name">
      <h3>{{ data.author }}</h3>
      {{ data.text }}
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
}
</script>
