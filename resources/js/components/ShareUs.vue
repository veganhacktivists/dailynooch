<template>
  <Modal>
    <template v-slot:button-inner>Share {{ buttonText }}!</template>
    <template v-slot:body>
      <h2 class="text-tertiary text-center" style="margin-bottom: -15px;">Share this on..</h2>
        <div class="share-network-list">
          <ShareNetwork
            v-for="network in networks"
            :network="network.network"
            :key="network.network"
            :style="{backgroundColor: network.color}"
            :url="url"
            :title="title"
            :buttonText="buttonText"
          >
            <i :class="network.icon"></i>
            <span>{{ network.name }}</span>
          </ShareNetwork>
        </div>
    </template>
  </Modal>
</template>

<script>
import Modal from './Modal'
import { ShareNetwork } from 'vue-social-sharing'

export default {
  name: 'share-us',
  props: {
    title: {
      type: String,
      required: true,
    },
    url: {
      type: String,
      default: window.location.protocol + '//' + window.location.hostname
    },
    buttonText: {
      type: String,
      required: true,
    },
  },
  components: {
    Modal,
    ShareNetwork,
  },
  data() {
    return {
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
          network: 'reddit',
          name: 'Reddit',
          icon: 'fab fah fa-lg fa-reddit',
          color: '#ff4500',
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
}
</script>

<style lang="scss" scoped>
.share-network-list {
  display: flex;
  width: 100%;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: space-around;
  max-width: 50rem;
  margin: auto;
  margin-top: 1.5rem;
  margin-bottom: 1rem;
}

a[class^='share-network-'] {
  flex: none;
  color: #ffffff;
  width: 200px;
  background-color: #333;
  border-radius: 0.1875rem;
  overflow: hidden;
  display: flex;
  flex-direction: row;
  align-content: center;
  align-items: center;
  cursor: pointer;
  margin-top: 0.5rem;

  .fah {
    background-color: rgba(0, 0, 0, 0.2);
    padding: 0.625rem;
    flex: 0 1 auto;
  }

  span {
    padding: 0 0.625rem;
    flex: 1 1;
    font-weight: 500;
  }
}
</style>
