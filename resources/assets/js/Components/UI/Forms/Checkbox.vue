<template>
    <input v-model="proxyChecked"
           :value="value"
           class="text-primary focus:ring-0 border-gray-300 rounded"
           type="checkbox">
</template>

<script>
    import {
        computed,
        defineComponent,
    } from "vue"

    export default defineComponent({
        emits: ["update:checked"],

        props: {
            checked: { type: [Array, Boolean], required: false, default: false },
            value: { type: String, required: false, default: null },
        },

        setup(props, { emit }) {
            const proxyChecked = computed({
                get: () => props.checked,
                set: (val) => emit("update:checked", val),
            })

            return {
                proxyChecked,
            }
        },
    })
</script>
