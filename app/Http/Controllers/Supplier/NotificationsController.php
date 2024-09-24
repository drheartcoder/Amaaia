<?php

namespace App\Http\Controllers\Supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Common\Traits\MultiActionTrait;

use App\Models\NotificationsModel;

use Session;
use Validator;
use DataTables;
class NotificationsController extends Controller
{
	use MultiActionTrait;
	
	public function __construct(NotificationsModel $notifications_model)
	{
		$this->arr_view_data       = [];
		$this->NotificationsModel  = $notifications_model;
		$this->supplier_panel_slug = config('app.project.supplier_panel_slug');
		$this->supplier_url_path   = url(config('app.project.supplier_panel_slug'));
		$this->module_url_path    = $this->supplier_url_path."/notifications";
		$this->module_title       = "Notification";
		$this->module_view_folder = "supplier.notifications";
		$this->module_icon        = "fa fa-bell";
		$this->BaseModel          = $notifications_model;
	}
	public function index()
	{
		$login_supplier_id = 0;
		$login_supplier_id = login_user_id('supplier');

		$this->NotificationsModel->where([
			'is_read'            => '0',
			'receiver_user_type' => '3',
			'receiver_user_id'   => $login_supplier_id
		])
		->update(['is_read'=>'1']);
		
		$this->arr_view_data['parent_module_icon']   = "icon-home2";
		$this->arr_view_data['parent_module_title']  = "Dashboard";
		$this->arr_view_data['parent_module_url']    = $this->supplier_url_path.'/dashboard';
		$this->arr_view_data['page_title']           = "Manage ".str_plural($this->module_title);
		$this->arr_view_data['module_title']         = "Manage ".str_plural($this->module_title);
		$this->arr_view_data['module_icon']          = $this->module_icon;
		$this->arr_view_data['module_url_path']      = $this->module_url_path;
		$this->arr_view_data['supplier_panel_slug']  = $this->supplier_panel_slug;
		
		return view($this->module_view_folder.'.index',$this->arr_view_data);
	}

	public function load_data(Request $request)
	{
		$login_supplier_id = '';
		$arr_search_column      = $request->input('column_filter');

		$obj_notificatins = $this->BaseModel;
		if(isset($arr_search_column['q_notification']) && $arr_search_column['q_notification']!="")
		{
			$obj_notificatins = $obj_notificatins->where('notification_message', 'LIKE', "%".$arr_search_column['q_notification']."%");	
		}

		$login_supplier_id = login_user_id('supplier');

		$obj_notificatins = $obj_notificatins->select(['id', 'notification_message','notification_url', 'is_read', 'created_at'])->where([
			'receiver_user_type' => '3',
			'receiver_user_id'   => $login_supplier_id,
		]);

		if($obj_notificatins)
		{
			$json_result  = DataTables::of($obj_notificatins)->make(true);
			$build_result = $json_result->getData();

			foreach ($build_result->data as $key => $data) 
			{
				$built_view_href   = $this->module_url_path.'/edit/'.base64_encode($data->id);

				$built_bank_details_href   = $this->module_url_path.'/delete/'.base64_encode($data->id);

				if(isset($build_result->data) && sizeof($build_result->data)>0)
				{
					if($data->is_read != null && $data->is_read == "0")
					{   
						$build_status_btn = '<a class="btn btn-circle show-tooltip" style="color:red;" title="Unread" href="javascript:void(0)" data-original-title="Unread"><i class="fa fa-circle"  title="Unread" style="color:red;"></i></a>';
					}
					elseif($data->is_read != null && $data->is_read == "1")
					{
						$build_status_btn = '<a class="btn btn-circle show-tooltip" style="color:green;" title="Read" href="javascript:void(0)" data-original-title="Read"><i class="fa fa-circle" title="Read" style="color:green;"></i></a>';
					}

					$built_delete_button = "<a class='btn btn-default btn-rounded show-tooltip' title='Delete' href='".$built_bank_details_href."'  data-original-title='View Bank Details' onclick='return confirm_action(this,event,\"Do you really want to delete this record ?\")' ><i class='fa fa-trash' ></i></a>";

					$action_button = $built_delete_button;

					$id = isset($data->id)? base64_encode($data->id) :'';

					if(isset($data->notification_message) && !empty($data->notification_message))
					{
						$msg = htmlspecialchars_decode($data->notification_message);
						if(isset($data->notification_url) && !empty($data->notification_url))
						{
							$notification_message = "<a href='".$data->notification_url."' target='_blank'>".$msg."</a>";	
						}
						else
						{
							$notification_message = $msg;	
						}
						
					}

					$build_result->data[$key]->id                   = $id;				
					$build_result->data[$key]->notification_message = isset($notification_message)? $notification_message :'NA';				
					$build_result->data[$key]->created_at          = isset($data->created_at)? get_formated_created_date($data->created_at) :'';

					$build_result->data[$key]->build_status_check  = $build_status_btn;
					$build_result->data[$key]->built_action_button = $action_button;

				}
			}
			return response()->json($build_result);
		}
	}

	/*
    | Function  : Set notification status as read.
    | Name      : Deepak Bari
    | Date      : 21 June, 2018
    */

	public function read($enc_notification_id = false)
	{
		$arr_response = [];
		if($enc_notification_id != false)
		{
			$notification_id = base64_decode($enc_notification_id);

			$status = $this->BaseModel->where('id',$notification_id)
					            	  ->update(['is_read'=>'1']);

			if($status)
			{
				$arr_response['status'] = 'success';
			}
			else
			{
				$arr_response['status'] = 'error';	
			}
		}
		else
		{
			$arr_response['status'] = 'error';	
		}

		return $arr_response;
	}

}
