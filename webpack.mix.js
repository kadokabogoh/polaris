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

mix.js('resources/js/app.js', 'public/js')
mix.js('resources/js/secure/main.js', 'public/js/secure')
mix.js('resources/js/secure/home/index.js', 'public/js/secure/home')

mix.css('resources/css/app.css', 'public/css')
mix.css('resources/css/secure/main.css', 'public/css/secure')
mix.css('resources/css/secure/home/index.css', 'public/css/secure/home')
