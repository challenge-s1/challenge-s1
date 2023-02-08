
<script setup>

import { ref, reactive, inject } from "vue";
import { useRoute } from "vue-router";
import { useStore } from "vuex";
import axios from "axios";
import { user as UserProvierKeys } from '@/components/providers/UserProviderKeys.js';
import mypastrie from "@/assets/img/mypastrie.jpeg";
import UserForm from "../../components/UserForm.vue";
import FormField from "../../components/FormField.vue";
import router from "../../router";
const categories = ref([]);


const store = useStore();
const route = useRoute();
const url = (import.meta.env.VITE_API_URL)
const products = ref([]);
const userToken = inject(UserProvierKeys);
const showModal = ref(false);
const productData = ref({});
const modalActive = ref({
    value: false,
    id: null,
});

const images = ref(null);
const product = reactive({
    name: '',
    description: '',
    price: '',
    category: '',
    contentUrl: '',
});

const PastriesData = reactive({
    name: '',
    description: '',
    price: '',
    category: '',
    contentUrl: '',
});

const errors = ref({
    name: '',
    description: '',
    price: '',
    // category: '',
    general: ''
});

const validate = () => {
    errors.value = {};
    if (product.name == '') {
        errors.value.name = 'Name is required';
    }
    if (product.description == '') {
        errors.value.description = 'Description is required';
    }
    if (product.price == '') {
        errors.value.price = 'Price is required';
    }
    // if (product.category == '') {
    //     errors.value.category = 'Category is required';
    // }
    return Object.values(errors.value).length == 0;
}

function uploadFile(e) {
    images.value = e.target.files || e.dataTransfer.files;
}

const toggleModal = (pastries) => {
    console.log(pastries);
    showModal.value = !showModal.value;
    if (pastries) {
        modalActive.value.id = pastries.id;
        Object.assign(product, products.value.find((p) => p.id === pastries.id));
    }
};

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

// console.log(userToken.value.token.token);
const GetProduct = async () => {
    await axios.get(`${url}/users/${userToken.value.token.user.id}/passtries`, {
        headers: {
            authorization: 'Bearer ' + userToken.value.token.token
        }
    }).then((response) => {
        products.value = response.data;
        console.log(response.data);
        // for (const test of products.value) {
        //     console.log(test.name);
        // }
    }).catch((error) => {
        console.log(error);
    })

};
GetProduct();

const NotAvailable = async (pastry) => {
    const Statuspasrty = {
        Status: true
    };
    console.log(Statuspasrty);
    await axios.put(`${url}/pastries/${pastry.id}`, Statuspasrty, {
        headers: {
            authorization: 'Bearer ' + userToken.value.token.token
        }
    }).then((response) => {
        GetProduct();
        console.log(response);
    }).catch((error) => {
        console.log(error);
    })
};

const EditProduct = async (pastry) => {
    if (!validate()) {
        return;
    }
    console.log(validate());
    if (images.value == null) {
        product.contentUrl = product.contentUrl;

    } else {
        // product.contentUrl = images.value[0];
        const pictures = new FormData();
        pictures.append('imageFile', images.value[0]);
        console.log(pictures);
        await axios.post(`${url}/users/images/${pastry.id}/passtries`, pictures, {
            headers: {
                'Content-Type': 'multipart/form-data',
                Authorization: 'Bearer ' + userToken.value.token.token
            }
        }).then((response) => {
            console.log('response', response);

            // product.contentUrl = response.data;
        }).catch((error) => {
            // errors.value.general = error.message;
            console.log(error);
        });
    }
    const productpasrty = {
        name: product.name,
        description: product.description,
        price: product.price,
        category: product.category,
        contentUrl: product.contentUrl,
    };

    await axios.put(`${url}/pastries/${pastry.id}`, productpasrty, {
        headers: {
            authorization: 'Bearer ' + userToken.value.token.token
        }
    }).then((response) => {
        GetProduct();
        toggleModal();
        router.push({ name: "MyPastries" })
        console.log(response);
    }).catch((error) => {
        console.log(error);
        errors.value.general = error.message;
    })
};

</script>

