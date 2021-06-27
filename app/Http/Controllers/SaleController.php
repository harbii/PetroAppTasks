<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteSaleRequest;
use App\Http\Requests\CreateSaleRequest;

use Auth ;

class SaleController extends Controller {

    public function getList( ) {

        return ( Auth::check( ) ) ? Auth::user( ) -> sales : [ ] ;

    }

    public function delete( DeleteSaleRequest $Request ) {

        return ( Auth::check( ) ) ? [ Auth::user( ) -> sales( ) -> find( $Request -> id ) -> delete( ) ] : [ ] ;

    }

    public function create( CreateSaleRequest $request ) {

        return $this -> makeResponse( 'Customer.created' , 200 , [
            'sale' => Auth::user( ) -> sales( ) -> create( $request -> all( ) ) 
        ]) ;

    }

}
