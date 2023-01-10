<template>
    <UserProviderVue>
        <NavBarVue />
        <main class="ml-16 main">
          <router-view />
        </main>
    </UserProviderVue>
  <!-- <RouterView /> -->
</template>

<script setup>
import { RouterView } from "vue-router";
import NavBarVue from './components/bases/NavBar.vue';
import UserProviderVue from './components/providers/UserProvider.vue';
// import LoginVue from "./views/Login.vue";
// import HomeVue from "./views/Home.vue";
</script>

<style scoped>
  #app{
    display: block;
  }
  .main{
    margin-top: 5rem;
  }

</style>