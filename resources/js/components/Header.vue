<template>
  
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-success">
      <div class="container-fluid">
        <router-link :to="{name: 'home'}" class="navbar-brand">
          Boolpress
        </router-link>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item" v-for="(link, index) in menuBoolpress" :key="index">
              <router-link :to="{ name: link.routeName }" class="nav-link active">
                {{ link.label }}
              </router-link>
            </li>
            <!-- <li class="nav-item">
              <router-link :to="{name: 'about'}" class="nav-link">
                About
              </router-link>
            </li> -->

          </ul>
        </div>
      </div>
    </nav>
  </header>
</template>

<script>
export default {
  name: "Header",
  data(){
    return {
      menuBoolpress: [
        {
          label: 'Home',
          routeName: 'home' //stesso nome del router
        },
        {
          label: 'Chi siamo',
          routeName: 'about'
        },
        {
          label: 'I miei Posts',
          routeName: 'post'
        },
        {
          label: 'Contatti',
          routeName: 'contact'
        }
      ]
    }
  }
}
</script>

<style lang="sass" scoped>

</style>