<template>
  <Widget :name="name" :error="data.error">
    <figure>
      <a href="http://3movies.org/" target="_blank" rel="noopener">
        <img class="image" :src="data.imageUrl" :alt="imageAlt" />
      </a>
    </figure>
    <ShareUs :buttonText="'Doc of the month'" :title="shareTitle" />
  </Widget>
</template>

<script>
  import ShareUs from '../components/ShareUs'
  import Widget from '../components/Widget'

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
      ShareUs,
      Widget,
    },
    computed: {
      imageAlt() {
        const { docName } = this.data;
        return docName.charAt(0).toUpperCase() + docName.slice(1);
      },
      shareTitle() {
        const { origin } = document.location
        return `${origin}/${this.data.imageUrl} - find more vegan documentaries at ${origin}!`
      },
    },
  }
</script>
