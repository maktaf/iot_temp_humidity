<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    public $timestamps = false;
    
    public function datas(){
    	return $this->hasMany('App\Data');
    }
}
