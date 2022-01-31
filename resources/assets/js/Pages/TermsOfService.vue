<template>
    <Head title="Terms of Service"/>

    <div class="font-sans text-gray-900 antialiased">
        <div class="pt-4 bg-gray-100">
            <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
                <div>
                    <Logo/>
                </div>

                <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose"
                     v-html="terms"/>
            </div>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from "vue"
    import { Head }            from "@inertiajs/inertia-vue3"
    import Logo                from "@/Components/Logo"

    export default defineComponent({
        name: "TermsOfService",

        components: {
            Head,
            Logo,
        },

        props: {
            terms: { type: String, required: true },
        },
    })
</script>
