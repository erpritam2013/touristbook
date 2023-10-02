let mix = require('laravel-mix');

mix.postCss('resources/js/app.css', 'resources', [
    require('postcss-custom-properties')
]);