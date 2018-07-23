<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts(){
    	return $this->belongsToMany('App\Post');//laravel ispects name of table post_tag in alphabatical order
    }
}
