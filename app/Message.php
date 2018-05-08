<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
     protected $fillable = ['id','idconversation','body', 'ori','des'];
     
  public function ori(){
      return $this->belongsTo('App\User', 'ori');
  }

  public function des(){
      return $this->belongsTo('App\User', 'des');
  }
}
