<template>
  <Widget :name="name" :error="data.error">
    <template v-if="data.feedItems && data.feedItems.length">
      <swiper ref="mySwiper" :options="swiperOptions">
        <swiper-slide v-for="item in data.feedItems.slice(0, 4)" :key="item.link">
          <div class="card">
            <a :href="item.link" target="_blank" rel="noopener">
              <img class="card-img-top" :src="item.featured_image">
            </a>
            <div class="card-body d-flex flex-column justify-content-between">
              <a :href="item.link" target="_blank" rel="noopener">
                <h5 class="card-title">{{ item.title }}</h5>
              </a>
              <p class="card-text text-muted small">{{ getSiteName(item.link) }} | {{ getTimeago(item.date) }}</p>
            </div>
          </div>
        </swiper-slide>
        <div class="swiper-pagination" slot="pagination"></div>
      </swiper>
    </template>
  </Widget>
</template>

<script>
import Widget from '../components/Widget'
import { Swiper, SwiperSlide, directive } from 'vue-awesome-swiper'
import { getTimeAgo } from '../util/time-ago';

export default {
  name: 'news',
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
  data() {
    return {
      swiperOptions: {
        loop: true,
        slidesPerView: 'auto',
        spaceBetween: 10,
        pagination: {
          el: '.swiper-pagination'
        },
      }
    }
  },
  components: {
    Widget,
    Swiper,
    SwiperSlide,
  },
  directives: {
    swiper: directive
  },
  methods: {
    getSiteName(url) {
      const hostname = new URL(url).hostname.split('.');
      return hostname[hostname.length - 2].toUpperCase();
    },
    getTimeago(date) {
      return getTimeAgo(date);
    }
  },
}
</script>

<style lang="scss">
@import '~swiper/swiper';
</style>

<style lang="scss" scoped>
.swiper-container {
  width: 100%;
}

.swiper-slide {
  display: flex;
  height: auto;
  width: 60%;
  min-width: 12rem;
}

.card {
  height: 100%;
}

.card-img-top {
  height: 9.25rem;
  object-fit: cover;
  object-position: 50% 50%;
}
</style>
