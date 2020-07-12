<?php 

namespace App\Http\Controllers; 

use Illuminate\Http\Request; 
use App\Model\MenuRole;
use App\Model\Role;
use Illuminate\Support\Facades\Route;  
use Illuminate\Support\Facades\Lang;
use App\Menu;

class RoleMenuController extends Controller {
	 
	
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
		$role = $request->input("role");
		
		return view('modules.role.showrole',compact('role'));
	}
	 
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
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
 		$menus = $request->input("menu");
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
		$menurole = MenuRole::where('menu_id', $id)->first();
		return view('modules.role.editrolemenu',compact('menuRole'));
	}
	
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{  
		return view('modules.rolemenu.editrolemenu',compact('id'));
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
		MenuRole::where('role_id', $id)->delete();

		$menus = $request->input("menu");
		
		if ($menus!=null) {
			foreach ($menus as $menu) {
				MenuRole::create([
						'role_id' => $id,
						'menu_id' => $menu
				]);
			}		
		}
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
	
}
