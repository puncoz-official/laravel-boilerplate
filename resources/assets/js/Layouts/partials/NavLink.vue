<template>
    <Link :class="{
              'border-primary-400 text-gray-900 focus:border-primary-700': active,
              'border-transparent text-gray-500 focus:border-gray-300 hover:text-gray-700 hover:border-gray-300 focus:text-gray-700': !active
          }"
          :href="href"
          class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 focus:outline-none transition">
        <slot/>
    </Link>
</template>

<script>
    import { Link }            from "@inertiajs/inertia-vue3"
    import { defineComponent } from "vue"

    export default defineComponent({
        name: "NavLink",

        components: {
            Link,
        },

        props: {
            href: { type: String, required: true },
            active: { type: Boolean, required: false, default: false },
        },
    })
</script>
