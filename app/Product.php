<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function catagories(){
        return $this->belongsTo('App\Catagories','catagory_id','id');
    }
    public function section(){
        return $this->belongsTo('App\Section','section_id','id');
    }
}
