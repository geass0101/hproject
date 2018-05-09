<?php

namespace App;

use App\Relation;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Facades\JWTAuth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'email', 'password', 'type', 'city', 'country', 'profile',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany('App\Post', 'created_by');
    }

    public static function getFriends()
    {
        $user = JWTAuth::parseToken()->authenticate()->id;
        $rels = Relation::where('ori', $user)->orWhere('des', $user)->get();
        $self = User::find($user);
        $friends = [];
        for ($i = 0; $i < count($rels); $i++) {
            if ($rels[$i]->ori != $user) {
                array_push($friends, $rels[$i]->ori);
            }
            if ($rels[$i]->des != $user) {
                array_push($friends, $rels[$i]->des);
            }
        }
        $fr = [];
        foreach ($friends as $key => $value) {
            $user = User::find($value);
            array_push($fr, $user);
        }
        array_push($fr, $self);
        return $fr;
    }

}
