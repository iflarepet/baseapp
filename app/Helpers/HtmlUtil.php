<?php
namespace App\Helpers;
use Jenssegers\Date\Date;
use Session;
use App\Category;
use App\Code;
use Form;
use App;
use App\Post;
use GeoIP;
use Carbon\Carbon;


class HtmlUtil {
 
	public static function dateFormat($strDate) {
        Date::setLocale(App::getLocale());
        return Date::parse($strDate)->format('j F Y');
	}	

	public static function dateTimeFormat($strDate) {
        Date::setLocale(App::getLocale()); 
        return Date::parse($strDate)->format('j F Y h:i A');
    }


    public static function categoryOption($parentId, $selectedId) {
        $htmldesc = "<option value=\"\">-- Select --</option>\n";

        return $htmldesc . HtmlUtil::getCategoryOption("", $parentId, $selectedId);
    }

    public static function getCategoryOption($appendix, $parentId, $selectedId) {
        $htmldesc = "";
        $categories = [];
        if ($parentId!=null) {
            $categories = Category::where('is_active', 'Y')->where('parent_id', $parentId)->get();
        } else {
            $categories = Category::where('is_active', 'Y')->whereNull('parent_id')->get();

        }

		foreach ($categories as $c) {
            $htmldesc .= "<option value='".$c->id."'" .($selectedId==$c->id? "selected=\"selected\"" : "" ) . ">".$appendix.$c->name .' (' . $c->description . ')'."</option>\n";

            $htmldesc .= HtmlUtil::getCategoryOption($appendix."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", $c->id, $selectedId);
            
        } 
        return $htmldesc;
    }

    public static function select(
            $code, 
            $name, 
            $selected = null,
            array $attribute = [],
            array $selectAttributes = [],
            array $optionsAttributes = [],
            array $optgroupsAttributes = []
    ) {
        $list = collect(['' => '--Select--']);
        $list = $list->merge(HtmlUtil::getDataSource($code, $attribute));
        return Form::select($name, $list, $selected, $selectAttributes, $optionsAttributes, $optgroupsAttributes);
    }

    public static function getDataSource($code, array $attribute = []) {
        $c = Code::where('code_group', "DATASOURCE")->where('code', $code)->where('is_active', 'Y')->first();
        if ($c->tag1=="CODE") {
            return HtmlUtil::getCodeData($code, $attribute);
        } else if ($c->tag1=="FUNCTION") {
            return HtmlUtil::getFunctionData($code, $attribute);
        } 
    }


    public static function getCodeData($code, array $attribute = []) {
        return Code::where('code_group', $code)->where('is_active', 'Y')->pluck('code', 'value1');        
    }

    public static function getFunctionData($code, array $attribute = []) {
        if ($code == 'CATEGORY') {
            return HtmlUtil::getCategory($attribute);
        }
    }

    public static function getCategory(array $attribute = [], $appendix = "") {
        $categories = [];
        $list = collect([]);
        if ($attribute['parentId'] !=null) {
            $categories = Category::where('is_active', 'Y')->where('parent_id', $attribute['parentId'])->get();
        } else {
            $categories = Category::where('is_active', 'Y')->whereNull('parent_id')->get();
        }

		foreach ($categories as $c) {
            $list = $list->merge([$c->id=>$appendix.$c->name ]);
            $l = HtmlUtil::getCategory(["parentId"=>$c->id], $appendix."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
            $list = $list->merge($l);
        }
        return $list;
    }


    // public static function getCategory($code, array $attribute = [], $appendix = "") {
    //     $categories = [];
    //     $list = [];
    //     if ($attribute['parentId'] !=null) {
    //         $categories = Category::where('is_active', 'Y')->where('parent_id', $parentId)->get();
    //     } else {
    //         $categories = Category::where('is_active', 'Y')->whereNull('parent_id')->get();

    //     }

	// 	foreach ($categories as $c) {

    //         $htmldesc .= "<option value='".$c->id."'" .($selectedId==$c->id? "selected=\"selected\"" : "" ) . ">".$appendix.$c->name .' (' . $c->description . ')'."</option>\n";

    //         $htmldesc .= HtmlUtil::getCategoryOption($appendix."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", $c->id, $selectedId);
            
    //     } 
    //     return $list;
    // }
    
    public static function getListByCode($code, array $attribute = []) {
        return Code::where('code_group', $code)
                ->where('is_active', 'Y')->pluck('code', 'value1');
    }


    public static function dataSource($code, $selectedId) {
    }

    public static function selectOption($code, $selectedId) {
        return HtmlUtil::searchcode($code, $selectedId);
    }
    

	public static function searchcode($code, $selectedId){
        $htmldesc = "<option value=\"\">-- Select --</option>\n";

		$codegroup = $code;
		$codes = Code::where('code_group', $codegroup)
				->where('is_active', 'Y')->get();
		
		foreach ($codes as $c) {
            $htmldesc .= "<option value='".$c->code."'" .($selectedId==$c->code? "selected=\"selected\"" : "" ) . ">".$c->value1 ."</option>\n";
		}
		return $htmldesc;
	}

    public static function initComment($type, $reference_id) {   
        return Post::where('type', '=', $type)->where('reference_id', '=', $reference_id)->first();
    }

    public static function toLocalTime($date) {
        $ip = \Request::ip();
        // $ip = '36.83.195.74';
        //Get visitors Geo info based on his IP
        $geo = GeoIP::getLocation($ip);
        return Carbon::parse($date)->timezone($geo['timezone'])->format('d M Y H:i');


    }
}
