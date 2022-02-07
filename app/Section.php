<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'sections';
    public function catagories(){
        return $this->hasMany('App\Catagories','section_id')->where(['parent_id'=>0,'status'=>1])->with('subcatagories');
    }
}
