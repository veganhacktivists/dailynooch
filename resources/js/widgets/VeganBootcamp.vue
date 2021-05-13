<template>
  <Widget :name="name" :error="data.error">
    <figure>
      <a href="http://vbcamp.org/dailynooch" target="_blank">
        <img class="image" :src="data.imageUrl" alt="Vegan Bootcamp – Take the Vegan 30 Day Challenge" />
      </a>
    </figure>
    <p>
      <b>Vegan Bootcamp</b> is a free challenge website that will take you
      step-by-step towards a Vegan diet and lifestyle.
      <b>Already Vegan?</b>
      <a href="http://vbcamp.org/dailynooch" target="_blank" rel="noopener">
        Sign up and share
      </a>
      the challenge with your friends and family using your own unique trackable
      link! 🐤
    </p>
    <a
      href="http://vbcamp.org/dailynooch"
      target="_blank"
      rel="noopener"
      class="btn btn-primary"
    >
      Signup and share!
    </a>
  </Widget>
</template>

<script>
  import Widget from '../components/Widget'

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
    },
  }
</script>

<style scoped>
  p {
    line-height: 27px;
  }
</style>
