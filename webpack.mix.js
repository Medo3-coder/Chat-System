const mix = require('laravel-mix');
require('dotenv').config();

/*
dotenv :  allows you to separate secrets from your source code.
This is useful in a collaborative environment (e.g., work, or open source)
 where you may not want to share your database login
credentials with other people. Instead, you can share the source code while allowing other people to create their own . env file

*/

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

mix.js('resources/js/app.js', 'public/js').vue()
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .webpackConfig(require('./webpack.config'));

if (mix.inProduction()) {
    mix.version();
}