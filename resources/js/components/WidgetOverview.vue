<template>
  <div class="container">
    <div v-if="state === 'error'" class="alert alert-danger" role="alert">
      <i class="fas fa-kiwi-bird"></i>&nbsp;
      There was a problem loading the widgets. Please try again later.
    </div>

    <!-- @todo Display loading indicator according to design -->
    <div v-else-if="state === 'loading'" class="spinner-border" role="status">
      <span class="sr-only">Loading...</span>
    </div>

    <div v-else class="row">
      <div class="col col-md-3">
        <component
          v-for="widget in widgetsLeft"
          :key="widget.id"
          :is="widget.type"
          :name="widget.name"
          :data="widget.data"
        />
      </div>
      <div class="col-12 col-md-9 col-lg-6">
        <component
          v-for="widget in widgetsCenter"
          :key="widget.id"
          :is="widget.type"
          :name="widget.name"
          :data="widget.data"
        />
      </div>
      <div class="col col-md-3">
        <component
          v-for="widget in widgetsRight"
          :key="widget.id"
          :is="widget.type"
          :name="widget.name"
          :data="widget.data"
        />
      </div>
    </div>
  </div>
</template>

<script>
import Widget from './Widget'
import widgetComponents from '../widgets'

export default {
  name: 'widget-overview',
  components: {
    ...widgetComponents,
  },
  provide() {
    return {
      widgetContext: this.widgetContext,
    }
  },
  data() {
    // @todo Come up with a better way to structure widgets and figure out what
    // the initial position of each widget should be.

    return {
      widgetContext: { mode: 'view' },
      widgetsLeft: [],
      widgetsCenter: [],
      widgetsRight: [],
      // Either loading, success or error.
      state: 'loading',
    }
  },
  async mounted() {
    try {
      const { data } = await axios.get('/widgets')

      this.state = 'success'
      // @todo Figure how where each widget should be positioned and how to
      // store this in state.
      data.widgets.forEach(widget => {
        if (widget.type == 'art') {
          this.widgetsRight.push(widget);
        }
        else {
          this.widgetsCenter.push(widget);
        }
      });
    } catch (err) {
      this.state = 'error'
    }
  },
}
</script>

<style>
</style>
