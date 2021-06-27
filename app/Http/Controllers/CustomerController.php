<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginCustomerRequest;
use App\Http\Requests\CreateUserRequest;
use App\Models\customer;
use App\Models\User;

use Auth ;
use Hash ;

class CustomerController extends Controller {

    public function login( LoginCustomerRequest $request ) {

        if( ! Auth::guard( 'customer' ) -> attempt( $request -> all( ) ) ) return $this -> makeResponse( 'auth.failed' , 422 ) ;
        else return $this -> makeResponse( 'auth.logged' , 200 , [ 'customer' => customer::where( 'email' , $request -> get( 'email' ) ) -> first( ) ] ) ;

    }

    public function CreateUser( CreateUserRequest $request ) {

        return $this -> makeResponse( 'Customer.created' , 200 , [
            'user' => Auth::user( ) -> users( ) -> create( [
                'email'    =>                $request -> get( 'email'      ) ,
                'password' => Hash :: make ( $request -> get( 'password' ) ) ,
            ] ) 
        ]) ;

    }

}
