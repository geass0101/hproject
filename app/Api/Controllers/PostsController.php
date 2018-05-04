<?php

namespace App\Api\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Dingo\Api\Routing\Router;
use Tymon\JWTAuth\Facades\JWTAuth;

class PostsController.php extends Controller
{
  public function createPost(Request $request){
      $post = new Post;
      $post->body=$request->body;
      $post->created_by=JWTAuth::parseToken()->authenticate()->id;
      $post->type=$request->type;
      if(isset($request->date)){
        $post->date=$request->date;
      } else {
        $post->date=date('d-m-Y');
      }
      $post->save();
  }

  public function editPost(Request $request){

  }

  public function deletePost(Request $request){
    
  }


}
