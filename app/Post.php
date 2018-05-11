<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['id', 'body', 'created_by', 'type'];
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}
