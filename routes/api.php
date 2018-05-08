<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

// JWT API
$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Api\Controllers'], function ($api) {
        $api->post('authenticate', 'AuthenticateController@authenticate');
        $api->post('register', 'AuthenticateController@register');
        $api->post('refresh-token', 'AuthenticateController@refreshToken');

        // UsersController
        $api->get('profile','UsersController@fetchProfile');
        $api->post('profile','UsersController@editProfile');

        // Friends
        $api->get('friends','RelationsController@getFriends');
        $api->post('friends','RelationsController@addFriend');
        $api->get('requests','RelationsController@getRequests');
        $api->post('requests','RelationsController@confirmFriend');

        //Search
        $api->post('search','UsersController@searchUsers');

        //Posts
        $api->get('posts','PostsController@getPosts');
        $api->post('create','PostsController@createPost');

        $api->group( [ 'middleware' => ['jwt.auth'] ], function ($api) {
            $api->get('jokes', 'JokesController@index');
            $api->get('authenticate/user', ['as' => 'auth.user', 'uses' => 'AuthenticateController@getAuthenticatedUser']);
        });
    });
});
