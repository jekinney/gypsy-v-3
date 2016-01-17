<?php

namespace App\Http\Requests\User\Password;

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
        if(auth()->user()->password)
        {
            return [
                'current_password' => 'required',
                'password' => 'required|confirmed|between:6,16',
            ];
        }
        return [
            'password' => 'required|confirmed|between:6,16',
        ];
    }
}
