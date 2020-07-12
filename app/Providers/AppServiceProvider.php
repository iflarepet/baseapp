<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use App;
use Cookie;
use GeoIP;
use Request;
use Carbon\Carbon;
use Crypt;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Validator::extend('recaptcha', 'App\\Validators\\ReCaptcha@validate');          

        //Check for 'lang' cookie
        $cookie = Cookie::get('lang');

        // //Get visitors IP
        $ip = \Request::ip();
        // //Get visitors Geo info based on his IP
        $geo = GeoIP::getLocation($ip);
        //Get visitors country name
        $country = $geo['country'];
        //Prepared language based on country name
        //Add as many as you want
        $languages = [
            'United States' => 'en',
            'Indonesia' => 'id',
            'Thailand' => 'th',
        ];

        if(isset($cookie) && !empty($cookie)) {
            // if ( \Session::has('locale')) {
            //If cookie exist change application language
            //We use this for good measure
            $cookie = Crypt::decrypt($cookie);
            App::setLocale($cookie); 
            Carbon::setLocale($cookie);

        }else {
            //If cookie doesnt exist
            //Check country name in languages array
            if (array_key_exists($country, $languages)) {
                //Get country value(language) from array
                $lang = $languages[$country];
                //Set language based on value
                // dd($lang);
                App::setLocale($lang); 
                Carbon::setLocale($lang);
            }
            else {
                //Set language for good measure
                App::setLocale(App::getLocale()); 
                Carbon::setLocale($cookie);
            }
        }        
    }

}
