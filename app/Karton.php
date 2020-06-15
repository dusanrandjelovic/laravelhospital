<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karton extends Model
{
  public function pacijent(){
  return $this->belongsTo('App\Pacijent');
}

public function lekovi(){
  return $this->belongsToMany('App\Lek');
}

public function dijagnoze(){
  return $this->belongsToMany('App\Dijagnoza');
}
}
