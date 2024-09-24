<?php

namespace App\Http\Controllers\Front\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NotificationsModel;

use Session;
use Validator;

class NotificationsController extends Controller
{
	public function __construct(NotificationsModel $notifications_model)
	{

		$this->arr_view_data       = [];
		$this->user_panel_slug     = config('app.project.user_panel_slug');
		$this->user_url_path       = url(config('app.project.user_panel_slug'));
		$this->module_url_path     = $this->user_url_path;
		$this->module_title        = "Notification";
		
		$this->BaseModel           = $notifications_model;

		$this->module_view_folder  = "front.user.notifications";

		$this->user_panel_slug = config('app.project.user_panel_slug');
		$this->user_url_path       = url(config('app.project.user_panel_slug'));
		$this->module_url_path     = $this->user_url_path."/notifications";
	}

	/*
	| Author    : Deepak Bari
	| Function  : Display listing of notifications.
	*/

	public function index()
	{
		$arr_notification = $arr_pagination = [];
		$login_user_id = 0;
		$login_user_id = login_user_id('user');

		$this->BaseModel->where([
			'is_read'            => '0',
			'receiver_user_type' => '2',
			'receiver_user_id'   => $login_user_id
		])
		->update(['is_read'=>'1']);

		$obj_notification = $this->BaseModel->where([
					             			  'receiver_user_type' => '2',
					             			  'receiver_user_id'   => $login_user_id
					             			])
					             			->orderBy('id','DESC')
					             			->select('id','notification_message','notification_url','type')
		                                    ->paginate(10);

		if($obj_notification)
		{
			$arr_pagination   =  clone $obj_notification;
			$arr_notification = $obj_notification->toArray();
		}

		$this->arr_view_data['parent_module_icon']   = "icon-home2";
		$this->arr_view_data['parent_module_title']  = "Dashboard";
		$this->arr_view_data['parent_module_url']    = $this->user_url_path.'/dashboard';
		$this->arr_view_data['page_title']           = $this->module_title;
		$this->arr_view_data['module_title']         = $this->module_title;
		
		$this->arr_view_data['module_url_path']      = $this->module_url_path;
		$this->arr_view_data['user_panel_slug']      = $this->user_panel_slug;
		$this->arr_view_data['arr_notification']            = $arr_notification;
		$this->arr_view_data['arr_pagination']            = $arr_pagination;
		
		return view($this->module_view_folder.'.index',$this->arr_view_data);
	}

	/*
	| Author    : Deepak Bari
	| Function  : Delete specific notification.
	*/

	public function delete($enc_id)
	{
		if($enc_id)
		{
			$id = base64_decode($enc_id);

			$status = $this->BaseModel->where('id',$id)->delete();

			if($status)
			{
				Session::flash('error',str_singular($this->module_title).' deleted successfully.');
			}
			else
			{
				Session::flash('error','Problem Occurred, While deleting '.str_singular($this->module_title));
			}
		}
		else
		{
			Session::flash('error','Problem Occurred, While deleting '.str_singular($this->module_title));
		}

		return redirect()->back();
	}
}
