<template>
  <Widget :name="name" :error="data.error">
    <template v-if="data.feedItems">
      <!-- @todo Implement proper design -->
      <p v-for="item of data.feedItems.slice(0, 10)" :key="item.link">
        {{ item.title }}
      </p>
    </template>
  </Widget>
</template>

<script>
import Widget from '../components/Widget'

export default {
  name: 'nutritional-facts',
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
