<template>
  <Widget :name="name" :error="data.error">
    <blockquote class="blockquote">
      <ReadMore more-str="More" :text="data.text" less-str="Less" :max-chars="150" />
    </blockquote>
    <ShareUs :title="data.text + ' - find more vegan quotes at '" />
  </Widget>
</template>

<script>
import Widget from '../components/Widget'
import ReadMore from '../components/ReadMore'
import ShareUs from '../components/ShareUs'

export default {
  name: 'fact-of-the-day',
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
    ShareUs
  },
}
</script>
