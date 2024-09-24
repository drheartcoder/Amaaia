<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Common\Traits\MultiActionTrait;

use App\Models\NotificationTemplateModel;

use Validator;
use Session;
use DataTables;

class NotificationTemplateController extends Controller
{
  
	use MultiActionTrait;	

	public function __construct(NotificationTemplateModel $notification_template_model)
	{
		$this->arr_view_data              = [];
		$this->NotificationTemplateModel  = $notification_template_model;
		$this->admin_panel_slug           = config('app.project.admin_panel_slug');
		$this->admin_url_path             = url(config('app.project.admin_panel_slug'));
		$this->module_url_path            = $this->admin_url_path."/notification_template";
		$this->module_title               = "Notification Template";
		$this->module_view_folder         = "admin.notification_template";
		$this->module_icon                = "fa fa fa-envelope";
		$this->BaseModel                  = $notification_template_model;
	}

	public function index()
	{
		$this->arr_view_data['parent_module_icon']   = "icon-home2";
		$this->arr_view_data['parent_module_title']  = "Dashboard";
		$this->arr_view_data['parent_module_url']    = $this->admin_url_path.'/dashboard';
		$this->arr_view_data['page_title']           = "Manage ".str_plural($this->module_title);
		$this->arr_view_data['module_title']         = "Manage ".str_plural($this->module_title);
		$this->arr_view_data['module_icon']          = $this->module_icon;
		$this->arr_view_data['module_url_path']      = $this->module_url_path;
		$this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
		
		return view($this->module_view_folder.'.index',$this->arr_view_data);

	}

	public function edit($enc_id)
	{
		$id = base64_decode($enc_id);
		$arr_notification_template = $arr_variables = [];

		$obj_notification_template = $this->BaseModel->where('id',$id)->select('*')->first();
		
		if($obj_notification_template)
		{
			$arr_notification_template = $obj_notification_template->toArray();	
		}

		$arr_variables = isset($arr_notification_template['template_variables']) && !empty($arr_notification_template['template_variables']) ? explode("~",$arr_notification_template['template_variables']):array();

		$this->arr_view_data['arr_variables']              = $arr_variables;
		$this->arr_view_data['arr_notification_template']  = $arr_notification_template;
		$this->arr_view_data['id']                         = $enc_id;
		$this->arr_view_data['page_title']                 = "Edit ".str_singular($this->module_title);
		$this->arr_view_data['parent_module_icon']         = "icon-home2";
		$this->arr_view_data['parent_module_title']        = "Dashboard";
		$this->arr_view_data['parent_module_url']          = $this->admin_url_path.'/dashboard';
		$this->arr_view_data['module_title']               = str_plural($this->module_title);
		$this->arr_view_data['module_icon']                = $this->module_icon;
		$this->arr_view_data['module_icon']                = $this->module_icon;
		$this->arr_view_data['module_url']                 = $this->module_url_path;
		$this->arr_view_data['admin_panel_slug']           = $this->admin_panel_slug;
		$this->arr_view_data['sub_module_title']           = 'Edit '.str_singular($this->module_title);
		$this->arr_view_data['sub_module_icon']            = 'fa fa-pencil-square-o';

		$this->arr_view_data['module_url_path']            = $this->module_url_path;

		return view($this->module_view_folder.'.edit',$this->arr_view_data);
	}

	public function update(Request $request, $enc_id)
	{
		$arr_rules      = $arr_template = array();
		$status         = false;

		$arr_rules['template_name']       = "required";
		$arr_rules['template_html']       = "required";

		$validator = validator::make($request->all(),$arr_rules);

		if ($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$template_name = $request->input('template_name', null);
		$id         = base64_decode($enc_id);


		$arr_template['template_name']      = $template_name;
		$arr_template['template_html']      = $request->input('template_html', null);

		$dose_exist = $this->BaseModel->where('template_name', '=', $template_name)->where('id', '!=', $id)->count();

		if($dose_exist> 0 )
		{
			Session::flash('error', 'This '.$this->module_title.' is already exist.');
			return redirect()->back();
		}
		$status = $this->BaseModel->where('id', $id)->update($arr_template);		

		if($status)
		{
			Session::flash('success', $this->module_title.' updated successfully.');
			return redirect($this->module_url_path);
		}

		Session::flash('error', 'Error while updating '.$this->module_title.'.');
		return redirect()->back();

	}

	public function load_data(Request $request)
	{
		$arr_search_column      = $request->input('column_filter');

		$obj_notification_templates = $this->BaseModel;
		if(isset($arr_search_column['q_template_name']) && $arr_search_column['q_template_name']!="")
		{
			$obj_notification_templates = $obj_notification_templates->where('template_name', 'LIKE', "%".$arr_search_column['q_template_name']."%");	
		}

		$obj_notification_templates = $obj_notification_templates->select(['id', 'template_name','created_at']);

		if($obj_notification_templates)
		{
			$json_result  = DataTables::of($obj_notification_templates)->make(true);
			$build_result = $json_result->getData();

			foreach ($build_result->data as $key => $data) 
			{
				$built_view_href   = $this->module_url_path.'/edit/'.base64_encode($data->id);

				$built_bank_details_href   = $this->module_url_path.'/delete/'.base64_encode($data->id);

				if(isset($build_result->data) && sizeof($build_result->data)>0)
				{
					$built_view_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_view_href."' title='Edit' data-original-title='Edit'><i class='fa fa-pencil-square-o' ></i></a>";

					$action_button = $built_view_button;

					$id = isset($data->id)? base64_encode($data->id) :'';

					$build_result->data[$key]->id                  = $id;				

					$build_result->data[$key]->template_name       = isset($data->template_name)? $data->template_name :'';				

					$build_result->data[$key]->template_subject    = isset($data->template_subject)? $data->template_subject :'';

					$build_result->data[$key]->template_from       = isset($data->template_from)? $data->template_from :'';

					$build_result->data[$key]->template_from_mail  = isset($data->template_from_mail)? $data->template_from_mail :'';

					$build_result->data[$key]->created_at          = isset($data->created_at)? get_formated_created_date($data->created_at) :'';

					$build_result->data[$key]->built_action_button = $action_button;

				}
			}
			return response()->json($build_result);
		}
	}

}
