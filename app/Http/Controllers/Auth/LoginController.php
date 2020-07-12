<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use App\Model\Menu;
use App\Model\UserActivity;
use Session;
use Carbon\Carbon;
use Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {
    	$field = filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL)
    	? $this->username()
    	: 'username';
    	
    	return [
    			$field => $request->get($this->username()),
    			'password' => $request->password,
    	];
    }
    
    protected function authenticated(Request $request, $user)
    { 
//     	App\Role::where('id', $user-id);
    
    	
//     	throw ValidationException::withMessages([
//     			$this->username() => [trans('auth.locked')],
//     	]);
// 		$list = array();

    	$list = Menu::join('menu_role', 'menus.id', '=', 'menu_role.menu_id')
    	->join('roles', 'roles.id', '=', 'menu_role.role_id')
    	->join('user_role', 'roles.id', '=', 'user_role.role_id')
    	->join('users', 'users.id', '=', 'user_role.user_id')
    	->where('users.id', '=', $user->id)
    	->select('menus.*')
    	->distinct()->get();
    	Session::put('menu', $list); 
        
        $now = Carbon::now();

        $userActivity = UserActivity::whereUserId($user->id)->first();
        if ($userActivity) { 
            UserActivity::whereUserId($user->id)->update([
                    'login_at' => $now,
                    'logout_at' => null,
                    'last_activity' => $request->url(),
                    'last_activity_at' => $now,
                    'last_ip' => $request->ip()
                    ]);	
        } else { 
            UserActivity::create([
                'user_id' => $user->id,
                'login_at' => $now,
                'last_activity' => $request->url(),
                'last_activity_at' => $now,
                'last_ip' => $request->ip()
                ]);     
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $now = Carbon::now();
        $userActivity = UserActivity::whereUserId(Auth::user()->id)->first();
        if ($userActivity) { 
            UserActivity::whereUserId(Auth::user()->id)->update([
                    'logout_at' => $now,
                    'last_activity' => $request->url(),
                    'last_activity_at' => $now,
                    'last_ip' => $request->ip()
                    ]);	
        } 

        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }

}
