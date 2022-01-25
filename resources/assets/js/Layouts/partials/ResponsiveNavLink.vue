<template>
    <div>
        <button v-if="as === 'button'" :class="classes" class="w-full text-left">
            <slot/>
        </button>

        <Link v-else :class="classes" :href="href">
            <slot/>
        </Link>
    </div>
</template>

<script>
    import { Link } from "@inertiajs/inertia-vue3"
    import {
        computed,
        defineComponent,
    }               from "vue"

    export default defineComponent({
        name: "ResponsiveNavLink",

        components: {
            Link,
        },

        props: {
            active: { type: Boolean, required: false, default: false },
            href: { type: String, required: false, default: "#" },
            as: { type: String, required: false, default: "button" },
        },

        setup(props) {
            const classes = computed(() => {
                return [
                    ["block pl-3 pr-4 py-2 border-l-4 text-base font-medium focus:outline-none transition"],
                    [
                        props.active
                            ? "border-primary-400 text-primary-700 bg-primary-50 focus:text-primary-800 focus:bg-primary-100 focus:border-primary-700"
                            : "border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300",
                    ],
                ]
            })

            return {
                classes,
            }
        },
    })
</script>
