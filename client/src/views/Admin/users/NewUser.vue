<script setup>
import AdminNavbar from "@/components/Navbars/AdminNavbar.vue";
import Sidebar from "@/components/Sidebar/Sidebar.vue";
import HeaderStats from "@/components/Headers/HeaderStats.vue";
import FooterAdmin from "@/components/Footers/FooterAdmin.vue";
import UserFormVue from '@/components/UserForm.vue';
import FormField from '@/components/FormField.vue';
import { inject, reactive, ref } from 'vue';
import { useRouter } from "vue-router";
import { useStore } from 'vuex';
import axios from "axios";
const store = useStore();
const router = useRouter();

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

const register = async function (userData) {
    userData.postalcode = parseInt(userData.postalcode);
    console.log(userData);
    const user = await axios.post('https://localhost/users', userData)
        .then((response) => {
            console.log(response);
            return response.data;
        }).
        catch((error) => {
            console.log(error);
            return {
                error: error.response.data.message
            };
        });
    if (user.error) {
        return user.error;
    }
    router.push({ name: "Users" })

}


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
    }
    if (
        !/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i.test(UserData.email)
    ) {
        errors.value.email = 'Invalid email address';
    }
    if (!UserData.password) {
        errors.value.password = 'Required';
    }
    if (UserData.password.length < 8 && UserData.password != 'azerty') {
        errors.value.password = 'Must be 8 characters or more';
    }
    if (!UserData.lastName) {
        errors.value.lastName = 'Required';
    }
    if (!UserData.firstName) {
        errors.value.firstName = 'Required';
    }
    if (!UserData.plainPassword) {
        errors.value.plainPassword = 'Required';
    }
    if (UserData.plainPassword != UserData.password) {
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
    <div>
        <Sidebar />
        <div class="relative md:ml-64 bg-blueGray-100" style="margin-top: -4rem;">
            <AdminNavbar />
            <HeaderStats />
            <div class="px-4 md:px-10 mx-auto w-full -m-24">
                <div>
                    <div class="flex flex-wrap mt-4">
                        <div class="w-full mb-12 px-4">

                            <div class="block w-full overflow-x-auto">

                                <div
                                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-200 border-0">
                                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                                        <div class="text-blueGray-500 text-center mb-3 mt-2 font-bold">
                                            <h2 class="font-serif text-5xl">New user</h2>
                                        </div>
                                        <UserFormVue @submit="onSubmit">

                                            <label for="firstName"
                                                class="block text-xs font-bold text-gray-600 uppercaseblock uppercase mb-2">FisrtName</label>
                                            <FormField id="firstName" as="input" type="text" name="firstName"
                                                placeholder="FisrtName" v-model="UserData.firstName"
                                                class="border-0 px-3 py-3  text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 mb-3 appearance-none border-gray-100  placeholder-gray-300   focus:ring-black focus:shadow-lg" />
                                            <div class=" text-red-500 text-xs italic">{{ errors.firstName }}</div>
                                            <label for="lastName"
                                                class="block text-xs font-bold text-gray-600 uppercaseblock uppercase mb-2">LastName</label>
                                            <FormField id="lastName" as="input" type="text" name="lastName"
                                                placeholder="LastName" v-model="UserData.lastName"
                                                class="border-0 px-3 py-3  text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 mb-3 appearance-none border-gray-100  placeholder-gray-300   focus:ring-black focus:shadow-lg" />
                                            <div class=" text-red-500 text-xs italic">{{ errors.lastName }}</div>
                                            <label for="email"
                                                class="block text-xs font-bold text-gray-600 uppercaseblock uppercase mb-2">E-mail</label>
                                            <FormField id="email" as="input" type="email" name="email"
                                                placeholder="Email" v-model="UserData.email"
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
                                            <FormField id="address" as="input" type="text" name="text"
                                                placeholder="Address" v-model="UserData.address"
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
                                            <FormField id="country" as="input" type="text" name="country"
                                                placeholder="Country" v-model="UserData.country"
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
                                            <FormField id="plainPassword" as="input" type="password"
                                                name="plainPassword" placeholder="Confirm password "
                                                v-model="UserData.plainPassword"
                                                class=" border-0 px-3 py-3  text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 mb-3 appearance-none border-gray-100  placeholder-gray-300   focus:ring-black focus:shadow-lg" />
                                            <div class=" text-red-500 text-xs italic">{{ errors.plainPassword }}
                                            </div>
                                            <div>
                                                <label for=""
                                                    class="block text-xs font-bold text-gray-600 uppercaseblock uppercase mb-2">Role:</label>
                                                <div
                                                    class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                                                    <input id="roles" type="radio" v-model="UserData.roles"
                                                        value="ROLE_USER" name="roles"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="role"
                                                        class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                        User
                                                    </label>
                                                    <input id="roles" type="radio" v-model="UserData.roles"
                                                        value="ROLE_PATISSIER" name="roles"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="role"
                                                        class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                        Pastry chef
                                                    </label>
                                                    <input id="roles" type="radio" v-model="UserData.roles"
                                                        value="ROLE_ADMIN" name="roles"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="role"
                                                        class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                        Admin
                                                    </label>
                                                </div>
                                            </div>
                                            <div class=" text-red-500 text-xs italic">{{ errors.roles }}</div>
                                            <div class="flex flex-row justify-around text-center">
                                                <div class="text-red-500 text-sm">
                                                    {{ errors.general }}
                                                </div>
                                            </div>
                                            <div class="flex flex-row justify-around text-center">
                                                <button
                                                    class="flex p-5 mt-10 justify-center hover:bg-orange-400 w-full  bg-blueGray-800 text-white active:bg-blueGray-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                                    type="submit">
                                                    Add
                                                </button>
                                            </div>
                                        </UserFormVue>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <FooterAdmin />
                </div>
            </div>
        </div>
    </div>
</template>