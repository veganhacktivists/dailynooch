<template>
  <Widget :name="name" :error="data.error">
    <figure>
      <a href="http://vbcamp.org/dailynooch" target="_blank"><img class="image" :src="data.imageUrl" /></a>
    </figure>
	<p>
   <b> Vegan Bootcamp </b>is a free challenge website that will take you step-by-step towards a Vegan diet and lifestyle. <b style="
">Already Vegan?</b> <a href="http://vbcamp.org/dailynooch" target="_blank">Signup and share</a> the challenge with your friends and family using your own unique trackable link! 🐤
  </p>
  <a href="http://vbcamp.org/dailynooch" target="_blank"><button class="btn btn-primary">Signup and share!</button></a>
  </Widget>
</template>

<script>
import Widget from '../components/Widget'
import ShareUs from '../components/ShareUs'

export default {
  name: 'vegan-bootcamp',
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
      return `${this.data.imageUrl} - find more vegan challenges at ${window.location.protocol + '//' + window.location.hostname}!`
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
