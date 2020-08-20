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

    <ul class="list-group" v-for="animal in saved" :key="animal.item">
      <li class="list-group-item px-0 border-0 d-flex justify-content-between">
        <span>{{ animal.item }}</span>
        <span>{{ animal.value }}</span>
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
    saved: function () {
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
  },
  watch: {
    years(newYears) {
      localStorage.animalsSavedCounterYears = newYears
    },
  },
}
</script>
