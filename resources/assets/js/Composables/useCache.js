"use strict"
import {
    get as _get,
    has as _has,
    set as _set,
} from "lodash"

import { ref } from "vue"

export default () => {
    const cache = ref({})

    const has = (key) => _has(cache, key)
    const get = (key) => _get(cache, key)
    const set = (key, value) => _set(cache, key, value)
    const del = (key) => {
        delete cache[key]
    }

    return { has, get, set, del }
}
