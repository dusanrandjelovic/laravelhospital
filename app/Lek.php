<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lek extends Model
{
  public function kartoni(){
return $this->belongsToMany('App\Karton');
}
}
