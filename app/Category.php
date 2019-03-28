<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
	
	protected $appends = [
		'media'
	];

    protected $dates = ['deleted_at'];

    public function challenges() {
        return $this->hasMany('App\Challenge');
    }

    public function media() {
        return $this->morphMany('App\Media', 'owner');
    }
	
	public function getMediaAttribute() {
		return $this->media()->get();
	}
}
