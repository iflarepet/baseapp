<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\AuthenticationException;
use App\Model\Menu;
use Session;
use Auth;
use Carbon\Carbon;
use App\Model\UserActivity;

class AppMiddleware
{
	protected $except = ['/','view', 'search', 'locale'];
	
	
	/* @param  \Illuminate\Http\Request  $request
	* @param  \Closure  $next
	* @return mixed
	*/
	public function handle($request, Closure $next, ...$guards)
	{
		$url = Route::getCurrentRoute()->uri(); 
		foreach ($this->except as $e) {
			if (strpos($url, $e) === 0) {
				return $next($request);
			}
		}

		$list = null; 
		if (Auth::user()) { 
			$list = Session::get('menu'); 
			if ($list==null) {
				$list = Menu::join('menu_role', 'menus.id', '=', 'menu_role.menu_id')
				->join('roles', 'roles.id', '=', 'menu_role.role_id')
				->join('user_role', 'roles.id', '=', 'user_role.role_id')
				->join('users', 'users.id', '=', 'user_role.user_id')
				->where('users.id', '=', Auth::user()->id)
				->select('menus.*')
				->distinct()->get();
				Session::put('menu', $list);
			} 
		} else { 
			$list = Session::get('menu');   
			if ($list==null || count($list)==0) {
				$list = Menu::join('menu_role', 'menus.id', '=', 'menu_role.menu_id')
				->join('roles', 'roles.id', '=', 'menu_role.role_id')
				->where('roles.id', '=', '4')
				->select('menus.*')
				->distinct()->get();
				Session::put('menu', $list);
			}
			 
		}  
		// add log user activity
		if (Auth::user()) {  
			$now = Carbon::now();
			$userActivity = UserActivity::whereUserId(Auth::user()->id)->first();
			if ($userActivity) { 
				UserActivity::whereUserId(Auth::user()->id)->update([
                    'last_activity' => $request->url(),
					'last_activity_at' => $now,
					'last_ip' => $request->ip()
                    ]);	
			} 
		}

		// super user by pass all 
		if (Auth::user()) {  
			if (count(Auth::user()->roles)>0 &&Auth::user()->roles[0]->id=='1') 
				return $next($request); 
		} 
		
		if ($list!=null) {
			foreach ($list as $e) {  
				if (strpos($url, $e->url) === 0) { 
					return $next($request);
				}
			} 
		}
		
// 		return $next($request);
// 		return redirect('home')->with('error','You have not admin access');



		throw new AuthenticationException('Unauthenticated.', $guards);
	}
	
	protected function authenticate(array $guards)
	{
		if (empty($guards)) {
			return $this->auth->authenticate();
		}
		
		foreach ($guards as $guard) {
			if ($this->auth->guard($guard)->check()) {
				return $this->auth->shouldUse($guard);
			}
		}
		
		throw new AuthenticationException('Unauthenticated.', $guards);
	}
}
