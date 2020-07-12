<?php 

namespace App\Http\Controllers; 

use Illuminate\Http\Request;
use Auth; 
use App\User;
use App\Model\Profile;
use Illuminate\Support\Facades\Lang;
use App\Services\CompetitionService;
use App\Services\FollowService;

class ProfileController extends Controller {
	 
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
		return view('modules.profile.indexprofile');
	}
	 
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{ 
		return view('modules.profile.indexprofile' );
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
				'category_id' => 'required',
				'name' => 'required',
				'description' => 'required',
				'is_active' => 'required',
		]); 
		 
		$input = $request->all(); 
		Template::create($input);
		 
		return redirect()->route('template.index')
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
		$user = User::find($id); 
		$registrations = Registration::where('user_id', $id)->paginate(5);
		$requestHandlers = Registration::where('handler_id', $id)->paginate(5);
		$competitionUsers = CompetitionUser::where('user_id', $id)->paginate(5);
		$competitionUsers = CompetitionUser::where('user_id', $id)->paginate(5);
		$userData = $this->competitionService->getUserChamp($id); 
		return view('modules.profile.viewprofile', compact('user', 'userData', 'registrations', 'requestHandlers'));
	}
	
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{ 
		$user = User::find(Auth::user()->id); 
		return view('modules.profile.editprofile',compact('user'));
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
		$type = request()->input('type');

		$user = User::find(Auth::user()->id);

		if ($type && $type=='avatar' && $request->file('image')!=null) {
			$uploadedFile = $request->file('image');
			$path = $uploadedFile->store('public/files/avatar');
		
			if ($user->profile==null) {
				Profile::create([
						'user_id' => Auth::user()->id,
						'avatar' => $path
				]); 
			} else {
				Profile::where('user_id', Auth::user()->id)
				->update([
						'avatar' => $path
						]);
			}
			return redirect()->route('profile.index');
			
		} else {
			request()->validate([
					'name' => 'required|string|max:100',
			]);
			
			$data = $request->all();
			$dob = $this->dateFormat($data['dob']);
			if ($user->profile==null) {
				Profile::create([
						'user_id' => Auth::user()->id,
						'dob' => $dob,
						'origin_id' => $data['origin_id'],
						'phone' => $data['phone'],
						'address1' => $data['address1'],
						'address2' => $data['address2'],
						'address3' => $data['address3'],
						'postal_code' => $data['postal_code'],
						'city_id' => $data['city_id'], 
				]); 
			} else {
				Profile::where('user_id', Auth::user()->id)
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
			
			return redirect()->route('profile.index')->with('success',Lang::get('label.update_successfully'));
		} 
	}

	
	public function transhipperprofile(Request $request, $id)
	{ 
		$user = User::find($id);  
		$routes = Route::where('transhipper_id', $id)->paginate(5);
		$schedules = Schedule::where('transhipper_id', $id)->latest()->paginate(5); 
		return view('modules.profile.indextranshipperprofile', compact('user', 'routes', 'schedules') );
	}
	
	
	function dateFormat($strDate) {
		if ($strDate!=null) {
			$date = explode('/', $strDate);
			return $date[2] . '-' . $date[0] . '-' . $date[1];
		}
		return null;
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{  
		return view('modules.profile.indexprofile');
	}
	  
	public function follow($id)
	{ 
		$this->followService->profileFollowing($id, Auth::user()->id);
		return redirect()->back();
	}

	public function removeFollower($id) {
		$this->followService->profileFollowing(Auth::user()->id, $id);
		return redirect()->back();		
	}
	
	public function follower(Request $request, $id)
	{ 
		$user = User::find($id);  
		$followers = $this->followService->getProfileFollower($id);

		if ($request->ajax()) {
			$view = view('modules.profile.follower-data',compact('user', 'followers'))->render();
			return response()->json(['html'=>$view]);
		}
		return view('modules.profile.indexfollower', compact('user', 'followers'));
	}
	
	public function following(Request $request, $id)
	{ 
		$user = User::find($id);  
		$followers = $this->followService->getProfileFollowing($id);

		if ($request->ajax()) {
			$view = view('modules.profile.follower-data',compact('user', 'followers'))->render();
			return response()->json(['html'=>$view]);
		}
		return view('modules.profile.indexfollowing', compact('user', 'followers'));			
	}
}
