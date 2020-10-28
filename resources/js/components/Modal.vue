<template>
  <div>
    <button class="btn btn-primary" @click="openModal">
      <slot name="button-inner">Open Modal</slot>
    </button>
    <transition name="modal">
      <div class="modal-mask" v-if="showModal" @click="closeModal">
        <div class="modal-container">
          <slot name="body">I'm a modal!</slot>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
export default {
  name: 'modal',
  data() {
    return {
      showModal: false,
    }
  },
  methods: {
    openModal() {
      this.showModal = true
    },
    closeModal() {
      this.showModal = false
    }
  },
}
</script>

<style lang="scss" scoped>
.modal-mask {
  display: flex;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  transition: opacity 0.3s ease;
  justify-content: center;
  align-items: center;
  z-index: 1;
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
</style>
