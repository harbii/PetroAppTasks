<?php
namespace App\Http\Middleware;
use Closure;
use Auth;
class Localization {
	/**
		* Handle an incoming request.
		*
		* @param \Illuminate\Http\Request $request
		* @param \Closure $next
		* @return mixed
	*/
  	public function handle( $request , Closure $next ) {
		app( ) -> setLocale( ( $request -> hasHeader( 'localization' ) ) ? $request -> header( 'localization' ) : 'en' );
    	return $next( $request );
  	}
}
