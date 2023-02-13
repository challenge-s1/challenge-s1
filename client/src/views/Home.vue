<script setup>
import IndexNavbar from "@/components/Navbars/IndexNavbar.vue";
import FooterComponent from "@/components/Footers/Footer.vue";
import homeimge from "@/assets/img/home1.png";
import chef1 from "@/assets/img/chef1.jpg";
import chef2 from "@/assets/img/chef2.jpg";
import chef3 from "@/assets/img/che3.webp";
import chef4 from "@/assets/img/chef4.jpeg";
import product from "@/assets/img/shop/product-1.jpg";
import { inject, ref, computed } from 'vue';
import { useStore } from 'vuex';

const store = useStore();

const isLoggedIn = computed({
    get: () => store.getters.isLoggedIn,
});
</script>
<template>
    <div>
        <index-navbar />
        <section class="header relative pt-16 items-center flex h-screen max-h-860-px">
            <div class="container mx-auto items-center flex flex-wrap">
                <div class="w-full md:w-8/12 lg:w-6/12 xl:w-6/12 px-4">
                    <div class="pt-32 sm:pt-0">
                        <h2 class="font-semibold text-4xl text-blueGray-600">
                            welcome for lovers of patterserie, you can learn how to make your favorite cake bitch to us
                            master class,
                            and order your favorite cake.
                        </h2>
                        <p class="mt-4 text-lg leading-relaxed text-blueGray-500">
                            Indulge in the rich and sophisticated flavors of gourmet pastries, expertly crafted by
                            master bakers.
                            From delicate flaky croissants filled with sweet cream, to fruity tarts bursting with juicy
                            freshness,
                            each bite is a taste sensation. Perfect for special occasions or as a decadent treat,
                            gourmet pastries elevate the everyday and tantalize the taste buds.
                            So why not treat yourself to something truly special today,
                            and experience the unparalleled bliss of a gourmet pastry.
                        </p>
                        <div class="mt-12" v-if="!store.getters.isLoggedIn">
                            <router-link :to="{ name: 'Login' }" target="_blank"
                                class="get-started text-white font-bold px-6 py-4 rounded outline-none focus:outline-none mr-1 mb-1 bg-red-300 hover:bg-red-600 uppercase text-sm shadow hover:shadow-lg ease-linear transition-all duration-150">
                                Get started
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>

            <img class="absolute top-0 b-auto right-0 pt-16 sm:w-6/12 -mt-48 sm:mt-0 w-10/12 max-h-860-px"
                :src="homeimge" alt="..." />
        </section>

        <section class="mt-48 md:mt-40  relative bg-blueGray-100">
            <div class="-mt-20 top-0 bottom-auto left-0 right-0 w-full absolute h-20" style="transform: translateZ(0);">
                <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg"
                    preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                    <polygon class="text-blueGray-100 fill-current" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
            <div class="container mx-auto">
                <div class="flex flex-wrap items-center">
                    <div class="w-10/12 md:w-6/12 lg:w-4/12 px-12 md:px-4 mr-auto ml-auto -mt-32">
                        <div
                            class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-red-500">
                            <img alt="..." :src="product" class="w-full align-middle rounded-t-lg" />
                            <blockquote class="relative p-8 mb-4">
                                <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 583 95"
                                    class="absolute left-0 w-full block h-95-px -top-94-px">
                                    <polygon points="-30,95 583,95 583,65" class="text-red-500 fill-current">
                                    </polygon>
                                </svg>
                                <h4 class="text-xl font-bold text-white">
                                    Cupcake
                                </h4>
                                <p class="text-md font-light mt-2 text-white">
                                    It is among the best-selling cakes with us, do not hesitate to join us to take
                                    advantage of our offer.
                                </p>
                            </blockquote>
                        </div>
                    </div>

                    <div class="w-full md:w-6/12 px-4">
                        <div class="flex flex-wrap">
                            <p class="text-lg font-light leading-relaxed mt-4 mb-4 text-blueGray-600">
                                A pastry cupcake is a sweet treat that is loved by people of all ages. It is a small,
                                individual-sized cake that is baked in a muffin tin and topped with delicious frosting.
                                Cupcakes come in a wide variety of flavors, including chocolate, vanilla, red velvet,
                                and many more. The best part about cupcakes is that they are easy to decorate, making
                                them perfect for special occasions like birthdays and holidays. Whether you're looking
                                for a simple treat or something more elaborate, a pastry cupcake is sure to satisfy your
                                sweet tooth. So why not treat yourself to one today and enjoy a bite of heaven?
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mx-auto overflow-hidden pb-20">
                <div class="flex flex-wrap items-center ">
                    <div class="w-full md:w-6/12 px-4 mr-auto ml-auto mt-32">
                        <div class="justify-center flex flex-wrap relative">
                            <div class="my-4 w-full lg:w-6/12 px-4">
                                <img :src="chef3" class="shadow-md rounded-lg mt-8 max-w-full   " />
                                <img :src="chef4" class="shadow-md rounded-lg mt-8 max-w-full   " />
                            </div>
                            <div class="my-4 w-full lg:w-6/12 px-4 lg:mt-16">
                                <img :src="chef1" class="shadow-md rounded-lg mt-8 max-w-full   " />
                                <img :src="chef2" class="shadow-md rounded-lg mt-8 max-w-full   " />
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-4/12 px-12 md:px-4 ml-auto mr-auto mt-48">
                        <h3 class="text-3xl mb-2 font-semibold leading-normal">
                            Master class
                        </h3>
                        <p class="text-lg font-light leading-relaxed mt-4 mb-4 text-blueGray-600">
                            "Attention all pastry enthusiasts! Get ready to expand your dessert-making skills with our
                            upcoming Pastry Master Class. Led by world-renowned chefs, you'll learn the tricks of the
                            trade and create delectable confections that are both beautiful and delicious. From classic
                            French pastries to modern dessert innovations, you'll discover a world of possibilities in
                            this hands-on experience. Whether you're a seasoned pastry chef or just starting out, this
                            master class is the perfect opportunity to take your skills to the next level. Enroll today
                            and get ready to create the sweetest memories of your life!"
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="pb-16 bg-blueGray-200 relative pt-32">
            <div class="-mt-20 top-0 bottom-auto left-0 right-0 w-full absolute h-20" style="transform: translateZ(0);">
                <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg"
                    preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                    <polygon class="text-blueGray-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>

            <div class="container mx-auto" v-if="!store.getters.isLoggedIn">
                <div
                    class=" flex flex-wrap justify-center bg-white shadow-xl rounded-lg -mt-64 py-16 px-12 relative z-10">
                    <div class="w-full text-center lg:w-8/12">
                        <p class="text-4xl text-center">
                            <span role="img" aria-label="love">
                                😍
                            </span>
                        </p>
                        <h3 class="font-semibold text-3xl">
                            Do you like our work?
                        </h3>
                        <p class="text-blueGray-500 text-lg leading-relaxed mt-4 mb-4">
                            Do not hesitate to join our customers or to bake us
                        </p>
                        <div class="sm:block flex flex-col mt-10">

                            <router-link :to="{ name: 'Login' }"
                                class="get-started text-white font-bold px-6 py-4 rounded outline-none focus:outline-none mr-1 mb-2 bg-red-400 hover:bg-red-600 uppercase text-sm shadow hover:shadow-lg ease-linear transition-all duration-150">
                                Login
                            </router-link>
                            <router-link :to="{ name: 'Register' }"
                                class="github-star sm:ml-1 text-white font-bold px-6 py-4 rounded outline-none focus:outline-none mr-1 mb-1 bg-blueGray-700 hover:bg-blueGray-600 uppercase text-sm shadow hover:shadow-lg ease-linear transition-all duration-150">

                                <span>Register</span>
                            </router-link>
                        </div>
                        <div class="text-center mt-16"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

