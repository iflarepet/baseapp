<?php

namespace App\Model; 

use phpDocumentor\Reflection\Types\This;
use Illuminate\Support\Facades\DB; 

class Menu extends AppModel
{ 
	
	protected $fillable = [
			'parent_id', 'name', 'description', 'url', 'resource_id', 'icon_id','order_number', 'tag', 'is_active'
	];
	  
	
	public function parent() {
		return $this->hasOne('App\Model\Menu', 'id', 'parent_id');
	}
	
	
	public function roles()
	{
		return $this->belongsToMany('App\Model\Role', 'menu_role');
	}
	 
}