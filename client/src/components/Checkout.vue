<script>
import { defineComponent, ref } from 'vue'
import { useStripe, StripeElement } from 'vue-use-stripe'
import axios from 'axios'
import { useStore } from "vuex";
import { inject } from 'vue'
import { user as UserProvierKeys } from '@/components/providers/UserProviderKeys.js';
import '@stripe/stripe-js'
import Modal from '../components/ModalForm.vue';

export default defineComponent({
    components: { StripeElement, Modal },
    emits: ["checkout-done"],
    setup(_, { emit }) {
        const event = ref(null)
        const error = ref('')
        const url = (import.meta.env.VITE_API_URL)
        const store = useStore();
        const userToken = store.getters.user
        // const userToken = inject(UserProvierKeys);
        const stripeKey = (import.meta.env.VITE_STRIPE_KEY)
        const waitForResponse = ref(false);
        const {
            stripe,
            elements: [cardElement],
        } = useStripe({
            key: stripeKey || '',
            elements: [{ type: 'card', options: {} }],
        })

        const checkout = async (handleClose) => {
            if (event.value?.complete) {
                const token = await stripe.value?.createToken(cardElement.value);
                const stripeToken = (await stripe.value?.createToken(cardElement.value)).token.id;
                if (stripeToken) {
                    waitForResponse.value = true;
                }
                const response = await axios.post(`${url}/users/${userToken.id}/carts/checkout`, {
                    stripeToken: stripeToken
                }, {
                    headers: {
                        authorization: 'Bearer ' + userToken.token
                    }
                }).then((response) => {
                    waitForResponse.value = false;
                    handleClose();
                    emit('checkout-done', response.data);
                }).catch((error) => {
                    console.log(error);
                    error.value = error.response.data.message;
                });

            }
        }

        return {
            event,
            waitForResponse,
            error,
            cardElement,
            checkout,
        }
    },
})
</script>
<template>
    <Modal class="w-10/12">
        <template #activator="{ toggleModal }">
            <button type="button" @click="toggleModal"
                class="block px-5 py-3 text-sm text-gray-100 transition bg-gray-700 rounded  hover:bg-orange-400">
                Checkout
            </button>
        </template>
        <template v-slot:title>
            <h1>Process To Payment</h1>
        </template>
        <template #default class="w-full">
            <div class="w-full">
                <div class="mt-8 mb-8">
                    <StripeElement :element="cardElement" @change="event = $event" />
                    <div v-if="event && event.error">{{ event.error.message }} </div>
                    <div v-if="error" class="text-red">{{ error }}</div>
                </div>
            </div>
        </template>
        <template #footer="{ handleClose }">
            <button v-if="waitForResponse" type="button" disabled
                class="inline-flex w-full justify-center cursor-pointer select-none appearance-none items-center  space-x-2 rounded border border-blue-700 bg-blue-700 p-4 text-sm font-medium text-white transition hover:border-blue-800 hover:bg-blue-800 focus:border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-300 disabled:pointer-events-none disabled:opacity-75">
                <svg class="h-4 w-4 animate-spin" viewBox="3 3 18 18">
                    <path class="fill-blue-800"
                        d="M12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5ZM3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12Z">
                    </path>
                    <path class="fill-blue-100"
                        d="M16.9497 7.05015C14.2161 4.31648 9.78392 4.31648 7.05025 7.05015C6.65973 7.44067 6.02656 7.44067 5.63604 7.05015C5.24551 6.65962 5.24551 6.02646 5.63604 5.63593C9.15076 2.12121 14.8492 2.12121 18.364 5.63593C18.7545 6.02646 18.7545 6.65962 18.364 7.05015C17.9734 7.44067 17.3403 7.44067 16.9497 7.05015Z">
                    </path>
                </svg>
                <span>Loading...</span>
            </button>
            <button v-else type="submit" class=" flex p-4 bg-black
                font-medium justify-center text-white uppercase 
                focus:outline-none hover:bg-orange-400 w-full hover:shadow-none"
                @click="checkout(handleClose)">Pay</button>

        </template>
    </Modal>


</template>