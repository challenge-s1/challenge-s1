<script setup>
import { ref, inject, reactive } from 'vue';
import Modal from '../components/Modal.vue';
import FormField from '../components/FormField.vue';
import UserForm from '../components/UserForm.vue';

const updateProfile = () => {
    console.log('updateProfile');
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
    } else if( !userData.firstName) {
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
</script>
<template>
    <UserForm @submit="updateProfile">

        <Modal class="w-10/12">
            <template #activator="{ toggleModal }">
                <button type="button" @click="toggleModal">
                    Open Modal
                </button>
            </template>
            <template v-slot:title>
                <h1>Update profile</h1>
            </template>
            <template #default class="w-full">
                <div class="w-full">
                    <!-- <label for="firstName" class="block text-xs font-semibold text-gray-600 uppercase">FisrtName</label> -->
                    <FormField id="firstName" as="input" type="text" name="firstName" placeholder="Prénom"
                        v-model="userData.firstName"
                        class=" mb-3 w-full appearance-none border-2 border-gray-100 px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:shadow-lg" />
                    <div class=" text-red-500 text-xs italic">{{ errors.firstName }}</div>
                    <!-- <label for="lastName" class="block text-xs font-semibold text-gray-600 uppercase">LastName</label> -->
                    <FormField id="lastName" as="input" type="text" name="lastName" placeholder="Nom"
                        v-model="userData.lastName"
                        class="mb-3 w-full appearance-none border-2 border-gray-100 px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:shadow-lg" />
                    <div class=" text-red-500 text-xs italic">{{ errors.lastName }}</div>

                    <!-- <label for="email" class="block text-xs font-semibold text-gray-600 uppercase">E-mail</label> -->
                    <FormField id="email" as="input" type="email" name="email" placeholder="Email"
                        v-model="userData.email"
                        class="mb-3 w-full appearance-none border-2 border-gray-100 px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:shadow-lg" />
                    <div class=" text-red-500 text-xs italic">{{ errors.email }}</div>
                    <FormField id="city" as="input" type="text" name="city" placeholder="City" v-model="userData.city"
                        class="mb-3 w-full appearance-none border-2 border-gray-100 px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:shadow-lg" />
                    <div class=" text-red-500 text-xs italic">{{ errors.city }}</div>
                    <FormField id="address" as="input" type="text" name="text" placeholder="Address"
                        v-model="userData.address"
                        class="mb-3 w-full appearance-none border-2 border-gray-100 px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:shadow-lg" />
                    <div class=" text-red-500 text-xs italic">{{ errors.address }}</div>
                    <FormField id="postalcode" as="input" type="number" name="email" placeholder="postal code"
                        v-model="userData.postalcode"
                        class="mb-3 w-full appearance-none border-2 border-gray-100 px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:shadow-lg" />
                    <div class=" text-red-500 text-xs italic">{{ errors.postalcode }}</div>
                    <FormField id="country" as="input" type="text" name="country" placeholder="Country"
                        v-model="userData.country"
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


</template>