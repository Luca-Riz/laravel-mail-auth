<template>
  <main>
    <!-- <div class="container mt-3">
      <p>Pagina: {{ currentPage }} di {{ lastPage }} pagine totali</p>
    </div> -->
    <div class="container">
      <div class="row">
        <div class="col-sm-6" v-for="post in posts" :key="post.id">
          <div class="card mt-3">
            <div class="card-body">
              <h5 class="card-title">{{ post.title }}</h5>
              <p>{{ formatData(post.created_at) }}</p>
              <p class="card-text">{{ truncate(post.content, 150) }}</p>
              <a href="#" class="btn btn-primary">Dettagli</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- num pagina previos and next -->
    <div class="container mt-5">
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li class="page-item" 
          :class="{'disabled' : currentPage === 1}">
            <button class="page-link" href="#" @click="getPosts(currentPage - 1)">Previous</button>
          </li>

          <li class="page-item"
            :class="{'active' : currentPage == i}"
            v-for="i in lastPage" :key="i"
            @click="getPosts(i)">
              <a class="page-link" href="#"> {{ i }} </a>
          </li>


          <li class="page-item"
          :class="{'disabled' : currentPage === lastPage}">
            <button class="page-link" href="#" @click="getPosts(currentPage + 1)">Next</button>
          </li>
        </ul>
      </nav>
    </div>
    <!-- end num pagina previos and next -->

  </main>
</template>

<script>
export default {
  name: "Main",
  data() {
    return {
      chiamataApi: 'http://127.0.0.1:8000/api/posts',
      posts: [],
      currentPage: 1,
      lastPage: null
    }
  },
  created(){
    this.getPosts(1);
  },
  methods:{
    getPosts(pagePost){
      axios.get(this.chiamataApi, {
        params: {
          page: pagePost
        }
      })
          .then(response => {

            this.posts = response.data.results.data;
            this.currentPage = response.data.results.current_page;
            this.lastPage = response.data.results.last_page;
            // console.log(this.posts);

          })
          .catch()
    },

    truncate(text,maxlength){
      if(text.length > maxlength){
        return text.substr(0,maxlength) + '...';
      }

      return text;
    },

    formatData(data){
      //creiamo un'istanza dell'oggetto date sulla data created_at
      const postData = new Date(data);

      let day = postData.getDate();
      let month = parseInt(postData.getMonth() + 1);

        //prendiamo giorno, mese e anno
      if(day < 10){
        day = '0' + day;
      }

      if(month < 10){
        month = '0' + month;
      }

      //restituisce la data formattata
      return day + '/' + month + '/' + postData.getFullYear();
    }
  }
}
</script>

<style lang="sass" scoped>

</style>