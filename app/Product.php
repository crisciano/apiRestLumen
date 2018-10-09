<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** um produto pertence a uma categoria ==> belongsTo <== */
    public function categories(){
        return $this->belongsTo('App\Category');
    }
}
