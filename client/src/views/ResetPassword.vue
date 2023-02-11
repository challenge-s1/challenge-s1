
<script setup>
import UserForm from '../components/UserForm.vue';
import FormField from '../components/FormField.vue';

import { reactive } from 'vue';
import { useRoute,useRouter } from 'vue-router';
import axios from 'axios';
const route = useRoute();
const router = useRouter();
const UserData = reactive({
    password: '',
    password2:'',
    errors: ''
})
const onSubmit = function () {

    if (UserData.password != UserData.password2) {
      UserData.errors = "Passwords don't match"
    }
    else {
      UserData.errors = ''
    }
    if(UserData.password.length < 6){
      UserData.errors = "Password must be at least 6 characters"
    }
    else {
      UserData.errors = ''
    }
    if(UserData.errors == ''){
      axios.post('https://localhost/users/update-password', 
        { 
          password: UserData.password,
          token : route.params.token
        }
      ).then((response) => {
        console.log(response);
        router.push({ name: 'Login'});

      })
      .catch((error) => {
        console.log(error);
      });
  }
    else{
        console.log("error")
    }
  console.log(UserData)
}



</script>

<template>
    <div class="container px-6 mx-auto">
        <div class="flex  text-center md:text-left md:flex-row h-screen justify-evenly md:items-center">

            <div class="bg-white p-10 flex flex-col shadow-xl rounded-xl">
                <h2 class="text-2xl font-bold text-gray-800 text-left mb-5">
                    Update Password
                </h2>
                <UserForm @submit="onSubmit">
                    <!-- <label for="email" class="block text-xs font-semibold text-gray-600 uppercase">E-mail</label> -->
                    <FormField id="password" as="input" type="password" name="password" placeholder="new password" required
                        v-model="UserData.password"
                        class=" mb-4 w-full appearance-none border-2 border-gray-100 rounded-lg px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-green-600 focus:shadow-lg" />
                    <!-- <label for="password" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Mot de passe
                    </label> -->
                    <FormField id="password2" as="input" type="password" name="password2" placeholder="confirm password" required
                        v-model="UserData.password2"
                        class="  w-full appearance-none border-2 border-gray-100 rounded-lg px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-green-600 focus:shadow-lg" />

                    <p v-if="errors != ''">{{ UserData.errors }}</p>
                     
                    <button type="submit"
                        class="  mt-10 
                        font-medium  uppercase
                        focus:outline-none hover:bg-green-800 hover:shadow-none w-full py-4 bg-green-600 rounded-lg text-green-100">Update</button>
                </UserForm>
            </div>

        </div>
    </div>




</template>