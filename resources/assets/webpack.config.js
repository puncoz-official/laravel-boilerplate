const path = require("path")
const { DefinePlugin } = require("webpack")

module.exports = {
    resolve: {
        alias: {
            ziggy: path.resolve("vendor/tightenco/ziggy/dist"),
            "@": path.resolve("resources/assets/js"),
        },
    },

    plugins: [
        new DefinePlugin({
            __VUE_OPTIONS_API__: "false",
            __VUE_PROD_DEVTOOLS__: "false",
        }),
    ],

    output: {
        publicPath: path.normalize("/dist/"),
        chunkFilename: "js/chunks/[name].js?id=[chunkhash]",
    },

    watchOptions: {
        ignored: /node_modules/,
    },
}
