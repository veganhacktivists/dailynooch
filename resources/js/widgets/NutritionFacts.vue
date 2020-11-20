<template>
  <Widget :name="name" :error="data.error">
    <template v-if="data.feedItems && data.feedItems.length">
      <Slider
        name="nutrition-facts-slider"
        :items="items"
        pagination
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

<style lang="scss">
.swiper-pagination-nutrition-facts-slider {
  position: initial;
}
</style>
