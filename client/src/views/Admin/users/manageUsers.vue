<script setup>
import CardTable from "@/components/Cards/CardTable.vue";
import AdminNavbar from "@/components/Navbars/AdminNavbar.vue";
import Sidebar from "@/components/Sidebar/Sidebar.vue";
import HeaderStats from "@/components/Headers/HeaderStats.vue";
import FooterAdmin from "@/components/Footers/FooterAdmin.vue";
import Modal from "@/components/Modal.vue";
import dayjs from 'dayjs';
import { ref, reactive, inject } from "vue";
import { useRoute } from "vue-router";
import { useStore } from "vuex";
import axios from "axios";
import { user as UserProvierKeys } from '@/components/providers/UserProviderKeys.js';

const store = useStore();
const route = useRoute();
const url = (import.meta.env.VITE_API_URL)
// const userToken = inject(UserProvierKeys);
const userToken = store.getters.user
const users = ref([]);

const userManageData = reactive({
    id: '',
    firstName: '',
    lastName: '',
    email: '',
    city: '',
    address: '',
    postalcode: '',
    country: '',
    roles: '',
})
const userData = reactive({
    id: '',
    firstName: '',
    lastName: '',
    email: '',
    city: '',
    address: '',
    postalcode: '',
    country: '',
    roles: '',
    is_Active: '',
    createdAt: '',
    updatedAt: '',
})
const openModalUpdate = ref(false);
const openModalgetuser = ref(false);

const handleOpenModalUpdate = () => {
    openModalUpdate.value = !openModalUpdate.value;
};
const handleOpenModalgetUser = () => {

    openModalgetuser.value = !openModalgetuser.value;

};

const getUserManageToUpdate = (user) => {
    userManageData.id = user.id;
    userManageData.email = user.email;
    userManageData.firstName = user.firstName;
    userManageData.lastName = user.lastName;
    userManageData.city = user.city;
    userManageData.address = user.address;
    userManageData.postalcode = user.postalcode;
    userManageData.country = user.country;
    userManageData.roles = user.roles;
    handleOpenModalUpdate();
}

const getUserManage = (user) => {
    userData.id = user.id;
    userData.email = user.email;
    userData.firstName = user.firstName;
    userData.lastName = user.lastName;
    userData.city = user.city;
    userData.address = user.address;
    userData.postalcode = user.postalcode;
    userData.country = user.country;
    userData.roles = user.roles;
    userData.is_Active = user.is_Active;
    userData.createdAt = user.createdAt;
    userData.updatedAt = user.updatedAt;
    handleOpenModalgetUser();
}

const GetUsers = async () => {
    await axios.get(`${url}/users`, {
        headers: {
            authorization: 'Bearer ' + userToken.token
        }
    }).then((response) => {
        console.log(response.data);
        users.value = response.data;
        console.log(users.value);
        users.value.forEach((user) => {
            user.createdAt = dayjs(user.createdAt).format('DD/MM/YYYY');
            user.updatedAt = dayjs(user.updatedAt).format('DD/MM/YYYY');
        })
    }).catch((error) => {
        console.log(error);
    })
};
GetUsers();

const updateUserInfo = async () => {
    handleOpenModalUpdate();
    const userdata = {
        "email": userManageData.email,
        "firstName": userManageData.firstName,
        "lastName": userManageData.lastName,
        "city": userManageData.city,
        "address": userManageData.address,
        "postalcode": userManageData.postalcode,
        "country": userManageData.country,
        "roles": userManageData.roles,

    }
    await axios.put(`${url}/users/${userManageData.id}`, userdata, {
        headers: {
            authorization: 'Bearer ' + userToken.token
        }
    }).then((response) => {
        console.log(response.data);
        GetUsers();
    }).catch((error) => {
        console.log(error);
    })
}

