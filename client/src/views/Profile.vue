<script setup>
import { ref, inject, reactive } from 'vue';
import Modal from '../components/ModalForm.vue';
import FormField from '../components/FormField.vue';
import UserForm from '../components/UserForm.vue';
import axios from 'axios';
import { user as UserProvierKeys } from '@/components/providers/UserProviderKeys.js';

const token = inject(UserProvierKeys);
const updateProfile = () => {
    axios.put('https://localhost/user/profile', userData)
        .then((response) => {
            console.log(response);
        })
        .catch((error) => {
            console.log(error);
        });
}

const userData = reactive({
    firstName: '',
    lastName: '',
    email: '',
    city: '',
    address: '',
    postalcode: '',
    country: '',
})
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
    if (!userData.email) {
        errors.value.email = 'Required';
    } else if (
        !/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i.test(userData.email)
    ) {
        errors.value.email = 'Invalid email address';
    }
    if (!userData.lastName) {
        errors.value.lastName = 'Required';
    } else if (!userData.firstName) {
        errors.value.firstName = 'Required';
    }
    if (!userData.city) {
        errors.value.city = 'Required';
    }
    if (!userData.address) {
        errors.value.address = 'Required';
    }
    if (!userData.postalcode) {
        errors.value.postalcode = 'Required';
    }
    if (!userData.country) {
        errors.value.country = 'Required';
    }
}
const getUserData = async () => {
    console.log(token.value.token.token);
    await axios.get('https://localhost/user/profile', {
            headers: {
                authorization: 'Bearer ' + token.value.token.token

            }
    })
        .then((response) => {
            userData.firstName = response.data.firstName;
            userData.lastName = response.data.lastName;
            userData.email = response.data.email;
            userData.city = response.data.city;
            userData.address = response.data.address;
            userData.postalcode = response.data.postalcode;
            userData.country = response.data.country;
        })
        .catch((error) => {
            console.log(error);
        });
        console.log(userData   );
}
getUserData();

</script>
<template>
    <div
        style="background-image: url('https://images.unsplash.com/photo-1499336315816-097655dcfbda?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=2710&amp;q=80');">
        <div class=" py-16 bg-blueGray-200">
            <div class="container mx-auto px-4 inline-block">
                <div class=" flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg -mt-64">
                    <div class="px-6">
                        <div class="flex flex-wrap justify-center">
                            <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
                                <div class="relative">
                                    <img alt="..."
                                        src="https://demos.creative-tim.com/notus-js/assets/img/team-2-800x800.jpg"
                                        class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px">
                                </div>
                            </div>
                            <div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
                                <div class="py-6 px-3 mt-32 sm:mt-0">
                                    <UserForm @submit="updateProfile">

                                        <Modal class="w-10/12">
                                            <template #activator="{ toggleModal }">
                                                <button type="button" @click="toggleModal" class="bg-pink-500 active:bg-pink-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150"
