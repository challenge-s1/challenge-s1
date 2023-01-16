<script setup>

import UserFormVue from '../components/UserForm.vue';
//import UserProviderVue from '../components/providers/UserProvider.vue';
import { user as UserProvierKeys } from '../components/providers/UserProviderKeys.js';
import LoginVue from './Login.vue';
import { inject } from 'vue';
const user = inject(UserProvierKeys);
</script>

<template>
    <div class="wrapper">
        <!-- <UserProviderVue v-slot="{user}" > -->
        <LoginVue v-if="!user" />
        <div v-if="user"
            class="flex h-screen w-full items-center justify-center bg-gray-900 bg-cover bg-no-repeat overflow-y-auto"
            style="background-image:url('https://reward-process.com/wp-content/uploads/2017/06/challenge-commercial-4-etapes.jpg')">
        </div>
        <!-- </UserProviderVue> -->

    </div>
</template>