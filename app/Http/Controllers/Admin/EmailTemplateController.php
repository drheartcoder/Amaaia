<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Traits\MultiActionTrait;

use App\Models\EmailTemplateModel;

use Validator;
use Session;
use DataTables;


class EmailTemplateController extends Controller
{
	use MultiActionTrait;	

	public function __construct(EmailTemplateModel $email_template_model)
	{
		$this->arr_view_data           = [];
		$this->EmailTemplateModel = $email_template_model;
		$this->admin_panel_slug   = config('app.project.admin_panel_slug');
		$this->admin_url_path     = url(config('app.project.admin_panel_slug'));
		$this->module_url_path    = $this->admin_url_path."/email_template";
		$this->module_title       = "Email Template";
		$this->module_view_folder = "admin.email_template";
		$this->module_icon        = "fa fa fa-envelope-square";
		$this->BaseModel          = $email_template_model;
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

	public function create()
	{
		$this->arr_view_data['parent_module_icon']  = "icon-home2";
		$this->arr_view_data['parent_module_title'] = "Dashboard";
		$this->arr_view_data['parent_module_url']   = $this->admin_url_path.'/dashboard';
		$this->arr_view_data['page_title']          = "Manage ".str_plural($this->module_title);
		$this->arr_view_data['module_title']        = "Manage ".str_plural($this->module_title);
		$this->arr_view_data['module_icon']         = $this->module_icon;
		$this->arr_view_data['module_url']     	   = $this->module_url_path;
		$this->arr_view_data['module_url_path']     = $this->module_url_path;
		$this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
		$this->arr_view_data['sub_module_title']    = 'Add '.str_singular($this->module_title);
		$this->arr_view_data['sub_module_icon']     = 'fa fa-plus';

		return view($this->module_view_folder.'.create',$this->arr_view_data);
	}

	public function store(Request $request)
	{
		$arr_rules      = $arr_occassion = array();
		$status         = false;

		$arr_rules['occasion_name']  =  "required";

		$validator = validator::make($request->all(),$arr_rules);

		if ($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$occasion_name = $request->input('occasion_name', null);

		$slug       = str_slug($occasion_name);

		$model = "OccasionsModel";

		$slug = get_slug($model,$slug);

		$arr_occassion['occasion_name'] = $occasion_name;
		$arr_occassion['slug']          = $slug;
		$arr_occassion['status']        = '1';

		$dose_exist = $this->BaseModel->where('occasion_name', '=', $occasion_name)->count();

		if($dose_exist> 0 )
		{
			Session::flash('error', $this->module_title.' with this name already exist.');
			return redirect()->back();
		}
		
		$status = $this->BaseModel->create($arr_occassion);		

		if($status)
		{
			Session::flash('success', $this->module_title.' added successfully.');
			return redirect($this->module_url_path);
		}

		Session::flash('error', 'Error while adding '.$this->module_title.'.');
		return redirect()->back();
	}

	public function edit($enc_id)
	{
		$id = base64_decode($enc_id);
		$arr_email_template = $arr_variables = [];

		$obj_email_template = $this->BaseModel->where('id',$id)->select('*')->first();
		
		if($obj_email_template)
		{
			$arr_email_template = $obj_email_template->toArray();	
		}

		$arr_variables = isset($arr_email_template['template_variables']) && !empty($arr_email_template['template_variables']) ? explode("~",$arr_email_template['template_variables']):array();



		$this->arr_view_data['arr_variables']       = $arr_variables;
		$this->arr_view_data['arr_email_template']  = $arr_email_template;
		$this->arr_view_data['id']                  = $enc_id;
		$this->arr_view_data['page_title']          = "Edit ".str_singular($this->module_title);
		$this->arr_view_data['parent_module_icon']  = "icon-home2";
		$this->arr_view_data['parent_module_title'] = "Dashboard";
		$this->arr_view_data['parent_module_url']   = $this->admin_url_path.'/dashboard';
		$this->arr_view_data['module_title']        = str_plural($this->module_title);
		$this->arr_view_data['module_icon']         = $this->module_icon;
		$this->arr_view_data['module_icon']         = $this->module_icon;
		$this->arr_view_data['module_url']          = $this->module_url_path;
		$this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
		$this->arr_view_data['sub_module_title']    = 'Edit '.str_singular($this->module_title);
		$this->arr_view_data['sub_module_icon']     = 'fa fa-pencil-square-o';

		$this->arr_view_data['module_url_path']     = $this->module_url_path;

		return view($this->module_view_folder.'.edit',$this->arr_view_data);
	}

	public function update(Request $request, $enc_id)
	{
		$arr_rules      = $arr_template = array();
		$status         = false;

		$arr_rules['template_name']       = "required";
		$arr_rules['template_from']       = "required";
		$arr_rules['template_from_mail']  = "required";
		$arr_rules['template_subject']    = "required";
		$arr_rules['template_html']       = "required";

		$validator = validator::make($request->all(),$arr_rules);

		if ($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$template_name = $request->input('template_name', null);
		$id         = base64_decode($enc_id);


		$arr_template['template_name']      = $template_name;
		$arr_template['template_from']      = $request->input('template_from', null);
		$arr_template['template_from_mail'] = $request->input('template_from_mail', null);
		$arr_template['template_subject']   = $request->input('template_subject', null);
		$arr_template['template_html']      = $request->input('template_html', null);

		$dose_exist = $this->BaseModel->where('template_name', '=', $template_name)->where('id', '!=', $id)->count();

		if($dose_exist> 0 )
		{
			Session::flash('error', $this->module_title.' with this name already exist.');
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


		$obj_email_templates = $this->BaseModel;
		if(isset($arr_search_column['q_template_name']) && $arr_search_column['q_template_name']!="")
		{
			$obj_email_templates = $obj_email_templates->where('template_name', 'LIKE', "%".$arr_search_column['q_template_name']."%");	
		}

		$obj_email_templates = $obj_email_templates->select(['id', 'template_name', 'template_subject', 'template_from','template_from_mail','created_at']);

		if($obj_email_templates)
		{
			$json_result  = DataTables::of($obj_email_templates)->make(true);
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

					$build_result->data[$key]->template_subject              = isset($data->template_subject)? $data->template_subject :'';

					$build_result->data[$key]->template_from              = isset($data->template_from)? $data->template_from :'';

					$build_result->data[$key]->template_from_mail              = isset($data->template_from_mail)? $data->template_from_mail :'';

					$build_result->data[$key]->created_at          = isset($data->created_at)? get_formated_created_date($data->created_at) :'';

					$build_result->data[$key]->built_action_button = $action_button;

				}
			}
			return response()->json($build_result);
		}
	}

	 public function preview(Request $request)
    {
        $form_data = [];

        $content ="";
        
        $form_data = $request->all();

        if(isset($form_data['preview_html']) && !empty($form_data['preview_html']))
        {
            if(isset($form_data['preview_html']) && !empty($form_data['preview_html']))
            {
                $content = html_entity_decode($form_data['preview_html']);
                return view('admin.email.general',compact('content'))->render();    
            }
            else
            {
                Session::flash('error','Please enter '.str_singular($this->module_title).' content');
                return redirect()->back();       
            }
        }
        else
        {
            Session::flash('error','Problem occured while showing '.str_singular($this->module_title).' preview');
            return redirect()->back();
        }
    }


}
