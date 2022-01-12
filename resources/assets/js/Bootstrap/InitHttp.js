"use strict"

import Axios from "axios"

/**
 * @param {App} app
 */
export default (app) => {
    Axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest"

    app.config.globalProperties.$http = Axios.create()
}
