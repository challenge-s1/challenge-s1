<script>
import { createPopper } from "@popperjs/core";
import { user as UserProvierKeys } from '@/components/providers/UserProviderKeys.js';
import { inject, ref, computed } from 'vue';

import image from "@/assets/img/profil.webp";

export default {
  data() {
    return {
      dropdownPopoverShow: false,
      image: image,
      logout: inject('userProvider:logout'),
    };
  },
  methods: {
    toggleDropdown: function (event) {
      event.preventDefault();
      if (this.dropdownPopoverShow) {
        this.dropdownPopoverShow = false;
      } else {
        this.dropdownPopoverShow = true;
        createPopper(this.$refs.btnDropdownRef, this.$refs.popoverDropdownRef, {
          placement: "bottom-start",
        });
      }
    },
  },
};
</script>

<template>
  <div>
    <a class="text-blueGray-500 block" href="#pablo" ref="btnDropdownRef" v-on:click="toggleDropdown($event)">
      <div class="items-center flex">
        <span class="w-12 h-12 text-sm text-white bg-blueGray-200 inline-flex items-center justify-center rounded-full">
          <img alt="..." class="w-full rounded-full align-middle border-none shadow-lg" :src="image" />
        </span>
      </div>
    </a>
    <div ref="popoverDropdownRef"
      class="bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48" v-bind:class="{
        hidden: !dropdownPopoverShow,
        block: dropdownPopoverShow,
      }">
      <router-link :to="{ name: 'Profile' }"
        class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">
        Profile
      </router-link>
      <!-- <a href="javascript:void(0);"
        class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">
        Another action
      </a>
      <a href="javascript:void(0);"
        class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">
        Something else here
      </a> -->

      <div class="h-0 my-2 border border-solid border-blueGray-100" />
      <a class="  bg-red-400 text-white text-xs font-bold uppercase px-4 py-2 rounded shadow hover:shadow-lg
              outline-none focus:outline-none lg:mr-1 lg:mb-0 ml-3 mb-3 ease-linear transition-all duration-150"
        href="#" @click="logout">
        Logout
      </a>
    </div>
  </div>
</template>


