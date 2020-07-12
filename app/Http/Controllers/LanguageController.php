<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;
use App;

class LanguageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	parent::__construct(); 
    }

    public function change($lang) {
        //Languages you will be using in your app.
        $languages = ['en','id','th'];

        //Chech if language in link exist in array of languages you will be using in your app
        if(in_array($lang, $languages)) {
            //Set cookie for furder check
            //We use this to make sure language doesnt change on every App boot
            //Cookie will expire in two weeks
            //Change expire based on your wants and needs
        	\Session::put('locale', $lang);

             
            Cookie::queue(Cookie::make('lang', $lang , '20160'));
            // Cookie::queue('lang', $lang , '20160');
            //Redirect back
            return redirect()->back();

        } else {
            //We use this for good measure
            //Set default language
            App::setLocale(App::getLocale()); 
            //Redirect back
            return redirect()->back();
        }

    }
}