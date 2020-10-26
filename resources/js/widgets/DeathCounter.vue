<template>
  <Widget :name="name" :error="data.error">
    <div class="row">
      <div class="col-6 col-sm-3" v-for="(animals, i) in chunks" :key="i">
        <ul class="list-group" v-for="animal in animals" :key="animal.name">
          <li class="list-group-item px-0 border-0">
            <img
              :src="animal.icon"
              :alt="animal.name + ' icon'"
              :title="animal.name"
            />
            {{ Math.ceil(animal.value).toLocaleString() }}
          </li>
        </ul>
      </div>
    </div>

    <p class="text-muted">
      Animals murdered since this page was opened {{ timeSinceOpened }}. All numbers are extracted from FAOSTAT.
    </p>
  </Widget>
</template>

<script>
import Widget from '../components/Widget'
import { formatDistance, subMilliseconds, subSeconds } from 'date-fns'

export default {
  name: 'death-counter',
  props: {
    data: {
      type: Object,
      required: true,
    },
    name: {
      type: String,
      required: true,
    },
  },
  components: {
    Widget,
  },
  data() {
    return {
      columns: 4,
      interval: 50,
      now: new Date(),
      opened: new Date(),
    }
  },
  mounted() {
    setInterval(() => this.now = new Date(), this.interval)
  },
  computed: {
    duration() {
      return this.now.getTime() - this.opened.getTime()
    },
    chunks() {
      let animals = _.cloneDeep(this.data.animals)
      animals = _.orderBy(animals, 'value', 'desc')
      animals = _.map(animals, (animal) =>
        _.assign(animal, {
          icon: `/img/icons/${_.kebabCase(animal.name)}.png`,
          value: (animal.value / 365 / 24 / 60 / 60 / 1000) * this.duration,
        }),
      )
      return _.chunk(animals, Math.ceil(animals.length / this.columns))
    },
    description() {
      return this.data.description
    },
    timeSinceOpened() {
      return formatDistance(
        subMilliseconds(this.opened, this.duration),
        this.opened,
        { addSuffix: true, includeSeconds: true },
      )
    },
  },
}
</script>
