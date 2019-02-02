const mix = require("laravel-mix")
const path = require("path")

if (!mix.inProduction()) {
    mix.webpackConfig({ devtool: "inline-source-map" }).sourceMaps()
}

mix.options({
    uglify: {
        uglifyOptions: {
            compress: {
                drop_console: true,
            },
        },
    },
})

mix.setPublicPath(path.normalize("public/assets/auth"))
mix.setResourceRoot("/assets/auth/")

mix.webpackConfig({
    resolve: {
        alias: {
            "vue$": "vue/dist/vue.js",
        },
    },
})

mix.js("resources/assets/auth/js/app.js", "js/app.js").version()
mix.sass("resources/assets/auth/sass/app.scss", "css/app.css").version()

mix.extract([
    "jquery", "popper.js", "bootstrap",
    "axios", "vue",
])

mix.autoload({
    jquery: ["$", "window.jQuery"],
})
