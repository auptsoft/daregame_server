<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WalletEvent extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function wallet() {
        return $this->belongsTo('App\Wallet');
    }
}
