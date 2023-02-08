<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import { useStore } from "vuex";
import axios from "axios";
import { formatDate, formatTime } from "@/composable/dates.js";
const store = useStore();
const router = useRouter();
const url = (import.meta.env.VITE_API_URL)
const masterClasses = ref([]);
const user = store.getters.user;


const getMasterClasses = async () => {
  await axios.get(`https://localhost/master_classes`, {
    headers: {
      Accept: 'application/json'
    }
  }).then((response) => {
    console.log(response.data);
    masterClasses.value = response.data;
    console.log(masterClasses.value);
  }).catch((error) => {
    console.log(error);
  })

};

const addToCart = function (masterClass) {
  console.log(user.id)
  if (!store.getters.isLoggedIn) {
    router.push({ name: "Login" })
  }
}
getMasterClasses();

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
                  Welcome to our platform, where our pastry cooks offer you pastry workshops, an opportunity for
                  enthusiasts to learn how to bake and unearth the secrets of our experts.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden h-70-px"
          style="transform: translateZ(0);">
          <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"
            version="1.1" viewBox="0 0 2560 100" x="0" y="0">
            <polygon class="text-blueGray-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
          </svg>
        </div>
      </div>

      <section class="pb-20 bg-blueGray-200 -mt-24">
        <div class="container mx-auto px-4">
          <div class="flex flex-wrap">
            <div v-for="masterClass in masterClasses" :class="{'w-full md:w-4/12 px-4 mr-auto ml-auto  pt-6  text-center': !masterClass.isCanceled && masterClass.owner.id != user.id }">
              <div v-if="!masterClass.isCanceled">
                <div v-if="masterClass.owner.id != user.id" >
                  <div class="relative flex flex-col min-w-0 break-words  w-full mb-6 shadow-lg rounded-lg bg-red-300">
                    <img alt="..."
                      src="https://static.750g.com/images/1200-630/2bb28ae83807e3f46e861587586c6aee/adobestock-182827481.jpeg"
                      class="w-full align-middle rounded-t-lg" />
                    <blockquote class="relative p-8 mb-4">
                      <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 583 95"
                        class="absolute left-0 w-full block h-95-px -top-94-px">
                        <polygon points="-30,95 583,95 583,65" class="text-red-300 fill-current">
                        </polygon>
                      </svg>
                      <div class="flex absolute top-0">
                        <span
                          class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-purple-600 bg-purple-200 uppercase last:mr-0 mr-1">
                          {{ masterClass.title }}
                        </span>
                      </div>

                      <h4 class="text-xl  text-white">
                        <span class="font-bold"> {{ masterClass.title }}</span>
                      </h4>
                      <p class="text-md font-light mt-2 text-white">
                        proposed by : <span class="font-bold">{{ masterClass.owner.lastName }}
                          {{ masterClass.owner.firstName }}</span>
                      </p>
                      <p class="text-md font-light mt-2 text-white">
                        Discription :{{ masterClass.description }}
                      </p>
                      <p class="text-md font-light mt-2 text-white">
                        Address : {{ masterClass.adress }} {{ masterClass.city }} {{ masterClass.postalCode }}, {{
                          masterClass.country
                        }}
                      </p>
                      <p class="text-md font-light mt-2 text-white">
                        Date : {{ formatDate(masterClass.date) }}
                      </p>
                      <p class="text-md font-light mt-2 text-white">
                        hour : {{ formatTime(masterClass.time) }}
                      </p>
                      <p class="text-md font-light mt-2 text-white">
                        Price : <span class="font-bold">{{ masterClass.price }} € </span>
                      </p>
                      <button
                        class="bg-red-500 mt-2 text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded-full shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-15"
                        type="button" @click="addToCart(masterClass)">
                        <span class="flex flex-row">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 mr-3">
                            <path stroke-linecap="round" stroke-linejoin="round"
                              d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                          </svg>
                          participate
                        </span>
                      </button>
                    </blockquote>
                  </div>

                </div>

              </div>

            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
</template>

