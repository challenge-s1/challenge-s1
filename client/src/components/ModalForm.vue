<script setup>
import { ref, provide } from "vue";

const props = defineProps({
    class: {
        type: String,
        default: "",
    },
});
const open = ref(false);

function handleClose() {
    open.value = false;
}

function toggleModal() {
    open.value = !open.value;
}
</script>

<template>
    <slot name="form" :open="open">
        <slot name="activator" :open="open" :toggleModal="toggleModal">
            <button type="button" @click="toggleModal">Open Modal</button>
        </slot>
        <template v-if="open">
            <div class="overlay" @click="toggleModal"></div>
            <div class="modal  min-w-[50%]" :class="class">
                <div class="modal-title flex items-center justify-between rounded-t-lg bg-white">
                    <div class="grow text-center">
                        <slot name="title" :open="open">Modal Title</slot>
                    </div>
                    <svg @click="handleClose" xmlns="http://www.w3.org/2000/svg"
                        class="w-8 h-8 text-red-900 cursor-pointer" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="modal-content h-[65vh] overflow-y-auto">
                    <slot>Modal Content</slot>
                </div>
                <div class="modal-footer rounded-b-lg	">
                    <slot name="footer" :handleClose="handleClose">
                        <button @click="handleClose"
                            class=" flex p-5 bg-black
                        font-medium text-white uppercase 
                        focus:outline-none justify-center hover:bg-orange-400 w-full hover:shadow-none">Validate</button>
                    </slot>
                </div>
            </div>
        </template>
    </slot>
</template>

<style scoped>
.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1;
}

.modal {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 2;
}

.modal-content {
    background-color: white;
    padding: 1rem;
}

.modal-title {
    font-size: 1.5rem;
    font-weight: bold;
    padding: 1rem;
    border-bottom: 1px solid #e5e7eb;
}

.modal-footer {
    padding: 1rem;
    text-align: right;
    background-color: white;
}
</style>