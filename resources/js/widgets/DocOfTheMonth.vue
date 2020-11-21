<template>
  <Widget :name="name" :error="data.error">
    <figure>
      <a href="http://3movies.org/" target="_blank"><img class="image" :src="data.imageUrl" /></a>
    </figure>
    <ShareUs :buttonText="'Doc of the month'" :title="shareTitle"></ShareUs>
  </Widget>
</template>

<script>
import Widget from '../components/Widget'
import ShareUs from '../components/ShareUs'

export default {
  name: 'doc-of-the-month',
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
      return `${this.data.imageUrl} - find more vegan documentaries at ${window.location.protocol + '//' + window.location.hostname}!`
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
