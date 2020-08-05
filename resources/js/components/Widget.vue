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
      <div v-if="error">
        <div v-if="error.message" class="widget-error">
          <i class="fa fa-exclamation-triangle" aria-hidden="true" /> Error: <pre>{{ error.message}}</pre>
          File: <pre>{{ error.file}}</pre>
          Line: <pre>{{ error.line}}</pre>
          Trace: <pre>{{ error.trace}}</pre>
        </div>
        <div v-else class="alert alert-danger" role="alert">
          <i class="fas fa-kiwi-bird"></i>&nbsp;
          There was a problem loading this widget. Please try again later.
        </div>
      </div>
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

<style scoped lang="scss">
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

  .widget-error {
    max-height: 20rem;
    overflow: auto;

    i {
      color: red;
    }
  }
</style>
