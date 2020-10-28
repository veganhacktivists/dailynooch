<template>
  <Widget :name="name">
    <Slider
      name="r-vegan-slider"
      :items="items"
    />
  </Widget>
</template>

<script>
import Widget from '../components/Widget'
import Slider from '../components/Slider'

export default {
  name: 'reddit-rvegan',
  props: {
    data: {
      type: Array,
      required: true,
    },
    name: {
      type: String,
      required: true,
    },
  },
  components: {
    Widget,
    Slider
  },
  computed: {
    items() {
      return this.data.map(item => ({
        ...item,
        link: item.permalink,
        featuredImage: item.preview.images[0].resolutions[2].url.replace(/&amp;/g, '&'),
        footerText: `${item.ups} upvotes | ${item.num_comments} comments`,
      }));
    }
  }
}
</script>
