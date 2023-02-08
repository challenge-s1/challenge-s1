
<script setup>
import { ref } from 'vue';
import Card from '../components/card/prodCard.vue';
import axios from 'axios';

</script>

<template>
    <section class="py-10 bg-gray-100">
        <Card>
            <template #image>
                <img src="https://i.imgur.com/GIeyjWd.jpg" alt="Hotel Photo" />
            </template>
            <template #title>
                <h2 class="text-slate-700">Adobe Photoshop CC 2022</h2>
            </template>
            <template #description>
                <p class="mt-1 text-sm text-slate-400">Lisbon, Portugal</p>
            </template>
            <template #price>
                <p>
                    <span class="text-lg font-bold text-blue-500">$850</span>
                    <span class="text-sm text-slate-400">/night</span>
                </p>
            </template>
            <template #button>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>

                <button class="text-sm">Add to cart</button>
            </template>
        </Card>
    </section>
    <!-- <div>
        <div class=" px-10 py-20 bg-gray-100 grid gap-10 lg:grid-cols-3 xl:grid-cols-4 sm:grid-cols-2">
            <div
                class="max-w-xs rounded-md overflow-hidden shadow-lg hover:scale-105 transition duration-500 cursor-pointer">
                <div class="block relative h-72 bg-center bg-cover bg-no-repeat"
                    style="background-image: url(' https://www.recipetineats.com/wp-content/uploads/2020/09/Vanilla-Cupcakes-with-Vanilla-Swiss-Meringue-SQ.jpg');">
                    <div class=" block absolute left-0 text-center w-full" style="bottom:-15px">
                        <span>Cupcake</span>
                    </div>
                </div>
                <div class="py-4 px-4 bg-white">
                    <h3 class="text-md font-semibold text-gray-600">Apple MacBook Pro M1 13.3&quot; Silver 16GB/512GB
                        (MYDC2FN/A-16GB)</h3>
                    <p class="mt-4 text-lg font-thin">$ 2400</p>
                    <span
                        class="flex items-center justify-center mt-4 w-full bg-yellow-400 hover:bg-yellow-500 py-1 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <button class="font-semibold text-gray-800">Add to Basket</button>
                    </span>
                </div>
            </div>
            <div
                class="max-w-xs rounded-md overflow-hidden shadow-lg hover:scale-105 transition duration-500 cursor-pointer">
                <div>
                    <img src="https://media.cnn.com/api/v1/images/stellar/prod/201116214440-9-macbook-air-review-silicon-underscoredjpg.jpg?q=w_2615,h_1556,x_0,y_0,c_fill"
                        alt="" />
                </div>
                <div class="py-4 px-4 bg-white">
                    <h3 class="text-md font-semibold text-gray-600">Apple MacBook Pro M1 13.3&quot; Silver 16GB/512GB
                        (MYDC2FN/A-16GB)</h3>
                    <p class="mt-4 text-lg font-thin">$ 2400</p>
                    <span
                        class="flex items-center justify-center mt-4 w-full bg-yellow-400 hover:bg-yellow-500 py-1 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <button class="font-semibold text-gray-800">Add to Basket</button>
                    </span>
                </div>
            </div>
            <div
                class="max-w-xs rounded-md overflow-hidden shadow-lg hover:scale-105 transition duration-500 cursor-pointer">
                <div>
                    <img src="https://www.macworld.com/wp-content/uploads/2022/01/macbook-pro-compare.jpg?quality=50&strip=all&w=1024"
                        alt="" />
                </div>
                <div class="py-4 px-4 bg-white">
                    <h3 class="text-md font-semibold text-gray-600">Apple MacBook Pro M1 13.3&quot; Silver 16GB/512GB
                        (MYDC2FN/A-16GB)</h3>
                    <p class="mt-4 text-lg font-thin">$ 2400</p>
                    <span
                        class="flex items-center justify-center mt-4 w-full bg-yellow-400 hover:bg-yellow-500 py-1 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <button class="font-semibold text-gray-800">Add to Basket</button>
                    </span>
                </div>
            </div>
            <div
                class="max-w-xs rounded-md overflow-hidden shadow-lg hover:scale-105 transition duration-500 cursor-pointer">
                <div>
                    <img src="https://img.republicworld.com/republic-prod/stories/promolarge/xhdpi/g1jzwrwrlfim5wux_1623141909.jpeg"
                        alt="" />
                </div>
                <div class="py-4 px-4 bg-white">
                    <h3 class="text-md font-semibold text-gray-600">Apple MacBook Pro M1 13.3&quot; Silver 16GB/512GB
                        (MYDC2FN/A-16GB)</h3>
                    <p class="mt-4 text-lg font-thin">$ 2400</p>
                    <span
                        class="flex items-center justify-center mt-4 w-full bg-yellow-400 hover:bg-yellow-500 py-1 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <button class="font-semibold text-gray-800">Add to Basket</button>
                    </span>
                </div>
            </div>
            <div
                class="max-w-xs rounded-md overflow-hidden shadow-lg hover:scale-105 transition duration-500 cursor-pointer">
                <div>
                    <img src="https://cdn.mos.cms.futurecdn.net/GfinEMFXnT42BFxAcDc2rA.jpg" alt="" />
                </div>
                <div class="py-4 px-4 bg-white">
                    <h3 class="text-md font-semibold text-gray-600">Apple MacBook Pro M1 13.3&quot; Silver 16GB/512GB
                        (MYDC2FN/A-16GB)</h3>
                    <p class="mt-4 text-lg font-thin">$ 2400</p>
                    <span
                        class="flex items-center justify-center mt-4 w-full bg-yellow-400 hover:bg-yellow-500 py-1 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <button class="font-semibold text-gray-800">Add to Basket</button>
                    </span>
                </div>
            </div>
            <div
                class="max-w-xs rounded-md overflow-hidden shadow-lg hover:scale-105 transition duration-500 cursor-pointer">
                <div>
                    <img src="https://images.indianexpress.com/2021/12/macbook-pro-2021-review-featured-image.jpg"
                        alt="" />
                </div>
                <div class="py-4 px-4 bg-white">
                    <h3 class="text-md font-semibold text-gray-600">Apple MacBook Pro M1 13.3&quot; Silver 16GB/512GB
                        (MYDC2FN/A-16GB)</h3>
                    <p class="mt-4 text-lg font-thin">$ 2400</p>
                    <span
                        class="flex items-center justify-center mt-4 w-full bg-yellow-400 hover:bg-yellow-500 py-1 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <button class="font-semibold text-gray-800">Add to Basket</button>
                    </span>
                </div>
            </div>
        </div>
    </div> -->

</template>