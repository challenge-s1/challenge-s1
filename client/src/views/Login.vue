<script setup>

import UserFormVue from '../components/UserForm.vue';
// import UserProviderVue from '../components/providers/UserProvider.vue';
import { user as UserProvierKeys } from '../components/providers/UserProviderKeys.js';
import FormField from '../components/FormField.vue';
import IndexNavbar from "../components/Navbars/IndexNavbar.vue";
import registerBg2 from "../assets/img/login.png";
import { inject, provide, ref, reactive } from 'vue';
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
const error = ref('');

const onSubmit = function () {
    login(UserData).then((response) => {
        error.value = response;
    }).catch((er) => {
        error.value = er;
    })
}



</script>

<template>

    <div>

        <main>
            <section class="relative w-full h-full pt-32 min-h-screen">
                <div class="absolute top-0 w-full h-full bg-orange-300 bg-repeat opacity-25 bg-full"
                    :style="`background-image: url('${registerBg2}');`"></div>
                <div class="container mx-auto px-4 ">
                    <div class="flex content-center items-center justify-center h-full">
                        <div class="w-full lg:w-4/12 px-4">
                            <div
                                class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-200 border-0">
                                <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                                    <div class="text-blueGray-400 text-center mb-3 font-bold">
                                        <small>Sign in with credentials</small>
                                    </div>
                                    <UserFormVue @submit="onSubmit">
                                        <div class="relative w-full mb-3">
                                            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                htmlFor="grid-password">
                                                Email
                                            </label>
                                            <FormField id="email" as="input"
                                                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                                type="email" name="email" placeholder="Email"
                                                v-model="UserData.email" />
                                        </div>
                                        <div class="relative w-full mb-3">
                                            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                htmlFor="grid-password">
                                                Password
                                            </label>
                                            <FormField id="password" as="input" type="password" name="password"
                                                placeholder="Password " v-model="UserData.password"
                                                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" />
                                        </div>
                                        <div class="text-red-500 text-sm">
                                            {{ error }}
                                        </div>
                                        <div class="text-center mt-6">
                                            <button type="submit"
                                                class="bg-blueGray-800 text-white hover:bg-orange-400 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full ease-linear transition-all duration-150">
                                                Sign In
                                            </button>
                                        </div>
                                        <div class="sm:flex sm:flex-wrap mt-8 sm:mb-4 text-sm text-center">
                                            <a href="forgot-password" class="flex-2 underline">
                                                <router-link :to="{ name: 'ForgotPassword' }">Forgot
                                                    password?</router-link>
                                            </a>

                                            <p class="flex-1 text-gray-500 text-md mx-4 my-1 sm:my-auto">
                                                or
                                            </p>

                                            <a href="register" class="flex-2 underline">
                                                <router-link :to="{ name: 'Register' }">Create new account</router-link>
                                            </a>
                                        </div>

                                    </UserFormVue>
                                    <!-- <form>
                            <div class="relative w-full mb-3">
                                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                    htmlFor="grid-password">
                                    Email
                                </label>
                                <input type="email"
                                    class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                    placeholder="Email" />
                            </div>

                            <div class="relative w-full mb-3">
                                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                    htmlFor="grid-password">
                                    Password
                                </label>
                                <input type="password"
                                    class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                    placeholder="Password" />
                            </div>
                            <div>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input id="customCheckLogin" type="checkbox"
                                        class="form-checkbox border-0 rounded text-blueGray-700 ml-1 w-5 h-5 ease-linear transition-all duration-150" />
                                    <span class="ml-2 text-sm font-semibold text-blueGray-600">
                                        Remember me
                                    </span>
                                </label>
                            </div>

                            <div class="text-center mt-6">
                                <button
                                    class="bg-blueGray-800 text-white active:bg-blueGray-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full ease-linear transition-all duration-150"
                                    type="button">
                                    Sign In
                                </button>
                            </div>
                        </form> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

</template>