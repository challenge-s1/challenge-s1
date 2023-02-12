<template>
    <div v-if="alert.open" class="text-white px-6 py-4 border-0 rounded relative mb-4 mt-6 " :class="alert.type == 'success' ?  'bg-amber-500' : ''">
      <span class="text-xl inline-block mr-5 align-middle">
        <i class="fas fa-bell"></i>
      </span>
      <span class="inline-block align-middle mr-8">
        <b class="capitalize">{{ alert.title }}</b> {{ alert.content }}
      </span>
      <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" v-on:click="closeAlert()">
        <span>×</span>
      </button>
    </div>
  </template>
  
<script setup>
    import { ref, watch, reactive } from 'vue'
    const props = defineProps({
          modelValue: {
            type: Object,
            default: false
        },
       
    })
    const emit = defineEmits(['update:modelValue'])
    const alert = reactive(props.modelValue);
    watch(() => props.modelValue.open, (value) => {
      if (value) {
        setTimeout(() => {
          alert.open = false;
          emit('update:modelValue', alert)
    }, 5000);
      }
        
    })
        
    const closeAlert= () => {
      alert.open = false;
      emit('update:modelValue', alert)
    }
  
  </script>