<template>
    <div class="relative w-full">
        <TextInput :type="visible ? 'text' : 'password'" v-bind="$attrs"/>

        <div class="absolute top-0 right-0 mt-3 mr-4 cursor-pointer" @click.prevent="toggleVisibility">
            <EyeOffIcon class="h-5 w-5" v-if="visible"/>
            <EyeIcon class="h-5 w-5" v-else/>
        </div>
    </div>
</template>

<script type="text/ecmascript-6">
    import TextInput from "@/Components/UI/Forms/TextInput"
    import {
        EyeIcon,
        EyeOffIcon,
    }                from "@heroicons/vue/outline"
    import { ref }   from "vue"

    export default {
        name: "PasswordInput",

        components: { TextInput, EyeOffIcon, EyeIcon },

        inheritAttrs: false,

        setup() {
            const visible = ref(false)

            const toggleVisibility = () => {
                visible.value = !visible.value
            }

            return { visible, toggleVisibility }
        },
    }
</script>
