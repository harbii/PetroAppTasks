<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest {
    public function rules( ) : array { return [
        'customer_id' => 'required|integer' ,
        'email'       => 'required|email'   ,
        'password'    => 'required|min:8'   ,
    ] ; }
}
