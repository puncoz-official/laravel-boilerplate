<template>
    <ButtonComponent class="bg-primary-500 text-secondary-400 hover:bg-primary-600">
        <slot/>
    </ButtonComponent>
</template>

<script>
    import ButtonComponent from "./Button"

    export default {
        name: "PrimaryButton",

        components: { ButtonComponent },
    }
</script>
