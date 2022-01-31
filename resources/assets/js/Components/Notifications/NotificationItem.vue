<template>
    <div :class="{
             'bg-green-500' : notification.type === 'success',
             'bg-red-500' : notification.type === 'error',
             'bg-yellow-500' : notification.type === 'warning',
             'bg-blue-500' : notification.type === 'info',
             'bg-primary-500' : notification.type === 'message',
         }"
         class="flex items-center rounded p-3 shadow-md mb-2 w-64">
        <div class="flex-1 flex items-center">
            <!-- icons -->
            <div class="text-white mr-3">
                <template v-if="notification.type === 'success'">
                    <CheckCircleIcon class="h-5 w-5"/>
                </template>

                <template v-else-if="notification.type === 'error'">
                    <ExclamationCircleIcon class="h-5 w-5"/>
                </template>

                <template v-else-if="notification.type === 'warning'">
                    <ExclamationIcon class="h-5 w-5"/>
                </template>

                <template v-else-if="notification.type === 'info'">
                    <InformationCircleIcon class="h-5 w-5"/>
                </template>

                <template v-else>
                    <InformationCircleIcon class="h-5 w-5"/>
                </template>
            </div>

            <!-- message -->
            <div class="text-white max-w-xs" v-text="notification.message"/>
        </div>

        <ButtonComponent class="py-1 px-1 text-white hover:opacity-75" @click.prevent="handleClose">
            <XIcon class="h-4" solid/>
        </ButtonComponent>
    </div>
</template>

<script>
    import ButtonComponent from "@/Components/UI/Buttons/Button"
    import {
        CheckCircleIcon,
        ExclamationCircleIcon,
        ExclamationIcon,
        InformationCircleIcon,
        XIcon,
    }                      from "@heroicons/vue/solid"

    export default {
        name: "NotificationItem",

        components: {
            ButtonComponent,
            InformationCircleIcon,
            ExclamationIcon,
            ExclamationCircleIcon,
            CheckCircleIcon,
            XIcon,
        },

        props: {
            notification: { type: Object, required: true },
        },

        emits: ["close"],

        setup(props, { emit }) {
            const handleClose = () => {
                emit("close", props.notification.id)
            }

            setTimeout(handleClose, 10000)

            return { handleClose }
        },
    }
</script>
