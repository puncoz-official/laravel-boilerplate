<template>
    <div v-show="message">
        <p class="text-sm text-red-600 mt-1">
            {{ message }}
        </p>
    </div>
</template>

<script type="text/ecmascript-6">
    export default {
        name: "InputError",

        props: {
            message: { type: String, required: false, default: "" },
        },
    }
</script>
