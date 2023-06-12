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

const source = 'resources';
const dist = 'public';

mix.js('resources/assets/js/setting.js', dist + '/js');
mix.js('resources/js/app.js', 'public/js')
mix.js(source + '/js/apply_form.js', 'public/js')
mix.js('resources/js/custom.js', 'public/js').postCss('resources/assets/scss/custom.css', 'public/css', [
    //
]).postCss('resources/css/app.css', 'public/css', [
    //
]);

mix.browserSync({
    proxy: 'vietseeds.local',
    port: 8000,
    files: [
        'app/**/*',
        'public/**/*',
        'resources/views/**/*',
        'resources/lang/**/*',
        'routes/**/*'
    ],
});
