<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\VerifyApiEmail;

//use App\Following;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable, SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
	protected $appends = [
        //'details',
        'attributes',
        'gender',
        'birthday',
		'followings',
		'followers',
		'profile_picture_url'
    ];

    public function details() {
        return $this->hasOne('App\UserDetails');
    }

    public function attributes() {
        return $this->hasMany('App\UserAttribute');
    }

    public function bankDetails() {
        return $this->hasMany('App\BankDetail');
    }

    public function wallet() {
        return $this->hasOne('App\Wallet');
    }

    public function postedChanllenges() {
        return $this->hasMany('App\Challenge', 'challenger_id');
    }

    public function challenges() {
        return $this->hasMany('App\Challenge', 'challenged_id');
    }

    public function roles() {
        return $this->belongsToMany('App\Role');
    }
	
	public function getDetailsAttribute() {
		return $this->details()->get()->first();
    }
    
    public function getAttributesAttribute() {
        $attributes = $this->attributes()->get();
        return $attributes;
    }
	
	public function getGenderAttribute() {
		if($this->details()->get()->first()) {
			return $this->details()->get()->first()->gender;
		} else return null;
	}
	
	public function getBirthdayAttribute() {
		if($this->details()->get()->first()) {
			return $this->details()->get()->first()->date_of_birth;
		} else return null;
	}
	
    public function followings() {
        $followingModels = $this->hasMany('App\Following', 'following_id');
        /*$followingUsers = $followingModels->map(function($item){
            return User::find($item->following_id);
        });*/
        return $followingModels;
    }

    public function followers() {
        $followerModels = $this->hasMany('App\Following', 'follower_id');
        /*$followerUsers = $followerModels->map(function($item){
            return User::find($item->follower_id);
        }); */
		return $followerModels;
    }

    public function isAdmin() {
        $role = $this->roles()->get()->first();
        return $role->title == 'Admin';
    }
	
	public function getFollowingsAttribute() {
		return $this->followings()->get();
	}
	
	public function getFollowersAttribute() {
		return $this->followers()->get();
	}
	
	public function getProfilePictureUrlAttribute() {
		if($this->details()->get()->first()) {
			return $this->details()->get()->first()->profile_picture_url;
		} else return null;
    }
    
    public function sendApiEmailVerificationNotification()
    {
        //return "hello";
        $this->notify(new VerifyApiEmail);
    }
}