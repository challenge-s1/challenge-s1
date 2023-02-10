<script setup>

import UserFormVue from '../../components/UserForm.vue';
import FormField from '../../components/FormField.vue';
import { reactive, ref } from 'vue';
import axios from 'axios';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';
import moment from 'moment';
const url = (import.meta.env.VITE_API_URL)
const store = useStore();
const user = store.getters.user;
const router = useRouter();

const UserData = reactive({
    title: '',
    description: '',
    price: '',
    maxNumber: '',
    date: '',
    time: '',
    adress: '',
    city: '',
    postalCode: '',
    country: '',
})

const errors = ref({
    title: '',
    description: '',
    price: '',
    maxNumber: '',
    date: '',
    time: '',
    adress: '',
    city: '',
    postalCode: '',
    country: '',
    general: '',
});

const validate = () => {
    const day = moment(new Date()).format('DD-MM-YYYY');
    errors.value.title = UserData.title ? '' : 'Required';
    errors.value.description = UserData.description ? '' : 'Required';
    errors.value.price = UserData.price ? '' : 'Required';
    errors.value.maxNumber = UserData.maxNumber ? '' : 'Required';
    errors.value.date = UserData.date  ? '' : 'Required';
    errors.value.time = UserData.time ? '' : 'Required';
    errors.value.adress = UserData.adress ? '' : 'Required';
    errors.value.city = UserData.city ? '' : 'Required';
    errors.value.postalCode = UserData.postalCode ? '' : 'Required';
    errors.value.country = UserData.country ? '' : 'Required';
    if (UserData.date && moment(UserData.date).format('DD-MM-YYYY') < day) {
        errors.value.date = 'Date must be greater than today';
    }
    if (UserData.price && UserData.price <= 0) {
        errors.value.price = 'Price must be greater than 0';
    }
    if (UserData.maxNumber && UserData.maxNumber <= 0) {
        errors.value.maxNumber = 'Max number must be greater than 0';
    }
    if (UserData.postalCode && UserData.postalCode <= 0) {
        errors.value.postalCode = 'Postal code must be greater than 0';
    }
    if(errors.value.title || errors.value.description || errors.value.price || errors.value.maxNumber || errors.value.date || errors.value.time || errors.value.adress || errors.value.city || errors.value.postalCode || errors.value.country){
        return false;
    }
    return true;
}

const onSubmit = async function () {

    if (!validate()) {
        return;
    }
    UserData.date  = moment(UserData.date).format('DD-MM-YYYY');
    await axios.post(`${url}/master_classes`, {
            "title": UserData.title,
            "description": UserData.description,
            "price": UserData.price,
            "maxNumber": UserData.maxNumber,
            "date": UserData.date,
            "time": UserData.time,
            "adress": UserData.adress,
            "city": UserData.city,
            "postalcode": UserData.postalCode,
            "country": UserData.country
        },{
        headers:{
            Authorization: 'Bearer ' + user.token
        }
    })
        .then((response) => {
            console.log(response);
            router.push({ name: 'PastryChefMasterClass' });
        })
        .catch((error) => {
            console.log(error);
        });
   

}

</script>

