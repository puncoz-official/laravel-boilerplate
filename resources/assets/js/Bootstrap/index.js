"use strict"

import InitHttp            from "@/Bootstrap/InitHttp"
import { InertiaProgress } from "@inertiajs/progress"
import mitt                from "mitt"

/**
 * @param {App} app
 * @constructor
 */
export default (app) => {
    InitHttp(app)

    InertiaProgress.init({ color: "#F8D22C" })
    app.provide("emitter", mitt())

    app.config.errorHandler = (err, vm, info) => {
        console.error(err, vm, info)
    }
}
