<script setup>
import IndexDropdown from "@/components/Dropdowns/IndexDropdown.vue";
import { user as UserProvierKeys } from '@/components/providers/UserProviderKeys.js';
import { inject, ref, computed } from 'vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';
import UserDropdown from "@/components/Dropdowns/UserDropdown.vue";


const store = useStore();
const router = useRouter();
const user = inject(UserProvierKeys);
const logout = inject('userProvider:logout');
const navbarOpen = ref(false);
const userToken = store.getters.user


// const isPastryChef = computed(() => {
//   return store.getters.user.roles.includes('ROLE_PATISSIER');
// });


const setNavbarOpen = function () {
  navbarOpen.value = !navbarOpen.value;
};
const isLoggedIn = computed({
  get: () => store.getters.isLoggedIn,
});
const isPastrieOwner = computed({
  get: () => store.getters.isPastrieOwner,
});
const isAdmin = computed({
  get: () => store.getters.isAdmin,
});

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
          <a
            class="text-blueGray-700 text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-nowrap uppercase">
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
              Pastry shop
            </router-link>
          </li>
          <li class="flex items-center">
            <router-link
              class="hover:text-blueGray-500 text-blueGray-700 px-3 py-2 flex items-center text-xs uppercase font-bold"
              :to="{ name: 'MasterClassList' }">
              master pastry
            </router-link>
          </li>
          <li v-if="store.getters.isLoggedIn && isPastrieOwner" class="flex items-center">
            <router-link
              class="hover:text-blueGray-500 text-blueGray-700 px-3 py-2 flex items-center text-xs uppercase font-bold"
              :to="{ name: 'PastryChefMasterClass' }">
              my master pastry
            </router-link>
          </li>
          <li v-if="isLoggedIn && isPastrieOwner" class="flex items-center">
            <router-link
              class="hover:text-blueGray-500 text-blueGray-700 px-3 py-2 flex items-center text-xs uppercase font-bold"
              :to="{ name: 'MyPastries' }">
              My pastry
            </router-link>
          </li>
          <li v-if="isLoggedIn && isPastrieOwner" class="flex items-center">
            <router-link
              class="hover:text-blueGray-500 text-blueGray-700 px-3 py-2 flex items-center text-xs uppercase font-bold"
              :to="{ name: 'AddPastries' }">
              Add pastry
            </router-link>
          </li>
          <li v-if="isLoggedIn && isPastrieOwner" class="flex items-center">
            <router-link
              class="hover:text-blueGray-500 text-blueGray-700 px-3 py-2 flex items-center text-xs uppercase font-bold"
              :to="{ name: 'OrdrePastry' }">
              Order pastry
            </router-link>
          </li>
          <li v-if="isLoggedIn" class="flex items-center">
            <router-link
              class="hover:text-blueGray-500 text-blueGray-700 px-3 py-2 flex items-center text-xs uppercase font-bold"
              :to="{ name: 'OrdreClient' }">
              My Order
            </router-link>
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
            <button v-if="isAdmin">
              <router-link :to="{ name: 'Dashbord' }"
                class="border-red-400 text-black  text-xs font-bold uppercase px-4 py-2 rounded shadow hover:shadow-lg outline-none focus:outline-none lg:mr-1 lg:mb-0 ml-3 mb-3 ease-linear transition-all duration-150"
                type="button">
                dashboard

              </router-link>
            </button>
            <button v-if="store.getters.isLoggedIn">
              <router-link :to="{ name: 'Cart' }"
                class="border-white text-black  text-xs font-bold uppercase px-4 py-2 rounded shadow hover:shadow-lg outline-none focus:outline-none lg:mr-1 lg:mb-0 ml-3 mb-3 ease-linear transition-all duration-150"
                type="button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>

              </router-link>
            </button>

            <h1 class="mr-2 font-bold">
              {{ userToken.firstname }} {{ userToken.lastname }}
            </h1>
            <!-- <a class="  bg-red-400 text-white text-xs font-bold uppercase px-4 py-2 rounded shadow hover:shadow-lg
              outline-none focus:outline-none lg:mr-1 lg:mb-0 ml-3 mb-3 ease-linear transition-all duration-150"
              href="#" @click="logout">
              Logout
            </a> -->
            <ul class="flex-col md:flex-row list-none items-center  md:flex">
              <user-dropdown />
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>


