<template>
    <ButtonComponent class="bg-secondary border-secondary-700 hover:bg-secondary-400 text-white font-bold">
        <slot/>
    </ButtonComponent>
</template>

<script>
    import ButtonComponent from "./Button"

    export default {
        name: "SecondaryButton",

        components: { ButtonComponent },
    }
</script>
