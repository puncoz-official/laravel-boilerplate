"use strict"

import { inject } from "vue"

export default () => {
    const emitter = inject("emitter")

    return {
        success: (message) => {
            emitter.emit("notification", { type: "success", message })
        },

        error: (message) => {
            emitter.emit("notification", { type: "error", message })
        },

        warning: (message) => {
            emitter.emit("notification", { type: "warning", message })
        },

        info: (message) => {
            emitter.emit("notification", { type: "info", message })
        },

        message: (message) => {
            emitter.emit("notification", { type: "message", message })
        },
    }
}
