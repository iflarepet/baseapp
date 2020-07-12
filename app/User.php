<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Yajra\Auditable\AuditableTrait;


class User extends Authenticatable
{
    use Notifiable;
    use AuditableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'is_active', 'locked', 'created_by', 'updated_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Model\Role', 'user_role');
    }
    
    
    public function profile()
    {
    	return $this->hasOne('App\Model\Profile', 'user_id', 'id');
    }
    
    // public function socialFacebookAccount()
    // {
    // 	return $this->hasOne('App\SocialFacebookAccount', 'user_id', 'id');
    // }
    
    public function avatar() {
		if ($this->socialFacebookAccount) {
			return $this->socialFacebookAccount->avatar;
		}
		if ($this->profile) {
			if ($this->profile->avatar) {
				return asset(Storage::url($this->profile->avatar));
			}
		}
		
		return asset("images/avatar/noimage.png");
    }
    
    public function notification() 
    {
    	return $this->hasMany('App\Model\Notification', 'user_id', 'id');
    }

}
