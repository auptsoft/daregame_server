<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAttribute extends Model
{
    protected $fillable = [
        'name',
        'value',
        'user_id',
        'visibility'
    ];
    public function user() {
        return $this->belongsTo('App\User');
    }
}
