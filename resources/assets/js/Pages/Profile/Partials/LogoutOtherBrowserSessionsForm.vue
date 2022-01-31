<template>
    <ActionSection>
        <template #title>
            Browser Sessions
        </template>

        <template #description>
            Manage and log out your active sessions on other browsers and devices.
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600">
                If necessary, you may log out of all of your other browser sessions across all of your devices. Some of
                your recent sessions are listed below; however, this list may not be exhaustive.
                If you feel your account has been compromised, you should also update your password.
            </div>

            <!-- Other Browser Sessions -->
            <div v-if="sessions.length > 0" class="mt-5 space-y-6">
                <div v-for="(session, sessIndex) in sessions" :key="sessIndex" class="flex items-center">
                    <div>
                        <DesktopComputerIcon v-if="session.agent.is_desktop" class="w-6 h-6 text-gray-600"/>
                        <DeviceMobileIcon v-else class="w-6 h-6 text-gray-600"/>
                    </div>

                    <div class="ml-3">
                        <div class="text-sm text-gray-600">
                            {{ session.agent.platform ?? "Unknown" }} - {{ session.agent.browser ?? "Unknown" }}
                        </div>

                        <div>
                            <div class="text-xs text-gray-500">
                                {{ session.ip_address }},

                                <span v-if="session.is_current_device"
                                      class="text-green-500 font-semibold">
                                    This device
                                </span>
                                <span v-else>Last active {{ session.last_active }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center mt-5">
                <ConfirmsPassword :emit-password="true"
                                  :force-password="true"
                                  content="Please enter your password to confirm you would like to log out of your other browser sessions across all of your devices."
                                  title="Log Out Other Browser Sessions"
                                  @confirmed="logoutOtherBrowserSessions">
                    <template #default="slotProps">
                        <DangerButton :loading="slotProps.loading" @click="slotProps.click">
                            Log Out Other Browser Sessions
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
    import {
        DesktopComputerIcon,
        DeviceMobileIcon,
    }                          from "@heroicons/vue/outline"
    import { useForm }         from "@inertiajs/inertia-vue3"
    import { defineComponent } from "vue"

    export default defineComponent({
        name: "LogoutOtherBrowserSessionsForm",

        components: { DangerButton, ConfirmsPassword, ActionSection, DeviceMobileIcon, DesktopComputerIcon },

        props: {
            sessions: { type: Array, required: false, default: () => [] },
        },

        setup() {
            const route = useRoute()

            const form = useForm({
                password: "",
            })

            const logoutOtherBrowserSessions = (password) => {
                form.transform((data) => {
                    data.password = password

                    return data
                }).delete(route("other-browser-sessions.destroy"), {
                    preserveScroll: true,
                    onFinish: () => {
                        form.reset()
                    },
                })
            }

            return {
                logoutOtherBrowserSessions,
            }
        },
    })
</script>
