<script setup>
import axios from 'axios';
import { user as UserProvierKeys } from '@/components/providers/UserProviderKeys.js';
import { inject, ref } from 'vue';
const userToken = inject(UserProvierKeys);
const cartItems = ref([]);
const cartTotal = ref(0);
const getCart = async () => {
    const response = await axios.get(`https://localhost/users/${userToken.value.token.user.id}/carts`, {
        headers: {
            authorization: 'Bearer ' + userToken.value.token.token
        }
    }).then((response) => {
        cartItems.value = response.data['hydra:member'];
        for (let i = 0; i < cartItems.value.length; i++) {
            if (cartItems.value[i].cake) {
                cartTotal.value += cartItems.value[i].cake.price * cartItems.value[i].quantity;
            } else if (cartItems.value[i].masterClass) {
                cartTotal.value += cartItems.value[i].masterClass.price * cartItems.value[i].quantity;
            }
        }
    }).catch((error) => {
        console.log(error);
    });
}
getCart();
</script>
<template>
    <div class=" bg-white mt-5">
        <div>
        </div>
        <div class="font-normal">
            <div class=" ">
                <div class="text-black text-left font-['Playfair_Display']">
                    <p class=" italic m-0  text-[50px] leading-[67px] p-5 ml-10 mb-10">
                        Shopping cart
                    </p>
                </div>
            </div>
        </div>
        <div>
            <div class=" flex justify-around flex-wrap w-full">
                <div class=" w-[70%]">
                    <div class=" w-full ">
                        <div class=" left-0 text-left font-semibold mb-5
                            font-['Montserrat'] text-[rgba(17,17,17,1)]">
                            <div class=" flex justify-around ">
                                <p class="left-px  text-base uppercase inline m-0 leading-[19px]">
                                    Product
                                </p>
                                <p class=" text-base uppercase inline m-0 pl-4  leading-[19px]">
                                    Quantity
                                </p>
                                <p class=" text-base uppercase inline m-0  pr-8 leading-[19px]">
                                    Total
                                </p>
                            </div>
                        </div>
                        <div class=" w-full ">
                            <div class="  flex justify-around " v-for="itemCart of cartItems">
                                <div class=" left-0 text-left flex self-center
                                    font-['Montserrat'] text-[rgba(17,17,17,1)]">
                                    <div
                                        class="[background:url(https://uortjlczjmucmpaqqhqm.supabase.co/storage/v1/object/public/firejet-converted-images/images/889144cfd7ba8764cb74bed451ef95cee9f4e378:0.webp)_no-repeat_center_/_contain] left-px  w-[90px] h-[90px] top-[calc(50%_-_45px_+_0px)]">
                                    </div>
                                    <div v-if="itemCart" class=" inline-flex flex-col items-start  overflow-clip ">
                                        <p class="text-base px-5 font-medium uppercase m-0 leading-[19px]">
                                            {{itemCart.cake ? itemCart.cake.name : itemCart.masterClass.name}}
                                        </p>
                                        <p class="text-base font-semibold p-5 leading-[19px]">
                                            {{itemCart.cake ? itemCart.cake.price : itemCart.masterClass.price}}$
                                        </p>
                                    </div>
                                </div>
                                <div class=" flex font-medium self-center
                                    font-['Montserrat'] pr-5">
                                    <p
                                        class="left-0 cursor-pointer text-base leading-6 text-left inline m-0 h-[19px] w-[6.34px] top-[3px] text-[rgba(136,136,136,1)]">
                                        -
                                    </p>
                                    <div
                                        class=" top-0 bg-white text-center w-[65px] h-[26px] left-[10.34px] text-[rgba(17,17,17,1)]">
                                        <div
                                            class="pt-0.5 pl-7  left-0.5 top-px flex items-start pb-[3px] pr-[27px] overflow-clip">
                                            <p class="text-base m-0 leading-[19px]">{{ itemCart.quantity }}</p>
                                        </div>
                                    </div>
                                    <p
                                        class=" text-base cursor-pointer leading-6 text-left inline m-0 h-[19px] w-[9.51px] left-[79.55px] top-[3px] text-[rgba(136,136,136,1)]">
                                        +
                                    </p>
                                </div>
                                <div class="flex self-center justify-around">
                                    <p class=" self-center text-base font-semibold text-left inline m-0 font-['Montserrat'] leading-[19px]
                                    text-[rgba(17,17,17,1)] p-4">
                                    ${{ itemCart.quantity * (itemCart.cake.price ? itemCart.cake.price : itemCart.masterClass.price) }}
                                    </p>
                                    <button class="w-10 h-10  text-center font-normal 
                                    bg-[rgba(242,242,242,1)] rounded-[20px] font-['Inter'] text-[rgba(17,17,17,1)]">
                                        <p class="top-2.5  text-lg m-0 leading-[38px]">
                                            X
                                        </p>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class=" left-0 flex justify-around mt-10">
                        <button class="[box-shadow:0px_0px_0px_1px_rgba(225,_225,_225,_1)_inset]
                            [box-shadow-width:1px] pt-4 pl-9 flex items-start text-left font-semibold w-[266.21875px]
                            pb-[17px] pr-[37px] font-['Montserrat'] text-[rgba(17,17,17,1)] ">
                            <p class="text-sm uppercase m-0 tracking-[2px] leading-[18px]">
                                Continue Shopping
                            </p>
                        </button>
                        <button @click="getCart"
                            class="[box-shadow:0px_0px_0px_1px_rgba(17,_17,_17,_1)_inset] [box-shadow-width:1px] px-9 w-56 pt-4 gap-3 flex items-center text-white text-right pb-[17px] bg-[rgba(17,17,17,1)]">
                            <div class="w-4 pl-0.5 flex items-start font-normal font-['Inter']">
                                <p class="text-sm uppercase m-0 tracking-[2px] leading-[14px]">
                                    
                                </p>
                            </div>
                            <p class="text-sm font-semibold uppercase m-0 font-['Montserrat'] tracking-[2px]
                                leading-[18px]">
                                Update cart
                            </p>
                        </button>
                    </div>
                </div>
                <div class=" font-['Montserrat']">

                    <div class="p-5 bg-[rgba(253,243,234,1)] m-5">
                        <p
                            class="  text-base font-semibold text-left uppercase inline m-0  leading-[19px] text-[rgba(17,17,17,1)]">
                            Cart total
                        </p>
                        <div class=" ">
                            <div class="h-10 flex justify-around w-[280px] overflow-clip">
                                <div class="font-medium text-[rgba(68,68,68,1)]">
                                    <p class="left-0 top-2.5  text-base leading-10 m-0">
                                        Total
                                    </p>
                                </div>
                                <div class="font-semibold text-[rgba(226,107,12,1)]">
                                    <p class="top-2.5  text-base leading-10 m-0 ">
                                        $ {{ cartTotal }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <button
                            class="pb-3.5 self-end text-white text-center font-semibold pt-[13px] pl-[31px] pr-[30px] top-[171.19px] bg-[rgba(17,17,17,1)]">
                            <p class="text-sm uppercase m-0 tracking-[2px] leading-[18px]">
                                Proceed to checkout
                            </p>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
