<script setup>

import axios from 'axios';
import { ref, provide, inject, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
const url = (import.meta.env.VITE_API_URL)
const $route = useRoute();
const router = useRouter();


const activate = async () => {
    const token = $route.params.token;
    console.log($route.params.token);
    await axios.put(`${url}/account/activate`, { token: token })
        .then((response) => {
            console.log(response);
            router.push({ name: "Login" })
        })
        .catch((error) => {
            console.log(error);
        })
}
activate();


</script>
