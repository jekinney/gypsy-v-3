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
	//mix.copy('node_modules/vue-resource/dist/vue-resource.js', 'resources/assets/js/vue-resource.js');
	//mix.copy('node_modules/bootstrap-sass/assets/javascripts/bootstrap.js', 'resources/assets/js/bootstrap.js');
	//mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap', 'public/frontend/fonts/bootstrap');
    mix.sass(['app.scss'], 'public/frontend/css/main.css');
    mix.scripts(['jquery.js', 'bootstrap.js', 'vue.js', 'vue-resource.js'], 'public/frontend/js/main.js');

    mix.version(['frontend/css/main.css', 'frontend/js/main.js']);
});
