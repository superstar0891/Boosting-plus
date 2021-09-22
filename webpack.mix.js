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
mix.copyDirectory('resources/fonts', 'public/fonts');
mix.copyDirectory('node_modules/tinymce/plugins', 'public/node_modules/tinymce/plugins');
mix.copyDirectory('node_modules/tinymce/skins', 'public/node_modules/tinymce/skins');
mix.copyDirectory('node_modules/tinymce/themes', 'public/node_modules/tinymce/themes');
mix.copy('node_modules/tinymce/jquery.tinymce.js', 'public/node_modules/tinymce/jquery.tinymce.js');
mix.copy('node_modules/tinymce/jquery.tinymce.min.js', 'public/node_modules/tinymce/jquery.tinymce.min.js');
mix.copy('node_modules/tinymce/tinymce.js', 'public/node_modules/tinymce/tinymce.js');
mix.copy('node_modules/tinymce/tinymce.min.js', 'public/node_modules/tinymce/tinymce.min.js');
//Dashboard
mix.js('resources/views/dashboard/js/app.js', 'public/dash/js')
    .sass('resources/views/dashboard/sass/app.scss', 'public/dash/css');
mix.copyDirectory('resources/views/dashboard/img/games', 'public/dash/images/games');
mix.copyDirectory('resources/views/dashboard/img/products', 'public/dash/images/products');
//Frontend
mix.copyDirectory('resources/views/frontend/img', 'public/frontend/img');
mix.js('resources/views/frontend/js/main.js', 'public/frontend/js')
    .sass('resources/views/frontend/sass/style.scss', 'public/frontend/css');
