<template>
  <div v-swiper:mySwiper="swiperOptions" :class="swiperClass">
    <div v-if="width == 'peek'" class="overlay"></div>
    <div class="swiper-wrapper">
      <div class="swiper-slide" v-for="item in items" :key="item[itemKey]">
        <div class="card">
          <a v-if="cardHeadType == 'image'" :href="item.link" target="_blank" rel="noopener">
            <img class="card-img-top" :src="item.featured_image">
          </a>
          <video v-else width="100%" :poster="getVideoThumbnail(item)" controls>
              <source :src="getVideoLink(item)" :type="getVideoType(item)" />
              Your browser does not support the video tag.
          </video>
          <div class="card-body d-flex flex-column justify-content-between">
            <a :href="item.link" target="_blank" rel="noopener">
              <h5 class="card-title">{{ item.title }}</h5>
            </a>
            <p v-if="item.footerText" class="card-text text-muted small">
              {{ item.footerText }}
            </p>
          </div>
        </div>
      </div>
    </div>
    <div v-if="pagination" class="swiper-pagination" slot="pagination"></div>
  </div>
</template>

<script>
import { Swiper, SwiperSlide, directive } from 'vue-awesome-swiper'

export default {
  props: {
    width: {
      validator: (val) => ['peek', 'full'].includes(val),
      default: 'peek',
    },
    cardHeadType: {
      validator: (val) => ['image', 'video'].includes(val),
      default: 'image',
    },
    pagination: {
      type: Boolean,
      default: false
    },
    items: {
      type: Array,
      required: true,
    },
    itemKey: {
      type: String,
      default: 'link',
    }
  },
  directives: {
    swiper: directive
  },
  components: {
    Swiper,
    SwiperSlide,
  },
  computed: {
    swiperOptions() {
      return {
        loop: true,
        slidesPerView: this.width === 'peek' ? 'auto' : '1',
        spaceBetween: 10,
        pagination: {
          el: '.swiper-pagination',
          clickable: true
        },
      };
    },
    swiperClass() {
      return `width-${this.width}`;
    },
  },
  methods: {
    getVideoThumbnail(item) {
      return item.featured_image
    },
    getVideoLink(item) {
      return item.video.link
    },
    getVideoType(item) {
      return item.video.type
    }
  },
}
</script>

<style lang="scss">
@import '~swiper/swiper';
@import '~swiper/components/pagination/pagination';
</style>

<style lang="scss" scoped>
.swiper-container {
  width: 100%;

  .overlay {
    position: absolute;
    width: 20%;
    height: 100%;
    right: 0;
    background-image: linear-gradient(to right, rgba(255, 255, 255, 0) , rgb(160, 160, 160));
    z-index: 2;
  }
}

.width-peek {
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
}

.width-full {
  .swiper-pagination {
    position: initial;
  }
}
</style>
