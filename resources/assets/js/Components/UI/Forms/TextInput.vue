<template>
    <input ref="input"
           :class="{
               'border-gray-300 focus:border-primary-600 rounded-md focus:ring-0': border,
               'border-0 border-b focus:border-primary-600 focus:ring-0 px-0 text-lg': !border,
               'block w-full': full,
           }"
           :type="type"
           :value="modelValue"
           class=""
           @input="$emit('update:modelValue', $event.target.value)">
</template>

<script>
    import { defineComponent } from "vue"

    export default defineComponent({
        name: "TextInput",

        props: {
            type: { type: HTMLInputElement.type, required: false, default: "text" },
            border: { type: Boolean, required: false, default: false },
            full: { type: Boolean, required: false, default: false },
            modelValue: { type: [String, Number], required: false, default: null },
        },

        emits: ["update:modelValue"],

        methods: {
            focus() {
                this.$refs.input.focus()
            },
        },
    })
</script>
