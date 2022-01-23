<template>
    <ButtonComponent class="bg-red-500 border-red-700 hover:bg-red-400 text-white font-bold">
        <slot/>
    </ButtonComponent>
</template>

<script>
    import ButtonComponent from "./Button"

    export default {
        name: "DangerButton",

        components: { ButtonComponent },
    }
</script>
