<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pacijent extends Model
{
  public function user(){
  return $this->belongsTo('App\User');
}
public function karton(){
  return $this->hasOne('App\Karton');
}
}
