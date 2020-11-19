<template>
  <Widget :name="name" :error="data.error">
    <template v-if="data.feedItems && data.feedItems.length">
      <Slider
        name="news-slider"
        width="peek"
        :items="items"
        pagination
      />
    </template>
  </Widget>
</template>

<script>
import Widget from '../components/Widget'
import Slider from '../components/Slider';
import { getTimeAgo } from '../util/time-ago';

export default {
  name: 'news',
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
        footerText: `${this.getSiteName(item.link)} | ${getTimeAgo(item.date)}`,
      }));
    }
  },
  methods: {
    getSiteName(url) {
      const hostname = new URL(url).hostname.split('.');
      return hostname[hostname.length - 2].toUpperCase();
    },
  },
}
</script>

<style lang="scss">
.swiper-pagination-news-slider {
  position: initial;
}
</style>
