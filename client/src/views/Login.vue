<script setup>

import UserFormVue from '../components/UserForm.vue';
// import UserProviderVue from '../components/providers/UserProvider.vue';
import {user as UserProvierKeys} from '../components/providers/UserProviderKeys.js';
import FormField from '../components/FormField.vue';

import { inject,provide,reactive } from 'vue';
const login = inject('userProvider:login');
const props = defineProps(
    {
        email: {
            type: String,
            required: true
        },
        password: {
            type: String,
            required: false
        }
    }   
);

const UserData = reactive({
    email: props.email,
    password: props.password
})
const onSubmit = function (){
    login(UserData);
}



</script>

<template>

<div class="flex flex-col h-screen mt-10">
        <!-- Auth Card Container -->
        <div class="grid place-items-center mx-2 my-20 sm:my-auto">
            <!-- Auth Card -->
            <div class="bg-white rounded-lg shadow-md lg:shadow-lg">

                <!-- Card Title -->
                <h2 class="text-center font-semibold text-3xl lg:text-4xl text-gray-800">
                    Login
                </h2>
                <UserFormVue  @submit="onSubmit">
                    <label for="email" class="block text-xs font-semibold text-gray-600 uppercase">E-mail</label>
                    <FormField id="email" as="input" type="email" name="email" placeholder="email" v-model="UserData.email" class="block w-full py-3 px-1 mt-2 
                        text-gray-800 appearance-none 
                        border-b-2 border-gray-100
                        focus:text-gray-500 focus:outline-none focus:border-gray-200"/>
                    <label for="password" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Password</label>
                    <FormField id="password" as="input" type="password" name="password" placeholder="password" v-model="UserData.password" class="block w-full py-3 px-1 mt-2 
                        text-gray-800 appearance-none 
                        border-b-2 border-gray-100
                        focus:text-gray-500 focus:outline-none focus:border-gray-200"/>
                    <button type="submit" class="w-full py-3 mt-10 bg-teal-700 rounded-sm
                        font-medium text-white uppercase
                        focus:outline-none hover:bg-teal-800 hover:shadow-none">Login</button>
                    <div class="sm:flex sm:flex-wrap mt-8 sm:mb-4 text-sm text-center">
                        <a href="forgot-password" class="flex-2 underline">
                            Forgot password?
                        </a>

                        <p class="flex-1 text-gray-500 text-md mx-4 my-1 sm:my-auto">
                            or
                        </p>

                        <a href="register" class="flex-2 underline">
                            <router-link :to="{ name: 'Register' }">Create an Account</router-link>
                        </a>
                    </div>
                </UserFormVue>

            </div>
        </div>
    </div>

  
</template>