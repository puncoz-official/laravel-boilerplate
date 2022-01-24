<template>
    <Head :title="trans('auth.Login')"/>

    <AuthenticationCard>
        <template #logo>
            <Logo/>
        </template>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <Label :value="trans('validation.attributes.email')" block bold for="email"/>
                <TextInput id="email"
                           v-model="form.email"
                           autocomplete="email"
                           autofocus
                           border
                           class="my-1"
                           full
                           type="email"/>
                <InputError :message="form.errors.email"/>
            </div>

            <div class="mt-4">
                <Label :value="trans('validation.attributes.password')" block bold for="password"/>
                <PasswordInput id="password"
                               v-model="form.password"
                               autocomplete="current-password"
                               autofocus
                               border
                               class="my-1"
                               full/>
                <InputError :message="form.errors.password"/>
            </div>

            <div class="block mt-4">
                <Label>
                    <Checkbox v-model:checked="form.remember" name="remember"/>
                    <span class="ml-2 text-sm text-gray-600" v-text="trans('auth.Remember me')"/>
                </Label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link v-if="canResetPassword"
                      :href="route('password.request')"
                      class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ trans("auth.Forgot password") }}
                </Link>

                <PrimaryButton :loading="form.processing" class="ml-4" type="submit">
                    {{ trans("auth.Login") }}
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>

<script>
    import Logo                from "@/Components/Logo"
    import PrimaryButton       from "@/Components/UI/Buttons/PrimaryButton"
    import Checkbox            from "@/Components/UI/Forms/Checkbox"
    import Label               from "@/Components/UI/Forms/Label"
    import PasswordInput       from "@/Components/UI/Forms/PasswordInput"
    import TextInput           from "@/Components/UI/Forms/TextInput"
    import useRoute            from "@/Composables/useRoute"
    import useTrans            from "@/Composables/useTrans"
    import InputError          from "@/Jetstream/InputError"
    import AuthenticationCard  from "@/Layouts/AuthenticationCard"
    import { defineComponent } from "vue"
    import {
        Head,
        Link,
        useForm,
    }                          from "@inertiajs/inertia-vue3"

    export default defineComponent({
        name: "Login",

        components: {
            PrimaryButton,
            PasswordInput,
            Checkbox,
            InputError,
            TextInput,
            Label,
            Logo,
            AuthenticationCard,
            Head,
            Link,
        },

        props: {
            canResetPassword: { type: Boolean, required: false, default: false },
            status: { type: String, required: false, default: "" },
        },

        setup() {
            const route = useRoute()
            const trans = useTrans()

            const form = useForm({
                email: "",
                password: "",
                remember: false,
            })

            const submit = () => {
                form
                    .transform(data => ({
                        ...data,
                        remember: form.remember ? "on" : "",
                    }))
                    .post(route("login"), {
                        onFinish: () => form.reset("password"),
                    })
            }

            return {
                route,
                trans,
                form,
                submit,
            }
        },
    })
</script>
