var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss');
    mix.scripts([
        'vendor/vue.min.js',
        'vendor/vue-resource.min.js',
    ], 'public/js/vendor.js');
    mix.scripts([
        'vendor/html5shiv.min.js',
        'vendor/respond.min.js',
    ], 'public/js/old-browser.js');
});
