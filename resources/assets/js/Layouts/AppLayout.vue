<template>
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
    import useRoute            from "@/Composables/useRoute"
    import useState            from "@/Composables/useState"
    import NavBar              from "@/Layouts/partials/NavBar"
    import { Head }            from "@inertiajs/inertia-vue3"
    import { defineComponent } from "vue"

    export default defineComponent({
        name: "MainLayout",

        components: {
            NavBar,
            Head,
        },

        props: {
            title: { type: String, required: false, default: "" },
        },

        setup() {
            const route = useRoute()

            const [showingNavigationDropdown] = useState(false)

            const switchToTeam = function(team) {
                this.$inertia.put(route("current-team.update"), {
                    team_id: team.id,
                }, {
                    preserveState: false,
                })
            }



            return {
                route,
                showingNavigationDropdown,
                switchToTeam,
                logout,
            }
        },
    })
</script>
