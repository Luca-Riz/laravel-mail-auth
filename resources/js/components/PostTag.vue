<template>
  <div v-if="tags">
    <span class="badge badge-success" v-for="(tag, index) in tags" :key="index">
      {{ tag.name }}
    </span>
  </div>
</template>

<script>
export default {
  name: "PostTag",
  props: {
    tags: Array
  }
}
</script>

<style lang="scss" scoped>

</style>