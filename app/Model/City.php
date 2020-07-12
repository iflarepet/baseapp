<?php


namespace App\Model; 


class City extends AppModel
{
	
	
	protected $table = 'city';
	 
	protected $fillable = [
			'name', 'country_code', 'district', 'population',  
	];
	
	
	public function country()
	{
		return $this->hasOne('App\Model\Country', 'code', 'country_code');
	}
} 