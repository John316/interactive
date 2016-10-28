const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

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

elixir(mix => {
    mix.sass('app.scss')
        .styles([
            'app.css'
        ], 'public/css');
});

elixir(mix => {
    mix.browserify([
        'actions/ModulesActions.js',
        'components/MainSection.react.js',
        'components/Module.react.js',
        'dispatcher/AppDispatcher.js',
        'stores/ModulesStore.js',
        'app.js'
    ], 'public/js');
});

elixir(mix => {
    mix.scripts([
        '../old-js/browser.min.js',
        '../old-js/pusher.min.js',
        '../old-js/highcharts.js',
        //'../old-js/chart-themes.js',
        '../old-js/charts.js',
        '../old-js/lang.js',
        '../old-js/script.js'

    ], 'public/js/old');
});