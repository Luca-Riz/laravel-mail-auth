<template>
  <div class="container mt-3">
    <div class="card">
      <h5 class="card-header">{{ post.title }}</h5>
      <div class="card-body">
        <h5 class="card-title" v-if="post.category">
          {{ post.category.name }}
        </h5>
  
        <img class="w-100" :src="post.cover" :alt="post.title"> <!-- img presa con percorso assoluto creato in PostController riga~46 vedi nota -->

        <p class="card-text">{{ post.content }}</p>
        <PostTag :tags="post.tags"/>

        <!-- qui sotto decommentare se non si vogliono usare le props -->
        <!-- <div v-if="post.tags">
          <span class="badge badge-success" v-for="tag in post.tags" :key="tag.id">
            {{ tag.name }}
          </span>
        </div> -->

      </div>
    </div>
  </div>
</template>

<script>

import PostTag from '../components/PostTag';
export default {
  name: "SinglePost",
  components: {
    PostTag
  },
  data() {
    return {
      post: []
    }
  },
  mounted(){
    // console.log(this.$route.params.slug);
    axios.get('/api/post/'+this.$route.params.slug)
        .then( response => {
          this.post = response.data.results;
          console.log(this.post);
        })
        .catch(error => {
          console.log(error);
        });
  }
};
</script>

<style lang="scss" scoped>

</style>
