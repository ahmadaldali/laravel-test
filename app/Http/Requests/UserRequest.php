<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        //I remove unique rule from email, to be able use this validation on update user also
        //we can return the unique rule, and create UpdateUserRequest
        //in this case, we create a new user/admin with previous email
        //the response will be 500 not 422
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|confirmed|min:3',
            'avatar' => 'sometimes|string',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'is_admin' => 'sometimes|boolean',
            'is_marketing' => 'sometimes|boolean',
        ];
    }
}