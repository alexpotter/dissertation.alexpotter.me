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
    // Global CSS and JS
    mix.sass([
        'app.scss'
    ], 'public/assets/css');
    mix.copy('node_modules/bootstrap-sass/assets/javascripts/bootstrap.js', 'public/assets/js/bootstrap.js');
    mix.copy('resources/assets/js/google.js', 'public/assets/js');

    // Frontend
    mix.sass([
        'frontend.scss'
    ], 'public/assets/css/frontend/style.css');
});
