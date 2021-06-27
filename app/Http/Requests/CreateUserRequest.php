<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest {
    public function rules( ) : array { return [
        'email'    => 'required|email|unique:App\Models\User' ,
        'password' => 'required|min:8' ,
    ] ; }
}
