let mix = require("laravel-mix");

if (mix.inProduction) {
  mix.
      setPublicPath(path.normalize("public")).
      js("resources/assets/domain/front/js/app.js", "js/front/app.js").sourceMaps(false).
      sass("resources/assets/domain/front/sass/app.scss", "css/front/app.css").sourceMaps(false);
}

if (!mix.inProduction) {
  mix.
      setPublicPath(path.normalize("public")).
      js("resources/assets/domain/front/js/app.js", "js/front/app.js").sourceMaps(true);
  mix.
      setPublicPath(path.normalize("public")).
      sass("resources/assets/domain/front/sass/app.scss", "css/front/app.css").
      options({processCssUrls: false}).
      webpackConfig({devtool: "inline-source-map"}).
      sourceMaps(true);
}
