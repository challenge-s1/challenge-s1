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
    <div class="container mx-auto">
      <div class="flex justify-center">
        <div v-if="open"
          class="
            absolute
            inset-0
            flex
            items-center
            justify-center
            bg-gray-700 bg-opacity-50
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
    </div>
</template>
  