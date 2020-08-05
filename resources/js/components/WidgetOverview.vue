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
        <button class="btn btn-primary mb-4" @click="toggleEdit">Toggle edit mode</button>
        <Container
          group-name="movable"
          :get-child-payload="i => widgetsLeft[i]"
          drag-handle-selector=".handle"
          @drop="onDrop('widgetsLeft', $event)"
        >
          <Draggable v-for="widget in widgetsLeft" :key="widget.id">
            <component :is="widget.type" :name="widget.name" :data="widget.data" />
          </Draggable>
        </Container>
      </div>
      <div class="col-12 col-md-9 col-lg-6">
        <Container
          group-name="movable"
          :get-child-payload="i => widgetsCenter[i]"
          drag-handle-selector=".handle"
          @drop="onDrop('widgetsCenter', $event)"
        >
          <Draggable v-for="widget in widgetsCenter" :key="widget.id">
            <component :is="widget.type" :name="widget.name" :data="widget.data" />
          </Draggable>
        </Container>
      </div>
      <div class="col col-md-3">
        <Container
          group-name="movable"
          :get-child-payload="i => widgetsRight[i]"
          drag-handle-selector=".handle"
          @drop="onDrop('widgetsRight', $event)"
        >
          <Draggable v-for="widget in widgetsRight" :key="widget.id">
            <component :is="widget.type" :name="widget.name" :data="widget.data" />
          </Draggable>
        </Container>
      </div>
    </div>
  </div>
</template>

<script>
import { Container, Draggable } from 'vue-smooth-dnd'
import Widget from './Widget'
import { applyDrag } from '../util/helpers'
import widgetComponents from '../widgets'

export default {
  name: 'widget-overview',
  components: {
    Container,
    Draggable,
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
      widgetsRight: [
        {
          id: 1,
          type: 'art',
          name: 'Art of the day',
          data: {
            caption: 'By anonymous',
            imageAlt: 'Life is too short to make other lives shorter',
            imageUrl: 'https://i.imgur.com/Qvh34OM.png'
          }
        },
      ],
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
      this.widgetsCenter = data.widgets
    } catch (err) {
      this.state = 'error'
    }
  },
  methods: {
    onDrop(collection, dropResult) {
      this[collection] = applyDrag(this[collection], dropResult)
    },
    toggleEdit() {
      this.widgetContext.mode = this.widgetContext.mode === 'edit' ? 'view' : 'edit'
    },
  },
}
</script>

<style>
.smooth-dnd-container {
  min-height: 100%;
}
</style>
