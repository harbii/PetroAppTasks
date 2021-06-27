<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function customer( ) {
        return $this -> belongsTo( customer::class );
    }

    public function sales( ) {
        return $this -> hasMany( Sale::class , 'created_by' );
    }

}
