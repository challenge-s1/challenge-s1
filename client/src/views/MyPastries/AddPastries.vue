<script setup >
import { inject, provide, ref, reactive } from 'vue';
import { useRoute } from "vue-router";
import { useStore } from "vuex";
import axios from 'axios';
import { user as UserProvierKeys } from '@/components/providers/UserProviderKeys.js';

import UserForm from '../../components/UserForm.vue';
import FormField from '../../components/FormField.vue';
import router from '../../router';
import image1 from "@/assets/img/addimage1.png";
import image2 from "@/assets/img/addimage2.png";

const images = ref(null);
const store = useStore();
const route = useRoute();
const url = (import.meta.env.VITE_API_URL)
// const userToken = inject(UserProvierKeys);
const userToken = store.state.user;
const categories = ref([]);

const PastriesData = reactive({
    name: '',
    description: '',
    price: '',
    category: ''
});

const errors = ref({
    name: '',
    description: '',
    price: '',
    category: '',
    image: '',
    general: ''
})

const validate = () => {
    errors.value = {};
    if (PastriesData.name == '') {
        errors.value.name = 'Name is required';
    }
    if (PastriesData.description == '') {
        errors.value.description = 'Description is required';
    }
    if (PastriesData.price == '') {
        errors.value.price = 'Price is required';
    }
    if (PastriesData.category == '') {
        errors.value.category = 'Category is required';
    }
    if (images.value == null) {
        errors.value.image = 'Image is required';
    }
    return Object.values(errors.value).length == 0;
}

const GetCategories = async () => {
    await axios.get(`${url}/categories`, {
        headers: {
            authorization: 'Bearer ' + userToken.token
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

function uploadFile(e) {
    images.value = e.target.files || e.dataTransfer.files;
}

const addPastrie = async () => {
    if (!validate()) {
        return;
    }
    const pasttrie = {
        "name": PastriesData.name,
        "description": PastriesData.description,
        "price": PastriesData.price,
        "category": `/categories/${PastriesData.category}`
    }
    await axios.post(`${url}/pastries`, pasttrie, {
        headers: {
            Authorization: 'Bearer ' + userToken.token
        }
    }).then((response) => {
        addImage(response.data.id);
    }).catch((error) => {
        errors.value.general = error.message;
        console.log(error);
    });

};

const addImage = async (id) => {
    const pictures = new FormData();
    pictures.append('imageFile', images.value[0]);
    console.log(pictures);
    await axios.post(`${url}/users/images/${id}/passtries`, pictures, {
        headers: {
            'Content-Type': 'multipart/form-data',
            Authorization: 'Bearer ' + userToken.token
        }
    }).then((response) => {
        router.push({ name: "MyPastries" })
    }).catch((error) => {
        errors.value.general = error.message;
        console.log(error);
    });
}

</script>
<template>
    <div>
        <main>
            <section class="relative w-full h-full  pb-20 min-h-screen">
                <div class="flex flex-wrap items-center">
                    <div class="w-full md:w-5/12 px-12 md:px-4 ml-auto mr-auto mt-48">
                        <div class="flex content-center items-center justify-center h-full">
                            <div
                                class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-200 border-0">
                                <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                                    <div class="text-orange-400 text-center mb-3 font-bold">
                                        <h1 class="text-2xl">Add your cake or pastrys</h1>
                                    </div>
                                    <form @submit.prevent="addPastrie()">
                                        <div>
                                            <div class="relative w-full mb-3">
                                                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                                    Name
                                                </label>
                                                <input type="text" name="name"
                                                    class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-15"
                                                    placeholder="name" v-model="PastriesData.name" />
                                                <div class=" text-red-500 text-xs italic">{{ errors.name }}</div>
                                            </div>
                                            <div class="relative w-full mb-3">
                                                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                                    htmlFor="grid-password">
                                                    Description
                                                </label>
                                                <textarea type="text" name="description"
                                                    class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-15"
                                                    placeholder="description"
                                                    v-model="PastriesData.description"> </textarea>
                                                <div class=" text-red-500 text-xs italic">{{ errors.description }}</div>
                                            </div>
                                            <div class="relative w-full mb-3">
                                                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                                    Price
                                                </label>
                                                <input type="number" step="0.01" name="price"
                                                    class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-15"
                                                    placeholder="price" v-model="PastriesData.price" />
                                                <div class=" text-red-500 text-xs italic">{{ errors.price }}</div>
                                            </div>
                                            <div class="relative w-full mb-3">
                                                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                                    categorie
                                                </label>
                                                <select name="category" id=""
                                                    class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-15"
                                                    v-model="PastriesData.category">
                                                    <option :value="categorie.id" v-for="categorie in categories "
                                                        :key="categorie.id">
                                                        {{ categorie.name }}
                                                    </option>
                                                </select>
                                                <div class=" text-red-500 text-xs italic">{{ errors.category }}</div>
                                            </div>
                                            <div class="relative w-full mb-3">
                                                <label for="file"
                                                    class="block uppercase text-blueGray-600 text-xs font-bold mb-2">Select
                                                    a picture:</label>
                                                <input type="file"
                                                    class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-15"
                                                    ref="imageFile" @change="uploadFile" />
                                                <div class=" text-red-500 text-xs italic">{{ errors.image }}</div>
                                            </div>
                                            <div class="p-3 mt-2 text-center space-x-4 md:block">
                                                <button type="submit"
                                                    class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-md hover:shadow-lg hover:bg-orange-300">Save
                                                </button>
                                            </div>
                                            <div class=" text-red-500 text-xs italic">{{ errors.general }}</div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full md:w-5/12 px-4 mr-auto ml-auto mt-32">
                        <div class="relative flex flex-col min-w-0 w-full mb-6 mt-48 md:mt-0">
                            <img alt="..." :src="image2"
                                class="w-full align-middle rounded-lg absolute shadow-lg max-w-210-px left-260-px -top-160-px" />
                            <img alt="..." :src="image1"
                                class="w-full align-middle rounded absolute shadow-xl max-w-120-px left-195-px top-95-px" />
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</template>