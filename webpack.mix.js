let mix = require('laravel-mix');
require('laravel-mix-tailwind');

const WebpackShellPlugin = require('webpack-shell-plugin');
const path = require('path')

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
   .tailwind()
   .webpackConfig({
	    plugins:
	    [
	        new WebpackShellPlugin({
	        	onBuildStart:[
	        		'php artisan lang:js resources/js/messages.js --no-lib --quiet',
	        		'php artisan ziggy:generate resources/js/ziggy.js --quiet'
	        		],
	        	onBuildEnd:[]
	        })
	    ],
	    resolve: {
	        alias: {
	            ziggy: path.resolve('vendor/tightenco/ziggy/dist/js/route.js'),
	        },
	    },
	});
