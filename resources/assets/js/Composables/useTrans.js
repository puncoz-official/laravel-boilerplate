"use strict"

import { usePage }  from "@inertiajs/inertia-vue3"
import {
    get as _get,
    isEmpty,
}                   from "lodash"
import { computed } from "vue"

export default () => {
    const page = usePage()

    return (key, replace = {}) => {
        const translations = computed(() => page.props.value.translations)
        if (!translations.value) {
            return key
        }

        let translated = _get(translations.value, key, key)

        if (!isEmpty(replace)) {
            Object.keys(replace).forEach(key => {
                translated = translated.replace(`:${key}`, replace[key])
            })
        }

        return translated
    }
}
