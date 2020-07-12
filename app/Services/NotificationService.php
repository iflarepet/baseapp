<?php

namespace App\Services;  
use Illuminate\Support\ServiceProvider;

class NotificationService extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}
	
	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		require_once app_path() . '/Helpers/NotificationHelper.php';
	}
	
	 
}
