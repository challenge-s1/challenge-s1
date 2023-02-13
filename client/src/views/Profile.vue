<script setup>
import { ref, inject, reactive } from 'vue';
import Modal from '../components/ModalForm.vue';
import FormField from '../components/FormField.vue';
import UserForm from '../components/UserForm.vue';
import axios from 'axios';
import { useStore } from "vuex";
import { user as UserProvierKeys } from '@/components/providers/UserProviderKeys.js';
const url = (import.meta.env.VITE_API_URL)
// const userToken = inject(UserProvierKeys);
const store = useStore();
const userToken = store.getters.user;

const updateProfile = async (handleClose) => {
    console.log("updateProfile");
    if (!validate()) {
        return;
    }
    userData.value.postalcode = parseInt(userData.value.postalcode);
    await axios.patch(`${url}/users/${userToken.id}`, userData.value,
        {
            headers: {
                'content-type': 'application/merge-patch+json',
                authorization: 'Bearer ' + userToken.token
            }
        })
        .then((response) => {
            user.firstName = response.data.firstName;
            user.lastName = response.data.lastName;
            user.city = response.data.city;
            user.address = response.data.address;
            user.postalcode = response.data.postalcode;
            user.country = response.data.country;
            userData.value.firstName = response.data.firstName;
            userData.value.lastName = response.data.lastName;
            userData.value.city = response.data.city;
            userData.value.address = response.data.address;
            userData.value.postalcode = response.data.postalcode;
            userData.value.country = response.data.country;
            console.log(response);
            handleClose();
        })
        .catch((error) => {
            errors.value.general = error.response.data.message;
            console.log(error);
        });
}

const user = reactive({
    firstName: '',
    lastName: '',
    email: '',
    city: '',
    address: '',
    postalcode: '',
    country: '',
})

const userData = ref({});
const errors = ref({
    firstName: '',
    lastName: '',
    email: '',
    city: '',
    address: '',
    postalcode: '',
    country: '',
    general: '',
});

const validate = () => {
    errors.value = {};
    if (!userData.value.lastName) {
        errors.value.lastName = 'Required';
    } else if (!userData.value.firstName) {
        errors.value.firstName = 'Required';
    }
    if (!userData.value.city) {
        errors.value.city = 'Required';
    }
    if (!userData.value.address) {
        errors.value.address = 'Required';
    }
    if (!userData.value.postalcode) {
        errors.value.postalcode = 'Required';
    }
    if (!userData.value.country) {
        errors.value.country = 'Required';
    }
    return Object.values(errors.value).length == 0;
}
const getUserData = async () => {
    await axios.get(`${url}/users/${userToken.id}`, {
        headers: {
            authorization: 'Bearer ' + userToken.token

        }
    })
        .then((response) => {
            console.log(response.data);
            user.firstName = response.data.firstName;
            user.lastName = response.data.lastName;
            user.email = response.data.email;
            user.city = response.data.city;
            user.address = response.data.address;
            user.postalcode = response.data.postalcode;
            user.country = response.data.country;
            user.roles = response.data.roles;
            userData.value.firstName = response.data.firstName;
            userData.value.lastName = response.data.lastName;
            userData.value.city = response.data.city;
            userData.value.address = response.data.address;
            userData.value.postalcode = response.data.postalcode;
            userData.value.country = response.data.country;
            console.log("userData", userData.value);
        })
        .catch((error) => {
            console.log(error);
        });
    console.log(user);
}
getUserData();

