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
          <Draggable v-for="widget in widgetsLeft" :key="widget">
            <WidgetComponent :title="widget" :mode="mode" />
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
          <Draggable v-for="widget in widgetsCenter" :key="widget">
            <WidgetComponent :title="widget" :mode="mode" />
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
          <Draggable v-for="widget in widgetsRight" :key="widget">
            <WidgetComponent :title="widget" :mode="mode" />
          </Draggable>
        </Container>
      </div>
    </div>
  </div>
</template>

<script>
import { Container, Draggable } from 'vue-smooth-dnd'
import WidgetComponent from './WidgetComponent'
import { applyDrag } from "../util/helpers"

export default {
  name: 'widget-overview',
  components: {
    Container,
    Draggable,
    WidgetComponent
  },
  data() {
    return {
      mode: 'view',
      // @todo Come up with a better way to structure widgets. And get this from
      // the API.
      widgetsLeft: [
        'Recipes of the day',
      ],
      widgetsCenter: [
        'Quote of the day',
        'Art of the day'
      ],
      widgetsRight: [
        'Lives counter',
        'Latest news'
      ],
    }
  },
  methods: {
    onDrop(collection, dropResult) {
      this[collection] = applyDrag(this[collection], dropResult)
    },
    toggleEdit() {
      this.mode = this.mode === 'edit' ? 'view' : 'edit'
    }
  }
}
</script>

<style>
.smooth-dnd-container {
  min-height: 100%;
}
</style>
