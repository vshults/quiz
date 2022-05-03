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

mix.styles([
    'resources/assets/admin/plugins/fontawesome-free/css/all.min.css',
    'resources/assets/admin/css/adminlte.min.css',
    'resources/assets/admin/css/jquery.json-viewer.css',
    'resources/assets/admin/css/jquery.fancybox.css'
],'public/assets/admin/css/admin.css');

mix.scripts([
    'resources/assets/admin/plugins/jquery/jquery.min.js',
    'resources/assets/admin/plugins/jquery/jquery-ui.min.js',
    'resources/assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js',
    'resources/assets/admin/js/adminlte.min.js',
    'resources/assets/admin/js/Chart.bundle.js',
    'resources/assets/admin/js/jquery.json-editor.min.js',
    'resources/assets/admin/js/demo.js',
],'public/assets/admin/js/admin.js');

mix.scripts([
    'resources/assets/admin/js/pages/host.js',
    'resources/assets/admin/js/pages/setting.js',
    'resources/assets/admin/js/pages/question.js',
    'resources/assets/admin/js/pages/user.js',
    'resources/assets/admin/js/pages/selection.js',
],'public/assets/admin/js/ajax.js');

mix.scripts([
    'resources/assets/admin/js/pages/graphs.js',
    'resources/assets/admin/js/jquery.fancybox.js',
    'resources/assets/admin/js/pages/sort.js',
],'public/assets/admin/js/main.js');

mix.copyDirectory('resources/assets/admin/plugins/fontawesome-free/webfonts','public/assets/admin/webfonts');
mix.copyDirectory('resources/assets/admin/img','public/assets/admin/img');
mix.copy('resources/assets/admin/css/adminlte.min.css.map','public/assets/admin/css/adminlte.min.css.map');