</script>
<template>
    <div>
        <Modal :open="openModalUpdate" @close="handleOpenModalUpdate" style="margin-top: 12rem;">
            <template #title>
                <h1 class="text-2xl font-semibold text-gray-700">Update user :</h1>
            </template>
            <form @submit.prevent="updateUserInfo">
                <div>
                    <label for="email">email</label>
                    <input type="email" name="email" id="email" v-model="userManageData.email"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                        placeholder="email">
                </div>

                <div>
                    <label for="firstName">FisrtName</label>
                    <input type="text" name="firstName" id="firstName" v-model="userManageData.firstName"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                        placeholder="FisrtName">
                </div>
                <div>
                    <label for="lastName">LastName</label>
                    <input type="text" name="lastName" id="lastName" v-model="userManageData.lastName"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                        placeholder="LastName">
                </div>
                <div>
                    <label for="address">address</label>
                    <input type="text" name="address" id="address" v-model="userManageData.address"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                        placeholder="address">
                </div>
                <div>
                    <label for="city">city</label>
                    <input type="text" name="city" id="city" v-model="userManageData.city"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                        placeholder="city">
                </div>
                <div>
                    <label for="postalcode">postalcode</label>
                    <input type="number" name="postalcode" id="postalcode" v-model="userManageData.postalcode"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                        placeholder="postalcode">
                </div>
                <div>
                    <label for="country">country</label>
                    <input type="text" name="country" id="country" v-model="userManageData.country"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                        placeholder="country">
                </div>
                <div>
                    <label for="roles">Roles</label>
                    <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                        <input id="roles" type="radio" v-model="userManageData.roles" value="ROLE_USER"
                            :checked="userManageData.roles == 'ROLE_USER'" name="roles"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="role" class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            User
                        </label>
                        <input id="roles" type="radio" v-model="userManageData.roles"
                            :checked="userManageData.roles[0] == 'ROLE_PATISSIER'" value="ROLE_PATISSIER" name="roles"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="role" class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Pastry chef
                        </label>
                        <input id="roles" type="radio" v-model="userManageData.roles" value="ROLE_ADMIN"
                            :checked="userManageData.roles[0] == 'ROLE_ADMIN'" name="roles"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="role" class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Admin
                        </label>
                    </div>
                </div>
                <button type="submit"
                    class="px-4 mt-2 float-right py-2 font-semibold text-white bg-blue-500 rounded hover:bg-blue-700">
                    Update
                </button>

            </form>
        </Modal>
        <Modal :open="openModalgetuser" @close="handleOpenModalgetUser">
            <template #title>
                <h1 class="text-2xl font-semibold text-gray-700">More details :</h1>
            </template>
            <div class="flex flex-row mb-2">
                <h1 lass=" text-blueGray-500 text-lg leading-relaxed font-bold"> ID : </h1>
                <p class=" text-blueGray-500 text-lg leading-relaxed">
                    {{ userData.id }}
                </p>
            </div>
            <div class="flex flex-row mb-2">
                <h1 lass=" text-blueGray-500 text-lg leading-relaxed font-bold"> Email : </h1>
                <p class=" text-blueGray-500 text-lg leading-relaxed">
                    {{ userData.email }}
                </p>
            </div>
            <div class="flex flex-row mb-2">
                <h1 lass="text-blueGray-500 text-lg leading-relaxed font-bold"> Role : </h1>
                <p class=" text-blueGray-500 text-lg leading-relaxed">
                    {{ userData.roles[0] }}
                </p>
            </div>
            <div class="flex flex-row mb-2">
                <h1 lass=" text-blueGray-500 text-lg leading-relaxed font-bold"> First Name : </h1>
                <p class=" text-blueGray-500 text-lg leading-relaxed">
                    {{ userData.firstName }}
                </p>
            </div>
            <div class="flex flex-row mb-2">
                <h1 lass=" text-blueGray-500 text-lg leading-relaxed font-bold"> Last Name : </h1>
                <p class=" text-blueGray-500 text-lg leading-relaxed">
                    {{ userData.lastName }}
                </p>
            </div>
            <div class="flex flex-row mb-2">
                <h1 lass="text-blueGray-500 text-lg leading-relaxed font-bold"> Adress : </h1>
                <p class=" text-blueGray-500 text-lg leading-relaxed">
                    {{ userData.address }}
                </p>
            </div>
            <div class="flex flex-row mb-2">
                <h1 lass=" text-blueGray-500 text-lg leading-relaxed font-bold"> City : </h1>
                <p class=" text-blueGray-500 text-lg leading-relaxed">
                    {{ userData.city }}
                </p>
            </div>
            <div class="flex flex-row mb-2">
                <h1 lass=" text-blueGray-500 text-lg leading-relaxed font-bold"> Postal Code : </h1>
                <p class=" text-blueGray-500 text-lg leading-relaxed">
                    {{ userData.postalcode }}
                </p>
            </div>
            <div class="flex flex-row mb-2">
                <h1 lass=" text-blueGray-500 text-lg leading-relaxed font-bold"> Country : </h1>
                <p class=" text-blueGray-500 text-lg leading-relaxed">
                    {{ userData.country }}
                </p>
            </div>
            <div class="flex flex-row mb-2">
                <h1 lass=" text-blueGray-500 text-lg leading-relaxed font-bold"> Is active her count : </h1>
                <p class=" text-blueGray-500 text-lg leading-relaxed">
                    {{ userData.is_Active }}
                </p>
            </div>
            <div class="flex flex-row mb-2">
                <h1 lass="text-blueGray-500 text-lg leading-relaxed font-bold"> Created At : </h1>
                <p class=" text-blueGray-500 text-lg leading-relaxed">
                    {{ userData.createdAt }}
                </p>
            </div>
            <div class="flex flex-row mb-2">
                <h1 lass=" text-blueGray-500 text-lg leading-relaxed font-bold"> Updated At : </h1>
                <p class=" text-blueGray-500 text-lg leading-relaxed">
                    {{ userData.updatedAt }}
                </p>
            </div>
        </Modal>
        <div>

            <Sidebar />
            <div class="relative md:ml-64 bg-blueGray-100" style="margin-top: -4rem;">
                <AdminNavbar />
                <HeaderStats />
                <div class="px-4 md:px-10 mx-auto w-full -m-24">
                    <div>
                        <div class="flex flex-wrap mt-4">
                            <div class="w-full mb-12 px-4">
                                <CardTable>
                                    <template #title>
                                        <h1> Manage Users</h1>
                                        <!-- <router-link :to="{ name: 'UserAdd' }">
                                            Add
                                        </router-link> -->
                                        <router-link :to="{ name: 'NewUser' }">
                                            <button
                                                class="bg-red-400 mt-2 text-black hover:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded-xl shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                                                <span class="flex flex-row">
                                                    <span class="mr-2">
                                                        <i class="fas fa-sharp fa-solid fa-user-plus ml-2"></i>
                                                    </span>
                                                    Add users
                                                </span>
                                            </button>
                                        </router-link>
                                    </template>
                                    <template #theadTr>
                                        <tr>
                                            <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                                :class="[
                                                    color === 'light'
                                                        ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                                        : 'bg-blueGray-50 text-blueGray-500 border-blueGray-100',
                                                ]">
                                                ID
                                            </th>
                                            <!-- <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                            :class="[
                                                color === 'light'
                                                    ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                                    : 'bg-blueGray-50 text-blueGray-500 border-blueGray-100',
                                            ]">
                                            Last Name
                                        </th>
                                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                            :class="[
                                                color === 'light'
                                                    ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                                    : 'bg-blueGray-50 text-blueGray-500 border-blueGray-100',
                                            ]">
                                            First Name
                                        </th> -->

                                            <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                                :class="[
                                                    color === 'light'
                                                        ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                                        : 'bg-blueGray-50 text-blueGray-500 border-blueGray-100',
                                                ]">
                                                Email
                                            </th>
                                            <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                                :class="[
                                                    color === 'light'
                                                        ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                                        : 'bg-blueGray-50 text-blueGray-500 border-blueGray-100',
                                                ]">
                                                Role
                                            </th>
                                            <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                                :class="[
                                                    color === 'light'
                                                        ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                                        : 'bg-blueGray-50 text-blueGray-500 border-blueGray-100',
                                                ]">
                                                Is Active
                                            </th>
                                            <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                                :class="[
                                                    color === 'light'
                                                        ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                                        : 'bg-blueGray-50 text-blueGray-500 border-blueGray-100',
                                                ]">
                                                Created At
                                            </th>
                                            <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                                :class="[
                                                    color === 'light'
                                                        ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                                        : 'bg-blueGray-50 text-blueGray-500 border-blueGray-100',
                                                ]">
                                                Updated At
                                            </th>
                                            <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                                :class="[
                                                    color === 'light'
                                                        ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                                        : 'bg-blueGray-50 text-blueGray-500 border-blueGray-100',
                                                ]">
                                                Actions
                                            </th>
                                        </tr>
                                    </template>
                                    <template #tbodyTr>
                                        <tr v-for="usermange in users " :key="usermange.id">
                                            <td
                                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                {{ usermange.id }}
                                            </td>
                                            <!-- <td
                                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            {{ usermange.lastName }}
                                        </td>
                                        <td
                                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            {{ usermange.firstName }}
                                        </td> -->

                                            <td
                                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                {{ usermange.email }}
                                            </td>
                                            <td
                                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                {{ usermange.roles[0] }}
                                            </td>
                                            <td
                                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                <span v-if="usermange.is_Active === true">
                                                    <i class="fas fa-circle text-emerald-500 mr-2"></i>
                                                    active
                                                </span>
                                                <span v-else>
                                                    <i class="fas fa-circle text-orange-500 mr-2"></i> inactive
                                                </span>
                                            </td>

                                            <td
                                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                {{ usermange.createdAt }}
                                            </td>
                                            <td
                                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                {{ usermange.updatedAt }}
                                            </td>
                                            <td
                                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                <div class="flex items-center">
                                                    <button type="button" @click="getUserManageToUpdate(usermange)"
                                                        class="bg-white mt-2 text-black hover:bg-white font-bold uppercase text-sm px-6 py-3 rounded-xl shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                                                        <span class="flex flex-row">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                            </svg>
                                                        </span>
                                                    </button>
                                                    <button type="button" @click="getUserManage(usermange)"
                                                        class="bg-white mt-2 text-black hover:bg-white font-bold uppercase text-sm px-6 py-3 rounded-xl  hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                                                        <span class="flex flex-row">
                                                            <i class="fas fa-sharp fa-solid fa-arrow-right"></i>
                                                        </span>
                                                    </button>
                                                    <!-- <button type="button" @click="getUserManage(usermange)"
                                                        class="mt-2 text-black  font-bold uppercase text-sm px-6 py-3 rounded-xl shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                                                        <span class="flex flex-row">
                                                            <i class="fas fa-sharp fa-solid fa-arrow-right"></i>

                                                        </span>
                                                    </button> -->

                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                </CardTable>
                            </div>
                        </div>
                    </div>
                    <FooterAdmin />
                </div>
            </div>
        </div>
    </div>
</template>

