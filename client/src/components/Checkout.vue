<script>
import { defineComponent, ref } from 'vue'
import { useStripe, StripeElement } from 'vue-use-stripe'
import axios from 'axios'
import { inject } from 'vue'
import { user as UserProvierKeys } from '@/components/providers/UserProviderKeys.js';
import '@stripe/stripe-js'
import Modal from '../components/ModalForm.vue';


export default defineComponent({
    components: { StripeElement, Modal },
    setup() {
        const event = ref(null)
        const userToken = inject(UserProvierKeys);

        const {
            stripe,
            elements: [cardElement],
        } = useStripe({
            key: 'pk_test_51LIe1ACGeX3aOpihN6MPyNRRerWe6egT5efxDqhf8tqRkukdPZgCAeyM9tPoz3MiS8k1Q7A2eJqro1GrikEGAVZM00uHgyfuDZ' || '',
            elements: [{ type: 'card', options: {} }],
        })

        const checkout = async (handleClose) => {
            if (event.value?.complete) {
                const token = await stripe.value?.createToken(cardElement.value);
                console.log(token);
                const stripeToken = (await stripe.value?.createToken(cardElement.value)).token.id;
                const response = await axios.post(`https://localhost/users/${userToken.value.token.user.id}/carts/checkout`, {
                    stripeToken: stripeToken
                }, {
                    headers: {
                        authorization: 'Bearer ' + userToken.value.token.token
                    }
                }).then((response) => {
                    handleClose();
                    console.log(response);
                }).catch((error) => {
                    console.log(error);
                });

            }
        }

        return {
            event,
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
                class="block px-5 py-3 text-sm text-gray-100 transition bg-gray-700 rounded hover:bg-gray-600">
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
                    <div v-if="event && event.error">{{ event.error.message }}</div>
                </div>
            </div>
        </template>
        <template #footer="{ handleClose }">
            <button type="submit" class=" flex p-4 bg-black
                font-medium justify-center text-white uppercase 
                focus:outline-none hover:bg-orange-400 w-full hover:shadow-none"
                @click="checkout(handleClose)">Pay</button>
        </template>
    </Modal>

</template>