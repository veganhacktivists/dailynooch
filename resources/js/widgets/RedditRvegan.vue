<template>
  <Widget :name="name">
    <Slider
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
      return this.data.map(i => {
        i.link = i.permalink;
        i.featured_image = i.preview.images[0].resolutions[2].url.replace(/&amp;/g, '&');
        i.footerText = `${ i.ups } upvotes | ${ i.num_comments } comments`;
        return i;
      });
    }
  }
}
</script>
