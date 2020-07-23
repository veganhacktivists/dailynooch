<template>
  <div>
    <button class="btn btn-primary" @click="shareToggle">Share</button>
    <transition name="modal">
      <div class="modal-mask" v-if="showModal" @click="shareToggle">
        <div class="modal-container">
          <h2 class="text-tertiary text-center">Share This On!</h2>
          <hr>
          <div id="share-network-list">
            <ShareNetwork
              v-for="network in networks"
              :network="network.network"
              :key="network.network"
              :style="{backgroundColor: network.color}"
              :url="sharing.url"
              :title="sharing.title"
            >
              <i :class="network.icon"></i>
              <span>{{ network.name }}</span>
            </ShareNetwork>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
import { ShareNetwork } from 'vue-social-sharing'

export default {
  name: 'share-us',
  props: {
    url: {
      type: String,
    },
    title: {
      type: String,
      required: true,
    },
  },
  components: {
    ShareNetwork,
  },
  data() {
    return {
      showModal: false,
      sharing: {
        url: this.url || 'https://www.veganhactivists.org',
        title: this.title,
      },
      networks: [
        {
          network: 'facebook',
          name: 'Facebook',
          icon: 'fab fah fa-lg fa-facebook-f',
          color: '#1877f2',
        },
        {
          network: 'twitter',
          name: 'Twitter',
          icon: 'fab fah fa-lg fa-twitter',
          color: '#1da1f2',
        },
        {
          network: 'email',
          name: 'Email',
          icon: 'far fah fa-lg fa-envelope',
          color: '#333333',
        },
      ],
    }
  },
  methods: {
    shareToggle() {
      this.showModal = !this.showModal
    },
  },
}
</script>

<style lang="scss" scoped>
.modal-mask {
  display: flex;
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  transition: opacity 0.3s ease;
  justify-content: center;
  align-items: center;
}

.modal-container {
  width: 300px;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
  transition: all 0.3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}

#share-network-list {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: space-around;
  max-width: 1000px;
  margin: auto;
  margin-top: 1.5rem;
  margin-bottom: 1rem;
}

a[class^='share-network-'] {
  flex: none;
  color: #ffffff;
  background-color: #333;
  border-radius: 3px;
  overflow: hidden;
  display: flex;
  flex-direction: row;
  align-content: center;
  align-items: center;
  cursor: pointer;
  margin-top: 0.5rem;

  .fah {
    background-color: rgba(0, 0, 0, 0.2);
    padding: 10px;
    flex: 0 1 auto;
  }

  span {
    padding: 0 10px;
    flex: 1 1;
    font-weight: 500;
  }
}
</style>
