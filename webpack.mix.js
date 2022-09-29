const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

 mix.js('resources/js/app.js', 'public/js').vue()
    .js('resources/frontend/src/main.js', 'public/js/frontend/')
    .sass('resources/frontend/src/assets/scss/app.scss', 'public/css/frontend/')
    .postCss('resources/frontend/src/assets/css/style.css', 'public/css/frontend/')

mix.copyDirectory('resources/frontend/src/assets/', 'public/assets/');
mix.copyDirectory('resources/frontend/src/assets/blogger/assets', 'public/blogger/assets/');
