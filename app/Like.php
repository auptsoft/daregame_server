<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    public function likeable(){
        return $this->morphTo();
    }
}
