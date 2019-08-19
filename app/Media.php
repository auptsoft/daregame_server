<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $appends = ['full_url'];
    public function owner() {
        return $this->morphTo();
    }

    public function getFullUrlAttribute() {
        return env('STORAGE_URL').$this->attributes['url'];
    }
}
