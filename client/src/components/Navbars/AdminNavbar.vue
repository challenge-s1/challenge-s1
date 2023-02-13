<template>
  <!-- Navbar -->
  <nav
    class="absolute top-0 left-0 w-full z-10 bg-transparent md:flex-row md:flex-nowrap md:justify-start flex items-center p-4">
    <div class="w-full mx-autp items-center flex justify-between md:flex-nowrap flex-wrap md:px-10 px-4">
      <!-- Brand -->
      <a class="text-white text-sm uppercase hidden lg:inline-block font-semibold" href="javascript:void(0)">
        Dashboard
      </a>

      <ul class="flex-col md:flex-row list-none items-center hidden md:flex">
        <button>
          <router-link :to="{ name: 'Home' }"
            class="border-red-500 text-white   text-xs font-bold uppercase px-4 py-2 rounded shadow hover:shadow-lg outline-none focus:outline-none lg:mr-1 lg:mb-0 ml-3 mb-3 ease-linear transition-all duration-150"
            type="button">
            Go to site

          </router-link>
        </button>
        <h1 class="mr-2 font-bold flex-col md:flex-row list-none items-center hidden md:flex">
          {{ userToken.firstname }} {{ userToken.lastname }}
        </h1>
        <user-dropdown />
      </ul>
    </div>
  </nav>
  <!-- End Navbar -->
</template>

<script setup>
import UserDropdown from "@/components/Dropdowns/UserDropdown.vue";
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';
const store = useStore();
const router = useRouter();
const userToken = store.getters.user
</script>
