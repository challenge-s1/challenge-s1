<template>

    <slot :login="login" :user="user" :logout="logout"></slot>

</template>

<script setup>

import { ref, provide } from "vue";
import { user as UserKey } from "./UserProviderKeys"
import axios from "axios";
import { useRouter } from "vue-router";
import { useStore } from 'vuex';
const store = useStore();
const router = useRouter();
const url = (import.meta.env.VITE_API_URL)
const user = ref(store.state.user);
const login = async function (userData) {

    const result = await axios.post(`${url}/authentication_token`, userData).
        then((response) => {
            console.log(response);
            return response.data;
        }).
        catch((error) => {
            return {
                error: error.response.data.message
            };
        });

    if (result.error) {
        return result.error;
    }
    user.value = result;
    console.log(user.value);
    store.commit('addToken', result.token);
    store.commit('addId', result.user.id);
    store.commit('addRoles', result.user.role);
    store.commit('addfirstname', result.user.firstname);
    store.commit('addlastname', result.user.lastname);

    router.push({ name: "Home" })

}


const register = async function (userData) {
    userData.postalcode = parseInt(userData.postalcode);
    console.log(userData);
    const user = await axios.post(`${url}/users`, userData)
        .then((response) => {
            console.log(response);
            return response.data;
        }).
        catch((error) => {
            console.log(error);
            return {
                error: error.response.data.message
            };
        });
    if (user.error) {
        return user.error;
    }
    router.push({ name: "Login" })

}

const logout = function () {
    user.value = null;
    store.commit('removeUser');
    router.push({ name: "Home" })
}
provide(UserKey, user)
provide("userProvider:login", login)
provide("userProvider:logout", logout)
provide("userProvider:register", register)

</script>

<style scoped>

</style>