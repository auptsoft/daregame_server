<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function challenges() {
        return $this->belongsToMany('App\Challenge');
    }

    public function posts() {
        return $this->belongsToMany('App\Post');
    }
}
