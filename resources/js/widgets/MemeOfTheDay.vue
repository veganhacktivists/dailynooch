<template>
  <Widget :name="name" :error="data.error">
    <figure>
      <a :href="data.imageUrl" target="_blank">
        <img class="image" :src="data.imageUrl" />
      </a>
    </figure>
    <ShareUs :buttonText="name" :title="shareTitle" />
  </Widget>
</template>

<script>
  import ShareUs from '../components/ShareUs'
  import Widget from '../components/Widget'

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
      ShareUs,
      Widget,
    },
    computed: {
      shareTitle() {
        const { origin } = document.location
        return `${origin}/${this.data.imageUrl} - find more vegan memes at ${origin}!`
      },
    },
  }
</script>
