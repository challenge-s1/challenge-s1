<script setup>
import { ref, reactive } from "vue";
import { useRouter } from "vue-router";
import { useStore } from "vuex";
import axios from "axios";
import { formatDate, formatTime } from "@/composable/dates.js";
import Modal from "../../components/Modal.vue";
import moment from "moment";

const url = (import.meta.env.VITE_API_URL)
const store = useStore();
const router = useRouter();
const masterClasses = ref([]);
const user = store.getters.user;
const open = ref(false);
const openModalUpdate = ref(false);
const masterClasstoCancel = ref({});
const masterClasstoUpdate = reactive({
  id: '',
  title: '',
  description: '',
  maxNumber: '',
  date: '',
  time: '',
  adress: '',
  city: '',
  postalCode: '',
  country: '',
});


const handleOpen = () => {
  open.value = !open.value;
};

const handleOpenModalUpdate = () => {
  openModalUpdate.value = !openModalUpdate.value;
};

const getMasterClasses = async () => {
  await axios.get(`${url}/users/${user.id}/master_classes`, {
    headers: {
      Authorization: `Bearer ${user.token}`,
      Accept: 'application/json'
    }
  }).then((response) => {
    masterClasses.value = response.data;
    let options = { timeZone: 'UTC', hour: '2-digit', minute: '2-digit' };
    masterClasses.value.forEach(element => {
      let timeStr = new Date(element.time);
      let time = new Intl.DateTimeFormat('default', options).format(timeStr);
      element.time = time;
    });
  }).catch((error) => {
    console.log(error);
  })

}

const getMasterClassToCancel = (masterClass) => {
  masterClasstoCancel.value = masterClass;
  handleOpen();
}

const getMasterClassToUpdate = function (masterClass) {
  masterClasstoUpdate.id = masterClass.id;
  masterClasstoUpdate.title = masterClass.title;
  masterClasstoUpdate.description = masterClass.description;
  masterClasstoUpdate.maxNumber = masterClass.maxNumber;
  masterClasstoUpdate.date = masterClass.date;
  masterClasstoUpdate.time = masterClass.time;
  masterClasstoUpdate.adress = masterClass.adress;
  masterClasstoUpdate.city = masterClass.city;
  masterClasstoUpdate.postalCode = masterClass.postalcode;
  masterClasstoUpdate.country = masterClass.country;
  handleOpenModalUpdate();
}

const updateMasterClass = async () => {
  handleOpenModalUpdate();
  masterClasstoUpdate.date = moment(masterClasstoUpdate.date).format('YYYY-MM-DD');
  await axios.put(`${url}/master_classes/${masterClasstoUpdate.id}`, {
    "title": masterClasstoUpdate.title,
    "description": masterClasstoUpdate.description,
    "maxNumber": masterClasstoUpdate.maxNumber,
    "date": masterClasstoUpdate.date,
    "time": masterClasstoUpdate.time,
    "adress": masterClasstoUpdate.adress,
    "city": masterClasstoUpdate.city,
    "postalcode": masterClasstoUpdate.postalCode,
    "country": masterClasstoUpdate.country,
  }, {
    headers: {
      Authorization: `Bearer ${user.token}`,
      Accept: 'application/json'
    }
  }).then((response) => {
    console.log(response);
    getMasterClasses();
  }).catch((error) => {
    console.log(error);
  })
}

const cancelMasterClass = async () => {
  handleOpen();
  await axios.delete(`https://localhost/master-classes/${masterClasstoCancel.value.id}/cancel`, {
    headers: {
      Authorization: `Bearer ${user.token}`
    }
  }).then((response) => {
    console.log(response);
    getMasterClasses();
  }).catch((error) => {
    console.log(error);
  })

  router.push({ name: "PastryChefMasterClassesList" })
}

const addMasterClass = () => {
  if (!store.getters.isLoggedIn) {
    router.push({ name: "Login" })
  }
  router.push({ name: "AddMasterClass" })
}

