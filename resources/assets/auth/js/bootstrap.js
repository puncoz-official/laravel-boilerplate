import * as axios from "axios"

try {
    window.Popper = require("popper.js").default
    window.$ = window.jQuery = require("jquery")

    require("bootstrap")
} catch (e) {
    console.error(e)
}

axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest"

let token = document.head.querySelector("meta[name='csrf-token']")

if (token) {
    axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content
} else {
    console.error("CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token")
}
