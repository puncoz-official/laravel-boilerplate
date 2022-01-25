<template>
    <div>
        <button v-if="as === 'button'"
                class="block w-full px-4 py-2 text-sm leading-5 text-gray-700 text-left hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition"
                type="submit">
            <slot/>
        </button>

        <a v-else-if="as === 'a'"
           :href="href"
           class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition">
            <slot/>
        </a>

        <Link v-else
              :href="href"
              class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition">
            <slot/>
        </Link>
    </div>
</template>

<script>
    import { Link }            from "@inertiajs/inertia-vue3"
    import { defineComponent } from "vue"

    export default defineComponent({
        name: "DropdownLink",

        components: {
            Link,
        },

        props: {
            href: { type: String, required: false, default: null },
            as: { type: String, required: false, default: "a" },
        },
    })
</script>
