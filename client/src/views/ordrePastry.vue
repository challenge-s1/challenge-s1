
<script setup>

import { ref, reactive, inject, computed } from "vue";

import { useRoute } from "vue-router";
import { useStore } from "vuex";
import axios from "axios";
import CardTable from "@/components/Cards/CardTable.vue";
import { user as UserProvierKeys } from '@/components/providers/UserProviderKeys.js';
import mypastrie from "@/assets/img/mypastrie.jpeg";
import router from "../router";
import moment from "moment";
import Modal from "@/components/Modal.vue";

import { formatDate } from "@/composable/dates.js";


const store = useStore();
const route = useRoute();
const url = (import.meta.env.VITE_API_URL)
const orders = ref([]);
// const userToken = inject(UserProvierKeys);
const userToken = store.getters.user

const orderData = reactive({
    id: '',
    status: '',
    createdAt: '',
    updatedAt: '',
    // pastrie: {
    //     id: '',
    //     name: '',
    //     description: '',
    //     price: '',
    //     image: '',
    //     createdAt: '',
    //     updatedAt: '',
    //     owner: {
    //         id: '',
    //         email: '',
    //         firstName: '',
    //         lastName: '',
    //         city: '',
    //         address: '',
    //         postalcode: '',
    //         country: '',
    //         roles: '',
    //         is_Active: '',
    //         createdAt: '',
    //         updatedAt: '',
    //     }
    // },
    owner: {
        id: '',
        email: '',
        firstName: '',
        lastName: '',
        city: '',
        address: '',
        postalcode: '',
        country: '',
        roles: '',
        is_Active: '',
        createdAt: '',
        updatedAt: '',
    }

})
const openModalgetorder = ref(false);

const handleOpenModalgetOrder = () => {

    openModalgetorder.value = !openModalgetorder.value;

};


// console.log(userToken.value.token.token);
const GetOrders = async () => {
    await axios.get(`${url}/ordereds`, {
        headers: {
            authorization: 'Bearer ' + userToken.token
        }
    }).then((response) => {
        orders.value = response.data;
        console.log(response.data);
        // for (const test of products.value) {
        //     console.log(test.name);
        // }
    }).catch((error) => {
        console.log(error);
    })

};
GetOrders();
const ConfimLivrison = async (order) => {
    console.log(order);
    const StatusOrders = {
        status: true
    };
    console.log(order.id);
    console.log(StatusOrders);
    await axios.put(`${url}/ordereds/${order.id}`, StatusOrders, {
        headers: {
            authorization: 'Bearer ' + userToken.token
        }
    }).then((response) => {
        GetOrders();
        console.log(response);
    }).catch((error) => {
        console.log(error);
    })
};

const orderspastry = computed(() => {
    return orders.value.filter((order) => {
        console.log(order);
        return order.pastrie.owner.id == userToken.id
    })
});

const getUserorder = (order) => {
    console.log(order);
    orderData.id = order.id;
    orderData.status = order.status;
    orderData.createdAt = order.createdAt;
    orderData.owner.email = order.owner.email;
    orderData.owner.firstName = order.owner.firstName;
    orderData.owner.lastName = order.owner.lastName;
    orderData.owner.city = order.owner.city;
    orderData.owner.address = order.owner.address;
    orderData.owner.postalcode = order.owner.postalcode;
    orderData.owner.country = order.owner.country;
    handleOpenModalgetOrder();
}

</script>

