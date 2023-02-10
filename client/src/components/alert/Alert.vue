<template>
    <div v-if="alertOpen" class="text-white px-6 py-4 border-0 rounded relative mb-4 mt-6 " :class="type == 'success' ?  'bg-amber-500' : ''">
      <span class="text-xl inline-block mr-5 align-middle">
        <i class="fas fa-bell"></i>
      </span>
      <span class="inline-block align-middle mr-8">
        <b class="capitalize">{{ title }}</b> {{ content }}
      </span>
      <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" v-on:click="closeAlert()">
        <span>×</span>
      </button>
    </div>
  </template>
  
<script setup>
    import { ref, watch } from 'vue'
    const props = defineProps({
          modelValue: {
            type: Boolean,
            default: false
        },
        title: {
            type: String,
            default: 'Alert'
        },
        content: {
            type: String,
            default: ''
        },
        type: {
            type: String,
            default: 'success'
        }
    })
    const emit = defineEmits(['update:modelValue'])
    const alertOpen = ref(props.modelValue);
    watch(() => props.modelValue, (value) => {
        alertOpen.value = value;
        setTimeout(() => {
          emit('update:modelValue', false)
          alertOpen.value = false;
    }, 5000);
    })
        
    
  
    const closeAlert= () => {
      alertOpen.value = false;
      emit('update:modelValue', false)
    }
  
  </script>