</script>
<template>
    <div
        style="background-image: url('https://images.unsplash.com/photo-1499336315816-097655dcfbda?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=2710&amp;q=80');">
        <div class=" py-16 bg-blueGray-200">
            <div class="container mx-auto px-4 inline-block flex">
                <div class=" flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg ">
                    <div class="px-6">
                        <div class="flex flex-wrap justify-center">
                            <div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
                                <div class="py-6 px-3 mt-32 sm:mt-0">
                                    <UserForm>

                                        <Modal class="w-10/12">
                                            <template #activator="{ toggleModal }">
                                                <button type="button" @click="toggleModal"
                                                    class="bg-pink-500 active:bg-pink-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150">
                                                    Modify
                                                </button>
                                            </template>
                                            <template v-slot:title>
                                                <h1>Update profile</h1>
                                            </template>
                                            <template #default class="w-full">
                                                <div class="w-full">
                                                    <label for="firstName"
                                                        class="block text-xs font-semibold text-gray-600 uppercase text-left">FisrtName</label>
                                                    <FormField id="firstName" as="input" type="text" name="firstName"
                                                        placeholder="Prénom" v-model="userData.firstName"
                                                        class=" mb-3 w-full appearance-none border-2 border-gray-100 px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:shadow-lg" />
                                                    <div class=" text-red-500 text-xs italic">{{ errors.firstName }}
                                                    </div>
                                                    <label for="lastName"
                                                        class="block text-xs font-semibold text-gray-600 uppercase text-left">LastName</label>
                                                    <FormField id="lastName" as="input" type="text" name="lastName"
                                                        placeholder="Nom" v-model="userData.lastName"
                                                        class="mb-3 w-full appearance-none border-2 border-gray-100 px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:shadow-lg" />
                                                    <div class=" text-red-500 text-xs italic">{{ errors.lastName }}
                                                    </div>

                                                    <label for="email"
                                                        class="block text-xs font-semibold text-gray-600 uppercase text-left">City</label>

                                                    <FormField id="city" as="input" type="text" name="city"
                                                        placeholder="City" v-model="userData.city"
                                                        class="mb-3 w-full appearance-none border-2 border-gray-100 px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:shadow-lg" />
                                                    <div class=" text-red-500 text-xs italic">{{ errors.city }}</div>

                                                    <label for="adress"
                                                        class="block text-xs font-semibold text-gray-600 uppercase text-left">Adress</label>

                                                    <FormField id="address" as="input" type="text" name="text"
                                                        placeholder="Address" v-model="userData.address"
                                                        class="mb-3 w-full appearance-none border-2 border-gray-100 px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:shadow-lg" />
                                                    <div class=" text-red-500 text-xs italic">{{ errors.address }}</div>
                                                    <label for="postalcode"
                                                        class="block text-xs font-semibold text-gray-600 uppercase text-left">Postal
                                                        Code</label>
                                                    <FormField id="postalcode" as="input" type="number"
                                                        name="postalcode" placeholder="postal code"
                                                        v-model="userData.postalcode"
                                                        class="mb-3 w-full appearance-none border-2 border-gray-100 px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:shadow-lg" />
                                                    <div class=" text-red-500 text-xs italic">{{ errors.postalcode }}
                                                    </div>
                                                    <label for="country"
                                                        class="block text-xs font-semibold text-gray-600 uppercase text-left">Country</label>
                                                    <FormField id="country" as="input" type="text" name="country"
                                                        placeholder="Country" v-model="userData.country"
                                                        class="mb-3 w-full appearance-none border-2 border-gray-100 px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:shadow-lg" />
                                                    <div class=" text-red-500 text-xs italic">{{ errors.country }}</div>
                                                    <div class="flex flex-row justify-around text-center">
                                                        <div class="text-red-500 text-sm">
                                                            {{ errors.general }}
                                                        </div>

                                                    </div>
                                                </div>
                                            </template>
                                            <template #footer="{ handleClose }">
                                                <button type="submit" class=" flex p-4 bg-black
                font-medium justify-center text-white uppercase 
                focus:outline-none hover:bg-orange-400 w-full hover:shadow-none"
                                                    @click="updateProfile(handleClose)">Update</button>
                                            </template>
                                        </Modal>
                                    </UserForm>

                                </div>
                            </div>
                            <div class="w-full lg:w-4/12 px-4 lg:order-1">
                                <div class="flex justify-center py-4 lg:pt-4 pt-8">
                                    <div class="mr-4 p-3 text-center"
                                        v-if="user.roles && user.roles[0] == 'ROLE_PATISSIER'">
                                        <span
                                            class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">TODO</span><span
                                            class="text-sm text-blueGray-400">Subscriber</span>
                                    </div>
                                    <div class="lg:mr-4 p-3 text-center">
                                        <span
                                            class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">TODO</span><span
                                            class="text-sm text-blueGray-400">Comments</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-12">
                            <h3 class="text-4xl font-semibold leading-normal mb-2 text-blueGray-700 mb-2">
                                {{ user.firstName }} {{ user.lastName }}
                            </h3>
                            <div class="text-sm leading-normal mt-0 mb-2 text-blueGray-400 font-bold uppercase">
                                <i class="fas fa-map-marker-alt mr-2 text-lg text-blueGray-400"></i>
                                {{ user.city }}, {{ user.country }}
                                {{ user.address }}, {{ user.postalcode }}
                            </div>
                            <div class="mb-2 text-blueGray-600 mt-10" v-show="user.roles">
                                <i class="fas fa-briefcase mr-2 text-lg text-blueGray-400"></i>
                                {{ user.roles[0] }}
                            </div>
                        </div>
                        <div class="mt-10 py-10 border-t border-blueGray-200 text-center">
                            <div class="flex flex-wrap justify-center">
                                <div class="w-full lg:w-9/12 px-4">
                                    <p class="mb-4 text-lg leading-relaxed text-blueGray-700">
                                        Well you like to eat because you like to bake or you like to bake because you
                                        like to eat?
                                        Either way, you're in the right place.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</template>