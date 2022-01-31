<template>
    <div class="inline-block">
        <div class="inline-block">
            <slot :click="startConfirmingPassword" :loading="loading"/>
        </div>

        <ConfirmModal :show="showDialog" @cancelled="closeModal" @close="closeModal" @confirmed="confirmPassword">
            <template #title>
                {{ title }}
            </template>

            <template #content>
                {{ content }}

                <div class="mt-4">
                    <PasswordInput v-model="form.password"
                                   :placeholder="trans('validation.attributes.password')"
                                   autocomplete="password"
                                   class="mt-1 block w-full"
                                   @keypress="clearFormError('password')"
                                   @keyup.enter="confirmPassword"/>

                    <InputError :message="form.errors.password" class="mt-2"/>
                </div>
            </template>
        </ConfirmModal>
    </div>
</template>

<script>
    import ConfirmModal  from "@/Components/Modals/ConfirmModal"
    import InputError    from "@/Components/UI/Forms/InputError"
    import PasswordInput from "@/Components/UI/Forms/PasswordInput"
    import useApi        from "@/Composables/useApi"
    import useRoute      from "@/Composables/useRoute"
    import useState      from "@/Composables/useState"
    import useTrans      from "@/Composables/useTrans"
    import { useForm }   from "@inertiajs/inertia-vue3"
    import {
        defineComponent,
        nextTick,
    }                    from "vue"

    export default defineComponent({
        name: "ConfirmsPassword",

        components: { InputError, PasswordInput, ConfirmModal },

        emits: ["confirmed"],

        props: {
            title: { type: String, required: false, default: "Confirm Password" },
            content: {
                type: String,
                required: false,
                default: "For your security, please confirm your password to continue.",
            },
            button: { type: String, required: false, default: "Confirm" },
            forcePassword: { type: Boolean, required: false, default: false },
            emitPassword: { type: Boolean, required: false, default: true },
        },

        setup(props, { emit }) {
            const [loading, setLoading] = useState(false)
            const [showDialog, setShowDialog] = useState(false)

            const form = useForm({
                password: "",
            })

            const api = useApi()
            const route = useRoute()
            const trans = useTrans()

            const clearFormError = (fieldName) => {
                form.clearErrors(fieldName)
            }

            const startConfirmingPassword = async () => {
                setLoading(true)

                if (!props.forcePassword) {
                    const { body } = await api.get(route("password.confirmation"))

                    if (body.confirmed) {
                        setLoading(false)
                        emit("confirmed")

                        return
                    }
                }

                setShowDialog(true)
            }

            const confirmPassword = async () => {
                form.processing = true

                try {
                    await api.post(route("password.confirm"), {
                        password: form.password,
                    })

                    const password = form.password
                    form.processing = false
                    closeModal()
                    await nextTick()
                    emit("confirmed", props.emitPassword ? password : null)
                } catch (err) {
                    form.processing = false
                    form.errors.password = err.response.data.errors.password[0]
                }
            }

            const closeModal = () => {
                form.reset()
                setLoading(false)
                setShowDialog(false)
            }

            return {
                loading,
                showDialog,
                form,
                trans,
                clearFormError,
                startConfirmingPassword,
                confirmPassword,
                closeModal,
            }
        },
    })
</script>
