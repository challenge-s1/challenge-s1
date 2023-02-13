
<script setup>

import { ref, reactive, inject, computed } from "vue";

import { useRoute } from "vue-router";
import { useStore } from "vuex";
import axios from "axios";
import CardTable from "@/components/Cards/CardTable.vue";
import { user as UserProvierKeys } from '@/components/providers/UserProviderKeys.js';
import mypastrie from "@/assets/img/mypastrie.jpeg";
import router from "../router";
import { formatDate } from "@/composable/dates.js";
import Modal from "@/components/Modal.vue";



const store = useStore();
const route = useRoute();
const url = (import.meta.env.VITE_API_URL)
const orders = ref([]);
// const userToken = inject(UserProvierKeys);
const userToken = store.getters.user
const openModalgetorder = ref(false);

const handleOpenModalgetOrder = () => {

    openModalgetorder.value = !openModalgetorder.value;
    console.log(openModalgetorder.value);

};

const orderData = reactive({
    id: '',
    status: '',
    pastrie: {
        id: '',
        name: '',
        description: '',
        price: '',
        created_at: '',
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
    },


})


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

const orderspastry = computed(() => {
    return orders.value.filter((order) => {
        return order.owner.id == userToken.id
    })
});
const openModalgetuser = ref(false);
const handleOpenModalgetUser = () => {

    openModalgetuser.value = !openModalgetuser.value;

};
const getUserManage = (order) => {
    orderData.id = order.id;
    orderData.status = order.status;
    orderData.pastrie.id = order.pastrie.id;
    orderData.pastrie.name = order.pastrie.name;
    orderData.pastrie.description = order.pastrie.description;
    orderData.pastrie.price = order.pastrie.price;
    orderData.pastrie.owner.email = order.pastrie.owner.email;
    orderData.pastrie.owner.firstName = order.pastrie.owner.firstName;
    orderData.pastrie.owner.lastName = order.pastrie.owner.lastName;
    orderData.pastrie.owner.city = order.pastrie.owner.city;
    orderData.pastrie.owner.address = order.pastrie.owner.address;
    orderData.pastrie.owner.postalcode = order.pastrie.owner.postalcode;
    orderData.pastrie.owner.country = order.pastrie.owner.country;
    console.log(orderData);
    handleOpenModalgetUser();
}

</script>

<template>
    <div>
        <Modal :open="openModalgetuser" @close="handleOpenModalgetUser">
            <template #title>
                <h1 class="text-2xl font-semibold text-gray-700">More details :</h1>
            </template>
            <div class="flex flex-row mb-2">
                <h1 lass=" text-blueGray-500 text-lg leading-relaxed font-bold"> pastry name : </h1>
                <p class=" text-blueGray-500 text-lg leading-relaxed">
                    {{ orderData.pastrie.name }}
                </p>
            </div>
            <div class="flex flex-row mb-2">
                <h1 lass=" text-blueGray-500 text-lg leading-relaxed font-bold"> Description : </h1>
                <p class=" text-blueGray-500 text-lg leading-relaxed">
                    {{ orderData.pastrie.description }}
                </p>
            </div>
            <div class="flex flex-row mb-2">
                <h1 lass=" text-blueGray-500 text-lg leading-relaxed font-bold"> Price : </h1>
                <p class=" text-blueGray-500 text-lg leading-relaxed">
                    {{ orderData.pastrie.price }}
                </p>
            </div>
            <div class="flex flex-row mb-2">
                <h1 lass="text-blueGray-500 text-lg leading-relaxed font-bold"> Realized by : </h1>
                <p class=" text-blueGray-500 text-lg leading-relaxed">
                    {{ orderData.pastrie.owner.firstName }} {{ orderData.pastrie.owner.lastName }}
                </p>
            </div>
            <div class="flex flex-row mb-2">
                <h1 lass=" text-blueGray-500 text-lg leading-relaxed font-bold"> Email : </h1>
                <p class=" text-blueGray-500 text-lg leading-relaxed">
                    {{ orderData.pastrie.owner.email }}
                </p>
            </div>
            <div class="flex flex-row mb-2">
                <h1 lass=" text-blueGray-500 text-lg leading-relaxed font-bold"> Adress : </h1>
                <p class=" text-blueGray-500 text-lg leading-relaxed">
                    {{ orderData.pastrie.owner.address }}
                </p>
            </div>
            <div class="flex flex-row mb-2">
                <h1 lass=" text-blueGray-500 text-lg leading-relaxed font-bold"> City : </h1>
                <p class=" text-blueGray-500 text-lg leading-relaxed">
                    {{ orderData.pastrie.owner.city }}
                </p>
            </div>
            <div class="flex flex-row mb-2">
                <h1 lass=" text-blueGray-500 text-lg leading-relaxed font-bold"> Postal code : </h1>
                <p class=" text-blueGray-500 text-lg leading-relaxed">
                    {{ orderData.pastrie.owner.postalcode }}
                </p>
            </div>
            <div class="flex flex-row mb-2">
                <h1 lass=" text-blueGray-500 text-lg leading-relaxed font-bold"> Country: </h1>
                <p class=" text-blueGray-500 text-lg leading-relaxed">
                    {{ orderData.pastrie.owner.country }}
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
                                                    Realized by
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
                                                    {{ order.pastrie.owner.firstName }} {{
                                                        order.pastrie.owner.lastName
                                                    }}
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
                                                <button type="button" @click="getUserManage(order)"
                                                    class="bg-white mt-2 text-black hover:bg-white font-bold uppercase text-sm px-6 py-3 rounded-xl  hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                                                    <span class="flex flex-row">
                                                        <i class="fas fa-sharp fa-solid fa-arrow-right"></i>
                                                    </span>
                                                </button>
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
