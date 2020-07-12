<?php


namespace App\Model; 


class Category extends AppModel
{
	
	
// 	protected $table = 'category';
	
	protected $fillable = [
			'parent_id', 'name', 'description', 'is_active'
	];
	
	public function parent()
	{
		return $this->hasOne('App\Model\Category', 'id', 'parent_id');
	}
	
}