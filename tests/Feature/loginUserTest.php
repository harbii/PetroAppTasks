<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\customer;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class loginUserTest extends TestCase {

    use RefreshDatabase ;

    public function test_example( ) {
    
        $customer = customer::factory( ) -> create( ) ;

        $this
            -> postJson( route( 'User.login' ) , [ 'email' => $this -> faker -> unique ( ) -> safeEmail( ) , 'customer_id' => $customer -> id ] )
            -> assertStatus ( Response::HTTP_UNPROCESSABLE_ENTITY )
            -> assertJson   ( [
                'message' => 'The given data was invalid.' ,
                'errors'  => [ 'password' => [ 'The password field is required.' ] ]
            ] )
        ;

        $this
            -> postJson( route( 'User.login' ) , [ 'password' => 'password1D' , 'customer_id' => $customer -> id ] )
            -> assertStatus ( Response::HTTP_UNPROCESSABLE_ENTITY )
            -> assertJson   ( [
                'message' => 'The given data was invalid.' ,
                'errors'  => [ 'email' => [ 'The email field is required.' ] ]
            ] )
        ;

        $this
            -> postJson( route( 'User.login' ) , [
                'email'    => $this -> faker -> unique ( ) -> safeEmail( ) ,
                'password' => 'password1D'
            ] )
            -> assertStatus ( Response::HTTP_UNPROCESSABLE_ENTITY )
            -> assertJson   ( [
                'message' => 'The given data was invalid.' ,
                'errors'  => [ 'customer_id' => [ 'The customer id field is required.' ] ]
            ] )
        ;

        $this
            -> post( route( 'User.login' ) , [
                'customer_id' => $customer -> id ,
                'email'       => $this -> faker -> unique ( ) -> safeEmail( ) ,
                'password'    => 'password1D'
            ] )
            -> assertStatus ( Response::HTTP_UNPROCESSABLE_ENTITY )
            -> assertJson   ( [
                'message' => 'These credentials do not match our records.' ,
                'status'  => Response::HTTP_UNPROCESSABLE_ENTITY           ,
                'check'   => false                                         ,
                'data'    => [ ]                                           ,
            ] )
        ;

        $User = User::factory( ) -> create( ) ;

        $this
            -> post( route( 'User.login' ) , [
                'customer_id' => $User -> customer -> id + 1 ,
                'email'       => $User -> email              ,
                'password'    => 'password1D'
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
            -> post( route( 'User.login' ) , [
                'customer_id' => $User -> customer -> id ,
                'email'       => $User -> email          ,
                'password'    => 'password1Dz'
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
            -> post( route( 'User.login' ) , [
                'customer_id' => $User -> customer -> id ,
                'email'       => $User -> email          ,
                'password'    => 'password1D'
            ] )
            -> assertStatus ( Response::HTTP_OK )
            -> assertJson   ( [
                'message' => 'logged in successfully.' ,
                'status'  => Response::HTTP_OK         ,
                'check'   => true
            ] )
            -> assertJsonStructure( [ 'data' => [ 'user' => [
                'id'          ,
                'customer_id' ,
                'email'       ,
                'created_at'  ,
                'updated_at'  ,
            ]  ]  ] )
        ;

    }
}
