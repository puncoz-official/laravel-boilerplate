<template>
    <label class="text-gray-500 tracking-wide"
           :class="{
               'block': block,
               'required': required,
               'font-bold': bold,
               'font-medium': !bold,
               'text-xs': small,
               'text-sm': !small
           }">
        <slot>
            <span v-text="value"/>
        </slot>
    </label>
</template>

<script>
    import { defineComponent } from "vue"

    export default defineComponent({
        name: "Label",

        props: {
            value: { type: String, required: false, default: "" },
            required: { type: Boolean, required: false, default: false },
            block: { type: Boolean, required: false, default: false },
            bold: { type: Boolean, required: false, default: false },
            small: { type: Boolean, required: false, default: false },
        },
    })
</script>
