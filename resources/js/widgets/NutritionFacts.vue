<template>
  <Widget :name="name" :error="data.error">
    <template v-if="data.feedItems && data.feedItems.length">
      <Slider name="nutrition-facts-slider" :items="items" pagination />
    </template>
  </Widget>
</template>

<script>
  import Slider from '../components/Slider'
  import Widget from '../components/Widget'

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
      Slider,
      Widget,
    },
    computed: {
      items() {
        return this.data.feedItems.map((item) => ({
          ...item,
          featuredImage: item.featured_image,
        }))
      },
    },
  }
</script>
