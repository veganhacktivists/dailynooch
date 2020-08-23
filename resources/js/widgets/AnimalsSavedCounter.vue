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

    <ul class="list-group" v-for="animal in animals" :key="animal.name">
      <li class="list-group-item px-0 border-0 d-flex justify-content-between">
        <img :src="'/img/icons/' + animal.name.toLowerCase() + '.png'" />
        <span>{{ animal.name }}</span>
        <span>{{ animal.value.toLocaleString() }}</span>
      </li>
    </ul>

    <ul class="list-group" v-for="resource in resources" :key="resource.name">
      <li class="list-group-item px-0 border-0 d-flex justify-content-between">
        <span>{{ resource.name }}</span>
        <span>{{ resource.value.toLocaleString() }} {{ resource.unit }}</span>
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
      let animals = _.cloneDeep(this.data.animals)
      animals = _.map(animals, (animal) =>
        _.assign(animal, {
          value: Math.round(_.sum(_.takeRight(animal.values, this.years))),
        }),
      )
      animals = _.orderBy(animals, 'value', 'desc')
      animals = _.filter(animals, (animal) => Math.round(animal.value) > 0)
      return animals
    },
    resources() {
      let resources = [
        { name: 'Water', unit: 'l', value: 1519823 },
        { name: 'Grain', unit: 'kg', value: 6607 },
        { name: 'Forest', unit: 'sq. m', value: 1022 },
        { name: 'CO2', unit: 'kg', value: 3322 },
      ]
      resources = _.orderBy(resources, 'value', 'desc')
      resources = _.filter(
        resources,
        (resource) => Math.round(resource.value) > 0,
      )
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
