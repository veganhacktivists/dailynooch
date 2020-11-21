<template>
  <Widget :name="name" :error="data.error">
    <figure>
      <iframe width="100%" height="500px" frameborder="0" allowfullscreen="" src="//umap.openstreetmap.fr/de/map/animal-rights-map_487135?scaleControl=false&amp;miniMap=false&amp;scrollWheelZoom=true&amp;zoomControl=true&amp;allowEdit=false&amp;moreControl=true&amp;searchControl=true&amp;tilelayersControl=false&amp;embedControl=null&amp;datalayersControl=expanded&amp;onLoadPanel=caption&amp;captionBar=false&amp;fullscreenControl=false&amp;locateControl=true&amp;measureControl=false" style="overflow:hidden;height:300px;width:100%"></iframe>
    </figure>	
      <a href="https://animalrightsmap.org/" target="_blank"><button class="btn btn-primary">View the full map!</button></a>

  </Widget>
</template>

<script>
import Widget from '../components/Widget'
import ShareUs from '../components/ShareUs'

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
    ShareUs
  },
  computed: {
    shareTitle() {
      return `${this.data.imageUrl} - find more animal rights groups at ${window.location.protocol + '//' + window.location.hostname}!`
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
