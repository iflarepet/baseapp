<?php

namespace App\Model;
  
class MenuRole extends AppModel
{  
	protected $table = 'menu_role';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'menu_id', 'role_id',  
	];
	
	 
}
