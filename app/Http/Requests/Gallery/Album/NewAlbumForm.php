<?php

namespace App\Http\Requests\Gallery\Album;

use App\Http\Requests\Request;

class NewAlbumForm extends Request
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
            'name' => 'required|max:120',
            'description' => 'required|max:600',
        ];
    }
}
