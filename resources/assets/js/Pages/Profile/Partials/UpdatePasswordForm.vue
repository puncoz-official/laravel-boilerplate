<template>
    <FormSection @submitted="updatePassword">
        <template #title>
            Update Password
        </template>

        <template #description>
            Ensure your account is using a long, random password to stay secure.
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <Label :value="trans('validation.attributes.current_password')" for="current_password" required/>

                <PasswordInput id="current_password"
                               ref="oldPasswordInput"
                               v-model="form.current_password"
                               autocomplete="current-password"
                               border
                               full/>

                <InputError :message="form.errors.current_password"/>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <Label :value="trans('validation.attributes.password')" for="password" required/>

                <PasswordInput id="password"
                               ref="newPasswordInput"
                               v-model="form.password"
                               autocomplete="new-password"
                               border
                               full/>

                <InputError :message="form.errors.password"/>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <Label :value="trans('validation.attributes.password_confirmation')" for="password" required/>

                <PasswordInput id="password_confirmation"
                               v-model="form.password_confirmation"
                               autocomplete="new-password"
                               border
                               full/>

                <InputError :message="form.errors.password_confirmation"/>
            </div>
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </ActionMessage>

            <PrimaryButton :loading="form.processing" type="submit">
                {{ trans("general.actions.save") }}
            </PrimaryButton>
        </template>
    </FormSection>
</template>

<script>
    import PrimaryButton from "@/Components/UI/Buttons/PrimaryButton"
    import FormSection   from "@/Components/UI/Containers/FormSection"
    import ActionMessage from "@/Components/UI/Forms/ActionMessage"
    import InputError    from "@/Components/UI/Forms/InputError"
    import Label         from "@/Components/UI/Forms/Label"
    import PasswordInput from "@/Components/UI/Forms/PasswordInput"
    import useRoute      from "@/Composables/useRoute"
    import useTrans      from "@/Composables/useTrans"
    import { useForm }   from "@inertiajs/inertia-vue3"
    import {
        defineComponent,
        ref,
    }                    from "vue"

    export default defineComponent({
        name: "UpdatePasswordForm",

        components: { PrimaryButton, ActionMessage, InputError, PasswordInput, Label, FormSection },

        setup() {
            const trans = useTrans()
            const route = useRoute()

            const oldPasswordInput = ref(null)
            const newPasswordInput = ref(null)

            const form = useForm({
                current_password: "",
                password: "",
                password_confirmation: "",
            })

            const updatePassword = () => {
                form.put(route("user-password.update"), {
                    errorBag: "updatePassword",
                    preserveScroll: true,
                    onSuccess: () => form.reset(),
                    onError: () => {
                        if (form.errors.password) {
                            form.reset("password", "password_confirmation")
                            newPasswordInput.value?.focus()
                        }

                        if (form.errors.current_password) {
                            form.reset("current_password")
                            oldPasswordInput.value?.focus()
                        }
                    },
                })
            }

            return {
                trans,
                form,
                updatePassword,
            }
        },
    })
</script>
