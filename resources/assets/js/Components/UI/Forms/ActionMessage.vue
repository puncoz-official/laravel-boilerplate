<template>
    <div>
        <transition leave-active-class="transition ease-in duration-1000"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0">
            <div v-show="on" class="text-sm text-gray-600">
                <slot/>
            </div>
        </transition>
    </div>
</template>

<script>
    import { defineComponent } from "vue"

    export default defineComponent({
        name: "ActionMessage",

        props: {
            on: { type: Boolean, required: false, default: false },
        },
    })
</script>
