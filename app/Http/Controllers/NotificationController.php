<?php 

namespace App\Http\Controllers; 

use Auth;
use Illuminate\Http\Request; 
use NotificationHelper;

class NotificationController extends Controller {
	  
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
		$keyword = $request->input('keyword');		
		$notifications = NotificationHelper::getList($keyword, Auth::user()->id);
		return view('modules.notification.indexnotification', compact('notifications'));
	}
	  
	public function show(Request $request, $id)
	{
		NotificationHelper::read(Auth::user()->id, $id);
		$notification = NotificationHelper::get($id);	
		if ($notification->url=="#") {
			return redirect()->back();
		} else {
			return redirect($notification->url);
		}
	}
	
	public function read(Request $request, $id)
	{
		NotificationHelper::read(Auth::user()->id, $id);
		return redirect()->back();
	}
	
	public function allread(Request $request)
	{
		NotificationHelper::allread(Auth::user()->id);
		return redirect()->back();
	}
	
}
