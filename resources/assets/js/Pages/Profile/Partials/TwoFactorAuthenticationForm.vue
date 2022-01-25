<template>
    <jet-action-section>
        <template #title>
            Two Factor Authentication
        </template>

        <template #description>
            Add additional security to your account using two factor authentication.
        </template>

        <template #content>
            <h3 v-if="twoFactorEnabled" class="text-lg font-medium text-gray-900">
                You have enabled two factor authentication.
            </h3>

            <h3 v-else class="text-lg font-medium text-gray-900">
                You have not enabled two factor authentication.
            </h3>

            <div class="mt-3 max-w-xl text-sm text-gray-600">
                <p>
                    When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator
                    application.
                </p>
            </div>

            <div v-if="twoFactorEnabled">
                <div v-if="data.qrCode">
                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            Two factor authentication is now enabled. Scan the following QR code using your phone's authenticator application.
                        </p>
                    </div>

                    <div class="mt-4" v-html="data.qrCode"/>
                </div>

                <div v-if="data.recoveryCodes.length > 0">
                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.
                        </p>
                    </div>

                    <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                        <div v-for="code in data.recoveryCodes" :key="code">
                            {{ code }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <div v-if="! twoFactorEnabled">
                    <jet-confirms-password @confirmed="enableTwoFactorAuthentication">
                        <jet-button type="button" :class="{ 'opacity-25': data.enabling }" :disabled="data.enabling">
                            Enable
                        </jet-button>
                    </jet-confirms-password>
                </div>

                <div v-else>
                    <jet-confirms-password @confirmed="regenerateRecoveryCodes">
                        <jet-secondary-button v-if="data.recoveryCodes.length > 0"
                                              class="mr-3">
                            Regenerate Recovery Codes
                        </jet-secondary-button>
                    </jet-confirms-password>

                    <jet-confirms-password @confirmed="showRecoveryCodes">
                        <jet-secondary-button v-if="data.recoveryCodes.length === 0" class="mr-3">
                            Show Recovery Codes
                        </jet-secondary-button>
                    </jet-confirms-password>

                    <jet-confirms-password @confirmed="disableTwoFactorAuthentication">
                        <jet-danger-button :class="{ 'opacity-25': data.disabling }"
                                           :disabled="data.disabling">
                            Disable
                        </jet-danger-button>
                    </jet-confirms-password>
                </div>
            </div>
        </template>
    </jet-action-section>
</template>

<script>
    import useApi              from "@/Composables/useApi"
    import JetActionSection    from "@/Jetstream/ActionSection.vue"
    import JetButton           from "@/Jetstream/Button.vue"
    import JetConfirmsPassword from "@/Jetstream/ConfirmsPassword.vue"
    import JetDangerButton     from "@/Jetstream/DangerButton.vue"
    import JetSecondaryButton  from "@/Jetstream/SecondaryButton.vue"
    import { Inertia }         from "@inertiajs/inertia"
    import { usePage } from "@inertiajs/inertia-vue3"
    import {
        computed,
        defineComponent,
        reactive,
    }                  from "vue"

    export default defineComponent({
        components: {
            JetActionSection,
            JetButton,
            JetConfirmsPassword,
            JetDangerButton,
            JetSecondaryButton,
        },

        setup(props) {
            const page = usePage()
            const Api = useApi()

            const data = reactive({
                enabling: false,
                disabling: false,

                qrCode: null,
                recoveryCodes: [],
            })

            const twoFactorEnabled = computed(() => !data.enabling && page.props.value.user.two_factor_enabled)

            const enableTwoFactorAuthentication = () => {
                data.enabling = true
                // @todo route name is not available in vendor package
                Inertia.post("/user/two-factor-authentication", {}, {
                    preserveScroll: true,
                    onSuccess: page => {
                        Promise.all([
                            showQrCode(),
                            showRecoveryCodes(),
                        ]).then(() => { data.enabling = false })
                    },
                })
            }

            const showQrCode = async () => {
                // @todo route name is not available in vendor package
                const response = await Api.get("/user/two-factor-qr-code")

                data.qrCode = response.body.svg
            }

            const showRecoveryCodes = async () => {
                // @todo route name is not available in vendor package
                const response = await Api.get("/user/two-factor-recovery-codes")

                data.recoveryCodes = response.body
            }

            const regenerateRecoveryCodes = async () => {
                // @todo route name is not available in vendor package
                await Api.post("/user/two-factor-recovery-codes")
                await showRecoveryCodes()
            }

            const disableTwoFactorAuthentication = () => {
                data.disabling = true

                // @todo route name is not available in vendor package
                Inertia.delete("/user/two-factor-authentication", {
                    preserveScroll: true,
                    onSuccess: () => { data.disabling = false },
                })
            }

            return {
                data,
                twoFactorEnabled,
                enableTwoFactorAuthentication,
                disableTwoFactorAuthentication,
                regenerateRecoveryCodes,
                showRecoveryCodes,
                showQrCode,
            }
        },
    })
</script>
