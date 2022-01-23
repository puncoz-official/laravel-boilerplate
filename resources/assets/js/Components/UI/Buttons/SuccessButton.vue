<template>
    <ButtonComponent class="bg-green-500 border-green-700 hover:bg-green-400 text-white font-bold">
        <slot/>
    </ButtonComponent>
</template>

<script>
    import ButtonComponent from "./Button"

    export default {
        name: "SuccessButton",

        components: { ButtonComponent },
    }
</script>
