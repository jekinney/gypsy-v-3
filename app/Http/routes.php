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
    Route::group(['namespace' => 'Frontend'], function() {
    	  Route::get('/', ['as'=>'home', 'uses' => 'Page\PageController@home']);
            Route::group(['prefix' => 'market', 'as' => 'market.', 'namespace' => 'Market'], function() {
        	  Route::get('/', ['as'=>'index', 'uses'=>'MarketController@index']);
        	  Route::get('show/{market_slug}', ['as'=>'show', 'uses'=>'MarketController@show']);
        	  Route::get('type/{type_slug}', ['as'=>'type', 'uses'=>'MarketController@type']);
        });
        Route::group(['prefix' => 'blog', 'as' => 'blog.', 'namespace' => 'Blog'], function() {
    	      Route::get('/', ['as' => 'articles.index', 'uses'=>'ArticleController@index']);
    	      Route::get('article/{slug}', ['as' => 'article.show', 'uses'=>'ArticleController@show']);
    	      Route::get('categories', ['as' => 'categories.all', 'uses'=>'CategoryController@listWithCount']);
        });
        Route::group(['prefix' => 'gallery', 'as' => 'gallery.', 'namespace' => 'Gallery'], function() {
            Route::get('/', ['as' => 'index', 'uses'=>'GalleryController@index']);
            Route::get('{slug}', ['as' => 'show', 'uses'=>'GalleryController@show']);
        });
        Route::group(['prefix' => 'contact', 'as' => 'contact.', 'namespace' => 'Contact'], function() {
            Route::get('/', ['as' => 'index', 'uses'=>'ContactController@index']);
        });
    });

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Backend'], function() {
        Route::get('/', ['as' => 'home', 'uses'=>'Page\PageController@index']);

        Route::group(['prefix' => 'blog', 'as' => 'blog.', 'namespace' => 'Blog'], function() {
            Route::group(['prefix' => 'article', 'as'=>'article.'], function() {
                Route::get('unpublished/list', ['as' => 'unpublished.list', 'uses'=>'ArticleController@unpublishedList']);
                Route::get('published/list', ['as' => 'published.list', 'uses'=>'ArticleController@publishedList']);
                Route::get('create', ['as' => 'create', 'uses'=>'ArticleController@create']);
                Route::get('edit/{id}', ['as' => 'edit', 'uses'=>'ArticleController@edit']);
                Route::post('store', ['as'=>'store', 'uses'=>'ArticleController@store']);
                Route::put('update', ['as'=>'update', 'uses'=>'ArticleController@update']);
            });
            Route::group(['prefix' => 'category', 'as'=>'category.'], function() {
                Route::get('list', ['as' => 'list', 'uses'=>'CategoryController@listing']);
                Route::post('store', ['as'=>'store', 'uses'=>'CategoryController@store']);
                Route::put('update', ['as'=>'update', 'uses'=>'CategoryController@update']);
                Route::delete('remove/{id}', ['as'=>'remove', 'uses'=>'CategoryController@remove']);
            });
        });

        Route::group(['prefix' => 'market', 'as' => 'market.', 'namespace' => 'Market'], function() {
            Route::get('/', ['as'=>'index', 'uses'=>'MarketController@index']);
            Route::get('create', ['as'=>'create', 'uses'=>'MarketController@create']);
            Route::get('edit/{id}', ['as'=>'edit', 'uses'=>'MarketController@edit']);
            Route::post('store', ['as'=>'store', 'uses'=>'MarketController@store']);
            Route::put('update', ['as'=>'update', 'uses'=>'MarketController@update']);

            Route::group(['prefix' => 'type', 'as' => 'type.'], function() {
                Route::get('/', ['as'=>'index', 'uses'=>'TypeController@index']);
                Route::post('store', ['as'=>'store', 'uses'=>'TypeController@store']);
                Route::put('update', ['as'=>'update', 'uses'=>'TypeController@update']);
                Route::delete('remove/{id}', ['as'=>'remove', 'uses'=>'TypeController@remove']);
            });
        });
    });
});
