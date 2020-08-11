<template>
  <Widget :name="name" :error="data.error">
    <template v-if="data.feedItems">
      <Carousel :perPage="1" loop>
        <Slide v-for="item in data.feedItems.slice(0, 5)" :key="item.link">
          <video width="100%" :poster="getVideoThumbnail(item)" controls>
            <source :src="getVideoLink(item)" :type="getVideoType(item)" />
            Your browser does not support the video tag.
          </video>
          <h5>{{ item.title }}</h5>
        </Slide>
      </Carousel>
    </template>
  </Widget>
</template>

<script>
import Widget from '../components/Widget'
import { Carousel, Slide } from 'vue-carousel'

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
    Carousel,
    Slide,
  },
  methods: {
    getVideoThumbnail(item) {
      return item.enclosures[0].link
    },
    getVideoLink(item) {
      return item.enclosures[1].link
    },
    getVideoType(item) {
      return item.enclosures[1].type
    }
  },
}
</script>

<style lang="scss">
.VueCarousel-dot-container,
.VueCarousel-dot {
  margin-top: 0 !important;
}
</style>
