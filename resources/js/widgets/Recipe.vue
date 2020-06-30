<template>
  <Widget :name="Recipe" />
</template>

<script>
import Widget from "../components/Widget"

export default {
  name: 'news',
  props: {
    data: {
      type: Object,
      required: true
    },
    name: {
      type: String,
      required: true
    }
  },
  components: {
    Widget
  }
}
</script>
