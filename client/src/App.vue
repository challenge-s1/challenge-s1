<template>
  <UserProviderVue>
    <div class=" bg-gray-100  overflow-hidden">
      <NavBarVue />
      <main class="px-6 pt-40 mb-5 p-4 bg-white">
        <router-view />
      </main>

    </div>
  </UserProviderVue>
  <!-- <RouterView /> -->
</template>

<script setup>
import { RouterView } from "vue-router";
import NavBarVue from './components/bases/NavBar.vue';
import UserProviderVue from './components/providers/UserProvider.vue';
// import LoginVue from "./views/Login.vue";
// import HomeVue from "./views/Home.vue";
import { useStore } from 'vuex';
const store = useStore();

store.commit('loadStore');

</script>

<style scoped>
.main {
  margin-top: 5rem;
}
</style>