<script setup>
import axios from 'axios';
import { user as UserProvierKeys } from '@/components/providers/UserProviderKeys.js';
import { inject, ref, onBeforeMount, reactive } from 'vue'
import { useStore } from "vuex";
import Alert from '@/components/alert/Alert.vue';
import Checkout from '@/components/Checkout.vue';

const url = (import.meta.env.VITE_API_URL)
// const userToken = inject(UserProvierKeys);
const userToken = store.getters.user
const store = useStore();
const cartItems = ref([]);
const vouchers = ref([]);
const cartTotalMasterClass = ref(0);
const cartTotalPastrie = ref(0);

const quantityByItemCart = reactive({});
const hasBeenModify = ref(false);
const alert = reactive({
    open: false,
    title: '',
    content: '',
    type: 'success'
});

const getCart = async () => {
    cartTotalPastrie.value = 0;
    cartTotalMasterClass.value = 0;
    console.log(userToken.value)
    const response = await axios.get(`${url}/users/${userToken.id}/carts`, {
        headers: {
            authorization: 'Bearer ' + userToken.token
        }
    }).then((response) => {
        console.log(response);
        // cartItems.value = response.data['hydra:member'];
        cartItems.value = response.data;
        console.log(cartItems.value);
        for (const element of cartItems.value) {
            if (element.cake) {
                cartTotalPastrie.value += element.cake.price * element.quantity;
            } else if (element.masterClass) {
                cartTotalMasterClass.value += element.masterClass.price * element.quantity;
                timer(element.id, element.updated_at);
            }
            quantityByItemCart[element.id] = element.quantity;
        }
        console.log(quantityByItemCart);
    }).catch((error) => {
        console.log(error);
    });
}

const getVoucher = async () => {
    if (cartTotalMasterClass.value > 0) {
        vouchers.value = [];
        console.log(userToken.value)
        const response = await axios.get(`${url}/users/${userToken.id}/vouchers`, {
            headers: {
                authorization: 'Bearer ' + userToken.token
            }
        }).then((response) => {
            const vouchersData = response.data['hydra:member'];
            for (const voucher of vouchersData) {
                if (cartTotalMasterClass.value >= voucher.price) {
                    cartTotalMasterClass.value -= voucher.price;
                    vouchers.value.push(voucher);
                } else {
                    const rest = voucher.price - cartTotalMasterClass.value;
                    cartTotalMasterClass.value = 0;
                    vouchers.value.push({ price: voucher.price - rest, all: voucher.price });
                }
            }

            console.log(response);
        }).catch((error) => {
            console.log(error);
        });
    }
}
onBeforeMount(async () => {
    await getCart();
    await getVoucher();
});

const handleSubmit = async (id) => {

    console.log(id, quantityByItemCart[id]);

    const reponse = await axios.patch(`${url}/users/${userToken.id}/carts/${id}`,
        {
            quantity: quantityByItemCart[id]
        }, {
        headers: {
            'content-type': 'application/merge-patch+json',
            authorization: 'Bearer ' + userToken.token
        }
    }).then((response) => {
        alert.open = true;
        alert.title = 'Your cart has been updated !';
        console.log(response);

        getCart();
        getVoucher();
    }).catch((error) => {
        console.log(error);
    });

};

const deleteItemCart = async (id) => {
    const response = await axios.delete(`${url}/users/${userToken.id}/carts/${id}`, {
        headers: {
            authorization: 'Bearer ' + userToken.token
        }
    }).then((response) => {
        console.log(response);
        getCart();
        getVoucher();
    }).catch((error) => {
        console.log(error);
    });
};

const getDifferenceBetweenNowAndDate = (date) => {
    const now = new Date();
    const dateToCompare = new Date(date);
    const difference = now.getTime() - dateToCompare.getTime();
    const differenceInMinutes = Math.ceil(difference / (1000 * 60));
    return differenceInMinutes;
}

const timerTime = ref({});

const timer = (id, date) => {
    const differenceInMinutes = getDifferenceBetweenNowAndDate(date);
    const departMinutes = 5 - differenceInMinutes;
    let temps = departMinutes * 60

    setInterval(() => {
        if (temps > 0) {
            let minutes = parseInt(temps / 60, 10)
            let secondes = parseInt(temps % 60, 10)

            minutes = minutes < 10 ? "0" + minutes : minutes
            secondes = secondes < 10 ? "0" + secondes : secondes

            timerTime.value[id] = `${minutes}:${secondes}`
            temps = temps <= 0 ? 0 : temps - 1
        } else {
            deleteItemCart(id);
        }
    }, 1000)

}
const onCheckoutDone = (payload) => {
    alert.open = true;
    alert.title = payload;
    getCart();
    getVoucher();

}

