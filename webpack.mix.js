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

 let theme = process.env.npm_config_theme;

 if(theme) {
    require(`${__dirname}/themes/${theme}/webpack.mix.js`);
 } else {
     // default theme to compile if theme is not specified
   require(`${__dirname}/themes/theme-name/webpack.mix.js`);
 }
