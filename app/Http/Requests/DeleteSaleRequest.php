<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteSaleRequest extends FormRequest {
    public function rules( ) : array { return [
        'id' => 'required|exists:App\Models\Sale'
    ] ; }
}
