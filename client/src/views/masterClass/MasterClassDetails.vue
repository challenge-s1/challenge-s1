<script setup>
import { computed,ref } from 'vue';
import { useRoute,useRouter } from 'vue-router'
import axios from 'axios';
import {formatDate,formatTime} from "@/composable/dates.js"
import product from "@/assets/img/shop/product-1.jpg";
import Modal from "@/components/Modal.vue";
import { useStore } from 'vuex';


const store = useStore();
const route = useRoute();
const user = store.getters.user
const masterClass = ref({});
const open = ref(false);
const openModalUpdate = ref(false);
const today = new Date();

const handleOpen = () => {
    open.value = !open.value;
};

const handleOpenModalUpdate = () => {
    openModalUpdate.value = !openModalUpdate.value;
};

const getMasterClass = async ()=> {
  await axios.get(`https://localhost/master_classes/${route.params.id}`, {
    headers: {
      Accept: 'application/json'
    }
  }).then((response) => {
    masterClass.value = response.data;
    masterClass.value.expired = false;
    let options = { timeZone: 'UTC', hour: '2-digit', minute: '2-digit' };
    let timeStr = new Date(masterClass.value.time);
    let time = new Intl.DateTimeFormat('default', options).format(timeStr);
    masterClass.value.time = time;
    let date = new Date(masterClass.value.date);
    if (today > date) {
        masterClass.value.expired = true;
    }
    if (today == date) {
        if (new Intl.DateTimeFormat('default', options).format(today) > time) {
            masterClass.value.expired = true;
        }
    }
  }).catch((error) => {
    console.log(error);
  })
  
}
const getMasterClassToCancel = () => {
    handleOpen();
}

const getMasterClassToUpdate = function(){
   masterClass.value.date = formatDate(masterClass.value.date);
  handleOpenModalUpdate();
}

const updateMasterClass = async () =>{
    handleOpenModalUpdate();
    await axios.put(`https://localhost/master_classes/${masterClass.value.id}`, {
        "title": masterClass.value.title,
        "description": masterClass.value.description,
        "maxNumber": masterClass.value.maxNumber,
        "date": masterClass.value.date,
        "time": masterClass.value.time,
        "adress": masterClass.value.adress,
        "city": masterClass.value.city,
        "postalcode": masterClass.value.postalCode,
        "country": masterClass.value.country,
    }, {
        headers: {
          Authorization: `Bearer ${user.token}`,
          Accept : 'application/json'
        }
    }).then((response) => {
        console.log(response);
        getMasterClass();
    }).catch((error) => {
        console.log(error);
    })
}

const cancelMasterClass = async () => {
    
    handleOpen();
    await axios.delete(`https://localhost/master-classes/${masterClass.value.id}/cancel`, {
        headers: {
          Authorization: `Bearer ${user.token}`
        }
    }).then((response) => {
        console.log(response);
        getMasterClass();
    }).catch((error) => {
        console.log(error);
    })
}

getMasterClass();



</script> 


