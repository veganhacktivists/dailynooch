<template>
  <Widget :name="name">
    <figure>
      <img class="image" :src="data.imageUrl" :alt="data.imageAlt" />
      <figcaption>— {{ data.caption }}</figcaption>
    </figure>
    <button class="btn btn-primary" @click="share">Share</button>
  </Widget>
</template>

<script>
import Widget from './../components/Widget'

export default {
  name: 'art-widget',
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
