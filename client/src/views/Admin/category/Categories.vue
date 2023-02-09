<script setup>
import CardTable from "@/components/Cards/CardTable.vue";
import AdminNavbar from "@/components/Navbars/AdminNavbar.vue";
import Sidebar from "@/components/Sidebar/Sidebar.vue";
import HeaderStats from "@/components/Headers/HeaderStats.vue";
import FooterAdmin from "@/components/Footers/FooterAdmin.vue";

import { ref, reactive, inject } from "vue";
import { useRoute } from "vue-router";
import { useStore } from "vuex";
import axios from "axios";
import { user as UserProvierKeys } from '@/components/providers/UserProviderKeys.js';

const store = useStore();
const route = useRoute();
const url = (import.meta.env.VITE_API_URL)
const products = ref([]);
const userToken = inject(UserProvierKeys);
const categories = ref([]);
const showModal = ref(false);
const showModalAdd = ref(false);
const modalActive = ref({
    value: false,
    id: null,
});

console.log(store.getters.isTokenExpired);
const categryData = reactive({
    name: '',
});
const categorieData = reactive({
    name: '',
});

const errors = ref({
    name: '',
    general: ''
})
const validate = () => {
    errors.value = {};
    if (categorieData.name == '') {
        errors.value.name = 'Name is required';
    }
    return Object.values(errors.value).length == 0;
}
const validate1 = () => {
    errors.value = {};
    if (categryData.name == '') {
        errors.value.name = 'Name is required';
    }
    return Object.values(errors.value).length == 0;
}
const GetCategories = async () => {
    await axios.get(`${url}/categories`, {
        headers: {
            authorization: 'Bearer ' + userToken.value.token.token
        }
    }).then((response) => {
        console.log(response.data);
        categories.value = response.data;
        console.log(categories.value);
    }).catch((error) => {
        console.log(error);
    })
};
GetCategories();

const toggleModalUpdate = (categorie) => {
    showModal.value = !showModal.value;
    if (categorie) {
        modalActive.value.id = categorie.id;
        Object.assign(categryData, categories.value.find((p) => p.id === categorie.id));
    }
};
const toggleModalAdd = () => {
    showModalAdd.value = !showModalAdd.value;
};

const AddCategry = async () => {
    if (!validate()) {
        return;
    }
    const data = {
        name: categorieData.name,
    }
    await axios.post(`${url}/categories`, data, {
        headers: {
            authorization: 'Bearer ' + userToken.value.token.token
        }
    }).then((response) => {
        console.log(response.data);
        GetCategories();
        toggleModalAdd();
    }).catch((error) => {
        console.log(error);
    })
};

const EditCategry = async (category) => {
    if (!validate1()) {
        return;
    }
    const data = {
        name: categryData.name,
    }
    await axios.put(`${url}/categories/${category.id}`, data, {
        headers: {
            authorization: 'Bearer ' + userToken.value.token.token
        }
    }).then((response) => {
        console.log(response.data);
        GetCategories();
        toggleModalUpdate();
    }).catch((error) => {
        console.log(error);
    })
};




</script>
<template>
    <div>
        <Sidebar />
        <div class="relative md:ml-64 bg-blueGray-100">
            <AdminNavbar />
            <HeaderStats />
            <div class="px-4 md:px-10 mx-auto w-full -m-24">
                <div>
                    <div class="flex flex-wrap mt-4">
                        <div class="w-full mb-12 px-4">
                            <CardTable>
                                <template #title>
                                    <h1> Manage category</h1>
                                    <button>
                                        <button type="button" v-on:click="toggleModalAdd()"
                                            class="bg-red-400 mt-2 text-black hover:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded-xl shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                                            <span class="flex flex-row">
                                                <span class="mr-2">
                                                    <i class="fas fa-sharp fa-solid fa-plus ml-2"></i>
                                                </span>
                                                Add category
                                            </span>
                                        </button>
                                    </button>
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
                                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                            :class="[
                                                color === 'light'
                                                    ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                                    : 'bg-blueGray-50 text-blueGray-500 border-blueGray-100',
                                            ]">
                                            Name
                                        </th>
                                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                            :class="[
                                                color === 'light'
                                                    ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                                    : 'bg-blueGray-50 text-blueGray-500 border-blueGray-100',
                                            ]">
                                            Action
                                        </th>
                                    </tr>
                                </template>
                                <template #tbodyTr>
                                    <tr v-for="categorie in categories " :key="categorie.id">
                                        <td
                                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            {{ categorie.id }}
                                        </td>
                                        <td
                                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            {{ categorie.name }}
                                        </td>
                                        <td
                                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            <div class="flex items-center">
                                                <button type="button" v-on:click="toggleModalUpdate(categorie)"
                                                    class="bg-white mt-2 text-black hover:bg-white font-bold uppercase text-sm px-6 py-3 rounded-xl shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                                                    <span class="flex flex-row">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                        </svg>
                                                    </span>
                                                </button>
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
        <div v-if="showModal"
            class="overflow-x-hidden overflow-y-auto  fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
            <div class="relative w-auto mb-6 mt-72 mx-auto max-w-3xl">
                <div
                    class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                    <div
                        class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
                        <h3 class="text-3xl font-semibold">
                            Edit Category : {{ categryData.name }}
                        </h3>
                        <button
                            class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none"
                            v-on:click="toggleModalUpdate()">
                            <span
                                class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-red-900 cursor-pointer"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                        </button>
                    </div>
                    <!--body-->
                    <div class="relative p-6 flex-auto">
                        <form @submit.prevent="EditCategry(categryData)">
                            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                Name
                            </label>
                            <input type="text" name="name"
                                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-15"
                                placeholder="name" v-model="categryData.name" />
                            <div class=" text-red-500 text-xs italic">{{ errors.name }}</div>

                            <div class="p-3 mt-2 text-center space-x-4 md:block">
                                <button
                                    class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                    type="button" v-on:click="toggleModalUpdate()">
                                    Close
                                </button>
                                <button type="submit"
                                    class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-md hover:shadow-lg hover:bg-orange-300">Save
                                </button>
                            </div>
                            <!-- <div class=" text-red-500 text-xs italic">{{ errors.general }}</div> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="showModal" class="opacity-10 fixed inset-0 z-40 bg-black"></div>
        <div v-if="showModalAdd"
            class="overflow-x-hidden overflow-y-auto  fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
            <div class="relative w-auto mb-6 mt-72 mx-auto max-w-3xl">
                <div
                    class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                    <div
                        class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
                        <h3 class="text-3xl font-semibold">
                            Add Category
                        </h3>
                        <button
                            class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none"
                            v-on:click="toggleModalAdd()">
                            <span
                                class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-red-900 cursor-pointer"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                        </button>
                    </div>
                    <!--body-->
                    <div class="relative p-6 flex-auto">
                        <form @submit.prevent="AddCategry()">
                            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                Name
                            </label>
                            <input type="text" name="name"
                                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-15"
                                placeholder="name" v-model="categorieData.name" />
                            <div class=" text-red-500 text-xs italic">{{ errors.name }}</div>

                            <div class="p-3 mt-2 text-center space-x-4 md:block">
                                <button
                                    class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                    type="button" v-on:click="toggleModalAdd()">
                                    Close
                                </button>
                                <button type="submit"
                                    class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-md hover:shadow-lg hover:bg-orange-300">Save
                                </button>
                            </div>
                            <!-- <div class=" text-red-500 text-xs italic">{{ errors.general }}</div> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="showModalAdd" class="opacity-10 fixed inset-0 z-40 bg-black"></div>
    </div>
</template>

