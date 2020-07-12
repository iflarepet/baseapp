<?php

namespace App\Model;
 
use Carbon\Carbon;
use Illuminate\Support\Facades\Lang;

class Notification extends AppModel
{ 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    		'user_id', 'message', 'param', 'url', 'date', 'status', 'created_by', 'updated_by'
    ];  

    public function timestamp() {
    	$now = Carbon::now(); 
    	$date = Carbon::parse($this->date);

    	$secDiff = $date->diffInSeconds($now);
    	$minDiff = $date->diffInMinutes($now);
    	$hourDiff = $date->diffInHours($now);    	
    	$dayDiff = $date->diffInDays($now);
    	$str = "";
    	if ($secDiff<10) {
    		$str = Lang::get('notification.now');
		} else if ($secDiff<60) {
    		$str = $secDiff . " " . Lang::get('notification.sec');
    	}else if ($minDiff<60) {
    		$str = $minDiff . " " . Lang::get('notification.min');
    	} else if ($hourDiff<24) {
    		$str = $hourDiff . " " . Lang::get('notification.hour');
    	} else {
    		if ($dayDiff==1)
    			$str = $dayDiff . " " . Lang::get('notification.day');
    		else
    			$str = $dayDiff . " " . Lang::get('notification.days');
    	}
    	return $str; 
    }
}
