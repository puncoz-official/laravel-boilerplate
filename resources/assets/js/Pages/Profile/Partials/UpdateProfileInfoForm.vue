<template>
    <FormSection @submitted="updateProfileInformation">
        <template #title>
            Profile Information
        </template>

        <template #description>
            Update your account's profile information and email address.
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div v-if="$page.props.jetstream.managesProfilePhotos" class="col-span-12 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input ref="photoInput"
                       accept="image/x-png,image/gif,image/jpeg"
                       class="hidden"
                       type="file"
                       @change="updatePhotoPreview">

                <Label :value="trans('validation.attributes.photo')" for="photo"/>

                <div class="mt-2 flex items-center gap-1">
                    <span class="relative inline-block h-20 w-20 rounded-full overflow-hidden bg-gray-100">
                        <img :alt="user.name"
                             :src="photoPreview ?? profilePicture(user)"
                             class="rounded-full h-20 w-20 object-cover">

                        <button :class="{
                                    'bg-[#00000011] hover:bg-[#00000077]': photoPreview,
                                    'bg-[#00000020] hover:bg-[#00000077]': !photoPreview,
                                }"
                                class="group absolute w-full h-full top-0 flex justify-center items-center"
                                type="button"
                                @click.prevent="selectNewPhoto">
                            <CameraIcon :class="{
                                            'hidden group-hover:block': photoPreview,
                                            'block': !photoPreview
                                        }"
                                        class="text-white h-8"/>
                        </button>
                    </span>
                </div>

                <InputError :message="form.errors.photo" class="mt-2"/>
            </div>

            <!-- Name -->
            <div class="col-span-12 sm:col-span-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <Label :value="trans('validation.attributes.first_name')" for="first_name" required/>
                        <TextInput id="first_name"
                                   v-model="form.first_name"
                                   autocomplete="first-name"
                                   border
                                   full/>
                        <InputError :message="form.errors.first_name"/>
                    </div>

                    <div>
                        <Label for="middle_name" value="Middle Name"/>
                        <TextInput id="middle_name"
                                   v-model="form.middle_name"
                                   autocomplete="middle-name"
                                   border
                                   full/>
                        <InputError :message="form.errors.middle_name"/>
                    </div>

                    <div>
                        <Label :value="trans('validation.attributes.last_name')" for="last_name"/>
                        <TextInput id="last_name"
                                   v-model="form.last_name"
                                   autocomplete="last-name"
                                   border
                                   full/>
                        <InputError :message="form.errors.last_name"/>
                    </div>
                </div>
            </div>

            <!-- Email -->
            <div class="col-span-12 sm:col-span-4">
                <Label :value="trans('validation.attributes.email')" for="email" required/>
                <div class="relative">
                    <TextInput id="email"
                               v-model="form.email"
                               autocomplete="email"
                               border
                               full
                               type="email"/>

                    <div class="absolute right-[10px] top-0 flex h-full items-center">
                        <Tooltip>
                            <BadgeCheckIcon :class="{
                                                'text-green-500': isEmailVerified && !isEmailChanged,
                                                'text-gray-500': isEmailChanged || !isEmailVerified,
                                            }"
                                            class="h-6 w-6"/>

                            <template #content>
                                <span v-if="isEmailChanged || !isEmailVerified"
                                      v-text="trans('modules.profile.not_verified')"/>
                                <span v-else-if="isEmailVerified"
                                      v-text="trans('modules.profile.verified')"/>
                            </template>
                        </Tooltip>
                    </div>
                </div>
                <InputError :message="form.errors.email"/>
            </div>
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </ActionMessage>

            <PrimaryButton :loading="form.processing" type="submit">
                {{ trans("general.actions.save") }}
            </PrimaryButton>
        </template>
    </FormSection>
</template>

<script>
    import PrimaryButton from "@/Components/UI/Buttons/PrimaryButton"
    import FormSection   from "@/Components/UI/Containers/FormSection"
    import ActionMessage from "@/Components/UI/Forms/ActionMessage"
    import InputError    from "@/Components/UI/Forms/InputError"
    import Label         from "@/Components/UI/Forms/Label"
    import TextInput     from "@/Components/UI/Forms/TextInput"
    import Tooltip       from "@/Components/UI/Tooltip/Tooltip"
    import { useMedia }  from "@/Composables/useMedia"
    import useRoute      from "@/Composables/useRoute"
    import useState      from "@/Composables/useState"
    import useTrans      from "@/Composables/useTrans"
    import {
        BadgeCheckIcon,
        CameraIcon,
    }                    from "@heroicons/vue/outline"
    import { Inertia }   from "@inertiajs/inertia"
    import { useForm }   from "@inertiajs/inertia-vue3"
    import {
        computed,
        defineComponent,
        ref,
    }                    from "vue"

    export default defineComponent({
        name: "UpdateProfileInfoForm",

        components: {
            ActionMessage,
            PrimaryButton,
            Tooltip,
            TextInput,
            InputError,
            Label,
            FormSection,
            CameraIcon,
            BadgeCheckIcon,
        },

        props: {
            user: { type: Object, required: true },
        },

        setup(props) {
            const trans = useTrans()
            const route = useRoute()

            const { profilePicture } = useMedia()

            const isEmailVerified = computed(() => props.user.is_email_verified)
            const isEmailChanged = computed(() => props.user.email !== form.email)

            const photoInput = ref(null)
            const [photoPreview, setPhotoPreview] = useState(null)

            const form = useForm({
                _method: "PUT",
                first_name: props.user.full_name.first_name ?? "",
                middle_name: props.user.full_name.middle_name ?? "",
                last_name: props.user.full_name.last_name ?? "",
                email: props.user.email,
                photo: null,
            })

            const updateProfileInformation = () => {
                form.transform((data) => {
                    if (photoPreview) {
                        data.photo = photoInput.value.files[0]
                    }

                    return data
                }).post(route("user-profile-information.update"), {
                    errorBag: "updateProfileInformation",
                    preserveScroll: true,
                    onSuccess: () => {
                        clearPhotoFileInput()
                    },
                })
            }

            const updatePhotoPreview = () => {
                if (photoInput.value) {
                    setPhotoPreview(URL.createObjectURL(photoInput.value.files[0]))
                }
            }

            const selectNewPhoto = () => {
                photoInput.value.click()
            }

            const deletePhoto = () => {
                Inertia.delete(route("current-user-photo.destroy"), {
                    preserveScroll: true,
                    onSuccess: () => {
                        setPhotoPreview(null)
                        clearPhotoFileInput()
                    },
                })
            }

            const clearPhotoFileInput = () => {
                if (photoInput.value?.value) {
                    photoInput.value.value = null
                }
            }

            return {
                trans,
                profilePicture,
                isEmailChanged,
                isEmailVerified,
                photoInput,
                photoPreview,
                form,
                updatePhotoPreview,
                selectNewPhoto,
                deletePhoto,
                updateProfileInformation,
            }
        },
    })
</script>
