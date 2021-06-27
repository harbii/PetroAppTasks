<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition( ) { return [
        'email'       => $this -> faker -> unique ( ) -> safeEmail( ) ,
        'customer_id' => customer::Factory        ( )                 , 
        'password' => '$2y$04$2hQ6qx9/olDScTBquglOy.AQOtdcqGmDGPqjnADQmRp3bpK3Sghnm'         , 
        // password1D
    ]; }
}
