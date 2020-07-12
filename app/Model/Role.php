<?php

namespace App\Model;

class Role extends AppModel
{ 
// 	protected $table = 'roles';
	
	protected $fillable = [
			'name', 'description', 'is_active'
	];
	  
}