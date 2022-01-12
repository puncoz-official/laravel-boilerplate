"use strict"

import InitHttp            from "@/Bootstrap/InitHttp"
import { InertiaProgress } from "@inertiajs/progress"

/**
 * @param {App} app
 * @constructor
 */
export default (app) => {
    InitHttp(app)

    InertiaProgress.init({ color: "#4B5563" })

    app.config.errorHandler = (err, vm, info) => {
        console.error(err, vm, info)
    }
}
