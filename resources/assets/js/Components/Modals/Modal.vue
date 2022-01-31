<template>
    <Teleport to="body">
        <Transition leave-active-class="duration-200">
            <div v-show="show" :class="modalClass" class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50">
                <Transition enter-active-class="ease-out duration-300"
                            enter-from-class="opacity-0"
                            enter-to-class="opacity-100"
                            leave-active-class="ease-in duration-200"
                            leave-from-class="opacity-100"
                            leave-to-class="opacity-0">
                    <div v-show="show" class="fixed inset-0 transform transition-all" @click="close">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"/>
                    </div>
                </Transition>

                <Transition enter-active-class="ease-out duration-300"
                            enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            enter-to-class="opacity-100 translate-y-0 sm:scale-100"
                            leave-active-class="ease-in duration-200"
                            leave-from-class="opacity-100 translate-y-0 sm:scale-100"
                            leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    <div v-show="show"
                         :class="maxWidthClass"
                         class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto">
                        <slot/>
                    </div>
                </Transition>
            </div>
        </Transition>
    </Teleport>
</template>

<script>
    import {
        computed,
        defineComponent,
        onMounted,
        onUnmounted,
        watch,
    } from "vue"

    export default defineComponent({
        name: "Modal",

        emits: ["close"],

        props: {
            show: { type: Boolean, required: false, default: false },
            maxWidth: { type: String, required: false, default: "2xl" },
            closeable: { type: Boolean, required: false, default: true },
            modalClass: { type: String, required: false, default: "" },
        },

        setup(props, { emit }) {
            const maxWidthClass = computed(() => ({
                sm: "sm:max-w-sm",
                md: "sm:max-w-md",
                lg: "sm:max-w-lg",
                xl: "sm:max-w-xl",
                "2xl": "sm:max-w-2xl",
            }[props.maxWidth]))

            watch(() => props.show, (show) => {
                if (show) {
                    document.body.style.overflow = "hidden"
                } else {
                    document.body.style.overflow = null
                }
            }, {
                immediate: true,
            })

            const close = () => {
                if (props.closeable) {
                    emit("close")
                }
            }

            const closeOnEscape = (e) => {
                if (e.key === "Escape" && props.show) {
                    close()
                }
            }

            onMounted(() => document.addEventListener("keydown", closeOnEscape))
            onUnmounted(() => document.removeEventListener("keydown", closeOnEscape))

            return {
                maxWidthClass,
                close,
            }
        },
    })
</script>
