<script setup>

import { user as UserProvierKeys } from '@/components/providers/UserProviderKeys.js';
import { inject } from 'vue';
const user = inject(UserProvierKeys);
const logout = inject('userProvider:logout');
//<!-- style="background-image: url('src/assets/img/cupcaks.png')" -->

</script>
   
<template>
    <!-- Header -->
    <div>
        <nav
            class="fixed w-full pl-16 flex justify-between items-center bg-white/[.6] backdrop-blur border-b-2 border-spacing-1">
            <div class="flex items-center flex-shrink-0 text-white mr-6">
                <a class="text-3xl font-bold leading-none" href="#">
                    <div class="p-3" style="overflow: hidden;">
                        <img src="@/assets/img/logo1.png" class="" style="overflow: hidden;" width="100" height="100"
                            alt="" />
                    </div>

                </a>
            </div>
            <div class="lg:hidden mr-7">
                <button class="navbar-burger flex items-center text-white">
                    <svg class="block h-4 w-4 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Mobile menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
                    </svg>
                </button>
            </div>
            <ul
                class="hidden absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2 lg:flex lg:mx-auto  lg:items-center lg:w-auto lg:space-x-6">
                <li>
                    <router-link class="text-xl text-black hover:text-gray-500"
                        :to="{ name: 'Home' }">Accueil</router-link>
                </li>
                <li>
                    <a class="text-xl text-black hover:text-gray-500" href="#">Contact
                    </a>
                </li>
            </ul>
            <span class="hidden mr-6 lg:flex">

                <div v-if="!user || Object.keys(user).length == 0" class="mr-8">
                    <a class=" lg:inline-block lg:ml-auto lg:mr-3 py-2 px-6 bg-gray-50 hover:bg-gray-100 text-sm text-gray-900 font-bold  rounded-xl transition duration-200"
                        href="#">
                        <router-link :to="{ name: 'Login' }">Connexion</router-link>
                    </a>
                    <a class=" lg:inline-block py-2 px-6 bg-blue-500 hover:bg-blue-600 text-sm text-white font-bold rounded-xl transition duration-200"
                        href="#">
                        <router-link :to="{ name: 'Register' }">
                            S'inscrire
                        </router-link>
                    </a>
                </div>
                <div v-else>
                    <a class=" lg:inline-block lg:ml-auto lg:mr-3 py-2 px-6 bg-gray-50 hover:bg-gray-100 text-sm text-gray-900 font-bold  rounded-xl transition duration-200"
                        href="#" @click="logout">
                        Logout
                    </a>

                </div>
            </span>
        </nav>
        <div class="navbar-menu relative z-50 hidden">
            <div class="navbar-backdrop fixed inset-0 bg-gray-800 opacity-25"></div>
            <nav
                class="fixed top-0 left-0 bottom-0 flex flex-col w-5/6 max-w-sm py-6 px-6 bg-white border-r overflow-y-auto">
                <div class="flex items-center mb-8">
                    <a class="mr-auto text-3xl font-bold leading-none" href="#">
                        <!-- <img src="" class="" style="overflow: hidden;" width="50%" height="50%" alt="" /> -->
                    </a>
                    <button class="navbar-close">
                        <svg class="h-6 w-6 text-black cursor-pointer hover:text-gray-500"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div>

                    <div v-if="!user" class="mb-2">
                        <a class="mr-5 lg:inline-block lg:ml-auto lg:mr-3 py-2 px-6 bg-gray-300 hover:bg-black text-sm text-gray-900 font-bold  rounded-xl transition duration-200"
                            href="#">
                            <router-link :to="{ name: 'Login' }">Connexion</router-link>
                        </a>
                        <a class="lg:inline-block py-2 px-6 bg-blue-500 hover:bg-blue-600 text-sm text-white font-bold rounded-xl transition duration-200"
                            href="#">
                            <router-link :to="{ name: 'Register' }">
                                S'inscrire
                            </router-link>
                        </a>
                    </div>
                    <ul>
                        <li class="mb-1">
                            <a class="block p-4 text-sm font-semibold text-black hover:bg-blue-50 hover:text-blue-600 rounded"
                                href="#"><router-link :to="{ name: 'Home' }">Accueil</router-link></a>
                        </li>
                        <li class="mb-1">
                            <a class="block p-4 text-sm font-semibold text-black hover:bg-blue-50 hover:text-blue-600 rounded"
                                href="#">Contact</a>
                        </li>
                    </ul>
                </div>
            </nav>

        </div>
    </div>

</template>

