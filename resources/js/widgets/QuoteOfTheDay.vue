<template>
  <Widget :name="name" :error="data.error">
    <blockquote class="blockquote">
      <ReadMore
        more-str="More"
        :text="quoteText"
        less-str="Less"
        :max-chars="150"
      />
      <p>
        <em>&mdash;{{ data.author }}</em>
      </p>
    </blockquote>
    <ShareUs :buttonText="'this quote'" :title="shareTitle" />
  </Widget>
</template>

<script>
  import Widget from '../components/Widget'
  import ReadMore from '../components/ReadMore'
  import ShareUs from '../components/ShareUs'

  export default {
    name: 'quote-of-the-day',
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
      ReadMore,
      ShareUs,
    },
    computed: {
      quoteText() {
        return `“${this.data.text}”`
      },
      shareTitle() {
        return `${this.quoteText} - find more vegan quotes at ${window.location.origin}!`
      },
    },
  }
</script>
