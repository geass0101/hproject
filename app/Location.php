<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['id', 'lat', 'long'];

    public function user()
    {
        return $this->hasOne('App\User');
    }
}
