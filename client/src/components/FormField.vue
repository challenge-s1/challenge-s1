<script setup>
import { inject } from 'vue'
const props = defineProps(
    {
        name: {
            type: String,
            required: true
        },
        as: {
            type: String,
            required: false
        },
        placeholder: {
            type: String,
            required: false
        },
        type: {
            type: String,
            required: false
        },
        class: {
            type: String,
            required: false
        },
        modelValue: {
            type: [String, Object],
            default: ''
        }
    }
);
</script>

<template>
    <div>
        <component :is="as" :name="name" :type="type" :placeholder="placeholder" :class="class"
            @input="$emit('update:modelValue', $event.target.value)" :value="modelValue">
            <slot />
        </component>
    </div>
</template> 
