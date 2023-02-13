<script setup>
import Navbar from "@/components/Navbars/AuthNavbar.vue";

import { ref, reactive, inject } from "vue";
import { useRouter } from "vue-router";
import { useStore } from "vuex";
import axios from "axios";
import { user as UserProvierKeys } from '@/components/providers/UserProviderKeys.js';

const store = useStore();
const route = useRouter();
const url = (import.meta.env.VITE_API_URL)
const products = ref([]);
const userToken = inject(UserProvierKeys);

const GetProduct = async () => {
    await axios.get(`${url}/pastries`)
        .then((response) => {
            console.log(response.data);
            products.value = response.data;
            // for (const test of products.value) {
            //     console.log(test.name);
            // }
        }).catch((error) => {
            console.log(error);
        })

};
GetProduct();

const AddCart = async (pastrie) => {
    await axios.post(`${url}/carts/pastrie/${pastrie.id}`, {},
        {
            headers: {
          authorization: 'Bearer ' + userToken.value.token
        }
        }
    ).then((response) => {
        route.push({ name: "Cart" })
        console.log(response);
    }).
    catch((error) => {
        console.log(error);
    })
}

</script>

<template>
    <div>
        <main>
            <div class="relative pt-16 pb-32 flex content-center items-center justify-center min-h-screen-75">
                <div class="absolute top-0 w-full h-full bg-center bg-cover"
                    style="background-image: url('https://www.marmiteauxplumes.com/wp-content/uploads/2021/01/36519-738-cupcakes-5116009_640.jpg');">
                    <span id="blackOverlay" class="w-full h-full absolute opacity-75 bg-black"></span>
                </div>
                <div class="container relative mx-auto">
                    <div class="items-center flex flex-wrap">
                        <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
                            <div class="pr-12">
                                <h1 class="text-white mt-4 font-semibold text-5xl">
                                    Enjoy us product.
                                </h1>
                                <p class="mt-4 text-lg text-blueGray-200">
                                    Welcome to our pastry shop, where every bite is a delightful experience. From our
                                    flaky croissants to our rich and gooey chocolate cakes, our desserts are made with
                                    the freshest ingredients and a touch of love. Our bakers are passionate about their
                                    craft and it shows in every pastry they create. Whether you're looking for a sweet
                                    start to your day or a decadent treat to share with friends, we have something for
                                    everyone. Come visit us and taste the magic for yourself. We can't wait to share our
                                    sweets with you!
                                </p>
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
                    <div class="flex flex-wrap">
                        <template v-for="pastries in products " :key="pastries.id">
                            <div v-if="pastries.Status == false"
                                class="w-full md:w-4/12 px-4 mr-auto ml-auto  pt-6  text-center">
                                <div
                                    class="relative flex flex-col min-w-0 break-words  w-full mb-6 shadow-lg rounded-lg bg-red-300">
                                    <!-- <img alt="..."
                                        src="https://static.750g.com/images/1200-630/2bb28ae83807e3f46e861587586c6aee/adobestock-182827481.jpeg"
                                        class="w-full align-middle rounded-t-lg" /> -->
                                    <img alt="..." :src="url + '/' + pastries.contentUrl"
                                        class="w-full align-middle rounded-t-lg" />
                                    <blockquote class="relative p-8 mb-4">

                                        <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 583 95"
                                            class="absolute left-0 w-full block h-95-px -top-94-px">
                                            <polygon points="-30,95 583,95 583,65" class="text-red-300 fill-current">
                                            </polygon>

                                        </svg>
                                        <div class="flex absolute top-0">
                                            <span
                                                class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-purple-600 bg-purple-200 uppercase last:mr-0 mr-1">
                                                {{ pastries.category.name }}
                                            </span>
                                        </div>

                                        <h4 class="text-xl  text-white">
                                            Name: <span class="font-bold"> {{ pastries.name }}</span>
                                        </h4>
                                        <p class="text-md font-light mt-2 text-white">
                                            realize by : <span class="font-bold">{{ pastries.owner.lastName }} {{
                                                pastries.owner.firstName
                                            }}</span>
                                        </p>
                                        <!-- <p class="text-md font-light mt-2 text-white">
                                            Discription :{{ pastries.description }}
                                        </p> -->
                                        <span class="text-md font-light mt-2 text-white flex justify-center">
                                            Discription :
                                            <details class="ml-1">
                                                <summary> Show more details
                                                </summary>
                                                {{ pastries.description }}
                                            </details>
                                        </span>
                                        <p class="text-md font-light mt-2 text-white">
                                            Price : <span class="font-bold">{{ pastries.price }} € </span>
                                        </p>
                                        <button @click="AddCart(pastries)"
                                            class="bg-red-500 mt-2 text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded-full shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                            type="button">
                                            <span class="flex flex-row">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                                </svg>

                                                Add to cart
                                            </span>
                                        </button>
                                    </blockquote>
                                </div>
                            </div>
                        </template>
                        <!-- <div class=" w-full md:w-4/12 px-4 mr-auto ml-auto    text-center">
                            <div
                                class="relative flex flex-col min-w-0 break-words bg-red-300 w-full mb-6 shadow-lg rounded-lg ">
                                <img alt="..."
                                    src="https://funcakes.com/content/uploads/2021/10/Choco-cake-960x540-c-default.jpg"
                                    class="w-full align-middle rounded-t-lg" />
                                <blockquote class="relative p-8 mb-4">
                                    <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 583 95" class="absolute left-0 w-full block h-95-px -top-94-px">
                                        <polygon points="-30,95 583,95 583,65" class="text-red-300 fill-current">
                                        </polygon>
                                    </svg>
                                    <h4 class="text-xl font-bold text-white">
                                        Top Notch Services
                                    </h4>
                                    <p class="text-md font-light mt-2 text-white">
                                        The Arctic Ocean freezes every winter and much of the
                                        sea-ice then thaws every summer, and that process will
                                        continue whatever happens.
                                    </p>
                                    <button
                                        class="bg-red-500  text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded-full shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                        type="button">
                                        <span class="flex flex-row">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                            </svg>

                                            Add to cart
                                        </span>
                                    </button>
                                </blockquote>
                            </div>
                        </div>
                        <div class=" w-full md:w-4/12 px-4 mr-auto ml-auto  pt-6  text-center">
                            <div
                                class="relative flex flex-col min-w-0 break-words  w-full mb-6 shadow-lg rounded-lg bg-red-300">
                                <img alt="..."
                                    src="https://www.healthyfoodcreation.fr/wp-content/uploads/2020/06/DSC_0295-scaled.jpg"
                                    class="w-full align-middle rounded-t-lg" />
                                <blockquote class="relative p-8 mb-4">
                                    <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 583 95" class="absolute left-0 w-full block h-95-px -top-94-px">
                                        <polygon points="-30,95 583,95 583,65" class="text-red-300 fill-current">
                                        </polygon>
                                    </svg>
                                    <h4 class="text-xl font-bold text-white">
                                        Top Notch Services
                                    </h4>
                                    <p class="text-md font-light mt-2 text-white">
                                        The Arctic Ocean freezes every winter and much of the
                                        sea-ice then thaws every summer, and that process will
                                        continue whatever happens.
                                    </p>
                                    <button
                                        class="bg-red-500  text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded-full shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                        type="button">
                                        <span class="flex flex-row">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                            </svg>
                                            Add to cart
                                        </span>
                                    </button>
                                </blockquote>
                            </div>
                        </div> -->
                    </div>
                </div>
            </section>
        </main>

    </div>
</template>
