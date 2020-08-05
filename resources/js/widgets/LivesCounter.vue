<template>
  <Widget :name="name" :error="data.error" />
</template>

<script>
import Widget from '../components/Widget'

export default {
  name: 'lives-counter',
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
