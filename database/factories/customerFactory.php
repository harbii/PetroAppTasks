<?php

namespace Database\Factories;

use App\Models\customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class customerFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition( ) { return [
        'name'     => $this -> faker -> unique( ) -> name                                    ,
        'email'    => rand( 0 , 999999999999999 ) . $this -> faker -> unique( ) -> safeEmail ,
        'password' => '$2y$04$2hQ6qx9/olDScTBquglOy.AQOtdcqGmDGPqjnADQmRp3bpK3Sghnm'         , 
        // password1D
    ] ; }
}
