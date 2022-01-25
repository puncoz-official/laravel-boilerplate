<template>
    <nav class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <Logo :href="route('dashboard')" logo-class="block h-9 w-auto"/>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <NavLink :active="route().current('dashboard')" :href="route('dashboard')">
                            {{ trans("modules.dashboard.title") }}
                        </NavLink>
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <!-- Settings Dropdown -->
                    <div class="ml-3 relative">
                        <Dropdown align="right" width="w-48">
                            <template #trigger>
                                <button v-if="$page.props.jetstream.managesProfilePhotos"
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none
                                            focus:border-primary-300 transition">
                                    <img :alt="$page.props.user.name"
                                         :src="$page.props.user.profile_photo_url"
                                         class="h-8 w-8 rounded-full object-cover">
                                </button>

                                <span v-else class="inline-flex rounded-md">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm
                                                    leading-4 font-medium rounded-md text-gray-500 bg-white
                                                    hover:text-gray-700 focus:outline-none transition"
                                            type="button">
                                        {{ $page.props.user.full_name.firstName }}

                                        <ChevronDownIcon class="ml-2 -mr-0.5 h-4 w-4"/>
                                    </button>
                                </span>
                            </template>

                            <template #content>
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ trans("modules.profile.Manage Account") }}
                                </div>

                                <DropdownLink :href="route('profile.show')">
                                    {{ trans("modules.profile.Profile") }}
                                </DropdownLink>

                                <div class="border-t border-gray-100"/>

                                <!-- Authentication -->
                                <form @submit.prevent="logout">
                                    <DropdownLink as="button">
                                        {{ trans("auth.Logout") }}
                                    </DropdownLink>
                                </form>
                            </template>
                        </Dropdown>
                    </div>
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button class="inline-flex items-center justify-center p-2 rounded-md text-gray-400
                                    hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100
                                    focus:text-gray-500 transition"
                            @click="setShowingNavigationDropdown(!showingNavigationDropdown)">
                        <MenuIcon v-show="!showingNavigationDropdown" class="h-6 w-6"/>
                        <XIcon v-show="showingNavigationDropdown" class="h-6 w-6"/>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}"
             class="sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <ResponsiveNavLink :active="route().current('dashboard')" :href="route('dashboard')">
                    {{ trans("modules.dashboard.title") }}
                </ResponsiveNavLink>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <div v-if="$page.props.jetstream.managesProfilePhotos" class="shrink-0 mr-3">
                        <img :alt="$page.props.user.full_name.firstName"
                             :src="$page.props.user.profile_photo_url"
                             class="h-10 w-10 rounded-full object-cover">
                    </div>

                    <div>
                        <div class="font-medium text-base text-gray-800">
                            {{ $page.props.user.full_name.firstName }}
                        </div>
                        <div class="font-medium text-sm text-gray-500">
                            {{ $page.props.user.email }}
                        </div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <ResponsiveNavLink :active="route().current('profile.show')" :href="route('profile.show')">
                        {{ trans("modules.profile.Profile") }}
                    </ResponsiveNavLink>

                    <!-- Authentication -->
                    <form method="POST" @submit.prevent="logout">
                        <ResponsiveNavLink as="button">
                            {{ trans("auth.Logout") }}
                        </ResponsiveNavLink>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</template>

<script type="text/ecmascript-6">
    import Logo              from "@/Components/Logo"
    import Dropdown          from "@/Components/UI/DropDown/Dropdown"
    import DropdownLink      from "@/Components/UI/DropDown/DropdownLink"
    import useRoute          from "@/Composables/useRoute"
    import useState          from "@/Composables/useState"
    import useTrans          from "@/Composables/useTrans"
    import NavLink           from "@/Layouts/partials/NavLink"
    import ResponsiveNavLink from "@/Layouts/partials/ResponsiveNavLink"
    import { MenuIcon }      from "@heroicons/vue/outline"
    import {
        ChevronDownIcon,
        XIcon,
    }                        from "@heroicons/vue/solid"

    export default {
        name: "NavBar",

        components: { ResponsiveNavLink, DropdownLink, Dropdown, NavLink, Logo, ChevronDownIcon, MenuIcon, XIcon },

        setup() {
            const route = useRoute()
            const trans = useTrans()

            const [showingNavigationDropdown, setShowingNavigationDropdown] = useState(false)

            const logout = function() {
                this.$inertia.post(route("logout"))
            }

            return {
                route,
                trans,
                showingNavigationDropdown,
                setShowingNavigationDropdown,
                logout,
            }
        },
    }
</script>
