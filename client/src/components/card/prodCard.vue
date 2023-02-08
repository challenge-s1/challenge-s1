<script setup>

</script>

<template>
    <div class="mx-auto grid max-w-6xl  grid-cols-1 gap-6 p-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
        <article
            class="rounded-xl bg-white p-3 shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300 ">

            <div class="relative flex items-end overflow-hidden rounded-xl">
                <slot name="image"></slot>

            </div>

            <div class="mt-1 p-2">
                <div class=" ">
                    <h2>test</h2>
                </div>
                <slot name="title"></slot>
                <slot name="description"></slot>

                <div class="mt-3 flex items-end justify-between">
                    <slot name="price"></slot>

                    <div
                        class="flex items-center space-x-1.5 rounded-lg bg-blue-500 px-4 py-1.5 text-white duration-100 hover:bg-blue-600">
                        <slot name="button"></slot>
                    </div>
                </div>
            </div>

        </article>
    </div>
</template>

<style scoped>

</style>