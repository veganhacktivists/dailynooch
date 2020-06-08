<template>
  <div class="container">
    <div class="row">
      <div class="col col-md-3">
        <button class="btn btn-primary mb-4" @click="toggleEdit">Toggle edit mode</button>
        <Container
          group-name="moveable"
          :get-child-payload="i => widgetsLeft[i]"
          drag-handle-selector=".handle"
          @drop="onDrop('widgetsLeft', $event)"
        >
          <Draggable v-for="widget in widgetsLeft" :key="widget.id">
            <component :is="widget.type" :data="widget.data" />
          </Draggable>
        </Container>
      </div>
      <div class="col-12 col-md-9 col-lg-6">
        <Container
          group-name="moveable"
          :get-child-payload="i => widgetsCenter[i]"
          drag-handle-selector=".handle"
          @drop="onDrop('widgetsCenter', $event)"
        >
          <Draggable v-for="widget in widgetsCenter" :key="widget.id">
            <component :is="widget.type" :data="widget.data" />
          </Draggable>
        </Container>
      </div>
      <div class="col col-md-3">
        <Container
          group-name="moveable"
          :get-child-payload="i => widgetsRight[i]"
          drag-handle-selector=".handle"
          @drop="onDrop('widgetsRight', $event)"
        >
          <Draggable v-for="widget in widgetsRight" :key="widget.id">
            <component :is="widget.type" :data="widget.data" />
          </Draggable>
        </Container>
      </div>
    </div>
  </div>
</template>

<script>
import { Container, Draggable } from 'vue-smooth-dnd'
import Widget from './Widget'
import { applyDrag } from "../util/helpers"
import widgetComponents from "../widgets"

// Mock data.
const widgets = [
  {
    id: 1,
    type: "art",
    data: {
      caption: "By anonymous",
      imageAlt: "Life is too short to make other lives shorter",
      imageUrl: "https://i.imgur.com/Qvh34OM.png"
    }
  },
  { id: 2, type: "livesCounter", data: null },
  { id: 3, type: "news", data: null },
  { id: 4, type: "quote", data: null },
  { id: 5, type: "recipe", data: null }
]

export default {
  name: 'widget-overview',
  components: {
    Container,
    Draggable,
    ...widgetComponents
  },
  provide() {
    return {
      widgetContext: this.widgetContext
    }
  },
  data() {
    // @todo Come up with a better way to structure widgets and figure out what
    // the initial position of each widget should be.
    const left = widgets.slice(0, 2)
    const center = widgets.slice(2, 4)
    const right = widgets.slice(4)

    return {
      widgetContext: { mode: 'view' },
      widgetsLeft: left,
      widgetsCenter: center,
      widgetsRight: right,
    }
  },
  methods: {
    onDrop(collection, dropResult) {
      this[collection] = applyDrag(this[collection], dropResult)
    },
    toggleEdit() {
      this.widgetContext.mode = this.widgetContext.mode === 'edit' ? 'view' : 'edit'
    }
  }
}
</script>

<style>
.smooth-dnd-container {
  min-height: 100%;
}
</style>
