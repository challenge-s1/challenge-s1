<script setup>

import UserFormVue from '../components/UserForm.vue';
// import UserProviderVue from '../components/providers/UserProvider.vue';
import { user as UserProvierKeys } from '../components/providers/UserProviderKeys.js';
import FormField from '../components/FormField.vue';

import { inject, provide, reactive } from 'vue';
const register = inject('userProvider:register');
const props = defineProps(
    {
        firstName: {
            type: String,
            required: true

        },
        lastName: {
            type: String,
            required: true

        },
        email: {
            type: String,
            required: true
        },
        password: {
            type: String,
            required: false
        },
        plainPassword: {
            type: String,
            required: false
        }
    }
);

const UserData = reactive({
    firstName: props.firstName,
    lastName: props.lastName,
    email: props.email,
    password: props.password,
    plainPassword: props.plainPassword
})
const onSubmit = function () {
    register(UserData);
}



</script>

<template>

    <div class="container px-6 mt-20 mb-5 p-4 ">
        <div class="flex justify-center self-center  z-10">

            <div class="p-12 bg-white mx-auto rounded-2xl w-2/5 ">
                <h2 class="text-2xl font-bold text-gray-800 text-left mb-5">
                    Création du compte
                </h2>
                <UserFormVue @submit="onSubmit">
                    <!-- <label for="firstName" class="block text-xs font-semibold text-gray-600 uppercase">FisrtName</label> -->
                    <FormField id="firstName" as="input" type="text" name="firstName" placeholder="Prénom"
                        v-model="UserData.firstName"
                        class=" mb-3 w-full appearance-none border-2 border-gray-100 rounded-lg px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-green-600 focus:shadow-lg" />
                    <!-- <label for="lastName" class="block text-xs font-semibold text-gray-600 uppercase">LastName</label> -->
                    <FormField id="lastName" as="input" type="text" name="lastName" placeholder="Nom"
                        v-model="UserData.lastName"
                        class=" mb-3 w-full appearance-none border-2 border-gray-100 rounded-lg px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-green-600 focus:shadow-lg" />
                    <!-- <label for="email" class="block text-xs font-semibold text-gray-600 uppercase">E-mail</label> -->
                    <FormField id="email" as="input" type="email" name="email" placeholder="Email"
                        v-model="UserData.email"
                        class=" mb-3 w-full appearance-none border-2 border-gray-100 rounded-lg px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-green-600 focus:shadow-lg" />
                    <!-- <label for="password"
                        class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Password</label> -->
                    <FormField id="password" as="input" type="password" name="password" placeholder="Mot de passe"
                        v-model="UserData.password"
                        class=" mb-3 w-full appearance-none border-2 border-gray-100 rounded-lg px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-green-600 focus:shadow-lg" />
                    <!-- <label for="plainPassword"
                        class="block mt-2 text-xs font-semibold text-gray-600 uppercase">plainPassword</label> -->
                    <FormField id="plainPassword" as="input" type="password" name="plainPassword"
                        placeholder="Confirmer le mot de passe " v-model="UserData.plainPassword"
                        class=" w-full appearance-none border-2 border-gray-100 rounded-lg px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-green-600 focus:shadow-lg" />
                    <div class="flex flex-row justify-around">
                        <button type="submit" class=" flex   p-5 mt-10 bg-teal-700 rounded-xl
                        font-medium text-white uppercase
                        focus:outline-none hover:bg-teal-800 hover:shadow-none">S'inscrire</button>
                    </div>
                </UserFormVue>
            </div>
        </div>
    </div>


</template>