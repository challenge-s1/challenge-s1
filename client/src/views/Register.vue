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
    roles: '',
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
    roles: '',
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
    } else if (!UserData.firstName) {
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
    if (!UserData.roles) {
        errors.value.roles = 'Required';
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
    UserData.roles = UserData.roles.split(" ");
    console.log(UserData);
    console.log(UserData.roles);
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
    <section class="relative w-full h-full py-20 min-h-screen">
        <div class="container mx-auto px-4 h-full">
            <div class="flex content-center items-center justify-center h-full">
                <div class="w-full lg:w-6/12 px-4">
                    <div
                        class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-200 border-0">
                        <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                            <div class="text-blueGray-400 text-center mb-3 font-bold">
                                <h2 class="font-serif text-5xl">Register</h2>
                                <h2 class="font-serif text-2xl	">
                                    Made from your own hands or buy yumee cakes
                                </h2>
                            </div>
                            <h2 class="text-2xl font-bold text-orange-400 text-left mb-5">
                                Let's cake together
                            </h2>
                            <UserFormVue @submit="onSubmit">

                                <label for="firstName"
                                    class="block text-xs font-bold text-gray-600 uppercaseblock uppercase mb-2">FisrtName</label>
                                <FormField id="firstName" as="input" type="text" name="firstName"
                                    placeholder="FisrtName" v-model="UserData.firstName"
                                    class="border-0 px-3 py-3  text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 mb-3 appearance-none border-gray-100  placeholder-gray-300   focus:ring-black focus:shadow-lg" />
                                <div class=" text-red-500 text-xs italic">{{ errors.firstName }}</div>

                                <label for="lastName"
                                    class="block text-xs font-bold text-gray-600 uppercaseblock uppercase mb-2">LastName</label>
                                <FormField id="lastName" as="input" type="text" name="lastName" placeholder="LastName"
                                    v-model="UserData.lastName"
                                    class="border-0 px-3 py-3  text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 mb-3 appearance-none border-gray-100  placeholder-gray-300   focus:ring-black focus:shadow-lg" />
                                <div class=" text-red-500 text-xs italic">{{ errors.lastName }}</div>

                                <label for="email"
                                    class="block text-xs font-bold text-gray-600 uppercaseblock uppercase mb-2">E-mail</label>
                                <FormField id="email" as="input" type="email" name="email" placeholder="Email"
                                    v-model="UserData.email"
                                    class="border-0 px-3 py-3  text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 mb-3 appearance-none border-gray-100  placeholder-gray-300   focus:ring-black focus:shadow-lg" />
                                <div class=" text-red-500 text-xs italic">{{ errors.email }}</div>

                                <label
                                    class="block text-xs font-bold text-gray-600 uppercaseblock uppercase mb-2">City</label>
                                <FormField id="city" as="input" type="text" name="city" placeholder="City"
                                    v-model="UserData.city"
                                    class="border-0 px-3 py-3  text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 mb-3 appearance-none border-gray-100  placeholder-gray-300   focus:ring-black focus:shadow-lg" />
                                <div class=" text-red-500 text-xs italic">{{ errors.city }}</div>

                                <label
                                    class="block text-xs font-bold text-gray-600 uppercaseblock uppercase mb-2">Address</label>
                                <FormField id="address" as="input" type="text" name="text" placeholder="Address"
                                    v-model="UserData.address"
                                    class="border-0 px-3 py-3  text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 mb-3 appearance-none border-gray-100  placeholder-gray-300   focus:ring-black focus:shadow-lg" />
                                <div class=" text-red-500 text-xs italic">{{ errors.address }}</div>

                                <label
                                    class="block text-xs font-bold text-gray-600 uppercaseblock uppercase mb-2">Postal
                                    Code</label>
                                <FormField id="postalcode" as="input" type="number" name="postalcode"
                                    placeholder="Postal Code" v-model="UserData.postalcode"
                                    class="border-0 px-3 py-3  text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 mb-3 appearance-none border-gray-100  placeholder-gray-300   focus:ring-black focus:shadow-lg" />
                                <div class=" text-red-500 text-xs italic">{{ errors.postalcode }}</div>

                                <label
                                    class="block text-xs font-bold text-gray-600 uppercaseblock uppercase mb-2">Country
                                </label>
                                <FormField id="country" as="input" type="text" name="country" placeholder="Country"
                                    v-model="UserData.country"
                                    class="border-0 px-3 py-3  text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 mb-3 appearance-none border-gray-100  placeholder-gray-300   focus:ring-black focus:shadow-lg" />
                                <div class=" text-red-500 text-xs italic">{{ errors.country }}</div>


                                <label for="password"
                                    class="block text-xs font-bold text-gray-600 uppercaseblock uppercase mb-2">Password</label>
                                <FormField id="password" as="input" type="password" name="password"
                                    placeholder="Password" v-model="UserData.password"
                                    class=" border-0 px-3 py-3  text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 mb-3 appearance-none border-gray-100  placeholder-gray-300   focus:ring-black focus:shadow-lg" />
                                <div class=" text-red-500 text-xs italic">{{ errors.password }}</div>

                                <label for="plainPassword"
                                    class="block text-xs font-bold text-gray-600 uppercaseblock uppercase mb-2">Confirm
                                    password</label>
                                <FormField id="plainPassword" as="input" type="password" name="plainPassword"
                                    placeholder="Confirm password " v-model="UserData.plainPassword"
                                    class=" border-0 px-3 py-3  text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 mb-3 appearance-none border-gray-100  placeholder-gray-300   focus:ring-black focus:shadow-lg" />
                                <div class=" text-red-500 text-xs italic">{{ errors.plainPassword }}</div>
                                <label for=""
                                    class="block text-xs font-bold text-gray-600 uppercaseblock uppercase mb-2">You are
                                    : </label>
                                <div class=" flex items-center pl-4 border border-gray-200 rounded
                                    dark:border-gray-700">
                                    <input id="roles" type="radio" v-model="UserData.roles" value="ROLE_USER"
                                        name="roles"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="role"
                                        class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                        User
                                    </label>
                                    <input id="roles" type="radio" v-model="UserData.roles" value="ROLE_PATISSIER"
                                        name="roles"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="role"
                                        class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                        Pastry chef

                                    </label>
                                    <div class=" text-red-500 text-xs italic">{{ errors.roles }}</div>
                                </div>
                                <div class="flex flex-row justify-around text-center">
                                    <div class="text-red-500 text-sm">
                                        {{ errors.general }}
                                    </div>
                                </div>
                                <div class="flex flex-row justify-around text-center">
                                    <button
                                        class="flex p-5 mt-10 justify-center hover:bg-orange-400 w-full  bg-blueGray-800 text-white active:bg-blueGray-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                        type="submit">
                                        Create Account
                                    </button>
                                </div>
                            </UserFormVue>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <div class="container  ">
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
                     <label for="firstName" class="block text-xs font-semibold text-gray-600 uppercase">FisrtName</label>
                    <FormField id="firstName" as="input" type="text" name="firstName" placeholder="Prénom"
                        v-model="UserData.firstName"
                        class=" mb-3 w-full appearance-none border-2 border-gray-100 px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:shadow-lg" />
                    <div class=" text-red-500 text-xs italic">{{ errors.firstName }}</div>
                    <label for="lastName" class="block text-xs font-semibold text-gray-600 uppercase">LastName</label>
                    <FormField id="lastName" as="input" type="text" name="lastName" placeholder="Nom"
                        v-model="UserData.lastName"
                        class="mb-3 w-full appearance-none border-2 border-gray-100 px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:shadow-lg" />
                    <div class=" text-red-500 text-xs italic">{{ errors.lastName }}</div>

                     <label for="email" class="block text-xs font-semibold text-gray-600 uppercase">E-mail</label>
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
                     <label for="password"
                        class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Password</label>
                    <FormField id="password" as="input" type="password" name="password" placeholder="Mot de passe"
                        v-model="UserData.password"
                        class=" mb-3 w-full appearance-none border-2 border-gray-100 px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:shadow-lg" />
                    <div class=" text-red-500 text-xs italic">{{ errors.password }}</div>
                     <label for="plainPassword"
                        class="block mt-2 text-xs font-semibold text-gray-600 uppercase">plainPassword</label>
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
    </div> -->


</template>