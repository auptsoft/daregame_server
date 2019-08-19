<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
	
	protected $appends = [
        'media',
        'user',
        'commentable'
	];

    protected $dates = ['deleted_at'];

    public function commentable() {
        return $this->morphTo();
    }
    
    public function media() {
        return $this->morphMany('App\Media', 'owner');
    }
	
	public function getMediaAttribute(){
		return $this->media()->get();
    }
    
    public function getUserAttribute() {
        return User::find($this->attributes['user_id']);
    }

    public function getCommentableAttribute() {
        return null; // return $this->commentable()->get();
    }
}
