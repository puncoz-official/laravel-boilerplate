<template>
    <AppLayout :title="trans('modules.dashboard.title')">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ trans("modules.dashboard.title") }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Welcome/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
    import useTrans            from "@/Composables/useTrans"
    import Welcome             from "@/Jetstream/Welcome.vue"
    import AppLayout           from "@/Layouts/AppLayout"
    import { defineComponent } from "vue"

    export default defineComponent({
        name: "Dashboard",

        components: {
            AppLayout,
            Welcome,
        },

        setup() {
            const trans = useTrans()

            return { trans }
        },
    })
</script>
