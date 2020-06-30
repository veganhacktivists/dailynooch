<template>
  <Widget :name="name" />
</template>

<script>
import Widget from '../components/Widget'

export default {
  name: 'quote',
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
