<template>
  <div class="card mb-4 border-0">
    <div class="card-body">
      <div class="d-flex">
        <template v-if="widgetContext.mode === 'edit'">
          <div class="handle">
            <HandleIcon />
          </div>
        </template>
        <h5 class="card-title text-tertiary">{{ name }}</h5>
      </div>
      <div v-if="error" v-html="error['xdebug_message']" style="max-height: 20rem; overflow-y: auto;"></div>
      <slot v-else />
    </div>
  </div>
</template>


<script>
import HandleIcon from './HandleIcon'

export default {
  name: 'widget',
  inject: ['widgetContext'],
  props: {
    name: {
      type: String,
      required: true,
    },
    error: {
      type: Object,
    }
  },
  components: {
    HandleIcon,
  },
}
</script>

<style scoped>
  .handle {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 1.5rem;
    height: 1.5rem;
    margin-right: 0.5rem;
    cursor: -webkit-grab;
    cursor: grab;
  }
</style>
