<?php


namespace App\Model; 


class Country extends AppModel
{
	
	
	protected $table = 'country';
	
	protected $primaryKey = 'code';  
	
	public $incrementing = false;
	
	protected $fillable = [
			'code', 'name', 'continent', 'region', 'surface_area', 'indep_year', 'local_name', 'government_form', 'capital', 'code2', 'phone_code'
	];
	  
}