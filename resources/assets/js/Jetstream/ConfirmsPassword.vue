<template>
    <span>
        <span @click="startConfirmingPassword">
            <slot/>
        </span>

        <jet-dialog-modal :show="confirmingPassword" @close="closeModal">
            <template #title>
                {{ title }}
            </template>

            <template #content>
                {{ content }}

                <div class="mt-4">
                    <jet-input ref="password"
                               v-model="form.password"
                               type="password"
                               class="mt-1 block w-3/4"
                               placeholder="Password"
                               @keyup.enter="confirmPassword"/>

                    <jet-input-error :message="form.error" class="mt-2"/>
                </div>
            </template>

            <template #footer>
                <jet-secondary-button @click="closeModal">
                    Cancel
                </jet-secondary-button>

                <jet-button class="ml-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" @click="confirmPassword">
                    {{ button }}
                </jet-button>
            </template>
        </jet-dialog-modal>
    </span>
</template>

<script>
    import useApi             from "@/Composables/useApi"
    import useRoute           from "@/Composables/useRoute"
    import { useForm }        from "@inertiajs/inertia-vue3"
    import {
        defineComponent,
        ref,
    }                         from "vue"
    import JetButton          from "./Button.vue"
    import JetDialogModal     from "./DialogModal.vue"
    import JetInput           from "./Input.vue"
    import JetInputError      from "./InputError.vue"
    import JetSecondaryButton from "./SecondaryButton.vue"

    export default defineComponent({
        emits: ["confirmed"],

        components: {
            JetButton,
            JetDialogModal,
            JetInput,
            JetInputError,
            JetSecondaryButton,
        },

        props: {
            title: {
                type: String,
                required: false,
                default: "Confirm Password",
            },
            content: {
                type: String,
                required: false,
                default: "For your security, please confirm your password to continue.",
            },
            button: {
                type: String,
                required: false,
                default: "Confirm",
            },
        },

        setup(props, { emit }) {
            const Api = useApi()
            const route = useRoute()

            const confirmingPassword = ref(false)

            // @todo bag: "confirmPassword",
            const form = useForm({
                password: "",
            })

            const startConfirmingPassword = async () => {
                const response = await Api.get(route("password.confirmation"))

                if (response.body.confirmed) {
                    emit("confirmed")

                    return
                }

                confirmingPassword.value = true
                form.reset()
            }

            const confirmPassword = async () => {
                form.post("/user/confirm-password", {
                    preserveScroll: true,
                    preserveState: true,
                    onSuccess: page => {
                        confirmingPassword.value = false
                        form.reset()
                        emit("confirmed")
                    },
                })
            }

            const closeModal = () => {
                confirmingPassword.value = false
                form.password = ""
                form.error = ""
            }

            return {
                form,
                confirmingPassword,
                startConfirmingPassword,
                confirmPassword,
                closeModal,
            }
        },
    })
</script>
