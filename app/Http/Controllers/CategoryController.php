<?php 

namespace App\Http\Controllers; 

use Illuminate\Http\Request;
use Auth;
use App\Category;
use Illuminate\Support\Facades\Route;  
use Illuminate\Support\Facades\Lang;
      
class CategoryController extends Controller {
	 
	
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
			$categories = Category::where('name', 'LIKE', '%' . $query . '%')->paginate(10);
			$categories->appends($request->only('keyword'));
		} else {
			$categories = Category::paginate(10);			
		} 
		return view('modules.admin.competition.category.indexcategory',compact('categories'));
	}
	 
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{ 
		return view('modules.admin.competition.category.addcategory');
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
		Category::create($input);
		 
		return redirect()->route('category.index')
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
		$category = Category::find($id);
		return view('modules.admin.competition.category.showcategory',compact('category'));
	}
	
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{ 
		$category = Category::find($id);
		return view('modules.admin.competition.category.editcategory',compact('category'));
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
				'is_active' => 'required',
		]);
		Category::find($id)->update($request->all());
		
		return redirect()->route('category.index')->with('success',Lang::get('label.update_successfully'));
		  
	}
	
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{  
		Category::find($id)->delete();
		return redirect()->route('modules.admin.competition.category.index')
		->with('success',Lang::get('label.deleted_successfully'));
	}
	 
	public function searchcategory(Request $request){
		$query = $request->get('term','');
		$categories = Category::where('name', 'LIKE', '%' . $query . '%')->where('is_active', 'Y')->get();
		
		$data=array();
		foreach ($categories as $c) {
			$data[]=array('category_id'=>$c->id,'name'=>$c->name .' (' . $c->description . ')');
		}
		return $data;
	}
	
}
