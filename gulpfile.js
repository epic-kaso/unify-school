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
    mix.less('super_admin.less', 'public/super_admin/css');
    mix.less('school.less', 'public/school_admin/css')
        .scriptsIn('resources/js/school_admin/app', 'public/school_admin/js/app.js')
        .scriptsIn('resources/js/app', 'public/app/js/main.js');
});
