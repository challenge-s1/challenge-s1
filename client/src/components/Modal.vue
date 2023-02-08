<script setup>

import {ref} from 'vue';

const props = defineProps({
  open: {
    type: Boolean,
    required: true,
  },
});

// defineEmits(['close']);

// function handleClose() {
//     $emit('close');
// }




</script>

<template>

<div v-if="open" class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
      <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
          <!--header-->
          <div class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
            <h3 class="text-3xl font-semibold">
              <slot name="title"></slot>
            </h3>
            <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" v-on:click="toggleModal()">
              <svg
                @click="$emit('close')"
                xmlns="http://www.w3.org/2000/svg"
                class="w-8 h-8 text-red-900 cursor-pointer"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                />
              </svg>
            </button>
          </div>
          <!--body-->
          <div class="relative p-6 flex-auto">
            <slot></slot>
          </div>
        </div>
      </div>
    </div>
    <div v-if="open" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
    <!-- <div class="container mx-auto">
      <div class="flex justify-center">
        <div v-if="open"
          class="
            inset-0
            flex
            items-center
            justify-center
            bg-gray-700 
            bg-opacity-50
          "
        >
        <div class="max-w-2xl p-6 mx-4 bg-white rounded-md shadow-xl min-w-[41.6%] min-h-[20rem]">
            <div class="flex items-center justify-between">
              <slot name="title"></slot>
              <svg
                @click="$emit('close')"
                xmlns="http://www.w3.org/2000/svg"
                class="w-8 h-8 text-red-900 cursor-pointer"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                />
              </svg>
            </div>
            <div class="mt-4">
              <slot></slot>
            </div>
          </div>
        </div>
      </div>
    </div> -->
</template>
  