</script>
<template>

    <Alert v-model="alert" />
    <section>
        <div class="max-w-screen-xl px-4 py-8 mx-auto sm:px-6 sm:py-12 lg:px-8">
            <div class="max-w-3xl mx-auto">
                <header class="text-center">
                    <h1 class="text-xl font-bold text-gray-900 sm:text-3xl">Your Cart</h1>
                </header>

                <div class="mt-8" v-if="cartItems.length > 0">
                    <ul class="space-y-4">
                        <li class="flex items-center" v-for="itemCart of cartItems">
                            <img v-if="itemCart.cake" src="@/assets/img/shop/product-1.jpg" alt=""
                                class="object-cover w-16 h-16 rounded" />
                            <img v-else-if="itemCart.masterClass" src="@/assets/img/masterClassTicket.png" alt=""
                                class="object-cover w-16 h-16 rounded" />
                            <div class="ml-4" v-if="itemCart.cake">
                                <h3 class="text-sm text-gray-900">{{ itemCart.cake.name }}</h3>

                                <dl class="mt-0.5 space-y-px text-[10px] text-gray-600">
                                    <div>
                                        <dt class="inline">Price:</dt>
                                        <dd class="inline"> ${{ itemCart.cake.price }}</dd>
                                    </div>


                                </dl>
                            </div>
                            <div class="ml-4" v-else-if="itemCart.masterClass">
                                <h3 class="text-sm text-gray-900">{{ itemCart.masterClass.title }}</h3>

                                <dl class="mt-0.5 space-y-px text-[10px] text-gray-600">
                                    <div>
                                        <dt class="inline">Price:</dt>
                                        <dd class="inline"> {{
                                            itemCart.masterClass.price
                                        }}$</dd>
                                    </div>


                                    <div>

                                        <dt class="inline">Masterclass stays in your basket for {{
                                        timerTime[itemCart.id] }}</dt>
                                    </div>
                                </dl>
                            </div>

                            <div class="flex items-center justify-end flex-1 gap-2">
                                <form @submit.prevent="handleSubmit(itemCart.id)">
                                    <label for="Line1Qty" class="sr-only"> Quantity </label>

                                    <input type="number" min="1" v-model="quantityByItemCart[itemCart.id]" id="Line1Qty"
                                        :readonly="itemCart.masterClass"
                                        class="h-8 w-12 rounded border-gray-200 bg-gray-50 p-0 text-center text-xs text-gray-600 [-moz-appearance:_textfield] focus:outline-none [&::-webkit-outer-spin-button]:m-0 [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:m-0 [&::-webkit-inner-spin-button]:appearance-none" />
                                </form>

                                <button class="text-gray-600 transition hover:text-red-600"
                                    @click="deleteItemCart(itemCart.id)">
                                    <span class="sr-only">Remove item</span>

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </li>
                    </ul>

                    <div class="flex justify-end pt-8 mt-8 border-t border-gray-100">
                        <div class="w-screen max-w-lg space-y-4">
                            <dl class="space-y-0.5 text-sm text-gray-700">



                                <div class="flex justify-between" v-for="voucher in vouchers">
                                    <dt>Discount</dt>
                                    <dd>-${{ voucher.price }}{{ voucher.all ? '/' + voucher.all : '' }}</dd>
                                </div>


                                <div class="flex justify-end" v-if="vouchers.length > 0">
                                    <span
                                        class="inline-flex items-center justify-center rounded-full bg-indigo-100 px-2.5 py-0.5 text-indigo-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="-ml-1 mr-1.5 h-4 w-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                                        </svg>

                                        <p class="text-xs whitespace-nowrap"> {{ vouchers.length }} Discounts Applied
                                        </p>
                                    </span>
                                </div>

                                <div class="flex justify-between !text-base font-medium">
                                    <dt>Total</dt>
                                    <dd>${{ cartTotalMasterClass + cartTotalPastrie }}</dd>
                                </div>
                            </dl>

                            <div class="flex justify-end">
                                <Checkout @checkout-done="onCheckoutDone" />
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else class="text-lg text-center  text-gray-900 sm:text-3lg m-8">

                    Your cart is empty, please add some items.
                </div>
            </div>
        </div>
    </section>
</template>
