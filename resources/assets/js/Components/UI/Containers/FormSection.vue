<template>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <SectionTitle>
            <template #title>
                <slot name="title"/>
            </template>
            <template #description>
                <slot name="description"/>
            </template>
        </SectionTitle>

        <div class="mt-5 md:mt-0 md:col-span-2">
            <form @submit.prevent="$emit('submitted')">
                <div :class="hasActions ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md'"
                     class="px-4 py-5 bg-white sm:p-6 shadow">
                    <div class="grid grid-cols-6 gap-6">
                        <slot name="form"/>
                    </div>
                </div>

                <div v-if="hasActions"
                     class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                    <slot name="actions"/>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import SectionTitle from "@/Components/UI/Containers/SectionTitle"
    import {
        computed,
        defineComponent,
    }                   from "vue"

    export default defineComponent({
        name: "FormSection",

        components: { SectionTitle },

        emits: ["submitted"],

        setup(props, { slots }) {
            const hasActions = computed(() => {
                return slots.actions !== undefined
            })

            return { hasActions }
        },
    })
</script>
