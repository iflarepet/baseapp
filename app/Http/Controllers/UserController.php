<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\User;
use App\Model\Profile;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Lang;
use App\Model\UserRole;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
	
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}	
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{    
		$query = $request->keyword;
	
		if ($query) {
			$users = User::where('username', 'LIKE', '%' . $query . '%')->
			orWhere('name', 'LIKE', '%' . $query . '%')->
			orWhere('email', 'LIKE', '%' . $query . '%')->paginate(10);
			$users->appends($request->only('keyword'));
		} else {
			$users = User::paginate(10);
		} 
		return view('modules.user.indexuser',compact('users'));
	}
	
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('modules.user.adduser');
	}
	
	
	
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{ 
		
		request()->validate([
				'name' => 'required|string|max:100',
				'email' => 'required|string|email|max:255|unique:users',
				'username' => 'required|string|unique:users',
				'role_id' => 'required|string',
		]);

		
		$password = $this->generateRandomString();
		$data = $request->all();
		
		$user = User::create([
				'name' => $data['name'],
				'email' => $data['email'],
				'password' => Hash::make($password),
				'username' => $data['username'],
				'is_active' => 'Y',
				'locked' => 'N',
				'created_by' => $data['username'],
				'updated_by' => $data['username']
		]);
		UserRole::create([
				'user_id' => $user->id,
				'role_id' => $data['role_id']
		]);
		
		$dob = $this->dateFormat($data['dob']); 
		Profile::create([
				'user_id' => $user->id,
				'dob' => $dob,
				'origin_id' => $data['origin_id'],
				'phone' => $data['phone'],
				'address1' => $data['address1'],
				'address2' => $data['address2'],
				'address3' => $data['address3'],
				'postal_code' => $data['postal_code'],
				'city_id' => $data['city_id'],
		]); 
		
		//todo send email to user
		
		
		return redirect()->route('user.index')
		->with('success',Lang::get('label.created_successfully'));
	}
	

	public function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$user = User::find($id);
		return view('modules.user.showuser',compact('user'));
	}
	
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$user = User::find($id);
		
		return view('modules.user.edituser',compact('user'));
	}
	
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{ 
		request()->validate([
				'name' => 'required|string|max:100',
		]);
		
		$user = User::find($id)->update($request->all());
				
		$data = $request->all();
		
		$userRole = UserRole::where('user_id', $id)->first();
		
		UserRole::find($userRole->id)->update(['role_id' => $data['role_id']]); 
		$dob = $this->dateFormat($data['dob']);
		if (Profile::where('user_id', $id)->get()->count()==0) {
			Profile::create([
					'user_id' => $id,
					'dob' => $dob,
					'origin' => $data['origin_id'],
					'phone' => $data['phone'],
					'address1' => $data['address1'],
					'address2' => $data['address2'],
					'address3' => $data['address3'],
					'postal_code' => $data['postal_code'],
					'city_id' => $data['city_id'],
			]);
		} else {
			Profile::where('user_id', $id)
			->update([
					'dob' => $dob,
					'origin_id' => $data['origin_id'],
					'phone' => $data['phone'],
					'address1' => $data['address1'],
					'address2' => $data['address2'],
					'address3' => $data['address3'],
					'postal_code' => $data['postal_code'],
					'city_id' => $data['city_id'],
			]);
		}
		
		return redirect()->route('user.index')->with('success',Lang::get('label.update_successfully'));
		
	}
	
	public function locked(Request $request, $id)
	{
		User::find($id)->update($request->all());			
		return redirect()->back()->with('success',Lang::get('label.update_successfully'));
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, $id)
	{ 
		return redirect()->route('user.index')->with('success',Lang::get('label.update_successfully')); 
	}
	

	function dateFormat($strDate) {
		if ($strDate!=null) {
			$date = explode('/', $strDate);
			return $date[2] . '-' . $date[0] . '-' . $date[1];
		}
		return null;
	}
	
}
