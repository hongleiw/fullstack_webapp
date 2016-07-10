<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //One to Many
    public function card() {
    	return $this->hasMany('App\card');
    }
}
