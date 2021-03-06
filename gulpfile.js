var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
	//mix.copy('node_modules/jquery/dist/jquery.js', 'resources/assets/js/jquery.js');
	//mix.copy('node_modules/vue/dist/vue.js', 'resources/assets/js/vue.js');
	//mix.copy('node_modules/bootstrap-sass/assets/javascripts/bootstrap.js', 'resources/assets/js/bootstrap.js');
	//mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap', 'public/frontend/fonts/bootstrap');
    //mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap', 'public/backend/fonts/bootstrap');
    //mix.copy('node_modules/font-awesome/css/font-awesome.css', 'resources/assets/css/font-awesome.css');
    //mix.copy('node_modules/font-awesome/fonts', 'public/frontend/fonts');
    //mix.copy('node_modules/font-awesome/fonts', 'public/backend/fonts');
    //mix.copy('node_modules/moment/moment.js', 'resources/assets/js/moment.js');
    //mix.copy('node_modules/twix/dist/twix.js', 'resources/assets/js/twix.js');
    //mix.copy('node_modules/jquery-ui/jquery-ui.js', 'resources/assets/js/jquery-ui.js');
    //mix.copy('node_modules/jsonlylightbox/css/lightbox.css', 'resources/assets/css/lightbox.css');
    //mix.copy('node_modules/jsonlylightbox/js/lightbox.js', 'resources/assets/js/lightbox.js');
    //mix.copy('node_modules/jsonlylightbox/img', 'public/img');
    mix.sass(['app.scss'], 'resources/assets/frontend/css/main.css');

    mix.styles([
        '../frontend/css/main.css',
        'sweet-alert.css',
        'lightbox.css',
        ], 'public/frontend/css/main.css');
    
    mix.scripts([
        'jquery.js', 
        'bootstrap.js', 
        'moment.js',
        'vue.js', 
        'vue-resource.js', 
        'sweet-alert.js',
        'lightbox.js',
        ], 'public/frontend/js/main.js');

    mix.version(['frontend/css/main.css', 'frontend/js/main.js']);

    mix.styles([
    	'../backend/css/bootstrap.min.css', 
    	'../backend/css/admin.min.css', 
    	'../backend/css/skin-blue.min.css',
        '../backend/js/datepicker/datepicker3.css',
        '../backend/css/timepicker/bootstrap-timepicker.css',
        'font-awesome.css',
        'sweet-alert.css',
    	], 'public/backend/css/main.css');

    mix.scripts([
        'jquery.js', 
        'bootstrap.js', 
        'moment.js',
        'jquery-ui.js',
        'vue.js', 
        'vue-resource.js',
        'moment.js',
        'dropzone.js',
        'sweet-alert.js',
        '../backend/js/app.js',
        '../backend/js/timepicker/bootstrap-timepicker.js',
        ], 'public/backend/js/main.js');

    mix.scripts([
        '../backend/js/marketItemDropzone.js',
        ], 'public/backend/js/marketItem.js');
    
    mix.version(['backend/css/main.css', 'backend/js/main.js']);
});