<template>
    <Modal :open="open" @close="handleOpen">
    <template #title>
        <h1 class="text-2xl font-semibold text-gray-700">Cancel Master Class</h1>
    </template>
    <form @submit.prevent="cancelMasterClass">
        <p>You will Cancel this Master Class, you can't update or receive reservation for this event</p>
        <div class="flex items-center justify-between mt-4">
            <button type="submit" class="px-4 py-2 font-semibold text-white bg-blue-500 rounded hover:bg-blue-700">
                Cancel
            </button>
        </div>
    </form>
  </Modal>
  <Modal :open="openModalUpdate" @close="handleOpenModalUpdate">
    <template #title>
        <h1 class="text-2xl font-semibold text-gray-700">Update Master Class</h1>
    </template>
    <form @submit.prevent="updateMasterClass">
   
        <div>
          <label for="title">Title</label>
          <input type="text" name="title" id="title" v-model.trim="masterClass.title" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" placeholder="Title">

        </div>
        <div>
          <label for="description">Description</label>
          <textarea name="description" id="description" v-model.trim="masterClass.description" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" placeholder="Description"/>
        </div>
          
        <div class="flex justify-between">
          <div>
            <label for="time">Time</label>
            <input type="time" name="time" id="time" v-model="masterClass.time" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
          </div>
          <div>
            <label for="date">Date</label>
            <input type="date" name="date" id="date" v-model="masterClass.date" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
          </div>
          
        </div>
        <div class="flex justify-between">
          <div>
            <label for="adress">Adress</label>
            <input type="text" name="adress" id="adress" v-model.trim="masterClass.adress" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" placeholder="Adress">
          </div>
          <div>
            <label for="city">City</label>
            <input type="text" name="city" id="city" v-model.trim="masterClass.city" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" placeholder="City">
          </div>
        </div>
        <div class="flex justify-between">
          <div class="mr-2">
            <label for="postalCode">Postal Code</label>
            <input type="text" name="postalCode" id="postalCode" v-model.trim="masterClass.postalCode" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" placeholder="Postal Code">
          </div>
          <div>
            <label for="country">Country</label>
            <input type="text" name="country" id="country" v-model.trim="masterClass.country" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" placeholder="Country">
          </div>
        </div>
        
        <button type="submit" class="px-4 mt-2 float-right py-2 font-semibold text-white bg-blue-500 rounded hover:bg-blue-700">
          Update
        </button>
        
    </form>
  </Modal>
  <section class="relative pt-16 pb-32 flex content-center items-center justify-center min-h-screen-75">
      <div class="absolute top-0 w-full h-full bg-center bg-cover"
          style="background-image: url('https://www.marmiteauxplumes.com/wp-content/uploads/2021/01/36519-738-cupcakes-5116009_640.jpg');">
          <span id="blackOverlay" class="w-full h-full absolute opacity-75 bg-black"></span>
      </div>
      <div class="container relative mx-auto">
          <div class="items-center flex flex-wrap">
            <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
                <div class="">
                    <h1 class="text-white mt-4 font-semibold text-5xl">
            
                        {{ masterClass.title }}
                    </h1>
                    <p class="mt-4 text-lg text-blueGray-200">
                        proposed by : <span class="font-bold">{{ masterClass.owner.lastName }}
                            {{ masterClass.owner.firstName }}</span>
                    </p>
                </div>
            </div>
          </div>
      </div>
      <!-- <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden h-70-px"
          style="transform: translateZ(0);">
          <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"
              version="1.1" viewBox="0 0 2560 100" x="0" y="0">
              <polygon class="text-blueGray-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
          </svg>
      </div> -->
  </section>
  <section>
    <div class="flex flex-wrap">  
    <div class="w-full px-4 flex-1">
        <div class="flex">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
            </svg>
            <span class="text-sm font-bold block my-4 p-3 text-blueGray-700 rounded">{{ masterClass.adress }} {{ masterClass.postalcode }} {{ masterClass.city }}, {{ masterClass.country }}</span>

        </div>
      
    </div>
    <div class="w-full px-4 flex-1">
        <div class="flex">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
            </svg>
            <span class="text-4XL text-center font-bold block my-4 p-3 text-blueGray-700 rounded">
                {{ formatDate(masterClass.date) }} at {{ masterClass.time }} 
            </span>
        </div>
        
    </div>
    <div class="w-full px-4 flex-1">
        <div class="flex">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-4XL text-center font-bold block my-4 p-3 text-blueGray-700 rounded">{{ masterClass.price }} €</span>
        </div>
      
    </div>
    <div class="w-full px-4 flex-1">
        <div class="flex">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>

            <span class="text-4XL text-center font-bold block my-4 p-3 text-blueGray-700 rounded">{{ masterClass.maxNumber }} seats available</span>
        </div>
      
    </div>
    <div v-if="store.getters.user && masterClass.owner.id == store.getters.user.id " class="w-full px-4 flex-1">
        <div v-if="masterClass.isCanceled">
            <span
                class="bg-orange-400 text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-purple-600 bg-purple-200 uppercase last:mr-0 mr-1">
                Cancelled
            </span>
        </div>
        <div v-else class="flex mt-8">
            <svg  @click="getMasterClassToUpdate" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
            </svg>
            <svg @click="getMasterClassToCancel" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
            </svg>
        </div>
      
    </div>
    <div v-else class="w-full px-4 flex-1" >
        <button v-if = "!masterClass.expired"
            class="bg-red-500 mt-2 text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded-full shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-15"
            type="button" @click="addToCart(masterClass)">
            <span class="flex flex-row">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    class="w-6 h-6 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
                participate
            </span>
        </button>
        <button v-else disabled
            class="bg-red-500 mt-2 text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded-full shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-15"
            type="button">
            
                expired
            
        </button>
    </div>
  </div>


  </section>

<section class="pb-16 bg-blueGray-200 relative pt-32">
    <div class=" top-0 bottom-auto left-0 right-0 w-full absolute h-20" style="transform: translateZ(0);">
        <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"
            version="1.1" viewBox="0 0 2560 100" x="0" y="0">
            <polygon class="text-blueGray-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
        </svg>
    </div>

    <div class="container mx-auto">
        <div class="flex flex-wrap justify-center bg-white shadow-xl rounded-lg -mt-20 py-16 px-12 relative z-10">
            <div class="w-full text-center lg:w-8/12">

                <p class="text-blueGray-500 text-lg leading-relaxed mt-4 mb-4">
                    {{ masterClass.description }}
                </p>
                <div class="text-center mt-16"></div>
                <h4 class="font-bold"> Reservations</h4>
                <table v-if="store.getters.user && masterClass.owner.id == store.getters.user.id "
                    class=" w-full table-auto mb-2">
                    <thead class="bg-white border-b">
                        <tr>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                User
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                User email
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                number of seats
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                price
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="reservation in masterClass.reservations" class="bg-gray-100 border-b">
                            <td class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                {{ reservation.userId.firstName }} {{ reservation.userId.lastName }}
                            </td>
                            <td class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                {{ reservation.userId.email}}
                            </td>
                            <td class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                {{ reservation.nbPlaces }}
                            </td>
                            <td class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                {{ reservation.price }} €
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>



</template>



