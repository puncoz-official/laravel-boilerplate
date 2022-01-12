"use strict"

import route                       from "ziggy"
import { Ziggy as ZiggyGenerated } from "../routes.generated"

export default () => {
    const routes = Ziggy || ZiggyGenerated // eslint-disable-line no-undef

    return (name, params = undefined, absolute = undefined) => route(name, params, absolute, routes)
}
