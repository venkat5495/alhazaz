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
   .sass('resources/sass/app.scss', 'public/css');

mix.styles(['public/assets/css/plugins.css'],'public/assets/css/mixplugins.css');
mix.styles(['public/assets/css/bootstrap-rtl.css'],'public/assets/css/mixbootstrap-rtl.css');
mix.styles(['public/assets/css/style.css'],'public/assets/css/mixstyle.css');
mix.styles(['public/assets/css/style-rtl.css'],'public/assets/css/mixstyle-rtl.css');

mix.styles([
    'public/assets/css/sweetalert2.min.css',
    'public/assets/css/jquery.share.css'],'public/assets/css/all.css');

mix.scripts(['public/assets/js/plugins.js',
    'public/assets/js/main.js',
    'public/assets/js/sweetalert2.min.js',
    'public/assets/js/jquery.share.js'],'public/assets/js/all.js');
// mix.scripts(['public/assets/js/plugins.js'],'public/assets/js/mixplugins.js');
// mix.scripts(['public/assets/js/main.js'],'public/assets/js/mixmain.js');
// mix.scripts(['public/frontend/js/sweetalert2.min.js'],'public/assets/js/mixsweetalert2.min.js');

