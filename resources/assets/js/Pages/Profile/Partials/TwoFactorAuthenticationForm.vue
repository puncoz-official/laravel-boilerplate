<template>
    <ActionSection>
        <template #title>
            Two Factor Authentication
        </template>

        <template #description>
            Add additional security to your account using two factor authentication.
        </template>

        <template #content>
            <h3 class="text-lg font-medium text-gray-900">
                <span v-if="twoFactorEnabled" v-text="'You have enabled two factor authentication.'"/>
                <span v-else v-text="'You have not enabled two factor authentication.'"/>
            </h3>

            <div class="mt-3 max-w-xl text-sm text-gray-600">
                <p>
                    When two factor authentication is enabled, you will be prompted for a secure, random token during
                    authentication. You may retrieve this token from your phone's Google Authenticator
                    application.
                </p>
            </div>

            <div v-if="twoFactorEnabled">
                <div v-if="qrCode">
                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            Two factor authentication is now enabled. Scan the following QR code using your phone's
                            authenticator application.
                        </p>
                    </div>

                    <div class="mt-4" v-html="qrCode"/>
                </div>

                <div v-if="recoveryCodes.length > 0">
                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            Store these recovery codes in a secure password manager. They can be used to recover access
                            to your account if your two factor authentication device is lost.
                        </p>
                    </div>

                    <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                        <div v-for="code in recoveryCodes" :key="code">
                            {{ code }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <div v-if="!twoFactorEnabled">
                    <ConfirmsPassword @confirmed="enableTwoFactorAuthentication">
                        <template #default="slotProps">
                            <PrimaryButton :loading="slotProps.loading" type="button" @click="slotProps.click">
                                Enable
                            </PrimaryButton>
                        </template>
                    </ConfirmsPassword>
                </div>

                <div v-else>
                    <ConfirmsPassword @confirmed="regenerateRecoveryCodes">
                        <template #default="slotProps">
                            <SecondaryButton v-if="recoveryCodes.length > 0"
                                             :loading="slotProps.loading"
                                             class="mr-3"
                                             @click="slotProps.click">
                                Regenerate Recovery Codes
                            </SecondaryButton>
                        </template>
                    </ConfirmsPassword>

                    <ConfirmsPassword @confirmed="showRecoveryCodes">
                        <template #default="slotProps">
                            <SecondaryButton v-if="recoveryCodes.length === 0"
                                             :loading="slotProps.loading"
                                             class="mr-3"
                                             @click="slotProps.click">
                                Show Recovery Codes
                            </SecondaryButton>
                        </template>
                    </ConfirmsPassword>

                    <ConfirmsPassword @confirmed="disableTwoFactorAuthentication">
                        <template #default="slotProps">
                            <DangerButton :loading="slotProps.loading" @click="slotProps.click">
                                Disable
                            </DangerButton>
                        </template>
                    </ConfirmsPassword>
                </div>
            </div>
        </template>
    </ActionSection>
</template>

<script>
    import ConfirmsPassword from "@/Components/Modals/ConfirmsPassword"
    import DangerButton     from "@/Components/UI/Buttons/DangerButton"
    import PrimaryButton    from "@/Components/UI/Buttons/PrimaryButton"
    import SecondaryButton  from "@/Components/UI/Buttons/SecondaryButton"
    import ActionSection    from "@/Components/UI/Containers/ActionSection"
    import useApi           from "@/Composables/useApi"
    import useState         from "@/Composables/useState"
    import { Inertia }      from "@inertiajs/inertia"
    import { usePage }      from "@inertiajs/inertia-vue3"
    import {
        computed,
        defineComponent,
    }                       from "vue"

    export default defineComponent({
        name: "TwoFactorAuthentication",

        components: { DangerButton, SecondaryButton, PrimaryButton, ConfirmsPassword, ActionSection },

        setup() {
            const page = usePage()
            const api = useApi()

            const [enabling, setEnabling] = useState(false)
            const [disabling, setDisabling] = useState(false)

            const [qrCode, setQrCode] = useState(false)
            const [recoveryCodes, setRecoveryCodes] = useState([])

            const twoFactorEnabled = computed(() => !enabling.value && page.props.value.auth.user.two_factor_enabled)

            const showQrCode = async () => {
                // @todo route name is not available in jetstream package
                const { body } = await api.get("/user/two-factor-qr-code")

                setQrCode(body.svg)
            }

            const showRecoveryCodes = async () => {
                // @todo route name is not available in vendor package
                const { body } = await api.get("/user/two-factor-recovery-codes")

                setRecoveryCodes(body)
            }

            const enableTwoFactorAuthentication = () => {
                setEnabling(true)
                // @todo route name is not available in vendor package
                Inertia.post("/user/two-factor-authentication", {}, {
                    preserveScroll: true,
                    onSuccess: () => Promise.all([
                        showQrCode(),
                        showRecoveryCodes(),
                    ]).then(() => {
                        setEnabling(false)
                    }),
                })
            }

            const regenerateRecoveryCodes = async () => {
                // @todo route name is not available in vendor package
                await api.post("/user/two-factor-recovery-codes")

                await showRecoveryCodes()
            }

            const disableTwoFactorAuthentication = () => {
                setDisabling(true)

                // @todo route name is not available in vendor package
                Inertia.delete("/user/two-factor-authentication", {
                    preserveScroll: true,
                    onSuccess: () => {
                        setDisabling(false)
                    },
                })
            }

            return {
                enabling,
                disabling,
                qrCode,
                recoveryCodes,
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
