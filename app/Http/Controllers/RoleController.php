<?php 

namespace App\Http\Controllers; 

use Illuminate\Http\Request;
use Auth;
use App\Model\Role;
use Illuminate\Support\Facades\Route;  
use Illuminate\Support\Facades\Lang;

class RoleController extends Controller {
	 
	
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
			$roles = Role::where('name', 'LIKE', '%' . $query . '%')->
			orWhere('description', 'LIKE', '%' . $query . '%')->paginate(10);
			$roles->appends($request->only('keyword'));
		} else {
			$roles = Role::paginate(10);			
		} 
		return view('modules.role.indexrole', compact('roles'));
	}
	 
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Responsee
	 */
	public function create()
	{ 
		return view('modules.role.addrole');
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
				'name' => 'required', 
				'is_active' => 'required',
		]);
		
		$input = $request->all();
		Role::create($input);
		 
		return redirect()->route('role.index')
		->with('success',Lang::get('label.created_successfully'));
	}
	
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$role = Role::find($id);
		return view('modules.role.showrole',compact('role'));
	}
	
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{ 
		$role = Role::find($id);
		return view('modules.role.editrole',compact('role'));
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
				'name' => 'required',
// 				'description' => 'required',
				'is_active' => 'required',
		]);
		Role::find($id)->update($request->all());
		
		return redirect()->route('role.index')->with('success',Lang::get('label.update_successfully'));
		  
	}
	
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{   
		Role::find($id)->delete(); 
		return redirect()->route('role.index')
		->with('success',Lang::get('label.deleted_successfully'));
	}
	 
	public function combo() {
		$listdb = Role::lists('name', 'id');
		return View::make('combo')->with('dcom', $listdb);
	}
	
	public function menurole() {
		return view('modules.menurole.menurole');
		
	}
	
	public function storemenu() {
		return view('modules.menurole.menurole');
		
	}
	
	
}
