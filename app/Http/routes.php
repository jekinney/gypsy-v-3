<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/
/*
* Image API Routes
*/
Route::post('/admin/blog/image/store', ['uses'=>'Backend\Blog\ImageController@store']);

Route::group(['prefix' => '/admin/market/item/image'], function() {
    Route::post('store', ['as' => 'store', 'uses' => 'Backend\Market\ItemImageController@store']);
});

Route::group(['prefix' => '/admin/gallery/photo'], function() {
    Route::post('store', ['as' => 'store', 'uses' => 'Backend\Gallery\PhotoController@store']);
});

/*
* Blog Comment API Routes
*/
Route::group(['middleware' => ['api']], function () {
    Route::group(['prefix' => 'blog/comment', 'namespace' => 'Frontend\Blog'], function() {
        Route::get('latest/{article_id}', 'CommentAPIController@latest');
        Route::get('all/{article_id}', 'CommentAPIController@all');
        Route::post('add', 'CommentAPIController@add');
        Route::post('hide', 'CommentAPIController@hide');
        Route::post('un-hide', 'CommentAPIController@unHide');
        Route::put('update', 'CommentAPIController@update');
        Route::put('remove', 'CommentAPIController@remove');
    });
});

/*
* All Web ROutes
*/
Route::group(['middleware' => ['web']], function () {
    /*
    * All Frontend Routes
    */
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

            Route::group(['prefix' => 'category', 'as' => 'category.'], function() {
    	        Route::get('/', ['as' => 'index', 'uses'=>'CategoryController@listWithCount']);
                Route::get('{slug}', ['as' => 'show', 'uses'=>'CategoryController@show']);
            });
        });
        Route::group(['prefix' => 'gallery', 'as' => 'gallery.', 'namespace' => 'Gallery'], function() {
            Route::get('/', ['as' => 'index', 'uses'=>'GalleryController@index']);
            Route::get('{slug}', ['as' => 'show', 'uses'=>'GalleryController@show']);
        });
        Route::group(['prefix' => 'contact', 'as' => 'contact.', 'namespace' => 'Contact'], function() {
            Route::get('/', ['as' => 'index', 'uses'=>'ContactController@index']);
        });

        Route::group(['prefix' => 'auth', 'as' => 'auth.', 'namespace' => 'Auth'], function() {
            Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);
            Route::get('register', ['as' => 'register', 'uses' => 'AuthController@register']);
            Route::post('login', ['as' => 'login', 'uses' => 'AuthController@login']);
            Route::post('post/login', ['as' => 'post.register', 'uses' => 'AuthController@postRegister']);

            Route::group(['prefix' => 'password', 'as' => 'password.'], function() {
                Route::post('update', ['as' => 'update', 'uses' => 'PasswordController@update']);
            });
        });

        Route::group(['prefix' => 'facebook', 'as' => 'facebook.', 'namespace' => 'Auth'], function() {
            Route::get('/', ['as' => 'provider', 'uses' => 'FacebookController@provider']);
            Route::get('callback', ['as' => 'callback', 'uses' => 'FacebookController@callback']);
        });

        Route::group(['prefix' => 'google', 'as' => 'google.', 'namespace' => 'Auth'], function() {
            Route::get('/', ['as' => 'provider', 'uses' => 'GoogleController@provider']);
            Route::get('callback', ['as' => 'callback', 'uses' => 'GoogleController@callback']);
        });

        Route::group(['prefix' => 'account', 'as' => 'account.', 'namespace' => 'Auth'], function() {
            Route::get('/', ['as' => 'index', 'uses' => 'AccountController@index']);
            Route::get('newsletter', ['as' => 'newsletter', 'uses' => 'AccountController@updateNewsletter']);
        });
    });
    /*
    * All Backend Routes
    */
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
             Route::group(['prefix' => 'image', 'as'=>'image.'], function() {
                Route::get('index', ['as' => 'index', 'uses'=>'ImageController@index']);
                Route::put('update', ['as' => 'update', 'uses' => 'ImageController@update']);
                Route::delete('remove', ['as'=>'remove', 'uses'=>'ImageController@remove']);
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

            Route::group(['prefix' => 'item', 'as' => 'item.'], function() {
                Route::get('/', ['as'=>'index', 'uses'=>'ItemController@index']);
                Route::get('edit/{id}', ['as'=>'edit', 'uses'=>'ItemController@edit']);
                Route::post('store', ['as'=>'store', 'uses'=>'ItemController@store']);
                Route::put('update', ['as'=>'update', 'uses'=>'ItemController@update']);
                Route::delete('remove', ['as'=>'remove', 'uses'=>'ItemController@remove']);
            });

            Route::group(['prefix' => 'image', 'as' => 'image.'], function() {
                Route::post('main', ['as' => 'main', 'uses' => 'ItemImageController@main']);
                Route::delete('remove', ['as' => 'remove', 'uses' => 'ItemImageController@remove']);
            });
        });
        Route::group(['prefix' => 'gallery', 'as' => 'gallery.', 'namespace' => 'Gallery'], function() {
          Route::group(['prefix' => 'album', 'as' => 'album.'], function() {
            Route::get('index', ['as' => 'index', 'uses' => 'AlbumController@index']);
            Route::get('show/{id}', ['as' => 'show', 'uses' => 'AlbumController@show']);
            Route::post('store', ['as' => 'store', 'uses' => 'AlbumController@store']);
            Route::put('update', ['as' => 'update', 'uses' => 'AlbumController@update']);
          });
          Route::group(['prefix' => 'photo', 'as' => 'photo.'], function() {
            Route::get('index', ['as' => 'index', 'uses' => 'PhotoController@index']);
            Route::put('update', ['as' => 'update', 'uses' => 'PhotoController@update']);
            Route::delete('remove', ['as' => 'remove', 'uses' => 'PhotoController@remove']);
          });
        });
    });
});
