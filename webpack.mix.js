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
    .sass('resources/sass/app.scss', 'public/css')
    .version();

mix.js('resources/js/material-dashboard.js', 'public/js');

mix.js('resources/js/settings.js', 'public/js');

mix.js('resources/js/pantallas/audio.js', 'public/js/pantallas')
    .js('resources/js/pantallas/eventos.js', 'public/js/pantallas')
    .js('resources/js/pantallas/main.js', 'public/js/pantallas')
    .js('resources/js/pantallas/solicitudes.js', 'public/js/pantallas')
    .js('resources/js/pantallas/utilidades.js', 'public/js/pantallas')
    .version();

mix.js('resources/js/secciones/alertas.js', 'public/js/secciones')
    .js('resources/js/secciones/botones.js', 'public/js/secciones')
    .js('resources/js/secciones/configuraciones.js', 'public/js/secciones')
    .js('resources/js/secciones/main.js', 'public/js/secciones')
    .js('resources/js/secciones/solicitudes.js', 'public/js/secciones')
    .js('resources/js/secciones/utilidades.js', 'public/js/secciones')
    .version();

mix.js('resources/js/totem/alertas.js', 'public/js/totem')
    .js('resources/js/totem/alertasIndex.js', 'public/js/totem')
    .js('resources/js/totem/configuraciones.js', 'public/js/totem')
    .js('resources/js/totem/formularios.js', 'public/js/totem')
    .js('resources/js/totem/inicio.js', 'public/js/totem')
    .js('resources/js/totem/main.js', 'public/js/totem')
    .js('resources/js/totem/solicitudes.js', 'public/js/totem')
    .js('resources/js/totem/utilidades.js', 'public/js/totem')
    .version();

mix.css('resources/css/material-dashboard_original.css', 'public/css')
    .css('resources/css/material-dashboard_pantalla.css', 'public/css')
    .css('resources/css/material-dashboard_totem.css', 'public/css')
    .css('resources/css/material-dashboard-rtl.css', 'public/css')
    .css('resources/css/material-dashboard.css', 'public/css');

mix.copyDirectory('resources/img', 'public/img', { overwrite: true });
mix.copyDirectory('resources/sound', 'public/sound', { overwrite: true });

if (mix.inProduction()) {
    mix.sourceMaps(false, 'source-map');
    mix.disableNotifications();
}
