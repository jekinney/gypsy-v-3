<?php

namespace App\Http\Requests\Blog;

use App\Http\Requests\Request;

class CommentForm extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(auth()->check()) return true;
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'article_id' => 'required|numeric',
            'body' => 'required|between:3,1000',
        ];
    }
}
