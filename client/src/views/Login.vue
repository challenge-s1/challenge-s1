<script setup>

import UserFormVue from '../components/UserForm.vue';
// import UserProviderVue from '../components/providers/UserProvider.vue';
import { user as UserProvierKeys } from '../components/providers/UserProviderKeys.js';
import FormField from '../components/FormField.vue';

import { inject, provide, reactive } from 'vue';
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
const onSubmit = function () {
    login(UserData);
}



</script>

<template>
    <div class="container px-6 mx-auto">
        <div class="flex  text-center md:text-left md:flex-row h-screen justify-evenly md:items-center">

            <div class="bg-white p-10 flex flex-col shadow-xl rounded-xl">
                <h2 class="text-2xl font-bold text-gray-800 text-left mb-5">
                    Se Connecter
                </h2>
                <UserFormVue @submit="onSubmit">
                    <!-- <label for="email" class="block text-xs font-semibold text-gray-600 uppercase">E-mail</label> -->
                    <FormField id="email" as="input" type="email" name="email" placeholder="Email"
                        v-model="UserData.email"
                        class=" mb-4 w-full appearance-none border-2 border-gray-100 rounded-lg px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-green-600 focus:shadow-lg" />
                    <!-- <label for="password" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Mot de passe
                    </label> -->
                    <FormField id="password" as="input" type="password" name="password" placeholder="Mot de passe "
                        v-model="UserData.password"
                        class="  w-full appearance-none border-2 border-gray-100 rounded-lg px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-green-600 focus:shadow-lg" />
                    <button type="submit"
                        class="  mt-10 
                        font-medium  uppercase
                        focus:outline-none hover:bg-green-800 hover:shadow-none w-full py-4 bg-green-600 rounded-lg text-green-100">Connexion</button>
                    <div class="sm:flex sm:flex-wrap mt-8 sm:mb-4 text-sm text-center">
                        <a href="forgot-password" class="flex-2 underline">
                            Mot de passe oublié?
                        </a>

                        <p class="flex-1 text-gray-500 text-md mx-4 my-1 sm:my-auto">
                            or
                        </p>

                        <a href="register" class="flex-2 underline">
                            <router-link :to="{ name: 'Register' }">S'inscrire</router-link>
                        </a>
                    </div>
                </UserFormVue>
            </div>

        </div>
    </div>




</template>