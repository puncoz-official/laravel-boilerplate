"use strict"

import route                       from "ziggy"

export default () => {
    let routes = Ziggy || {} // eslint-disable-line no-undef

    if (process.env.MIX_APP_ENV !== "local") {
        routes = require("../routes.generated")
    }

    return (name, params = undefined, absolute = undefined) => route(name, params, absolute, routes)
}
