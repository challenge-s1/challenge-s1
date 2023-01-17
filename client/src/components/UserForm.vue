<template>

    <form @submit.prevent="onSubmit">
       <slot></slot>
    </form>
</template>

<script setup>
import {reactive,inject} from "vue";


const $emit = defineEmits(["submit"]);

// const UserData = inject("UserData");

const onSubmit = function (){
    $emit("submit");

}
</script>

<style scoped>

</style>