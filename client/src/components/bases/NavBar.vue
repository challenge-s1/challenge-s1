<script setup>

import {user as UserProvierKeys} from '@/components/providers/UserProviderKeys.js';
import { inject } from 'vue';
const user = inject(UserProvierKeys);


</script>
   
<template>
    <!-- Header -->
    <div>
        <nav class="fixed w-full pl-16 flex  bg-slite-700">
            <div class="flex items-center flex-shrink-0 text-white mr-6">
                <a class="text-3xl font-bold leading-none" href="#">
                    <!-- <img src="@/assets/img/Motobike_ESGI.png" class="" style="overflow: hidden;" width="150"
                        height="150" alt="" /> -->
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
                class="hidden absolute lg:flex lg:mx-auto lg:items-center lg:w-auto lg:space-x-6">
                <li>
                    <router-link  class="text-sm text-gray-400 hover:text-gray-500"
                        :to="{ name: 'Home' }">Accueil</router-link>
                </li>
                <li  v-if="user" class="text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                        class="w-4 h-4 current-fill" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 5v0m0 7v0m0 7v0m0-13a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                    </svg>
               
                </li>
                <li>
                    <router-link v-if="user" class="text-sm text-gray-400 hover:text-gray-500"
                        :to="{ name: 'Login' }">Logout</router-link>

                </li>
               
                <li class="text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                        class="w-4 h-4 current-fill" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 5v0m0 7v0m0 7v0m0-13a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                    </svg>
                </li>
                <li><a class="text-sm text-gray-400 hover:text-gray-500" href="#">A propos</a></li>
              
                <li class="text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                        class="w-4 h-4 current-fill" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 5v0m0 7v0m0 7v0m0-13a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                    </svg>
                </li>
                <li><a class="text-sm text-gray-400 hover:text-gray-500" href="#">Contact</a></li>
                <li v-if="!user" class="text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                        class="w-4 h-4 current-fill" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 5v0m0 7v0m0 7v0m0-13a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                    </svg>
                </li>
                <li v-if="!user"><router-link class="text-sm text-gray-400 hover:text-gray-500" :to="{name:'Login'}">Connexion</router-link></li>
                <li v-if="!user" class="text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                        class="w-4 h-4 current-fill" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 5v0m0 7v0m0 7v0m0-13a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                    </svg>
                </li>
                <li v-if="!user"><router-link class="text-sm text-gray-400 hover:text-gray-500" :to="{name:'Register'}">Register</router-link></li>
            </ul>

        </nav>

    </div>
</template>

