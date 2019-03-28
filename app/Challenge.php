<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Challenge extends Model
{
    use SoftDeletes;
	
	protected $appends = [
        'challenger',
		'challenged',
        'category',
        'challenger_media',
		'challenged_media',
		'tags',
		'comments',
		'likes'
    ];
	
	protected $hidden = [
		//'media'
	];

    protected $dates = ['deleted_at'];

    public function challenger() {
        return $this->belongsTo('App\User', 'challenger_id');
    }

    public function challenged() {
        return $this->belongsTo('App\User', 'challenged_id');
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function media() {
        return $this->morphMany('App\Media', 'owner');
    }

    public function comments() {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function likes() {
        return $this->morphMany('App\Like', 'likeable');
    }

    public function tags() {
        return $this->belongsToMany('App\Tag');
    }
	
	public function getChallengerAttribute() {
		return $this->challenger()->get()->first();
	}
	
	public function getTagsAttribute(){
		return $this->tags()->get();
	}
	
	public function getChallengedAttribute() {
		return $this->challenged()->get()->first();
	}
	
	public function getCategoryAttribute(){
		return $this->category()->get()->first();
	}
	
	public function getChallengerMediaAttribute(){
		return $this->media()->where("extra", "challenger")->get();//->first();																																							
	}
	
	public function getChallengedMediaAttribute() {
		return $this->media()->where("extra", 'challenged')->get();//->first();
	}
	
	public function getCommentsAttribute() {
		return $this->comments()->get();
	}
	
	public function getLikesAttribute(){
		$likeables = $this->likes()->get();
		$likers = $likeables->map(function($item) {
			return User::find($item->user_id);
		});
		return $likers;
	}
}
