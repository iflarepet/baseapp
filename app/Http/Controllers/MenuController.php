<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Model\Menu;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Lang;

class MenuController extends Controller {
	
	
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
			$menus = Menu::where('name', 'LIKE', '%' . $query . '%')->
			orWhere('description', 'LIKE', '%' . $query . '%')
			->orderBy('id', 'asc')
			->paginate(10);
			$menus->appends($request->only('keyword'));
		} else {
			$menus = Menu::orderBy('id', 'asc')
			->paginate(10);
		} 
		return view('modules.menu.indexmenu',compact('menus'));
	}
	 
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{ 
		return view('modules.menu.addmenu');
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
				'url' => 'required',
				'is_active' => 'required',
		]);
		 
		$input = $request->all(); 
		Menu::create($input);
		
		return redirect()->route('menu.index')
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
		$menu = Menu::find($id);
		return view('modules.menu.showmenu',compact('menu'));
	}
	
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$menu = Menu::find($id);
		return view('modules.menu.editmenu',compact('menu'));
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
				'url' => 'required',
				'is_active' => 'required',
		]);
		Menu::find($id)->update($request->all());
		
		return redirect()->route('menu.index')->with('success',Lang::get('label.update_successfully'));
		 
	}
	
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		Menu::find($id)->delete();
		return redirect()->route('menu.index')->with('success',Lang::get('label.deleted_successfully'));
	}
	
	public function searchmenu(Request $request){
		$query = $request->get('term','');
		$menus = Menu::latest()->where('name', 'LIKE', '%' . $query . '%')->where('is_active', 'Y')->get();
		
		$data=array();
		foreach ($menus as $m) {
			$data[]=array('name'=>($m->parent?$m->parent->name.'-'.$m->name:$m->name),'parent_id'=>$m->id);
		}
		return $data;
	}
}
