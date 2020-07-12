<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
 
use Yajra\Auditable\AuditableTrait;
use Illuminate\Support\Facades\Storage;

class UserActivity extends AppModel
{

	protected $table = 'user_activity';
	
	protected $fillable = [
			'user_id', 'login_at', 'logout_at', 'last_activity','last_activity_at','last_ip'
	];
	
     
}
