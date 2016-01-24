<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer([
            'frontend.blog.article.ten',
            'frontend.blog.article.index',
            'frontend.blog.category.index',
            'frontend.blog.category.show',
            ], 'App\Http\ViewComposers\Blog\CategoryComposer'
        );
        view()->composer([
            'frontend.blog.article.ten',
            'frontend.blog.article.index',
            'frontend.blog.category.index',
            'frontend.blog.category.show',
            ], 'App\Http\ViewComposers\Blog\ArticleComposer'
        );
        view()->composer([
            'frontend.market.index',
            ], 'App\Http\ViewComposers\Market\TypeComposer'
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}