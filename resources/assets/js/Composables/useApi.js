"use strict"
import useCache   from "@/Composables/useCache"
import Http       from "axios"
import qs         from "qs"
import { inject } from "vue"

export default () => {
    const cache = useCache()
    const emitter = inject("emitter")

    const startLoading = () => {
        emitter.emit("start-loader")
    }
    const stopLoading = () => {
        emitter.emit("stop-loader")
    }

    const response = ({ data, status, headers }) => {
        return {
            body: data,
            status,
            headers,
        }
    }

    const successResponse = (res) => {
        stopLoading()

        return response(res)
    }

    const errorResponse = (error) => {
        stopLoading()

        let message = get(error, "response.data.message", null)
        message = message ||
            (error.response.status === 404 ? "Page not found." : "An error occurred. Please contact administrator.")

        emitter.emit("toast-notification", {
            type: "error",
            message: message,
        })

        throw error
    }

    const get = async (resource, params = {}, options = {}) => {
        const { customResponse, cacheEnable, showLoader } = {
            customResponse: true,
            cacheEnable: false,
            showLoader: true,
            ...options,
        }

        if (showLoader) {
            startLoading()
        }

        const config = {
            headers: {
                "Content-Type": "application/x-www-form-urlencoded;charset=utf-8",
            },
            params,
        }

        try {
            let res = {}
            const key = encodeURIComponent(resource + JSON.stringify(params))

            if (cacheEnable && cache.has(key)) {
                res = cache.get(key)
            } else {
                res = await Http.get(resource, config)
                cache.set(key, res)
            }

            if (!customResponse) {
                return res
            }

            return successResponse(res)
        } catch (error) {
            return errorResponse(error)
        }
    }

    const post = async (resource, params = {}, options = {}) => {
        const { customResponse, processParams, contentType, showLoader } = {
            customResponse: true,
            processParams: true,
            contentType: null,
            showLoader: true,
            ...options,
        }

        if (showLoader) { startLoading() }

        const config = {
            headers: {
                "Content-Type": contentType || "application/x-www-form-urlencoded;charset=utf-8",
            },
        }

        try {
            const response = await Http.post(
                resource,
                processParams ? qs.stringify(params) : params,
                config,
            )

            if (!customResponse) {
                return response
            }

            return successResponse(response)
        } catch (error) {
            return errorResponse(error)
        }
    }

    const put = async (resource, params = {}, options = {}) => {
        const { customResponse, processParams, contentType, showLoader } = {
            customResponse: true,
            processParams: true,
            contentType: null,
            showLoader: true,
            ...options,
        }

        if (showLoader) { startLoading() }

        const config = {
            headers: {
                "Content-Type": contentType || "application/x-www-form-urlencoded;charset=utf-8",
            },
        }

        try {
            const response = await Http.put(
                resource,
                processParams ? qs.stringify(params) : params,
                config,
            )

            if (!customResponse) {
                return response
            }

            return successResponse(response)
        } catch (error) {
            return errorResponse(error)
        }
    }

    const destroy = async (resource, options = {}) => {
        const { customResponse, showLoader } = {
            customResponse: true,
            showLoader: true,
            ...options,
        }

        if (showLoader) { startLoading() }

        try {
            const response = await Http.delete(resource)

            if (!customResponse) {
                return response
            }

            return successResponse(response)
        } catch (error) {
            return errorResponse(error)
        }
    }

    const invalidateCache = (resource, params = {}) => {
        const key = encodeURIComponent(resource + JSON.stringify(params))

        cache.del(key)
    }

    return {
        get,
        post,
        put,
        destroy,
        invalidateCache,
    }
}