<template>
    <div>
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
                                <h1 class="text-white mt-4 font-semibold text-5xl">
                                    My products
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
                    <div class="flex flex-wrap" v-if="products.length !== 0">

                        <div v-for="pastries in products " :key="pastries.id"
                            class="w-full md:w-4/12 px-4 mr-auto ml-auto  pt-6  text-center">
                            <div
                                class="relative flex flex-col min-w-0 break-words  w-full mb-6 shadow-lg rounded-lg bg-orange-400">
                                <img alt="..." :src="url + '/' + pastries.contentUrl"
                                    class="w-full align-middle rounded-t-lg" />
                                <!-- <img alt="..."
                                    src="https://static.750g.com/images/1200-630/2bb28ae83807e3f46e861587586c6aee/adobestock-182827481.jpeg"
                                    class="w-full align-middle rounded-t-lg" /> -->
                                <blockquote class="relative p-8 mb-4">
                                    <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 583 95" class="absolute left-0 w-full block h-95-px -top-94-px">
                                        <polygon points="-30,95 583,95 583,65" class="text-orange-400 fill-current">
                                        </polygon>
                                    </svg>
                                    <div class="flex absolute top-0">
                                        <span
                                            class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-purple-600 bg-purple-200  last:mr-0 mr-1">
                                            {{ pastries.category.name }}
                                        </span>
                                    </div>
                                    <h4 class="text-xl  text-white">
                                        Name: <span class="font-bold"> {{ pastries.name }}</span>
                                    </h4>
                                    <p class="text-md font-light mt-2 text-white">
                                        Discription :{{ pastries.description }}
                                    </p>
                                    <p class="text-md font-light mt-2 text-white">
                                        Price : <span class="font-bold">{{ pastries.price }} € </span>
                                    </p>
                                    <div v-if="pastries.Status == false" class="flex justify-content-center px-6 py-3 ">
                                        <button type="button" v-on:click="toggleModal(pastries)"
                                            class="bg-gray-500 mt-2 text-white hover:bg-gray-600 font-bold uppercase text-sm px-6 py-3 rounded-xl shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                                            <span class="flex flex-row">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                </svg>
                                                Edit
                                            </span>
                                        </button>
                                        <button
                                            class="bg-red-500 mt-2 text-white hover:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded-xl shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                            type="submit" @click="NotAvailable(pastries)">
                                            <span class="flex flex-row">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                                Not dispo
                                            </span>
                                        </button>
                                    </div>
                                    <div v-else>
                                        <button
                                            class="bg-red-300 mt-2 text-white hover:cursor-not-allowed  font-bold uppercase text-sm px-6 py-3 rounded-xl shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                            disabled>
                                            <span class="flex flex-row">
                                                <span class="ml-2">
                                                    <i class="fas fa-sharp fa-solid fa-ban text-red-600 ml-1"></i>
                                                </span>
                                                not available
                                            </span>
                                        </button>
                                    </div>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <div class="flex  text-center md:text-left md:flex-row h-screen justify-evenly md:items-center">

                            <div class="bg-white p-10 flex flex-col shadow-xl rounded-xl">
                                <p>You have no product</p>
                            </div>

                        </div>
                    </div>
                </div>
                <div v-if="showModal"
                    class="overflow-x-hidden overflow-y-auto  fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">

                    <div class="relative w-auto mb-6 mt-72 mx-auto max-w-3xl">
                        <!--content-->
                        <div
                            class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                            <!--header-->
                            <div
                                class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t">
                                <h3 class="text-3xl font-semibold">
                                    Edit pastry shop : {{ product.name }}
                                </h3>
                                <button
                                    class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none"
                                    v-on:click="toggleModal()">
                                    <span
                                        class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-8 h-8 text-red-900 cursor-pointer" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </span>
                                </button>
                            </div>
                            <!--body-->
                            <div class="relative p-6 flex-auto">
                                <form @submit.prevent="EditProduct(product)">

                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                        Name
                                    </label>
                                    <input type="text" name="name"
                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-15"
                                        placeholder="name" v-model="product.name" />
                                    <div class=" text-red-500 text-xs italic">{{ errors.name }}</div>
                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                        htmlFor="grid-password">
                                        Description
                                    </label>
                                    <textarea type="text" name="description"
                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-15"
                                        placeholder="description" v-model="product.description"> </textarea>
                                    <div class=" text-red-500 text-xs italic">{{ errors.description }}</div>
                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                        Price
                                    </label>
                                    <input type="number" name="price"
                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-15"
                                        placeholder="price" v-model="product.price" />
                                    <div class=" text-red-500 text-xs italic">{{ errors.price }}</div>


                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                        categorie
                                    </label>
                                    <select name="category" id=""
                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-15"
                                        v-model="product.category">
                                        <option :value="product.category.id" selected>{{
                                            product.category.name
                                        }}</option>
                                        <option :value="categorie.id" v-for="categorie in categories "
                                            :key="categorie.id">
                                            {{ categorie.name }}
                                        </option>
                                    </select>
                                    <!-- <div class=" text-red-500 text-xs italic">{{ errors.category }}</div> -->
                                    <img alt="..." :src="url + '/' + product.contentUrl"
                                        class="w-full align-middle p-3 rounded-t-lg"
                                        style="width:150px; height: 150px;" />
                                    <label for="file"
                                        class="block uppercase text-blueGray-600 text-xs font-bold mb-2">Select
                                        a picture:</label>
                                    <input type="file"
                                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-15"
                                        ref="imageFile" @change="uploadFile" />
                                    <div class="p-3 mt-2 text-center space-x-4 md:block">
                                        <button
                                            class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                            type="button" v-on:click="toggleModal()">
                                            Close
                                        </button>
                                        <button type="submit"
                                            class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-md hover:shadow-lg hover:bg-orange-300">Save
                                        </button>
                                    </div>
                                    <div class=" text-red-500 text-xs italic">{{ errors.general }}</div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <div v-if="showModal" class="opacity-10 fixed inset-0 z-40 bg-black"></div>
            </section>
        </main>
    </div>
</template>
