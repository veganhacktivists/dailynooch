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
      <div class="col-14 col-md-4 order-3 order-md-1">
        <component
          v-for="widget in widgetsLeft"
          :key="widget.id"
          :is="widget.type"
          :name="widget.name"
          :data="widget.data"
        />
      </div>
      <div class="col-14 col-md-6 order-1 order-md-2">
        <component
          v-for="widget in widgetsCenter"
          :key="widget.id"
          :is="widget.type"
          :name="widget.name"
          :data="widget.data"
        />
      </div>
      <div class="col-14 col-md-4 order-2 order-md-3">
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

      let widgetsMap = new Map();
      data.widgets.forEach(widget => widgetsMap.set(widget.type, widget));
      this.state = 'success'

      // Make sure that you update one of these three columns with the types of any new widgets or they won't appear.
      let leftWidgetOrder = ['quote-of-the-day','meme-of-the-day','help-make-vegans','help-potential-vegans'];
      let centerWidgetOrder = ['news','reddit-rvegan','nutrition-facts','nutrition-facts-videos','reddit-rveganrecipes','animal-rights-map'];
      let rightWidgetOrder = ['art','project-of-the-month','fact-of-the-day','death-counter','doc-of-the-month','vegan-bootcamp'];

      [{
        targetContainer: this.widgetsLeft,
        widgetOrder: leftWidgetOrder
      },
      {
        targetContainer: this.widgetsCenter,
        widgetOrder: centerWidgetOrder
      },
      {
        targetContainer: this.widgetsRight,
        widgetOrder: rightWidgetOrder
      }
      ].forEach(function(mapping) {
        let targetContainer = mapping.targetContainer, widgetOrder = mapping.widgetOrder;
        widgetOrder.filter(widgetType => widgetsMap.has(widgetType)).forEach(widgetType => targetContainer.push(widgetsMap.get(widgetType)));
      });

    } catch (err) {
      this.state = 'error'
    }
  },
}
</script>

<style>
</style>
