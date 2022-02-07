<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catagories extends Model
{
    protected $table ='catagories';
    public function subcatagories(){
        return $this->hasMany('App\Catagories','parent_id')->where('status',1);
    }
    public function parentcatagory(){
        return $this->belongsTo('App\Catagories','parent_id');
    }
    public function section(){
        return $this->belongsTo('App\Section','section_id')->select('id','name');
    }
}
