<template>
  <Widget :name="name" :error="data.error">
    <figure>
      <a :href="data.imageUrl" target="_blank" rel="noopener">
        <img class="image" :src="data.imageUrl" v-bind:alt="data.imageAlt" />
      </a>
      <figcaption v-if="data.caption">— {{ data.caption }}</figcaption>
    </figure>
    <ShareUs :buttonText="'today\'s art'" :title="shareTitle" />
  </Widget>
</template>

<script>
  import ShareUs from '../components/ShareUs'
  import Widget from '../components/Widget'

  export default {
    name: 'art',
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
        return `${origin}/${this.data.imageUrl} - find more vegan art at ${origin}!`
      },
    },
  }
</script>
