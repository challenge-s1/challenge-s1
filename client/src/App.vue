

<script setup>
import { RouterView } from "vue-router";
import NavBarVue from './components/bases/NavBar.vue';
import UserProviderVue from './components/providers/UserProvider.vue';
import IndexNavbar from './components/Navbars/IndexNavbar.vue';
import FooterComponent from "@/components/Footers/Footer.vue";
// import LoginVue from "./views/Login.vue";
// import HomeVue from "./views/Home.vue";
import { useStore } from 'vuex';
const store = useStore();

store.commit('loadStore');

</script>

<template>
  <UserProviderVue>
    <div id="app">
      <index-navbar />
      <router-view />
      <footer-component />
    </div>

    <!-- <div class=" bg-gray-100  overflow-hidden">
      <NavBarVue />
      <main class="pt-32 bg-white">
        <router-view />
      </main>

    </div> -->
  </UserProviderVue>
</template>

<style scoped>
.main {
  margin-top: 5rem;
}
</style>