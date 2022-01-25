"use strict"

import {
    readonly,
    ref,
} from "vue"

export default (initialState) => {
    const state = ref(initialState)

    const setState = (newState) => {
        state.value = newState
    }

    return [readonly(state), setState]
}
