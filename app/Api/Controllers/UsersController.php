<?php

namespace App\Api\Controllers;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UsersController extends BaseController
{

    public function searchUsers(Request $request)
    {
        if (isset($request->name)) {
            return User::where('name', 'LIKE', '%' . $request->name . '%')->get();
        } else {
            return 'No se ha indicado nombre de usuario';
        }
    }
    public function geosearchUsers(Request $request)
    {
        $users = Location::where('lat', $request->lat)->where('long', $request->long)->user()->get();

    }

    public function searchMembers($city)
    {
        return User::where('city', $city)->where('type', 1)->get();
    }

    public function searchGroups($city)
    {
        return User::where('city', $city)->where('type', 2)->get();
    }

    public function fetchProfile(Request $request)
    {
        $id = JWTAuth::parseToken()->authenticate()->id;
        return User::where('id', $id)->get();
    }

    public function getProfile(Request $request)
    {
        $id = $request->id;
        return User::where('id', $id)->get();
    }

    public function editProfile(Request $request)
    {
        $id = JWTAuth::parseToken()->authenticate()->id;
        $user = User::where('id', $id)->get()[0];
        $user->profile = $request->profile;
        $user->name = $request->name;
        $user->city = $request->city;
        $user->save();
    }
}
