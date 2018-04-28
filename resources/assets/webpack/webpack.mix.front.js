let mix = require("laravel-mix");

if (!mix.config.production) {
  mix.webpackConfig({devtool: "inline-source-map"}).sourceMaps();
}

mix.
    setPublicPath(path.normalize("public")).
    js("resources/assets/domain/front/js/app.js", "js/front/app.js").version().
    sass("resources/assets/domain/front/sass/app.scss", "css/front/app.css").version();
