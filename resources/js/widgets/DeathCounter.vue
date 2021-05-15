<template>
  <Widget :name="name" :error="data.error">
    <div class="row">
      <div class="col-6 col-sm-6" v-for="(animals, i) in chunks" :key="i">
        <ul class="list-group" v-for="animal in animals" :key="animal.name">
          <li class="list-group-item px-0 border-0">
            <img
              :src="animal.icon"
              :alt="animal.name"
              :title="animal.name"
            />
            {{ Math.ceil(animal.value).toLocaleString() }}
          </li>
        </ul>
      </div>
    </div>

    <p class="text-muted">
      Animals murdered since page was opened {{ timeSinceOpened }}.
    </p>
  </Widget>
</template>

<script>
  import { formatDistance, subMilliseconds, subSeconds } from 'date-fns'
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
        columns: 2,
        duration: 0,
        interval: 50,
        opened: new Date(),
      }
    },
    mounted() {
      setInterval(() => {
        this.duration = Date.now() - this.opened.getTime()
      }, this.interval)
    },
    computed: {
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
