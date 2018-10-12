<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    public $timestamps = false;
    public function systems(){
    	return $this->belongsTo('App\System');
    }
}
