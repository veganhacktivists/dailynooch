<template>
  <Widget :name="name" :error="data.error">
    <template v-if="data.feedItems && data.feedItems.length">
      <Slider
        width="peek"
        :items="items"
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
      return this.data.feedItems.map(i => {
        i.footerText = `${this.getSiteName(i.link)} | ${getTimeAgo(i.date)}`;
        return i;
      });
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
