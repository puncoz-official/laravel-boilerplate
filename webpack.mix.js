const mix = require("laravel-mix")
const path = require("path")

mix.setPublicPath(path.normalize("public/dist/"))
mix.setResourceRoot("/dist/")

mix.webpackConfig(require("./resources/assets/webpack.config"))
mix.babelConfig({
    plugins: ["@babel/plugin-syntax-dynamic-import"],
})

mix.js("resources/assets/js/app.js", "js/app.js").vue()

mix.sass("resources/assets/sass/app.scss", "css/app.css")
mix.postCss("resources/assets/sass/tailwind.css", "css/tailwind.css", [
    require("postcss-import"),
    require("tailwindcss")("./resources/assets/tailwind.config.js"),
    require("autoprefixer"),
])

mix.options({
    processCssUrls: true,
})
mix.extract()

if (mix.inProduction()) {
    mix.options({
        terser: {
            terserOptions: {
                compress: {
                    drop_console: true,
                    drop_debugger: true,
                },
            },
        },
    })
} else {
    mix.webpackConfig({ devtool: "inline-source-map" }).sourceMaps()
}

mix.version()
    .disableNotifications()
