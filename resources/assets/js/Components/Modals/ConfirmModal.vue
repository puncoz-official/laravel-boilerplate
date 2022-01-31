<template>
    <Modal :closeable="closeable"
           :show="show"
           max-width="lg"
           modal-class="flex justify-center items-center"
           @close="$emit('cancelled')">
        <div class="px-6 py-4">
            <div class="text-lg">
                <slot name="title"/>
            </div>

            <div class="mt-4">
                <slot name="content"/>
            </div>
        </div>

        <div class="flex justify-end w-full px-6 py-4">
            <CancelButton class="mr-2" @click.prevent="$emit('cancelled')">
                <slot name="cancel">
                    {{ trans("general.actions.cancel") }}
                </slot>
            </CancelButton>

            <PrimaryButton class="bg-red-500" @click.prevent="$emit('confirmed')">
                <slot name="confirm">
                    {{ trans("general.actions.confirm") }}
                </slot>
            </PrimaryButton>
        </div>
    </Modal>
</template>

<script>
    import Modal               from "@/Components/Modals/Modal"
    import CancelButton        from "@/Components/UI/Buttons/CancelButton"
    import PrimaryButton       from "@/Components/UI/Buttons/PrimaryButton"
    import { defineComponent } from "vue"
    import useTrans            from "../../Composables/useTrans"

    export default defineComponent({
        name: "ConfirmModal",

        components: { PrimaryButton, CancelButton, Modal },

        emits: ["confirmed", "cancelled"],

        props: {
            show: { type: Boolean, required: false, default: false },
            closeable: { type: Boolean, required: false, default: true },
        },

        setup() {
            const trans = useTrans()

            return { trans }
        },
    })
</script>
