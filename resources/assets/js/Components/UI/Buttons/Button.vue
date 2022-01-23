<template>
    <button v-if="linkComponent === 'button'"
            :class="{
                'w-full': full,
                'rounded-full': rounded,
                'rounded-md': !rounded,
                'p-4': large,
                'py-2 px-6': !large,
                'shadow-lg': large && shadow,
                'shadow-sm': !large && shadow,
                'opacity-50': loading || disabled,
                'opacity-50 cursor-wait': loading
            }"
            :disabled="isDisabled"
            :type="type"
            class="tracking-wide text-sm font-semibold font-display
                focus:outline-none focus:shadow-outline"
            v-bind="$attrs">
        <slot/>
    </button>

    <component :is="linkComponent"
               v-else
               :as="as"
               :class="{
                   'w-full': full,
                   'rounded-full': rounded,
                   'rounded-md': !rounded,
                   'p-4': large,
                   'py-2 px-6': !large,
                   'shadow-lg': large && shadow,
                   'shadow-sm': !large && shadow,
                   'opacity-50': loading || disabled,
                   'opacity-50 cursor-wait': loading
               }"
               :data="data"
               :href="href"
               :method="method"
               class="tracking-wide text-sm font-semibold font-display
                    focus:outline-none focus:shadow-outline"
               v-bind="$attrs">
        <slot/>
    </component>
</template>

<script>
    import { computed } from "vue"

    export default {
        name: "ButtonComponent",

        props: {
            inertiaLink: { type: Boolean, required: false, default: true },
            type: { type: String, required: false, default: "button" },
            as: { type: String, required: false, default: "a" },
            method: { type: String, required: false, default: "get" },
            href: { type: String, required: false, default: null },
            data: { type: [Object], required: false, default: () => ({}) },
            full: { type: Boolean, required: false, default: false },
            shadow: { type: Boolean, required: false, default: false },
            rounded: { type: Boolean, required: false, default: false },
            large: { type: Boolean, required: false, default: false },
            disabled: { type: Boolean, required: false, default: false },
            loading: { type: Boolean, required: false, default: false },
        },

        setup(props) {
            const linkComponent = computed(() => props.href ? (props.inertiaLink ? "inertia-link" : "a") : "button")

            const isDisabled = computed(() => props.disabled || props.loading)

            return { linkComponent, isDisabled }
        },
    }
</script>
