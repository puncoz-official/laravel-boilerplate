<template>
    <AppLayout :title="trans('modules.profile.Profile')">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ trans("modules.profile.Profile") }}
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                    <UpdateProfileInfoForm :user="$page.props.auth.user"/>

                    <SectionBorder/>
                </div>

                <div v-if="$page.props.jetstream.canUpdatePassword">
                    <UpdatePasswordForm class="mt-10 sm:mt-0"/>

                    <!--                    <jet-section-border/>-->
                </div>

                <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
                    <!--                    <two-factor-authentication-form class="mt-10 sm:mt-0"/>-->

                    <!--                    <jet-section-border/>-->
                </div>

                <!--                <logout-other-browser-sessions-form :sessions="sessions" class="mt-10 sm:mt-0"/>-->

                <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
                    <!--                    <jet-section-border/>-->

                    <!--                    <delete-user-form class="mt-10 sm:mt-0"/>-->
                </template>
            </div>
        </div>
    </AppLayout>
</template>

<script>
    import SectionBorder         from "@/Components/UI/Containers/SectionBorder"
    import useTrans              from "@/Composables/useTrans"
    import AppLayout             from "@/Layouts/AppLayout.vue"
    import UpdatePasswordForm    from "@/Pages/Profile/Partials/UpdatePasswordForm"
    import UpdateProfileInfoForm from "@/Pages/Profile/Partials/UpdateProfileInfoForm.vue"
    import { defineComponent }   from "vue"

    export default defineComponent({
        name: "Profile",

        components: {
            UpdatePasswordForm,
            SectionBorder,
            AppLayout,
            UpdateProfileInfoForm,
        },

        props: {
            sessions: { type: Array, required: false, default: () => [] },
        },

        setup() {
            const trans = useTrans()

            return {
                trans,
            }
        },
    })
</script>
