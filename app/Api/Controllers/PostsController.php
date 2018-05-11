<?php

namespace App\Api\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class PostsController extends BaseController
{
    public function createPost(Request $request)
    {
        $post = new Post;
        $post->body = $request->body;
        $post->created_by = JWTAuth::parseToken()->authenticate()->id;
        $post->type = $request->type;
        $post->save();
    }

    public function getPosts(Request $request)
    {
        $fr = User::getFriends();
        $posts = [];
        foreach ($fr as $friend) {
            $frp = $friend->posts()->get();
            foreach ($frp as $post) {
                $post->user = $friend->name;
                array_push($posts, $post);
            }
        };
        $col = collect($posts);
        $col2 = $col->sortByDesc('timestamp');

        return $col2->values()->all();
    }

    public function editPost(Request $request)
    {

    }

    public function deletePost(Request $request)
    {

    }

}
