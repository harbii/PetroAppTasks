<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Auth;

class UserController extends Controller {

    public function login( LoginUserRequest $request ) {

        if( ! Auth::guard( 'user' ) -> attempt( $request -> all( ) ) ) return $this -> makeResponse( 'auth.failed' , 422 ) ;
        else return $this -> makeResponse( 'auth.logged' , 200 , [ 'user' => User::where( 'email' , $request -> get( 'email' ) ) -> first( ) ] ) ;

    }

}
