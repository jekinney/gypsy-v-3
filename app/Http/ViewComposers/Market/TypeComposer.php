<?php

namespace App\Http\ViewComposers\Market;

use App\Markets\Type;
use Illuminate\View\View;

class TypeComposer
{
    /**
     * The Type Model.
     *
     * @var Category
     */
    protected $type;

    /**
     * Create a new profile composer.
     *
     * @param  Type $type
     * @return void
     */
    public function __construct(Type $type)
    {
        $this->type = $type;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('types', $this->type->get());
    }
}