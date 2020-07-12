<?php
namespace App\Helpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Lang;
use App\User; 
use App\Model\Notification;  
use App\Model\UserActivity;

class NotificationHelper {

	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public static function getList($keyword, $userId)
	{
		if ($keyword) {
			$notifications = Notification::latest()->Where('message', 'LIKE', '%' . $keyword . '%')
			->where("user_id", $userId)
			->paginate(10);
		} else {
			$notifications = Notification::latest()->where("user_id", $userId)
			->paginate(10);
		}
		return $notifications;
	}
	
	public static function getNewList($userId)
	{
		$notifications = Notification::latest()->where("user_id", $userId)->where('status', "NEW")->paginate(10);
		return $notifications;
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public static function store($userId, $message, $param, $url)
	{
		$notification = Notification::create([
				'user_id' => $userId,
				'message' => $message,
				'param' => json_encode($param),
				'url' => $url,
				'date' => Carbon::now(),
				'status' => 'NEW',
				'created_by' => 'SYSTEM',
				'updated_by' => 'SYSTEM',
		]); 

		// notify user if login to the system
		$userActivity = UserActivity::whereUserId($userId)
						->whereNull('logout_at')
						->first();
		if ($userActivity) {			 
			$now = Carbon::now(); 
			$diff = $now->diffInMinutes($userActivity->last_activity_at);
			if ($diff<=30) {
				$id = $notification->id;
				$message = self::show($id);
				$timestamp = $notification->timestamp();
				event(new \App\Events\NotificationEvent($userId,$id,$message,$timestamp));
			}

		}

	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public static function get($id)
	{
		return Notification::find($id);
	}
	
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public static function update($data, $id)
	{
		return Notification::find($id)->update($data);
	}
	
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public static function destroy($id)
	{
		return Notification::find($id)->delete();
	}
	
	
	public static function read($userId, $id)
	{
		$d = Notification::where('id', $id)->where("user_id", $userId);
		if ($d) {
			return Notification::find($id)->update(['status'=>"READ"]);
		}
		return false;
		
	}
	
	public static function allread($userId)
	{
		$notifications = Notification::where('status', 'NEW')->where("user_id", $userId)->get();
		
		foreach ($notifications as $n) {
			NotificationHelper::read($userId, $n->id);
		} 
		return true;
	}
	
	public static function show($id) 
	{
		$notification = Notification::find($id);
		$messageId = $notification->message;
		$json = $notification->param;
		$param = (array)json_decode($json,true);
		$message = Lang::get('message.'.$messageId, $param);
		return $message;
	}
	
	public static function broadcast($message, $param, $url) {
		$users = User::get();
		foreach ($users as $user) {
			self::store($user->id, $message, $param, $url);
		}
	}
	 

}
