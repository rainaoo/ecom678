<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    public function category(){
        return $this->belongsTo('App\Category','category_id');
    }

    public function section(){
        return $this->belongsTo('App\Section','section_id');
    }
}
