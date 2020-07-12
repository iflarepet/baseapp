<?php

namespace App\Model;
  
class UserRole extends AppModel
{  
	protected $table = 'user_role';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'user_id', 'role_id'
	];
	
	
}
