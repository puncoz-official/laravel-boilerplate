const mix = require("laravel-mix")
const path = require("path")

mix.setPublicPath(path.normalize("public/assets/back-office"))
mix.setResourceRoot("./../")

if (mix.inProduction()) {
    mix.options({
        // purifyCss: true,
        uglify: {
            uglifyOptions: {
                compress: {
                    drop_console: true,
                },
            },
        },
    })
} else {
    mix.webpackConfig({ devtool: "inline-source-map" }).sourceMaps()
}

function resolve(dir) {
    return path.join(__dirname, dir)
}

mix.webpackConfig({
    resolve: {
        alias: {
            "@": resolve("resources/assets/back/js"),
            "vue$": "vue/dist/vue.js",
        },
    },

    output: {
        publicPath: path.normalize("/assets/back-office/"),
        chunkFilename: "[name].js",
    },

    watchOptions: {
        ignored: /node_modules/,
    },
})

mix.js("resources/assets/back/js/app.js", "js/app.js").version()

mix.extract([
    "jquery", "popper.js", "bootstrap",
    "axios", "vue",
])

mix.autoload({
    jquery: ["$", "window.jQuery"],
})

mix.sass("resources/assets/back/sass/app.scss", "css/app.css").version()
