<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up( ) {
        Schema::create( 'sales' , function ( Blueprint $table ) {
            $table -> id         (                     )                                               ;
            $table -> date       ( 'date'              ) -> default( \DB::raw( 'CURRENT_TIMESTAMP' ) ) ;
            $table -> double     ( 'payments' , 20 , 4 )                                               ;
            $table -> timestamps (                     )                                               ;
            $table -> foreignId  ( 'created_by'        ) -> nullable( ) -> references( 'id' ) -> on( 'users' ) -> onDelete( 'cascade' ) -> onUpdate( 'cascade' ) ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down( ) {
        Schema::dropIfExists( 'sales' );
    }
}
