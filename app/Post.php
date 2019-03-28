<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function media() {
        return $this->morhMany('App\Media', 'media_owner');
    }

    public function comments() {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function likes() {
        return $this->morphMany('App\Like', 'likeable');
    }
}
