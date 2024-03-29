<template>
    <Head title="Forgot Password"/>

    <jet-authentication-card>
        <template #logo>
            <logo/>
        </template>

        <div class="mb-4 text-sm text-gray-600">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <jet-validation-errors class="mb-4"/>

        <form @submit.prevent="submit">
            <div>
                <jet-label for="email" value="Email"/>
                <jet-input id="email"
                           v-model="form.email"
                           type="email"
                           class="mt-1 block w-full"
                           required
                           autofocus/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Email Password Reset Link
                </jet-button>
            </div>
        </form>
    </jet-authentication-card>
</template>

<script>
    import { defineComponent }   from "vue"
    import {
        Head,
        useForm,
    }                            from "@inertiajs/inertia-vue3"
    import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue"
    import JetButton             from "@/Jetstream/Button.vue"
    import JetInput              from "@/Jetstream/Input.vue"
    import JetLabel              from "@/Jetstream/Label.vue"
    import JetValidationErrors   from "@/Jetstream/ValidationErrors.vue"
    import Logo                  from "@/Components/Logo"
    import useRoute              from "@/Composables/useRoute"

    export default defineComponent({
        components: {
            Head,
            JetAuthenticationCard,
            Logo,
            JetButton,
            JetInput,
            JetLabel,
            JetValidationErrors,
        },

        props: {
            status: {
                type: String,
                require: false,
                default: null,
            },
        },

        setup() {
            const route = useRoute()

            const form = useForm({
                email: "",
            })

            const submit = () => {
                form.post(route("password.email"))
            }

            return {
                form,
                submit,
            }
        },
    })
</script>
