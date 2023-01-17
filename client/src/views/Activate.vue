<script setup>

import axios from 'axios';
import { ref, provide, inject, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
const $route = useRoute();
const router = useRouter();

onMounted(() => {
    console.log("mounted");
    const token = $route.params.token;
    console.log($route.params.token);
    axios.put('https://localhost/account/activate', { token: token })
        .then((response) => {
            console.log(response);
            router.push({ name: "Login" })
        })
        .catch((error) => {
            console.log(error);
        })
})
</script>
