<template>
    <Head title="Register"/>

    <AuthenticationCard>
        <template #logo>
            <Logo/>
        </template>

        <form @submit.prevent="submit">
            <div>
                <Label :value="trans('validation.attributes.full_name')"
                       block
                       bold
                       for="full_name"
                       required/>

                <TextInput id="name"
                           v-model="form.full_name"
                           autocomplete="full-name"
                           autofocus
                           border
                           class="my-1"
                           full/>
                <InputError :message="form.errors.full_name"/>
            </div>

            <div class="mt-4">
                <Label :value="trans('validation.attributes.email')"
                       block
                       bold
                       for="email"
                       required/>

                <TextInput id="email"
                           v-model="form.email"
                           autocomplete="email"
                           border
                           class="my-1"
                           full
                           type="email"/>
                <InputError :message="form.errors.email"/>
            </div>

            <div class="mt-4">
                <Label :value="trans('validation.attributes.password')"
                       block
                       bold
                       for="password"
                       required/>

                <PasswordInput id="password"
                               v-model="form.password"
                               autocomplete="new-password"
                               border
                               class="my-1"
                               full/>
                <InputError :message="form.errors.password"/>
            </div>

            <div class="mt-4">
                <Label :value="trans('validation.attributes.password_confirmation')"
                       block
                       bold
                       for="password_confirmation"
                       required/>

                <PasswordInput id="password_confirmation"
                               v-model="form.password_confirmation"
                               autocomplete="new-password"
                               border
                               class="my-1"
                               full/>
                <InputError :message="form.errors.password_confirmation"/>
            </div>

            <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                <Label>
                    <div class="flex items-center">
                        <Checkbox v-model:checked="form.terms" name="terms"/>

                        <div class="ml-2">
                            I agree to the
                            <a :href="route('terms.show')"
                               class="underline text-sm text-gray-600 hover:text-gray-900"
                               target="_blank">
                                Terms of Service
                            </a> and
                            <a :href="route('policy.show')"
                               class="underline text-sm text-gray-600 hover:text-gray-900"
                               target="_blank">
                                Privacy Policy
                            </a>
                        </div>
                    </div>
                </Label>
            </div>

            <div class="flex items-center justify-end mt-6">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Already registered?
                </Link>

                <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="ml-4">
                    Register
                </jet-button>
            </div>
        </form>
    </AuthenticationCard>
</template>

<script>
    import Logo                from "@/Components/Logo"
    import Checkbox            from "@/Components/UI/Forms/Checkbox"
    import Label               from "@/Components/UI/Forms/Label"
    import PasswordInput       from "@/Components/UI/Forms/PasswordInput"
    import TextInput           from "@/Components/UI/Forms/TextInput"
    import useRoute            from "@/Composables/useRoute"
    import useTrans            from "@/Composables/useTrans"
    import InputError          from "@/Jetstream/InputError"
    import AuthenticationCard  from "@/Layouts/AuthenticationCard"
    import { defineComponent } from "vue"
    import JetButton           from "@/Jetstream/Button.vue"
    import {
        Head,
        Link,
        useForm,
    }                          from "@inertiajs/inertia-vue3"

    export default defineComponent({
        name: "Register",

        components: {
            Checkbox,
            PasswordInput,
            InputError,
            TextInput,
            Label,
            Logo,
            AuthenticationCard,
            Head,
            JetButton,
            Link,
        },

        setup() {
            const trans = useTrans()
            const route = useRoute()

            const form = useForm({
                full_name: "",
                email: "",
                password: "",
                password_confirmation: "",
                terms: false,
            })

            const submit = () => {
                form.post(route("register"), {
                    onFinish: () => form.reset("password", "password_confirmation"),
                })
            }

            return { trans, route, form, submit }
        },
    })
</script>
