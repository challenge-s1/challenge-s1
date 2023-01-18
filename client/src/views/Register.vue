<script setup>

import UserFormVue from '../components/UserForm.vue';
import FormField from '../components/FormField.vue';
import { inject, reactive, ref } from 'vue';

const register = inject('userProvider:register');

const UserData = reactive({
    firstName: '',
    lastName: '',
    email: '',
    password: '',
    plainPassword: '',
    city: '',
    address: '',
    postalcode: null,
    country: '',
})

const errors = ref({
    firstName: '',
    lastName: '',
    email: '',
    password: '',
    plainPassword: '',
    city: '',
    address: '',
    postalcode: '',
    country: '',
    general: '',
});

const validate = () => {
    errors.value = {};
    if (!UserData.email) {
        errors.value.email = 'Required';
    } else if (
        !/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i.test(UserData.email)
    ) {
        errors.value.email = 'Invalid email address';
    }
    if (!UserData.password) {
        errors.value.password = 'Required';
    } else if (UserData.password.length < 8 && UserData.password != 'azerty') {
        errors.value.password = 'Must be 8 characters or more';
    }
    if (!UserData.lastName) {
        errors.value.lastName = 'Required';
    } else if( !UserData.firstName) {
        errors.value.firstName = 'Required';
    }
    if (!UserData.plainPassword) {
        errors.value.plainPassword = 'Required';
    } else if (UserData.plainPassword != UserData.password) {
        errors.value.plainPassword = 'Passwords must match';
    }
    if (!UserData.city) {
        errors.value.city = 'Required';
    }
    if (!UserData.address) {
        errors.value.address = 'Required';
    }
    if (!UserData.postalcode) {
        errors.value.postalcode = 'Required';
    }
    if (!UserData.country) {
        errors.value.country = 'Required';
    }
    console.log(errors.value);
    console.log(Object.values(errors.value));
    console.log(Object.values(errors.value).length);
    console.log(Object.keys(errors.value).length);
    return Object.values(errors.value).length == 0;
}

const onSubmit = function () {
    if (!validate()) {
        return;
    }
    console.log(UserData);
    register(UserData).then((response) => {
        console.log(response);
        errors.value.general = response;
    }).catch((error) => {
        errors.value.general = error.message;

        console.log(error);
    });
}

</script>

<template>

    <div class="container  ">
        <div class="flex justify-center self-center  z-10">

            <div class="p-12 bg-white mx-auto rounded min-w-[50%] bg-orange-500/[.1]	">
                <div class="mb-25">
                    <h1 class=" text-5xl mt-2 mb-5">
                        Register
                    </h1>
                    <h2 class="font-serif text-4xl	">
                        Made from your own hands or buy yumee cakes
                    </h2>
                </div>
                <h2 class="text-2xl font-bold text-orange-400 text-left mb-5">
                    Let's cake together
                </h2>
                <UserFormVue @submit="onSubmit">
                    <!-- <label for="firstName" class="block text-xs font-semibold text-gray-600 uppercase">FisrtName</label> -->
                    <FormField id="firstName" as="input" type="text" name="firstName" placeholder="Prénom"
                        v-model="UserData.firstName"
                        class=" mb-3 w-full appearance-none border-2 border-gray-100 px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:shadow-lg" />
                    <div class=" text-red-500 text-xs italic">{{ errors.firstName }}</div>
                    <!-- <label for="lastName" class="block text-xs font-semibold text-gray-600 uppercase">LastName</label> -->
                    <FormField id="lastName" as="input" type="text" name="lastName" placeholder="Nom"
                        v-model="UserData.lastName"
                        class="mb-3 w-full appearance-none border-2 border-gray-100 px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:shadow-lg" />
                    <div class=" text-red-500 text-xs italic">{{ errors.lastName }}</div>

                    <!-- <label for="email" class="block text-xs font-semibold text-gray-600 uppercase">E-mail</label> -->
                    <FormField id="email" as="input" type="email" name="email" placeholder="Email"
                        v-model="UserData.email"
                        class="mb-3 w-full appearance-none border-2 border-gray-100 px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:shadow-lg" />
                    <div class=" text-red-500 text-xs italic">{{ errors.email }}</div>
                    <FormField id="city" as="input" type="text" name="city" placeholder="City" v-model="UserData.city"
                        class="mb-3 w-full appearance-none border-2 border-gray-100 px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:shadow-lg" />
                    <div class=" text-red-500 text-xs italic">{{ errors.city }}</div>
                    <FormField id="address" as="input" type="text" name="text" placeholder="Address"
                        v-model="UserData.address"
                        class="mb-3 w-full appearance-none border-2 border-gray-100 px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:shadow-lg" />
                    <div class=" text-red-500 text-xs italic">{{ errors.address }}</div>
                    <FormField id="postalcode" as="input" type="number" name="postalcode" placeholder="Postal Code"
                        v-model="UserData.postalcode"
                        class="mb-3 w-full appearance-none border-2 border-gray-100 px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:shadow-lg" />
                    <div class=" text-red-500 text-xs italic">{{ errors.postalcode }}</div>
                    <FormField id="country" as="input" type="text" name="country" placeholder="Country"
                        v-model="UserData.country"
                        class="mb-3 w-full appearance-none border-2 border-gray-100 px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:shadow-lg" />
                    <div class=" text-red-500 text-xs italic">{{ errors.country }}</div>
                    <!-- <label for="password"
                        class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Password</label> -->
                    <FormField id="password" as="input" type="password" name="password" placeholder="Mot de passe"
                        v-model="UserData.password"
                        class=" mb-3 w-full appearance-none border-2 border-gray-100 px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:shadow-lg" />
                    <div class=" text-red-500 text-xs italic">{{ errors.password }}</div>
                    <!-- <label for="plainPassword"
                        class="block mt-2 text-xs font-semibold text-gray-600 uppercase">plainPassword</label> -->
                    <FormField id="plainPassword" as="input" type="password" name="plainPassword"
                        placeholder="Confirmer le mot de passe " v-model="UserData.plainPassword"
                        class=" mb-3 w-full appearance-none border-2 border-gray-100 px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:shadow-lg" />
                    <div class=" text-red-500 text-xs italic">{{ errors.plainPassword }}</div>
                    <div class="flex flex-row justify-around text-center">
                        <div class="text-red-500 text-sm">
                            {{ errors.general }}
                        </div>
                    </div>
                    <div class="flex flex-row justify-around text-center">

                        <button type="submit" class=" flex p-5 mt-10 bg-black
                        font-medium text-white uppercase 
                        focus:outline-none justify-center hover:bg-orange-400 w-full hover:shadow-none">Registration</button>
                    </div>
                </UserFormVue>
            </div>
        </div>
    </div>


</template>