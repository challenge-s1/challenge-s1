

<script setup>
import { RouterView } from "vue-router";
import NavBarVue from './components/bases/NavBar.vue';
import UserProviderVue from './components/providers/UserProvider.vue';
import IndexNavbar from './components/Navbars/IndexNavbar.vue';
import FooterComponent from "@/components/Footers/Footer.vue";
// import LoginVue from "./views/Login.vue";
// import HomeVue from "./views/Home.vue";
import { useStore } from 'vuex';
import { useRoute } from "vue-router";
import router from "./router";
const store = useStore();
const route = useRoute();


store.commit('loadStore');
const isRoot = () => {
  // const name = 'Dashbord' || 'Categories';
  // return router.currentRoute.value.name == name;
  if (router.currentRoute.value.name == 'Dashbord' || router.currentRoute.value.name == 'Categories' || router.currentRoute.value.name == 'Users' || router.currentRoute.value.name == 'UsersAdd'
    || router.currentRoute.value.name == 'NewUser') {
    return true;
  } else {
    return false;
  }
}


</script>

<template>
  <UserProviderVue>
    <div id="app">

      <index-navbar v-if="!isRoot()" />
      <main class="pt-14">
        <router-view />
      </main>
      <footer-component v-if="!isRoot()" />
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