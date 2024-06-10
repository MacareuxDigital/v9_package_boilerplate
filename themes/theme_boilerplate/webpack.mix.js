const mix = require('laravel-mix');

mix.webpackConfig({
    externals: {
        jquery: 'jQuery',
        bootstrap: true,
        vue: 'Vue',
        moment: 'moment'
    }
});

mix.sass('css/presets/default/main.scss', 'css/skins/default.css')
    .sass('css/presets/wilma/main.scss', 'css/skins/wilma.css')
    .js('assets/js/main.js', 'js/main.js');