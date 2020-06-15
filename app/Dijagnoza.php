<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dijagnoza extends Model
{
  public function kartoni(){
return $this->belongsToMany('App\Karton');
}
}
