<template>
  <Widget :name="name" :error="data.error">
    <template v-if="data.feedItems && data.feedItems.length">
      <Slider
        width="full"
        cardHeadType="video"
        :items="items"
        pagination
      >
      </Slider>
    </template>
  </Widget>
</template>

<script>
import Widget from '../components/Widget'
import Slider from '../components/Slider';
import { getTimeAgo } from '../util/time-ago';

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
      return this.data.feedItems.map(i => {
        i.footerText = getTimeAgo(i.date);
        return i;
      });
    }
  },
}
</script>
