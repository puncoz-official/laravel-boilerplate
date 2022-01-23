const defaultTheme = require("tailwindcss/defaultTheme")
const forms = require("@tailwindcss/forms")
const typography = require("@tailwindcss/typography")

module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/assets/**/*.vue",
    ],

    theme: {
        extend: {
            colors: {
                primary: {
                    DEFAULT: "#F8D22C",
                    50: "#FEF8DE",
                    100: "#FDF4CA",
                    200: "#FCEBA2",
                    300: "#FBE37B",
                    400: "#F9DA53",
                    500: "#F8D22C",
                    600: "#E4BB08",
                    700: "#AE8F06",
                    800: "#786204",
                    900: "#413602",
                },

                secondary: {
                    DEFAULT: "#333333",
                    50: "#8F8F8F",
                    100: "#858585",
                    200: "#707070",
                    300: "#5C5C5C",
                    400: "#474747",
                    500: "#333333",
                    600: "#171717",
                    700: "#000000",
                    800: "#000000",
                    900: "#000000",
                },

                tertiary: {
                    DEFAULT: "#F36F21",
                    50: "#FCE0CF",
                    100: "#FBD3BC",
                    200: "#F9BA95",
                    300: "#F7A16E",
                    400: "#F58848",
                    500: "#F36F21",
                    600: "#D1550B",
                    700: "#9B3F08",
                    800: "#662906",
                    900: "#311403",
                },
            },

            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, typography],
}
