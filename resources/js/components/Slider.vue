<template>
  <div :ref="name" :class="swiperClass">
    <div class="swiper-wrapper">
      <div class="swiper-slide" v-for="item in items" :key="item[itemKey]"
      >
        <div class="card">
          <a v-if="cardHeadType == 'image'" :href="item.link" target="_blank" rel="noopener">
            <img class="card-img-top" :src="item.featuredImage">
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
    <div v-if="width == 'peek'" class="overlay"></div>
    <div v-if="pagination" :class="paginationClass"></div>
  </div>
</template>

<script>
import Swiper, { Pagination } from 'swiper';
Swiper.use([Pagination]);

export default {
  props: {
    name: {
      type: String,
      required: true,
    },
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
  data() {
    return {
      uniquePaginationClass: `swiper-pagination-${this.name}`,
    };
  },
  computed: {
    paginationClass() {
      return `swiper-pagination ${this.uniquePaginationClass}`;
    },
    swiperOptions() {
      return {
        loop: true,
        slidesPerView: this.width === 'peek' ? 'auto' : '1',
        spaceBetween: 10,
        pagination: {
          el: `.${this.uniquePaginationClass}`,
          clickable: true
        },
      };
    },
    swiperClass() {
      return `swiper-container width-${this.width}`;
    },
  },
  methods: {
    getVideoThumbnail(item) {
      return item.featuredImage
    },
    getVideoLink(item) {
      return item.video.link
    },
    getVideoType(item) {
      return item.video.type
    }
  },
  mounted: function() {
    const swiper = new Swiper(this.$refs[this.name], this.swiperOptions);
  },
}
</script>

<style lang="scss">
@import '~swiper/swiper-bundle';
</style>

<style lang="scss" scoped>
.swiper-container {
  width: 100%;
  z-index: auto;

  .overlay {
    position: absolute;
    width: 20%;
    height: 100%;
    top: 0;
    right: 0;
    background-image: linear-gradient(to right, rgba(255, 255, 255, 0) , rgba(0, 0, 0, 0.259));
  }

  .swiper-wrapper {
    z-index: auto;
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
    width: 100%;
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
