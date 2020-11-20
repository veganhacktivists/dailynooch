<template>
  <Widget :name="name" :error="data.error">
    <figure>
      <img class="image" :src="data.imageUrl" />
    </figure>
    <ShareUs :title="shareTitle"></ShareUs>
  </Widget>
</template>

<script>
import Widget from '../components/Widget'
import ShareUs from '../components/ShareUs'

export default {
  name: 'meme-of-the-day',
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
    ShareUs
  },
  computed: {
    shareTitle() {
      return `${this.data.imageUrl} - find more vegan memes at ${window.location.protocol + '//' + window.location.hostname}!`
    }
  },
  methods: {
    share() {
      alert('not yet implemented')
    },
  },
}
</script>

<style scoped>
.image {
  width: 100%;
}
</style>
