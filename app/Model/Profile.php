<?php

namespace App\Model;

class Profile extends AppModel
{ 
	protected $fillable = [
			'user_id', 'avatar', 'dob', 'gender', 'origin_id', 'phone', 'address1', 'address2', 'address3', 'postal_code', 'city_id'											
	];
	
 
	public function origin()
	{
		return $this->hasOne('App\Model\City', 'id', 'origin_id');
	}
	
	public function city()
	{
		return $this->hasOne('App\Model\City', 'id', 'city_id');
	}
	
}