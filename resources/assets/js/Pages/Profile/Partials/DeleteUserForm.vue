<template>
    <ActionSection>
        <template #title>
            Delete Account
        </template>

        <template #description>
            Permanently delete your account.
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600">
                Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting
                your account, please download any data or information that you wish to retain.
            </div>

            <div class="mt-5">
                <ConfirmsPassword :emit-password="true"
                                  :force-password="true"
                                  content="Please enter your password to confirm you would like to log out of your other browser sessions across all of your devices."
                                  title="Log Out Other Browser Sessions"
                                  @confirmed="deleteUser">
                    <template #default="slotProps">
                        <DangerButton :loading="slotProps.loading" @click="slotProps.click">
                            Delete Account
                        </DangerButton>
                    </template>
                </ConfirmsPassword>
            </div>
        </template>
    </ActionSection>
</template>

<script>
    import ConfirmsPassword    from "@/Components/Modals/ConfirmsPassword"
    import DangerButton        from "@/Components/UI/Buttons/DangerButton"
    import ActionSection       from "@/Components/UI/Containers/ActionSection"
    import useRoute            from "@/Composables/useRoute"
    import { useForm }         from "@inertiajs/inertia-vue3"
    import { defineComponent } from "vue"

    export default defineComponent({
        name: "DeleteUserForm",

        components: { ConfirmsPassword, DangerButton, ActionSection },

        setup() {
            const route = useRoute()

            const form = useForm({
                password: "",
            })

            const deleteUser = (password) => {
                form.transform((data) => {
                    data.password = password

                    return data
                }).delete(route("current-user.destroy"), {
                    preserveScroll: true,
                    onFinish: () => {
                        form.reset()
                    },
                })
            }

            return {
                deleteUser,
            }
        },
    })
</script>
