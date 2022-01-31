<template>
    <Modal :closeable="closeable" :max-width="maxWidth" :show="show" @close="$emit('close')">
        <div class="px-6 py-4">
            <div class="text-lg">
                <slot name="title"/>
            </div>

            <div class="mt-4">
                <slot name="content"/>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-100 text-right">
            <slot name="footer"/>
        </div>
    </Modal>
</template>

<script>
    import Modal               from "@/Components/Modals/Modal"
    import { defineComponent } from "vue"

    export default defineComponent({
        name: "DialogModal",

        emits: ["close"],

        components: {
            Modal,
        },

        props: {
            show: { type: Boolean, required: false, default: false },
            maxWidth: { type: String, required: false, default: "2xl" },
            closeable: { type: Boolean, required: false, default: true },
        },
    })
</script>
