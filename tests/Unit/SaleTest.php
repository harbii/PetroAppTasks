<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\customer;
use App\Models\User;
use App\Models\Sale;
use Symfony\Component\HttpFoundation\Response;

class SaleTest extends TestCase {

    public function testGetList( ) {

        $this -> getJson ( route( 'Sale.getList' ) ) -> assertJson ( [ ] ) ;

        $Sale = Sale::factory( ) -> create( ) ;

        $this
            -> actingAs   ( $Sale -> customer , 'customer' )
            -> getJson    ( route( 'Sale.getList' )        )
            -> assertJson ( [ [ 'id' => $Sale -> id ] ]    )
        ;

        $this
            -> actingAs   ( $Sale -> user , 'user'      )
            -> getJson    ( route( 'Sale.getList' )     )
            -> assertJson ( [ [ 'id' => $Sale -> id ] ] )
        ;

    }

    public function testSaleDelete( ) {

        $this -> deleteJson ( route( 'Sale.delete' ) ) -> assertJson ( [ ] ) ;

        $Sale = Sale::factory( ) -> create( ) ;

        $this
            -> actingAs   ( $Sale -> customer , 'customer' )
            -> deleteJson ( route( 'Sale.delete' ) , [ 'id' => $Sale -> id ] )
            -> assertJson ( [ ] )
        ;

        $this -> assertFalse( Sale::where( 'id' , $Sale -> id ) -> exists( ) );

        $Sale = Sale::factory( ) -> create( ) ;

        $this
            -> actingAs   ( $Sale -> user , 'user' )
            -> deleteJson ( route( 'Sale.delete' ) , [ 'id' => $Sale -> id ] )
            -> assertJson ( [ ] )
        ;

        $this -> assertFalse( Sale::where( 'id' , $Sale -> id ) -> exists( ) );

    }

    public function testCreateDelete( ) {

        $this
            -> postJson           ( route( 'Sale.create' ) )
            -> assertUnauthorized ( )
        ;

        $this
            -> actingAs           ( customer::factory( ) -> create( ) , 'customer' )
            -> postJson           ( route( 'Sale.create' )                         )
            -> assertUnauthorized ( )
        ;

        $User = User::factory( ) -> create( ) ;

        $this
            -> actingAs   ( $User , 'user' )
            -> postJson     ( route( 'Sale.create' ) )
            -> assertStatus ( Response::HTTP_UNPROCESSABLE_ENTITY )
            -> assertJson   ( [
                'message' => 'The given data was invalid.' ,
                'errors'  => [ 'payments' => [ 'The payments field is required.' ] ]
            ] )
        ;

        $this
            -> actingAs     ( $User , 'user' )
            -> postJson     ( route( 'Sale.create' ) , [ 'payments' => $this -> faker -> randomFloat ( 4 , 20 , 100 ) ] )
            -> assertJson   ( [ 'data' => [ 'sale' => [ 'created_by' => $User -> id ] ] ] )
            -> assertStatus ( Response::HTTP_OK )
            -> assertJson   ( [
                'message' => 'created successfully.' ,
                'status'  => Response::HTTP_OK         ,
                'check'   => true
            ] )
            -> assertJsonStructure( [ 'data' => [ 'sale' => [
                'id'          ,
                'payments' ,
                'created_by'       ,
                'created_at'  ,
                'updated_at'  ,
            ]  ]  ] )
        ;

    }

}
