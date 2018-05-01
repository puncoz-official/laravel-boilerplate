let mix = require("laravel-mix");

if (!mix.config.production) {
  mix.webpackConfig({devtool: "inline-source-map"}).sourceMaps();
}

mix.
    setPublicPath(path.normalize("public/auth/")).
    js("resources/assets/domain/auth/js/app.js", "js/app.js").version().
    sass("resources/assets/domain/auth/sass/app.scss", "css/app.css").version();
