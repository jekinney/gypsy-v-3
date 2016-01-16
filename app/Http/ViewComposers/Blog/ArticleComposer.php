<?php

namespace App\Http\ViewComposers\Blog;

use App\Blog\Repository\ArticleRepository;
use Illuminate\View\View;

class ArticleComposer
{
    /**
     * The Article Model.
     *
     * @var Article
     */
    protected $article;

    /**
     * Create a new profile composer.
     *
     * @param  Article  $article
     * @return void
     */
    public function __construct(ArticleRepository $article)
    {
        $this->article = $article;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('topTenArticles', $this->article->topTenTitles());
        $view->with('tenRecentArticles', $this->article->tenRecentTitles());
    }
}