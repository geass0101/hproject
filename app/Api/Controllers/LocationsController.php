<?php

namespace App\Api\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class LocationsController extends BaseController
{
    public function storeLocation(Request $request)
    {
        $id = JWTAuth::parseToken()->authenticate()->id;
        $loc = Localization::find($id);
        if (isset($loc)) {
            $loc->lat = $request->lat;
            $loc->long = $request->long;
            $loc->save();
        } else {
            $loc = new Localization;
            $loc->id = $id;
            $loc->lat = $request->lat;
            $loc->long = $request->long;
        }
    }

}
