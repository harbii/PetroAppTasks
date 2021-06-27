<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class customer extends Authenticatable{

    use HasFactory;

    protected $hidden = [
        'password',
    ];

    public function users( ) {
        return $this -> hasMany( User::class );
    }

    public function sales( ) {
        return $this -> hasManyThrough( Sale::class , User::class , 'customer_id' , 'created_by' );
    }

}
