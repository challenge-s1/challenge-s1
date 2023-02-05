<script setup>
import IndexDropdown from "@/components/Dropdowns/IndexDropdown.vue";
import { user as UserProvierKeys } from '@/components/providers/UserProviderKeys.js';
import { inject, ref } from 'vue';
const user = inject(UserProvierKeys);
const logout = inject('userProvider:logout');
const navbarOpen = ref(false);

const setNavbarOpen = function () {
  navbarOpen.value = !navbarOpen.value;
};


// export default {
//   data() {
//     return {
//       navbarOpen: false,
//     };
//   },
//   methods: {
//     setNavbarOpen: function () {
//       this.navbarOpen = !this.navbarOpen;

//     },
//   },
//   components: {
//     IndexDropdown,
//   },
// };
</script>
<template>
  <nav
    class="top-0 fixed z-50 w-full flex flex-wrap items-center justify-between px-2 navbar-expand-lg bg-white shadow">
    <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
      <div class="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start">
        <router-link :to="{ name: 'Home' }">
          <a class="text-blueGray-700 text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-nowrap uppercase"
            href="#pablo">
            <img src="../../assets/img/logo1.png" class="" style="overflow: hidden;" width="60" height="60" alt="" />
          </a>
        </router-link>
        <button
          class="cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none"
          type="button" v-on:click="setNavbarOpen">
          <i class="fas fa-bars"></i>
        </button>
      </div>
      <div class="lg:flex flex-grow items-center" :class="[navbarOpen ? 'block' : 'hidden']"
        id="example-navbar-warning">
        <ul class="flex flex-col lg:flex-row list-none mr-auto">
          <li class="flex items-center">
            <router-link
              class="hover:text-blueGray-500 text-blueGray-700 px-3 py-2 flex items-center text-xs uppercase font-bold"
              :to="{ name: 'Home' }">
              Home
            </router-link>
          </li>
          <li class="flex items-center">
            <router-link
              class="hover:text-blueGray-500 text-blueGray-700 px-3 py-2 flex items-center text-xs uppercase font-bold"
              :to="{ name: 'Pastries' }">
              pastry shop
            </router-link>
          </li>
          <li class="flex items-center">
            <a class="hover:text-blueGray-500 text-blueGray-700 px-3 py-2 flex items-center text-xs uppercase font-bold"
              href="#">
              Master pastry
            </a>
          </li>
        </ul>
        <ul class="flex flex-col lg:flex-row list-none lg:ml-auto">
          <!-- <li class="flex items-center">
            <index-dropdown />
          </li> -->


          <li class="flex items-center" v-if="!user || Object.keys(user).length == 0">
            <router-link :to="{ name: 'Login' }">
              <button
                class="bg-red-400 text-white  text-xs font-bold uppercase px-4 py-2 rounded shadow hover:shadow-lg outline-none focus:outline-none lg:mr-1 lg:mb-0 ml-3 mb-3 ease-linear transition-all duration-150"
                type="button">
                Sing in
              </button>
            </router-link>
            <router-link :to="{ name: 'Register' }">
              <button
                class="bg-red-700 text-white active:bg-emerald-600 text-xs font-bold uppercase px-4 py-2 rounded shadow hover:shadow-lg outline-none focus:outline-none lg:mr-1 lg:mb-0 ml-3 mb-3 ease-linear transition-all duration-150"
                type="button">
                Sing up
              </button>
            </router-link>
          </li>
          <li class="flex items-center" v-else>
            <a class="  bg-red-400 text-white text-xs font-bold uppercase px-4 py-2 rounded shadow hover:shadow-lg
              outline-none focus:outline-none lg:mr-1 lg:mb-0 ml-3 mb-3 ease-linear transition-all duration-150"
              href="#" @click="logout">
              Logout
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>


