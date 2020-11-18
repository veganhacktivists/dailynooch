<template>
  <Widget :name="name" :error="data.error">
    <template v-if="data.feedItems && data.feedItems.length">
      <Slider
        name="nutrition-facts-slider"
        :items="items"
      />
    </template>
  </Widget>
</template>

<script>
import Widget from '../components/Widget'
import Slider from '../components/Slider'

export default {
  name: 'nutrition-facts',
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
    Slider,
  },
  computed: {
    items() {
      return this.data.feedItems.map(item => ({
        ...item,
        featuredImage: item.featured_image,
      }));
    }
  },
}
</script>
