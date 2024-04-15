const mix = require('laravel-mix');

mix.webpackConfig({
    externals: {
        jquery: 'jQuery',
        bootstrap: true,
        vue: 'Vue',
        moment: 'moment'
    }
});

mix.sass('assets/scss/skins/default/main.scss', 'css/skins/default.css')
    .js('assets/js/main.js', 'js/main.js')
    .setPublicPath('..');