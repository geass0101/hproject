<?php

namespace App\Api\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Request;
use App\Relation;
use App\User;
use Dingo\Api\Routing\Router;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class PostsController.php extends Controller
{
  public function createPost(Request $request){

      $user1=JWTAuth::parseToken()->authenticate()->id;

  }

  public function confirmFriend(Request $request){

  }


}
