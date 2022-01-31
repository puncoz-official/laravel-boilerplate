<template>
    <Notifications/>

    <div>
        <Head :title="title"/>

        <div class="min-h-screen bg-gray-100">
            <NavBar/>

            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header"/>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot/>
            </main>
        </div>
    </div>
</template>

<script>
    import Notifications       from "@/Components/Notifications/Notifications"
    import useRoute            from "@/Composables/useRoute"
    import NavBar              from "@/Layouts/partials/NavBar"
    import { Head }            from "@inertiajs/inertia-vue3"
    import { defineComponent } from "vue"

    export default defineComponent({
        name: "MainLayout",

        components: {
            Notifications,
            NavBar,
            Head,
        },

        props: {
            title: { type: String, required: false, default: "" },
        },

        setup() {
            const route = useRoute()

            return {
                route,
            }
        },
    })
</script>
