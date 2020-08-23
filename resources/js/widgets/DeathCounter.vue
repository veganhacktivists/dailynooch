<template>
  <Widget :name="name" :error="data.error">
    <div class="row">
      <div class="col" v-for="animals in chunks">
        <ul class="list-group" v-for="animal in animals" :key="animal.name">
          <li class="list-group-item px-0 border-0">
            <img
              :src="'/img/icons/' + animal.name.toLowerCase() + '.png'"
              :alt="animal.name + ' icon'"
              :title="animal.name"
            />
            {{ Math.ceil(animal.value).toLocaleString() }}
          </li>
        </ul>
      </div>
    </div>

    <p class="text-muted">{{ description }}</p>
  </Widget>
</template>

<script>
import Widget from '../components/Widget'

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
      duration: 0,
      interval: 50,
      columns: 4,
    }
  },
  mounted() {
    setInterval(() => {
      this.duration += this.interval
    }, this.interval)
  },
  computed: {
    chunks() {
      let animals = _.cloneDeep(this.data.animals)
      animals = _.orderBy(animals, 'value', 'desc')
      animals = _.map(animals, (animal) =>
        _.assign(animal, {
          value: (animal.value / 365 / 24 / 60 / 60 / 1000) * this.duration,
        }),
      )
      return _.chunk(animals, Math.ceil(animals.length / this.columns))
    },
    description() {
      return this.data.description
    },
  },
}
</script>
