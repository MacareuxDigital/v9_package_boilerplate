const mix = require('laravel-mix');

mix.webpackConfig({
    externals: {
        jquery: 'jQuery',
        bootstrap: true,
        vue: 'Vue',
        moment: 'moment'
    }
});

mix.sass('assets/scss/main.scss', 'css/main.css')
    .js('assets/js/main.js', 'js/main.js')
    .setPublicPath('../assets');