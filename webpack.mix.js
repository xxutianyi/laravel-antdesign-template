// eslint-disable-next-line @typescript-eslint/no-var-requires,no-undef
const mix = require('laravel-mix');
// eslint-disable-next-line @typescript-eslint/no-var-requires,no-undef
const webpackConfig = require('./webpack.config')

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

mix.typeScript("resources/ts/app.tsx", "public/js")
    .copy('resources/images/favicon.png', 'public/images/favicon.png')
    .react()
    .webpackConfig(webpackConfig)
    .version()
    .sourceMaps();
