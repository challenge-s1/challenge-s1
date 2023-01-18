<template>

    <slot :login="login" :user="user"></slot>

</template>

<script setup>

import { ref, provide } from "vue";
import { user as UserKey } from "./UserProviderKeys"
import axios from "axios";
import { useRouter } from "vue-router";

const router = useRouter();
const user = ref();
const login = async function (userData) {
    console.log(userData);

    const token = await axios.post('https://localhost/authentication_token', userData).
        then((response) => {
            return response.data;
        }).
        catch((error) => {
            return {
                error: error.response.data.message
            };
        });
    if (token.error) {
        return token.error;
    }
    user.value = token.token
    console.log(user.value);
    router.push({ name: "Home" })


}


// const register = async function (userData) {
//     const user = await axios.post('https://localhost/users', userData)
//     // router.push({name:"Login"})

const register = async function (userData) {
    const user = await axios.post('https://localhost/users', userData)
    then((response) => {
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
    user.value = null
}
provide(UserKey, user)
provide("userProvider:login", login)
provide("userProvider:logout", logout)
provide("userProvider:register", register)

</script>

<style scoped>

</style>