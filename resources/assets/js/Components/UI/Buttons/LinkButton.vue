<template>
    <ButtonComponent :shadow="false" class="text-primary-600 hover:text-primary-800 !font-normal underline">
        <slot/>
    </ButtonComponent>
</template>

<script>
    import ButtonComponent from "./Button"

    export default {
        name: "LinkButton",

        components: { ButtonComponent },
    }
</script>
