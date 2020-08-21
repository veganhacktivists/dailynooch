<template>
  <Widget :name="name" :error="data.error">
    <label class="form-inline">
      <div class="form-group">
        I've been vegan for
        <input
          class="form-control mx-1 w-25"
          type="number"
          min="0"
          v-model="years"
        />
        years.
      </div>
    </label>

    <ul class="list-group" v-for="animal in animals" :key="animal.item">
      <li class="list-group-item px-0 border-0 d-flex justify-content-between">
        <span>{{ animal.item }}</span>
        <span>{{ animal.value }}</span>
      </li>
    </ul>

    <ul class="list-group" v-for="resource in resources" :key="resource.item">
      <li class="list-group-item px-0 border-0 d-flex justify-content-between">
        <span>{{ resource.item }}</span>
        <span>{{ resource.value }} {{ resource.unit }}</span>
      </li>
    </ul>
  </Widget>
</template>

<script>
import Widget from '../components/Widget'

export default {
  name: 'animals-saved-counter',
  props: {
    data: {
      type: Array,
      required: true,
    },
    name: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      years: 0,
    }
  },
  components: {
    Widget,
  },
  mounted() {
    if (localStorage.animalsSavedCounterYears) {
      this.years = localStorage.animalsSavedCounterYears
    }
  },
  computed: {
    animals() {
      let animals = this.data
      animals = _.map(animals, (animal) =>
        _.assign(animal, {
          value: Math.round(_.sum(_.takeRight(animal.values, this.years))),
        }),
      )
      animals = _.orderBy(animals, 'value', 'desc')
      animals = _.map(animals, (animal) =>
        _.assign(animal, { value: animal.value.toLocaleString() }),
      )
      animals = _.filter(animals, (animal) => animal.value !== '0')
      return animals
    },
    resources() {
      let resources = [
        { item: 'Water', unit: 'l', value: 1519823 },
        { item: 'Grain', unit: 'kg', value: 6607 },
        { item: 'Forest', unit: 'sq. m', value: 1022 },
        { item: 'CO2', unit: 'kg', value: 3322 },
      ]
      resources = _.map(resources, (resource) =>
        _.assign(resource, {
          value: (resource.value * this.years).toLocaleString(),
        }),
      )
      resources = _.orderBy(resources, 'value', 'desc')
      resources = _.map(resources, (resource) =>
        _.assign(resource, { value: resource.value.toLocaleString() }),
      )
      resources = _.filter(resources, (resource) => resource.value !== '0')
      return resources
    },
  },
  watch: {
    years(newYears) {
      localStorage.animalsSavedCounterYears = newYears
    },
  },
}
</script>
