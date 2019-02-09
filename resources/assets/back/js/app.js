import axios from "axios"
import Vue   from "vue"
import "./bootstrap"

Vue.prototype.$http = axios.create()

window.Bus = new Vue({ name: "Bus" })

Vue.config.errorHandler = (err, vm, info) => {
    console.error(err, vm, info)
}

new Vue({ /* eslint-disable-line no-new */
    el: "#app",
})
