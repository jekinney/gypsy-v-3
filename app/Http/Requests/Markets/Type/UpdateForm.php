<?php

namespace App\Http\Requests\Markets\Type;

use App\Http\Requests\Request;

class UpdateForm extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'          => 'required|numeric',
            'image'       => 'mimes:jpeg,png,jpg',
            'title'       => 'required|max:120',
            'description' => 'required|max:3000',
            'location'    => 'required|max:360',
        ];
    }
}
