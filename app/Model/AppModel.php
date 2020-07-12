<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Yajra\Auditable\AuditableTrait;

class AppModel extends Model
{ 
	
	use SoftDeletes;
	
	use AuditableTrait;
	 
	protected $dates = ['deleted_at'];
	 
	
	protected $timestamp=true;
}