const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .less('resources/less/login-register.less', 'public/css')
    .less('resources/less/admin.less', 'public/css')
    .less('resources/less/front.less', 'public/css')
    .less('resources/less/theme/less/AdminLTE.less', 'public/css');