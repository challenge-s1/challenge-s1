<script setup>

import UserFormVue from '../components/UserForm.vue';
//import UserProviderVue from '../components/providers/UserProvider.vue';
import {user as UserProvierKeys} from '../components/providers/UserProviderKeys.js';
import LoginVue from './Login.vue';
import { inject } from 'vue';
const user = inject(UserProvierKeys);
</script>

<template>
      <div class="wrapper">
        <!-- <UserProviderVue v-slot="{user}" > -->
                <LoginVue v-if="!user"/>
                <h1  v-if="user" className="text-3xl font-bold underline">
                    Hello world!
                </h1>
        <!-- </UserProviderVue> -->

    </div>
</template>