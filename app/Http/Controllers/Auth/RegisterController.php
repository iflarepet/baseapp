<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Model\UserRole;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use NotificationHelper;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    const default_role_id = '3';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        	'username' => 'required|string|unique:users'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     * 
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    { 
 		$user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
 			'username' => $data['username'],
 			'is_active' => 'Y',
 			'locked' => 'N',
 			'created_by' => $data['username'],
 			'updated_by' => $data['username'] 				
        ]); 
 		UserRole::create([
 			'user_id' => $user->id,
 			'role_id' => SELF::default_role_id,
 			'created_by' => $data['username'],
 			'updated_by' => $data['username']
 		]);
 		
 		
 		$param = [
 				'imgsrc' => $user->avatar(),
 				'name' => $user->name
 		];
 		NotificationHelper::store($user->id, 'message_001', $param, "#");
 		
 		return $user;
    }
}