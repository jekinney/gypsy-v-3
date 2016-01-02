<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
	Route::get('/', ['as'=>'home', 'uses' => 'Frontend\Page\PageController@home']);
    Route::group(['prefix' => 'market', 'as' => 'market.', 'namespace' => 'Frontend\Market'], function() {
    	Route::get('/', ['as'=>'index', 'uses'=>'MarketController@index']);
    	Route::get('show/{market_slug}', ['as'=>'show', 'uses'=>'MarketController@show']);
    	Route::get('type/{type_slug}', ['as'=>'type', 'uses'=>'MarketController@type']);
    });
    Route::group(['prefix' => 'blog', 'as' => 'blog.', 'namespace' => 'Frontend\Blog'], function() {
	   Route::get('/', ['as' => 'articles.index', 'uses'=>'ArticleController@index']);
	   Route::get('article/{slug}', ['as' => 'article.show', 'uses'=>'ArticleController@show']);
	   Route::get('categories', ['as' => 'categories.all', 'uses'=>'CategoryController@listWithCount']);
    });
     Route::group(['prefix' => 'gallery', 'as' => 'gallery.', 'namespace' => 'Frontend\Gallery'], function() {
       Route::get('/', ['as' => 'index', 'uses'=>'GalleryController@index']);
       Route::get('{slug}', ['as' => 'show', 'uses'=>'GalleryController@show']);
    });
});
