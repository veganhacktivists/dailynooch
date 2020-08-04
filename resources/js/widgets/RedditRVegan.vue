<template>
  <Widget :name="name">
    <p v-for="thread of data" :key="thread.permalink">
      <a :href="thread.permalink" target="_blank">
        <img :src="thread.thumbnail" v-if="thread.thumbnail !== 'self'" height="140px" width="140px" />
        <img :src="thread.thumbnail" v-if="thread.thumbnail == 'self'" height="140px" width="140px" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_173b9ddb486%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_173b9ddb486%22%3E%3Crect%20width%3D%22200%22%20height%3D%22200%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2274%22%20y%3D%22104.5%22%3Eno_thumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" />

        <blockquote class="blockquote">
          <p class="mb-0">{{ thread.title }}</p>
          <footer class="blockquote-footer">{{ thread.ups }} upvotes | {{ thread.num_comments }} comments</footer>
        </blockquote>
      </a>
    </p>
  </Widget>
</template>

<script>
import Widget from '../components/Widget'

export default {
  name: 'reddit-threads',
  props: {
    data: {
      type: Array,
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
a, a:hover, a:visited {
  color: inherit;
  text-decoration: inherit;
}
</style>
