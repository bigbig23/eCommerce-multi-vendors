<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,' .$this->id,
            'password' =>  'sometimes|nullable|confirmed|min:5',
           // 'password' => 'nullable|confirmed|min:5',
        ];
    }
}



//make email unique in admins table, except for this id $this->id which is currently working to change sth
