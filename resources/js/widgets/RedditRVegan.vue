<template>
  <Widget :name="name">
    <div id="redditThreadsContainer" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">

        <div
          v-for="(thread,index) in data"
          :key="thread.permalink"
          :class="['carousel-item text-center ', (index === 0 ? 'active' : '')]"
        >
          <a :href="thread.permalink" target="_blank" rel="noopener">
            <img v-if="thread.thumbnail == 'self'" height="140px" width="140px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIwAAACMCAYAAACuwEE+AAAEqUlEQVR4nO3ZwW6jSBRG4X7/Z2PFio03tUBigZAQQmUhdGcRXaYoFw6/OxmTzGnpU6sJXVD4GMrxn6qqDDjrz7tPAD8LwUBCMJAQDCQEAwnBQEIwkBAMJAQDCcFAQjCQEAwkBAMJwUBCMJAQDCQEAwnBQEIwkBAMJAQDCcFAQjCQEAwkBAMJwUBCMJAQDCQEAwnBQEIwkBAMJAQDCcFAQjCQEAwkBAMJwUBCMJAQDCQEAwnBQEIwkBAMJAQDCcFAQjCQEAwkBAMJwUBCMJAQDCQEAwnBQEIwkBAMJAQDCcFAQjCQEAwkPyqYYRh2/x7H0WKMbz+vkiucW9d1FmO02+22bYsx2jiOL4/5Y4KZ59nMbLctxviw7SqucG7DMJiZWQhh22ZmfxXyjwmm9AJc4UVRzve/1jSNhRCsrmuCucqLopzvFbwtGH8W1nVtwzBYjNFijNb3/a7oVNd1Ns+zxRhtnmfruu7T49xuN4sx2rqu22T9GZy+KOnY4zha0zQPx86f5y5fb6T7tm1bHDeEYNM0WYzRpml6GDc9t77vn16f9Ph+7KN5VFVldV1b13Xb8f0c0kfP0ZzfFoyZ2f1+t3VdbV1XizHasizb9nyCfgFL+x4FdjaY9O/7/b4dJ73Yped56cVN9/Wx0nGXZbG+77efHx3Px0zHOJqzMo+6rnfnku5rZrs34aXWMP5nmqbi5Nu23b2DfN90jGmaittLnj2S7vf77qL6C5p+GnglmHVdd+9OX3jn4/j+6ac4H3NZlt0YpTkfzcPHTefh17Lv+4c3lh/v0sHkd4e2bXcXr67rh4mk/F337C7zWTBpnOkx0wvzSjD5x88QgpmZzfNc3J7uf3RuPud1XV+ahx/vzDW6XDClCPzieTCli5l69kKeDab0nP+KYPI1Vj63fHt6vGeLXr9L+Lko88j5Omscx+2xfdlgSgc+Cia/yF8ZzJnzeyWYfN+vCiYfX5lHVX0sZtN1i5lta0mCIZjiPJZlsWEYLISwrZEu/0g6E4wvxvLnvvNF4DuDOfPOfDWY0trMF8/+CFLm4XeS0ri/4g5TVf8ubPPfVZRW9t8VTNd1Zna8kP2uYPJ9fc5n70b5vkfXy+f3K4Lxbeu6Wt/3FkKwruu2d0Tpk8RRMG3bHt6Cn51f0zTbOfitfBiG08/+V4Px/fM5518Inp2H7zvPs4UQtl8g+tx+RTBV9fFx2+80/mdZllOx5O8gP666WGzbdruofoH9t6HfFUwaic85H1cNP1/w+nX08/YYLxVMuthK1XVtIYTiR8Sq+rglH/3fz/iXaX4BfCzl/Pxn6Zdy+TilL+2ezc23p8dLxyz9vHRNlHmUrmN+fqV5vHrt/zoY/D8RDCQEAwnBQEIwkBAMJAQDCcFAQjCQEAwkBAMJwUBCMJAQDCQEAwnBQEIwkBAMJAQDCcFAQjCQEAwkBAMJwUBCMJAQDCQEAwnBQEIwkBAMJAQDCcFAQjCQEAwkBAMJwUBCMJAQDCQEAwnBQEIwkBAMJAQDCcFAQjCQEAwkBAMJwUBCMJAQDCQEAwnBQEIwkBAMJAQDCcFAQjCQEAwkBAMJwUBCMJAQDCQEA8k/EEevN+OTeggAAAAASUVORK5CYII=" />
            <img v-else :src="thread.thumbnail" />

            <blockquote class="blockquote">
              <p class="mb-0">{{ thread.title }}</p>
              <footer class="blockquote-footer">{{ thread.ups }} upvotes | {{ thread.num_comments }} comments</footer>
            </blockquote>
          </a>
        </div>
      </div>
      <a class="carousel-control-prev" href="#redditThreadsContainer" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#redditThreadsContainer" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </Widget>
</template>

<script>
import Widget from '../components/Widget'

export default {
  name: 'reddit-rvegan',
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
  },
}
</script>

<style scoped>
/* Disable styling on links to match figma design */
.carousel-item a, .carousel-item a:hover, .carousel-item a:visited {
  color: inherit;
  text-decoration: inherit;
}
/* Change carousel buttons to black so they're visible */
.carousel-control-next,
.carousel-control-prev {
    filter: invert(100%);
}
/* Display image as block so we can centre it */
.carousel-item img {
  display: block;
  margin: 0 auto;
}
/* Remove dash prefix on footer */
.blockquote-footer::before {
  content: none;
}
</style>
