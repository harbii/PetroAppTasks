<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController {

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function makeResponse( string $message , int $status = 200 , array $data = [ ] ) {
        return response( ) -> json( [
            'message' => trans ( $message ) ,
            'data'    => $data              ,
            'status'  => $status            ,
            'check'   => $status === 200 ? true : false
        ] , $status );
    }

}
