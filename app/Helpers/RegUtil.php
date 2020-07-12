<?php

namespace App\Helpers;
use App\Competition;


class RegUtil {
	
	public function __construct()
	{ 
	} 
	
	public static function getEntryNumber($id) {
		$entryNumber = Competition::find($id)->last_entry_number;
		$entryNumber++;
		Competition::find($id)->update([
				'last_entry_number' => $entryNumber,
		]);
		return $entryNumber;
	}
	
	public static function getRegNumber($id) {
		$regNumber = Competition::find($id)->last_reg_number;
		$regNumber++;
		Competition::find($id)->update([
				'last_reg_number' => $regNumber,
		]);
		return $regNumber;
	}
	
	
	public static function isSelected($reg_id, $list) {
		$isSelect = false;
		for ($j=0;$j<count($list); $j++) {
			if ($list[$j]==$reg_id)
				$isSelect = true;
		}
		return $isSelect;
	}
}