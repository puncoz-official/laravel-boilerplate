"use strict"

import { createInertiaApp } from "@inertiajs/inertia-vue3"
import {
    createApp,
    h,
}                           from "vue"
import Bootstrap            from "./Bootstrap"

(async () => {
    const appName = document.getElementsByTagName("title")[0]?.innerText || "Laravel"

    await createInertiaApp({
        title: (title) => `${title} - ${appName}`,
        resolve: async (name) => await import(`./Pages/${name}`),
        setup: ({ el, app: InertiaApp, props, plugin: InertiaPlugin }) => {
            const app = createApp({
                render: () => h(InertiaApp, props),
            })

            app.use(InertiaPlugin)
            Bootstrap(app)

            app.mount(el)
        },
    })
})()
