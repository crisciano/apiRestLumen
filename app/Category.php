<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** uma categoria tem varios produtos ==> hasMany <== **/ 
    public function produtos(){
        return $this->hasMany('App\Product');
    }
}