getMasterClasses();

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
        <input type="text" name="title" id="title" v-model.trim="masterClasstoUpdate.title"
          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" placeholder="Title">

      </div>
      <div>
        <label for="description">Description</label>
        <textarea name="description" id="description" v-model.trim="masterClasstoUpdate.description"
          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
          placeholder="Description" />
      </div>

      <div class="flex justify-between">
        <div>
          <label for="time">Time</label>
          <input type="time" name="time" id="time" v-model="masterClasstoUpdate.time"
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
        </div>
        <div>
          <label for="date">Date</label>
          <input type="date" name="date" id="date" v-model="masterClasstoUpdate.date"
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
        </div>

      </div>
      <div class="flex justify-between">
        <div>
          <label for="adress">Adress</label>
          <input type="text" name="adress" id="adress" v-model.trim="masterClasstoUpdate.adress"
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" placeholder="Adress">
        </div>
        <div>
          <label for="city">City</label>
          <input type="text" name="city" id="city" v-model.trim="masterClasstoUpdate.city"
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" placeholder="City">
        </div>
      </div>
      <div class="flex justify-between">
        <div class="mr-2">
          <label for="postalCode">Postal Code</label>
          <input type="text" name="postalCode" id="postalCode" v-model.number="masterClasstoUpdate.postalCode"
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
            placeholder="Postal Code">
        </div>
        <div>
          <label for="country">Country</label>
          <input type="text" name="country" id="country" v-model.trim="masterClasstoUpdate.country"
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" placeholder="Country">
        </div>
      </div>

      <button type="submit"
        class="px-4 mt-2 float-right py-2 font-semibold text-white bg-blue-500 rounded hover:bg-blue-700">
        Update
      </button>

    </form>
  </Modal>
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
                <button
                  class="bg-red-500 mt-2 text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded-full shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-15"
                  @click="addMasterClass">Add Master Class</button>
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

            <div v-for="masterClass in masterClasses" class="w-full md:w-4/12 px-4 mr-auto ml-auto  pt-6  text-center">
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
                    <router-link :to="{ name: 'MasterClassDetails', params: { id: masterClass.id } }">
                      <span
                        class="bg-orange-400 text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-purple-600 bg-purple-200 uppercase last:mr-0 mr-1">
                        {{ masterClass.title }}
                      </span>

                    </router-link>
                  </div>

                  <h4 class="text-xl  text-white">
                    <router-link :to="{ name: 'MasterClassDetails', params: { id: masterClass.id } }">
                      <span class="font-bold">
                        {{ masterClass.title }}
                      </span>

                    </router-link>
                  </h4>
                  <p class="text-md font-light mt-2 text-white">
                    Discription :{{ masterClass.description }}
                  </p>
                  <p class="text-md font-light mt-2 text-white">
                    Location :{{ masterClass.adress }} {{ masterClass.city }} {{ masterClass.postalcode }}, {{
                      masterClass.country
                    }}
                  </p>
                  <p class="text-md font-light mt-2 text-white">
                    Date : <span class="font-bold">{{ formatDate(masterClass.date) }} </span>
                  </p>
                  <p class="text-md font-light mt-2 text-white">
                    Time : <span class="font-bold">{{ masterClass.time }} </span></p>
                  <p class="text-md font-light mt-2 text-white">
                    Price : <span class="font-bold">{{ masterClass.price }} € </span>
                  </p>
                  <p class="text-md font-light mt-2 text-white">
                    Places : <span class="font-bold">{{ masterClass.maxNumber }} </span>
                  </p>
                  <div v-if="!masterClass.isCanceled">
                    <button @click="getMasterClassToCancel(masterClass)"
                      class="bg-red-500 mt-2 text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded-full shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-15"
                      type="button">
                      <span class="flex flex-row">
                        <font-awesome-icon icon="fa-solid fa-calendar-xmark" />
                        Cancel
                      </span>
                    </button>
                    <button @click="getMasterClassToUpdate(masterClass)"
                      class="bg-gray-700 mt-2 text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded-full shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-15"
                      type="button">
                      <span class="flex flex-row">
                        <font-awesome-icon icon="fa-solid fa-calendar-xmark" />
                        Edit
                      </span>
                    </button>
                  </div>

                  <button v-else disabled
                    class="bg-orange-400 mt-2 text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded-full shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-15"
                    type="button">
                    <span class="flex flex-row">
                      <font-awesome-icon icon="fa-solid fa-calendar-xmark" />
                      Canceled
                    </span>
                  </button>
                </blockquote>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
</template>

