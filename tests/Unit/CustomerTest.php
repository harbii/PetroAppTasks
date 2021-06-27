<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\customer;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class CustomerTest extends TestCase {

    public function CreateCustomerProvider( ) : array {
        parent::setUp( );
        return [ [
            'customer' => customer::factory( ) -> create( )
        ] ];
    }

    /**
     * @testdox check if user use phone number 
     * @dataProvider CreateCustomerProvider
     *
     * @return void
     */
    public function testCreateNewUser( customer $customer ) {

        $this
            -> postJson           ( route( 'Customer.CreateUser' ) , [ 'email' => $this -> faker -> unique ( ) -> safeEmail( ) , 'customer_id' => $customer -> id ] )
            -> assertUnauthorized ( )
        ;

        $this
            -> actingAs     ( $customer , 'customer' )
            -> postJson     ( route( 'Customer.CreateUser' ) , [ 'email' => $this -> faker -> unique ( ) -> safeEmail( ) ] )
            -> assertStatus ( Response::HTTP_UNPROCESSABLE_ENTITY )
            -> assertJson   ( [
                'message' => 'The given data was invalid.' ,
                'errors'  => [ 'password' => [ 'The password field is required.' ] ]
            ] )
        ;

        $this
            -> actingAs     ( $customer , 'customer' )
            -> postJson     ( route( 'Customer.CreateUser' ) , [ 'password' => 'password' ] )
            -> assertStatus ( Response::HTTP_UNPROCESSABLE_ENTITY )
            -> assertJson   ( [
                'message' => 'The given data was invalid.' ,
                'errors'  => [ 'email' => [ 'The email field is required.' ] ]
            ] )
        ;

        $this
            -> actingAs     ( $customer , 'customer' )
            -> postJson     ( route( 'Customer.CreateUser' ) , [
                'email'    => User::factory( ) -> create( ) -> email ,
                'password' => $this -> faker -> unique ( ) -> password  ( 8 ) ,
            ] )
            -> assertStatus ( Response::HTTP_UNPROCESSABLE_ENTITY )
            -> assertJson   ( [
                'message' => 'The given data was invalid.' ,
                'errors'  => [ 'email' => [ 'The email has already been taken.' ] ]
            ] )
        ;

        $this
            -> actingAs     ( $customer , 'customer' )
            -> postJson     ( route( 'Customer.CreateUser' ) , [
                'email'    => $this -> faker -> unique ( ) -> safeEmail (   ) ,
                'password' => $this -> faker -> unique ( ) -> password  ( 8 ) ,
            ] )
            -> assertStatus ( Response::HTTP_OK )
            -> assertJson   ( [
                'message' => 'created successfully.' ,
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
