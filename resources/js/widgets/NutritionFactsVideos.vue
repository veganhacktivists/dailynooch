<template>
  <Widget :name="name" :error="data.error">
    <template v-if="data.feedItems && data.feedItems.length">
      <Slider
        name="nf-videos-slider"
        width="full"
        cardHeadType="video"
        :items="items"
        pagination
      />
    </template>
  </Widget>
</template>

<script>
  import Widget from '../components/Widget'
  import Slider from '../components/Slider'
  import { getTimeAgo } from '../util/time-ago'

  export default {
    name: 'nutrition-facts-videos',
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
        return this.data.feedItems.map((item) => ({
          ...item,
          featuredImage: item.featured_image,
          footerText: getTimeAgo(item.date),
        }))
      },
    },
  }
</script>
