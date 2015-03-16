var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.less('admin.less','public/admin/css')
        .less('school_dashboard.less', 'public/school_admin/css')
        .less('super_admin_dashboard.less', 'public/super_admin/css')
        .scriptsIn('resources/js/school_admin/app', 'public/school_admin/js/main.js')
        .scriptsIn('resources/js/super_admin/app', 'public/super_admin/js/main.js')
        .scriptsIn('resources/js/app', 'public/app/js/main.js')
        .scriptsIn('resources/js/libs/core','public/app/libs/core_main.js')
        .scriptsIn('resources/js/libs/others','public/app/libs/others_main.js');
});
