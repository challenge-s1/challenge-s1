<template>
  <UserProviderVue>
    <div class=" bg-gray-100  overflow-hidden">
      <NavBarVue />
      <main>
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
</script>

<style scoped>
.main {
  margin-top: 5rem;
}
</style>