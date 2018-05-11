<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ori', 'des', 'status',
    ];
    public function ori()
    {
        return $this->belongsTo('App\User', 'ori');
    }
    public function des()
    {
        return $this->belongsTo('App\User', 'des');
    }
}