<template>
    <div>
        <Modal :open="openModalgetorder" @close="handleOpenModalgetOrder">
            <template #title>
                <h1 class="text-2xl font-semibold text-gray-700">More details :</h1>
            </template>
            <div class="flex flex-row mb-2">
                <h1 lass=" text-blueGray-500 text-lg leading-relaxed font-bold"> Email : </h1>
                <p class=" text-blueGray-500 text-lg leading-relaxed">
                    {{ orderData.owner.email }}
                </p>
            </div>
            <div class="flex flex-row mb-2">
                <h1 lass=" text-blueGray-500 text-lg leading-relaxed font-bold"> First Name : </h1>
                <p class=" text-blueGray-500 text-lg leading-relaxed">
                    {{ orderData.owner.firstName }}
                </p>
            </div>
            <div class="flex flex-row mb-2">
                <h1 lass=" text-blueGray-500 text-lg leading-relaxed font-bold"> Last Name : </h1>
                <p class=" text-blueGray-500 text-lg leading-relaxed">
                    {{ orderData.owner.lastName }}
                </p>
            </div>
            <div class="flex flex-row mb-2">
                <h1 lass="text-blueGray-500 text-lg leading-relaxed font-bold"> Adress : </h1>
                <p class=" text-blueGray-500 text-lg leading-relaxed">
                    {{ orderData.owner.address }}
                </p>
            </div>
            <div class="flex flex-row mb-2">
                <h1 lass=" text-blueGray-500 text-lg leading-relaxed font-bold"> City : </h1>
                <p class=" text-blueGray-500 text-lg leading-relaxed">
                    {{ orderData.owner.city }}
                </p>
            </div>
            <div class="flex flex-row mb-2">
                <h1 lass=" text-blueGray-500 text-lg leading-relaxed font-bold"> Postal Code : </h1>
                <p class=" text-blueGray-500 text-lg leading-relaxed">
                    {{ orderData.owner.postalcode }}
                </p>
            </div>
            <div class="flex flex-row mb-2">
                <h1 lass=" text-blueGray-500 text-lg leading-relaxed font-bold"> Country : </h1>
                <p class=" text-blueGray-500 text-lg leading-relaxed">
                    {{ orderData.owner.country }}
                </p>
            </div>
        </Modal>
        <main>

            <div class="relative pt-16 pb-32 flex content-center items-center justify-center min-h-screen-75">
                <div class="absolute top-0 w-full h-full bg-center bg-cover"
                    style="background-image: url('https://www.grizette.com/wp-content/uploads/2021/04/Patisserie-Montpellier%C2%A9Edalin-AdobeStock.jpeg');">
                    <span id="blackOverlay" class="w-full h-full absolute opacity-75 bg-black"></span>
                </div>
                <div class="container relative mx-auto">
                    <div class="items-center flex flex-wrap">
                        <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
                            <div class="pr-12">
                                <h1 class="text-white mt-4 mb-8 font-semibold text-5xl">
                                    My orders
                                    <span role="img" aria-label="love">
                                        😍
                                    </span>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden h-70-px"
                    style="transform: translateZ(0);">
                    <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg"
                        preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                        <polygon class="text-blueGray-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
                    </svg>
                </div>
            </div>

            <section class="pb-20 bg-blueGray-200 -mt-24">

                <div class="container mx-auto px-4">
                    <div class="px-4 md:px-10 mx-auto w-full -m-24">
                        <div>
                            <div class="flex flex-wrap mt-4">
                                <div class="w-full mb-12 px-4">
                                    <CardTable>
                                        <template #title>
                                            <h1> Manage orders</h1>
                                            <!-- <router-link :to="{ name: 'UserAdd' }">
                                            Add
                                        </router-link> -->

                                        </template>
                                        <template #theadTr>
                                            <tr>
                                                <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                                    :class="[
                                                        color === 'light'
                                                            ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                                            : 'bg-blueGray-50 text-blueGray-500 border-blueGray-100',
                                                    ]">
                                                    Pastry Name
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
                                                    User Name
                                                </th>
                                                <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                                    :class="[
                                                        color === 'light'
                                                            ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                                            : 'bg-blueGray-50 text-blueGray-500 border-blueGray-100',
                                                    ]">
                                                    quantity
                                                </th>
                                                <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                                    :class="[
                                                        color === 'light'
                                                            ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                                            : 'bg-blueGray-50 text-blueGray-500 border-blueGray-100',
                                                    ]">
                                                    Price
                                                </th>
                                                <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                                    :class="[
                                                        color === 'light'
                                                            ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                                            : 'bg-blueGray-50 text-blueGray-500 border-blueGray-100',
                                                    ]">
                                                    Status
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
                                                    Actions
                                                </th>
                                            </tr>
                                        </template>
                                        <template #tbodyTr>
                                            <tr v-for="order in orderspastry" :key="order.id">
                                                <td
                                                    class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                    {{ order.pastrie.name }}
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
                                                    {{ order.owner.lastName }} {{ order.owner.firstName }}
                                                </td>
                                                <td
                                                    class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                    {{ order.quantity }}
                                                </td>
                                                <td
                                                    class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                    {{ order.pastrie.price }}
                                                </td>
                                                <td
                                                    class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                    <span v-if="order.status == true">
                                                        <i class="fas fa-circle text-emerald-500 mr-2"></i>
                                                        Livery
                                                    </span>
                                                    <span v-else>
                                                        <i class="fas fa-circle text-orange-500 mr-2"></i> Pending
                                                    </span>
                                                </td>

                                                <td
                                                    class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                    {{ formatDate(order.created_at) }}
                                                </td>
                                                <td class="flex">
                                                    <button v-if="order.status == true"
                                                        class="bg-emerald-500 mt-2 text-white hover:bg-emerald-600 font-bold uppercase text-sm px-6 py-3 rounded-xl shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                                        disabled>
                                                        <span class="flex flex-row">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                                                            </svg>

                                                            It's Livery
                                                        </span>
                                                    </button>
                                                    <button v-else
                                                        class="bg-lightBlue-400 mt-2 text-white hover:bg-lightBlue-600 font-bold uppercase text-sm px-6 py-3 rounded-xl shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                                        type="submit" @click="ConfimLivrison(order)">
                                                        <span class="flex flex-row">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M7.5 7.5h-.75A2.25 2.25 0 004.5 9.75v7.5a2.25 2.25 0 002.25 2.25h7.5a2.25 2.25 0 002.25-2.25v-7.5a2.25 2.25 0 00-2.25-2.25h-.75m0-3l-3-3m0 0l-3 3m3-3v11.25m6-2.25h.75a2.25 2.25 0 012.25 2.25v7.5a2.25 2.25 0 01-2.25 2.25h-7.5a2.25 2.25 0 01-2.25-2.25v-.75" />
                                                            </svg>


                                                            Confirm Livery
                                                        </span>
                                                    </button>
                                                    <button type="button" @click="getUserorder(order)"
                                                        class="bg-white mt-2 text-black hover:bg-white font-bold uppercase text-sm px-6 py-3 rounded-xl  hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                                                        <span class="flex flex-row">
                                                            <i class="fas fa-sharp fa-solid fa-arrow-right"></i>
                                                        </span>
                                                    </button>
                                                </td>

                                            </tr>
                                        </template>
                                    </CardTable>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </main>
    </div>
</template>
