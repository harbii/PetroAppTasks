<?php

namespace Database\Factories;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sale::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition( ) { return [
        'date'       => now                           (              ) ,
        'payments'   => $this -> faker -> randomFloat ( 4 , 20 , 100 ) ,
        'created_by' => user  :: Factory              (              ) ,
    ] ; }
}
