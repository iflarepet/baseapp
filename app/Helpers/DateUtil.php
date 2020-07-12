<?php
namespace App\Helpers;

class DateUtil {

	public static function dateFormatDB($strDate) {
		$date = explode('/', $strDate);
		return $date[2] . '-' . $date[0] . '-' . $date[1];
	}
	
	public static function dateTimeFormatDB($strDate, $strTime) {
		$myTime = strtotime($strDate.' '.$strTime);
		return date("Y-m-d H:i:s", $myTime);	
	}
	
	function dateTimeFormat($strDate) {
		$myTime = strtotime($strDate);
		return date("m/d/Y h:i A", $myTime);
	}	
}
