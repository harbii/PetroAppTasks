<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\customer;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class loginCustomerTest extends TestCase {

    use RefreshDatabase ;

    public function test_example( ) {
    
        $this
            -> postJson( route( 'Customer.login' ) , [ 'email' => $this -> faker -> unique ( ) -> safeEmail( ) ] )
            -> assertStatus ( Response::HTTP_UNPROCESSABLE_ENTITY )
            -> assertJson   ( [
                'message' => 'The given data was invalid.' ,
                'errors'  => [ 'password' => [ 'The password field is required.' ] ]
            ] )
        ;

        $this
            -> postJson( route( 'Customer.login' ) , [ 'password' => 'password1D' ] )
            -> assertStatus ( Response::HTTP_UNPROCESSABLE_ENTITY )
            -> assertJson   ( [
                'message' => 'The given data was invalid.' ,
                'errors'  => [ 'email' => [ 'The email field is required.' ] ]
            ] )
        ;

        $this
            -> post( route( 'Customer.login' ) , [
                'email'    => $this -> faker -> unique ( ) -> safeEmail( ) ,
                'password' => 'password1D'
            ] )
            -> assertStatus ( Response::HTTP_UNPROCESSABLE_ENTITY )
            -> assertJson   ( [
                'message' => 'These credentials do not match our records.' ,
                'status'  => Response::HTTP_UNPROCESSABLE_ENTITY           ,
                'check'   => false                                         ,
                'data'    => [ ]                                           ,
            ] )
        ;

        $customer = customer::factory( ) -> create( ) ;

        $this
            -> post( route( 'Customer.login' ) , [
                'email'    => $customer -> email ,
                'password' => 'password1Dz'
            ] )
            -> assertStatus ( Response::HTTP_UNPROCESSABLE_ENTITY )
            -> assertJson   ( [
                'message' => 'These credentials do not match our records.' ,
                'status'  => Response::HTTP_UNPROCESSABLE_ENTITY           ,
                'check'   => false                                         ,
                'data'    => [ ]                                           ,
            ] )
        ;

        $this
            -> post( route( 'Customer.login' ) , [
                'email'    => $customer -> email ,
                'password' => 'password1D'
            ] )
            -> assertStatus ( Response::HTTP_OK )
            -> assertJson   ( [
                'message' => 'logged in successfully.' ,
                'status'  => Response::HTTP_OK         ,
                'check'   => true
            ] )
            -> assertJsonStructure( [ 'data' => [ 'customer' => [
                'id'         ,
                'name'       ,
                'email'      ,
                'created_at' ,
                'updated_at' ,
            ]  ]  ] )
        ;

    }
}
