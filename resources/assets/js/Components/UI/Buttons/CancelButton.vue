<template>
    <ButtonComponent class="bg-white border-gray-300 text-gray-700 hover:bg-gray-50 font-bold">
        <slot/>
    </ButtonComponent>
</template>

<script>
    import ButtonComponent from "./Button"

    export default {
        name: "CancelButton",

        components: { ButtonComponent },
    }
</script>
