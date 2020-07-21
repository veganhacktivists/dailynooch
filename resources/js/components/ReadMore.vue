<template>
  <p>
    {{ formattedString }}
    <button
      v-if="textTooLong && !link"
      class="btn btn-link shadow-none"
      @click="toggleReadMore"
    >
      {{ textExpanded ? lessStr : moreStr }}
    </button>
    <a
      v-else-if="textTooLong && link"
      :href="link"
    >
      {{ moreStr }}
    </a>
  </p>
</template>

<script>
export default {
  props: {
    moreStr: {
      type: String,
      default: "read more"
    },
    lessStr: {
      type: String,
      default: ""
    },
    text: {
      type: String,
      required: true
    },
    link: {
      type: String,
      default: null
    },
    maxChars: {
      type: Number,
      default: 100
    }
  },
  data() {
    return {
      textTooLong: (this.text.length > this.maxChars),
      textExpanded: false,
    };
  },
  computed: {
    formattedString() {
      if (this.textExpanded || !this.textTooLong) return this.text;

      return this.text
        .match(new RegExp(`^(.{${this.maxChars}}[\\w]*)`))[1]
        + "...";
    }
  },
  methods: {
    toggleReadMore() {
      this.textExpanded = !this.textExpanded
    }
  }
};
</script>
