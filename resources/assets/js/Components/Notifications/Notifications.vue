<template>
    <div class="fixed right-[20px] top-[20px] z-[100]">
        <NotificationItem v-for="notification in notifications"
                          :key="notification.id"
                          :notification="notification"
                          @close="handleOnClose"/>
    </div>
</template>

<script type="text/ecmascript-6">
    import NotificationItem from "@/Components/Notifications/NotificationItem"
    import useState         from "@/Composables/useState"
    import { usePage }      from "@inertiajs/inertia-vue3"
    import {
        inject,
        watch,
    }                       from "vue"

    export default {
        name: "Notifications",

        components: { NotificationItem },

        setup() {
            const page = usePage()
            const [notifications, setNotifications] = useState([])
            const emitter = inject("emitter")

            watch(() => page.props.value.flash, (flash) => {
                const flashList = Object.entries(flash).reduce((list, [type, message], index) => {
                    if (!message) {
                        return list
                    }

                    return [...list, { type, message, id: `${Date.now()}-${index}` }]
                }, [])

                setNotifications([...notifications.value, ...flashList])
            }, {
                immediate: true,
            })

            emitter.on("notification", (obj) => {
                setNotifications([
                    ...notifications.value, {
                        ...obj,
                        id: Date.now(),
                    }])
            })

            const handleOnClose = (id) => {
                setNotifications(notifications.value.filter(notification => notification.id !== id))
            }

            return { notifications, handleOnClose }
        },
    }
</script>