>
                                                    Modify
                                                </button>
                                            </template>
                                            <template v-slot:title>
                                                <h1>Update profile</h1>
                                            </template>
                                            <template #default class="w-full">
                                                <div class="w-full">
                                                    <!-- <label for="firstName" class="block text-xs font-semibold text-gray-600 uppercase">FisrtName</label> -->
                                                    <FormField id="firstName" as="input" type="text" name="firstName"
                                                        placeholder="Prénom" v-model="userData.firstName"
                                                        class=" mb-3 w-full appearance-none border-2 border-gray-100 px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:shadow-lg" />
                                                    <div class=" text-red-500 text-xs italic">{{ errors.firstName }}
                                                    </div>
                                                    <!-- <label for="lastName" class="block text-xs font-semibold text-gray-600 uppercase">LastName</label> -->
                                                    <FormField id="lastName" as="input" type="text" name="lastName"
                                                        placeholder="Nom" v-model="userData.lastName"
                                                        class="mb-3 w-full appearance-none border-2 border-gray-100 px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:shadow-lg" />
                                                    <div class=" text-red-500 text-xs italic">{{ errors.lastName }}
                                                    </div>

                                                    <!-- <label for="email" class="block text-xs font-semibold text-gray-600 uppercase">E-mail</label> -->
                                                    <FormField id="email" as="input" type="email" name="email"
                                                        placeholder="Email" v-model="userData.email"
                                                        class="mb-3 w-full appearance-none border-2 border-gray-100 px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:shadow-lg" />
                                                    <div class=" text-red-500 text-xs italic">{{ errors.email }}</div>
                                                    <FormField id="city" as="input" type="text" name="city"
                                                        placeholder="City" v-model="userData.city"
                                                        class="mb-3 w-full appearance-none border-2 border-gray-100 px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:shadow-lg" />
                                                    <div class=" text-red-500 text-xs italic">{{ errors.city }}</div>
                                                    <FormField id="address" as="input" type="text" name="text"
                                                        placeholder="Address" v-model="userData.address"
                                                        class="mb-3 w-full appearance-none border-2 border-gray-100 px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:shadow-lg" />
                                                    <div class=" text-red-500 text-xs italic">{{ errors.address }}</div>
                                                    <FormField id="postalcode" as="input" type="number" name="email"
                                                        placeholder="postal code" v-model="userData.postalcode"
                                                        class="mb-3 w-full appearance-none border-2 border-gray-100 px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:shadow-lg" />
                                                    <div class=" text-red-500 text-xs italic">{{ errors.postalcode }}
                                                    </div>
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
                                            <template #footer>
                                                <button type="submit" class=" flex p-4 bg-black
                font-medium justify-center text-white uppercase 
                focus:outline-none hover:bg-orange-400 w-full hover:shadow-none">Update</button>
                                            </template>
                                        </Modal>
                                    </UserForm>
                                    
                                </div>
                            </div>
                            <div class="w-full lg:w-4/12 px-4 lg:order-1">
                                <div class="flex justify-center py-4 lg:pt-4 pt-8">
                                    <div class="mr-4 p-3 text-center">
                                        <span
                                            class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">22</span><span
                                            class="text-sm text-blueGray-400">Friends</span>
                                    </div>
                                    <div class="mr-4 p-3 text-center">
                                        <span
                                            class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">10</span><span
                                            class="text-sm text-blueGray-400">Photos</span>
                                    </div>
                                    <div class="lg:mr-4 p-3 text-center">
                                        <span
                                            class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">89</span><span
                                            class="text-sm text-blueGray-400">Comments</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-12">
                            <h3 class="text-4xl font-semibold leading-normal mb-2 text-blueGray-700 mb-2">
                                {{ userData.firstName }} {{ userData.lastName }}
                            </h3>
                            <div class="text-sm leading-normal mt-0 mb-2 text-blueGray-400 font-bold uppercase">
                                <i class="fas fa-map-marker-alt mr-2 text-lg text-blueGray-400"></i>
                                {{ userData.city }}, {{ userData.country }}
                                {{ userData.address }}, {{ userData.postalcode }}
                            </div>
                            <div class="mb-2 text-blueGray-600 mt-10">
                                <i class="fas fa-briefcase mr-2 text-lg text-blueGray-400"></i>
                                {{ userData.roles }}
                            </div>
                            <div class="mb-2 text-blueGray-600">
                                <i class="fas fa-university mr-2 text-lg text-blueGray-400"></i>University of Computer
                                Science
                            </div>
                        </div>
                        <div class="mt-10 py-10 border-t border-blueGray-200 text-center">
                            <div class="flex flex-wrap justify-center">
                                <div class="w-full lg:w-9/12 px-4">
                                    <p class="mb-4 text-lg leading-relaxed text-blueGray-700">
                                        An artist of considerable range, Jenna the name taken by
                                        Melbourne-raised, Brooklyn-based Nick Murphy writes,
                                        performs and records all of his own music, giving it a
                                        warm, intimate feel with a solid groove structure. An
                                        artist of considerable range.
                                    </p>
                                    <a href="#pablo" class="font-normal text-pink-500">Show more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</template>