<template>
    <section class="relative w-full h-full py-40 min-h-screen">
        <div class="container mx-auto px-4 h-full">
            <div class="flex content-center items-center justify-center h-full">
                <div class="w-full lg:w-6/12 px-4">
                    <div
                        class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-200 border-0">
                        <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                            <div class="text-blueGray-400 text-center mb-3 font-bold">
                                <h2 class="font-serif text-2xl	">
                                    Add a MasterClass
                                </h2>
                            </div>
                            <h2 class="text-2xl font-bold text-orange-400 text-left mb-5">
                                Let's cake together
                            </h2>
                            <UserFormVue @submit="onSubmit">
                                <label for="title"
                                    class="block text-xs font-bold text-gray-600 uppercaseblock uppercase mb-2">title</label>
                                <FormField id="title" as="input" type="text" name="title"
                                    placeholder="title" v-model.trim="UserData.title"
                                    class="border-0 px-3 py-3  text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 mb-3 appearance-none border-gray-100  placeholder-gray-300   focus:ring-black focus:shadow-lg" />
                                <div class=" text-red-500 text-xs italic">{{ errors.title }}</div>

                                <label for="description"
                                    class="block text-xs font-bold text-gray-600 uppercaseblock uppercase mb-2">description</label>
                                <FormField id="description" as="textarea" name="description" placeholder="description"
                                    v-model.trim="UserData.description"
                                    class="border-0 px-3 py-3  text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 mb-3 appearance-none border-gray-100  placeholder-gray-300   focus:ring-black focus:shadow-lg" />
                                <div class=" text-red-500 text-xs italic">{{ errors.description }}</div>

                                <label for="price"
                                    class="block text-xs font-bold text-gray-600 uppercaseblock uppercase mb-2">price</label>
                                <FormField id="price" as="input" type="number" name="price" placeholder="price"
                                    v-model.number="UserData.price"
                                    class="border-0 px-3 py-3  text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 mb-3 appearance-none border-gray-100  placeholder-gray-300   focus:ring-black focus:shadow-lg" />
                                <div class=" text-red-500 text-xs italic">{{ errors.price }}</div>
                                <label for="maxNumber"
                                    class="block text-xs font-bold text-gray-600 uppercaseblock uppercase mb-2">places</label>
                                <FormField id="maxNumber" as="input" type="number" name="maxNumber" placeholder="maxNumber"
                                    v-model.number="UserData.maxNumber"
                                    class="border-0 px-3 py-3  text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 mb-3 appearance-none border-gray-100  placeholder-gray-300   focus:ring-black focus:shadow-lg" />
                                <div class=" text-red-500 text-xs italic">{{ errors.maxNumber }}</div>

                                <label for="date" class="block text-xs font-bold text-gray-600 uppercaseblock uppercase mb-2">Date</label>
                                <FormField id="date" as="input" type="date" name="date" placeholder="dd/mm/yyyy" v-model="UserData.date"
                                    class="border-0 px-3 py-3  text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 mb-3 appearance-none border-gray-100  placeholder-gray-300   focus:ring-black focus:shadow-lg" />
                                <div class=" text-red-500 text-xs italic">{{ errors.date }}</div>
                                <label for="time"
                                    class="block text-xs font-bold text-gray-600 uppercaseblock uppercase mb-2">Time</label>
                                <FormField id="time" as="input" type="time" name="time" placeholder="hh:mm"
                                    v-model="UserData.time"
                                    class="border-0 px-3 py-3  text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 mb-3 appearance-none border-gray-100  placeholder-gray-300   focus:ring-black focus:shadow-lg" />
                                <div class=" text-red-500 text-xs italic">{{ errors.time }}</div>
                                <label for ="address"
                                    class="block text-xs font-bold text-gray-600 uppercaseblock uppercase mb-2">Address</label>
                                <FormField id="address" as="input" type="text" name="address" placeholder="Address"
                                    v-model.trim="UserData.adress"
                                    class="border-0 px-3 py-3  text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 mb-3 appearance-none border-gray-100  placeholder-gray-300   focus:ring-black focus:shadow-lg" />
                                <div class=" text-red-500 text-xs italic">{{ errors.adress }}</div>
                                <label for="city"
                                    class="block text-xs font-bold text-gray-600 uppercaseblock uppercase mb-2">City</label>
                                <FormField id="city" as="input" type="text" name="city" placeholder="City"
                                    v-model.trim="UserData.city"
                                    class="border-0 px-3 py-3  text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 mb-3 appearance-none border-gray-100  placeholder-gray-300   focus:ring-black focus:shadow-lg" />
                                <div class=" text-red-500 text-xs italic">{{ errors.city }}</div>
                                <label for="postalcode"
                                    class="block text-xs font-bold text-gray-600 uppercaseblock uppercase mb-2">Postal
                                    Code</label>
                                <FormField id="postalcode" as="input" type="number" name="postalcode"
                                    placeholder="Postal Code" v-model.number="UserData.postalCode"
                                    class="border-0 px-3 py-3  text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 mb-3 appearance-none border-gray-100  placeholder-gray-300   focus:ring-black focus:shadow-lg" />
                                <div class=" text-red-500 text-xs italic">{{ errors.postalcode }}</div>

                                <label for="country"
                                    class="block text-xs font-bold text-gray-600 uppercaseblock uppercase mb-2">Country
                                </label>
                                <FormField id="country" as="input" type="text" name="country" placeholder="Country"
                                    v-model.trim="UserData.country"
                                    class="border-0 px-3 py-3  text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 mb-3 appearance-none border-gray-100  placeholder-gray-300   focus:ring-black focus:shadow-lg" />
                                <div class=" text-red-500 text-xs italic">{{ errors.country }}</div>

                                <div class="flex flex-row justify-around text-center">
                                    <div class="text-red-500 text-sm">
                                        {{ errors.general }}
                                    </div>
                                </div>
                                <div class="flex flex-row justify-around text-center">
                                    <button
                                        class="flex p-5 mt-10 justify-center hover:bg-orange-400 w-full  bg-blueGray-800 text-white active:bg-blueGray-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                        type="submit">
                                        Add Master class
                                    </button>
                                </div>
                            </UserFormVue>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>