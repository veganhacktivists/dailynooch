<template>
  <Widget :name="name" :error="data.error">
    <iframe
      width="100%"
      height="500"
      frameborder="0"
      allowfullscreen=""
      src="https://umap.openstreetmap.fr/en/map/animal-rights-map_487135?scaleControl=false&amp;miniMap=false&amp;scrollWheelZoom=true&amp;zoomControl=true&amp;allowEdit=false&amp;moreControl=true&amp;searchControl=true&amp;tilelayersControl=false&amp;embedControl=null&amp;captionBar=false&amp;fullscreenControl=false&amp;locateControl=true&amp;measureControl=false"
      class="iframe"
    />
    <a
      href="https://animalrightsmap.org/"
      target="_blank"
      rel="noopener"
      class="btn btn-primary"
    >
      View the full map!
    </a>
  </Widget>
</template>

<script>
  import Widget from '../components/Widget'

  export default {
    name: 'animal-rights-map',
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
  .iframe {
    overflow: hidden;
    height: 300px;
    width: 100%;
  }
</style>
