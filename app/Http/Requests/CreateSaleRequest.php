<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSaleRequest extends FormRequest {
    public function rules( ) : array { return [
        'payments' => 'required|between:0,100.0000' ,
    ] ; }
}
