<script setup>
import CardLineChart from "@/components/Cards/CardLineChart.vue";
import CardBarChart from "@/components/Cards/CardBarChart.vue";
import CardPageVisits from "@/components/Cards/CardPageVisits.vue";
import CardSocialTraffic from "@/components/Cards/CardSocialTraffic.vue";
import AdminNavbar from "@/components/Navbars/AdminNavbar.vue";
import Sidebar from "@/components/Sidebar/Sidebar.vue";
import HeaderStats from "@/components/Headers/HeaderStats.vue";
import FooterAdmin from "@/components/Footers/FooterAdmin.vue";
import { useRoute } from "vue-router";
import { useStore } from "vuex";
const store = useStore();
const route = useRoute();
// export default {
//   name: "admin-layout",
//   components: {

//   },
// };

</script>
<template>
    <div>
        <sidebar />
        <div class="relative md:ml-64 bg-blueGray-100" style=" margin-top: -4rem;">
            <admin-navbar />
            <header-stats />
            <div class="px-4 md:px-10 mx-auto w-full -m-24">
                <div>

                    <div class="flex mt-32">
                        <div class="flex">
                            <div class="flex">
                                <p>
                                    Welcome to the admin dashboard. Here you can manage all the content of the website.
                                </p>
                            </div>

                        </div>


                    </div>
                    <div class="flex flex-wrap justify-center mt-12">
                        <router-link :to="{ name: 'Users' }">
                            <div
                                class=" mr-3 flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                                <div class="flex-auto p-4">
                                    <div class="flex flex-wrap">
                                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                            <span class="font-semibold text-xl text-blueGray-700">
                                                Users
                                            </span>
                                        </div>
                                        <div class="relative w-auto pl-4 flex-initial">
                                            <div
                                                class=" p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full">
                                                <i class="fas fa-sharp fa-solid fa-users mr-2 text-sm"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </router-link>
                        <router-link :to="{ name: 'Categories' }">
                            <div
                                class=" mr-3 flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                                <div class="flex-auto p-4">
                                    <div class="flex flex-wrap">
                                        <div class="relative w-full pr-4 max-w-full flex-grow flex-1">

                                            <span class="font-semibold text-xl text-blueGray-700">
                                                Category
                                            </span>
                                        </div>
                                        <div class="relative w-auto pl-4 flex-initial">
                                            <div
                                                class=" p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full">
                                                <i class="fas fa-table mr-2 text-sm"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </router-link>
                    </div>
                </div>
                <footer-admin />
            </div>
        </div>
    </div>
</template>

