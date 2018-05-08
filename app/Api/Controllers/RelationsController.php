<?php

namespace App\Api\Controllers;

use Illuminate\Http\Request;
use App\Relation;
use App\User;
use Dingo\Api\Routing\Router;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class RelationsController extends BaseController
{
  public function addFriend(Request $request){
    $user1=JWTAuth::parseToken()->authenticate()->id;
    $user2= $request->userdes;

    $rel = new Relation;
    $rel->ori = $user1;
    $rel->des = $user2;
    $rel->status = 0;
    $rel->save();
  }

  public function confirmFriend(Request $request){
    $user1=JWTAuth::parseToken()->authenticate()->id;
    $user2=$request->userdes;
    $rel= Relation::where('ori',$user1)->where('des',$user2)->find();
    
    $rel->status = 1;
    $rel->save();
  }

  public function getRequests(Request $request){
    $user2=JWTAuth::parseToken()->authenticate()->id;
    $relations= Relation::where('des',$user2)->where('status',0)->get();
    $req=[];
    foreach ($relations as $rel) {
      array_push($req,User::find($rel->ori));
    }
    return $req;
  }

  public function getFriends(Request $request){
    $user=JWTAuth::parseToken()->authenticate()->id;

    $rels=Relation::where('ori',$user)->orWhere('des',$user)->get();
    $friends=[];
    for ($i=0; $i < count($rels) ; $i++) {
      if($rels[$i]->ori!=$user){
        array_push($friends,$rels[$i]->ori);
      }
      if($rels[$i]->des!=$user){
        array_push($friends,$rels[$i]->des);
      }
    }
    $fr=[];
    foreach ($friends as $key => $value) {
      $user=User::find($value);
      array_push($fr,$user);
    }

    return $fr;
  }
}
