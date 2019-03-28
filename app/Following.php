<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Following extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function following() {
        return $this->belongsTo('App\User', 'following_id');
    }

    public function follower() {
        return $this->belongsTo('App\User', 'follower_id');
    }
}
