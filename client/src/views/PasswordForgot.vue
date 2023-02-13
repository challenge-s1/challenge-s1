<script setup>
import { ref } from 'vue';
import Modal from '../components/Modal.vue';
import axios from 'axios';
const url = (import.meta.env.VITE_API_URL)

const open = ref(true);
const showMessage = ref(false);
const email = ref('');

const handleOpen = () => {
    open.value = !open.value;
};

const handleSubmit = () => {
    handleOpen();
    axios.post(`${url}/users/reset-password`, { email: email.value })
        .then((response) => {
            console.log(response);

        })
        .catch((error) => {
            console.log(error);
        });
    showMessage.value = true;

};


</script>


<template>

    <!-- 
    <div class="mt-20 bg-emerald-200" v-if="!open">
       
    </div> -->
    <div class="container px-6 mx-auto" v-if="showMessage">
        <div class="flex  text-center md:text-left md:flex-row h-screen justify-evenly md:items-center">

            <div class="bg-white p-10 flex flex-col shadow-xl rounded-xl">
                <p>a mail was sent to reset your password</p>
            </div>

        </div>
    </div>


    <Modal :open="open" @close="handleOpen">
        <template #title>
            <h1 class="text-2xl font-semibold text-gray-700">Reset Password</h1>
        </template>
        <form @submit.prevent="handleSubmit">
            <div class="flex flex-col mt-2">
                <label class="mb-1 text-sm font-semibold text-gray-600">Email</label>
                <input
                    class="px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                    type="email" placeholder="Email" v-model="email" />
            </div>
            <div class="flex items-center justify-between mt-4">
                <button type="submit" class="px-4 py-2 font-semibold text-white bg-blue-500 rounded hover:bg-blue-700">
                    Send
                </button>
            </div>
        </form>

    </Modal>


</template>