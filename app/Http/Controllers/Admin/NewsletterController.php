<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NewsletterModel;
use App\Common\Traits\MultiActionTrait;

use Validator;
use DataTables;
use Session;
use Excel;

class NewsletterController extends Controller
{
    use MultiActionTrait;	
	public function __construct(NewsletterModel $newsletter_model)
	{
		$this->arr_data           = [];
		$this->BaseModel          = $newsletter_model;
		$this->admin_panel_slug   = config('app.project.admin_panel_slug');
		$this->admin_url_path     = url(config('app.project.admin_panel_slug'));
		$this->module_url_path    = $this->admin_url_path."/subscribers";
		$this->module_title       = "Subscribers";
		$this->module_view_folder = "admin.newsletters";
		$this->module_icon        = "fa fa-comments-o";
	}

	public function index()
	{

		$this->arr_data['page_title']          = "Manage ".str_plural($this->module_title);
		$this->arr_data['parent_module_icon']   = "icon-home2";
        $this->arr_data['parent_module_title']  = "Dashboard";
        $this->arr_data['module_title']         = "Manage ".$this->module_title;
		$this->arr_data['module_icon']         = $this->module_icon;
		$this->arr_data['module_url_path']     = $this->module_url_path.'/manage';
		$this->arr_data['data_url_path']       = $this->module_url_path.'/load';
		$this->arr_data['form_url_path']       = $this->module_url_path;
		$this->arr_data['admin_panel_slug']    = $this->admin_panel_slug;
		$this->arr_data['parent_module_url']    = $this->admin_url_path;

		return view($this->module_view_folder.'.index',$this->arr_data);

	}	

	public function load_data(Request $request)
	{
		$arr_search_column      = $request->input('column_filter');


		$obj_brands = $this->BaseModel;
		if(isset($arr_search_column['q_email']) && $arr_search_column['q_email']!="")
		{
			$obj_brands = $obj_brands->where('email', 'LIKE', "%".$arr_search_column['q_email']."%");	
		}

		if(isset($arr_search_column['q_branddate']) && $arr_search_column['q_branddate']!="")
		{
			$obj_brands = $obj_brands->where('created_at', 'LIKE', "%".$arr_search_column['q_branddate']."%");	
		}
		$obj_brands = $obj_brands->select(['id', 'email', 'created_at']);

		if($obj_brands)
		{
			$json_result  = DataTables::of($obj_brands)->make(true);
			$build_result = $json_result->getData();

			foreach ($build_result->data as $key => $data) 
			{


				$delete_href   = $this->module_url_path.'/delete/'.base64_encode($data->id);

				if(isset($build_result->data) && sizeof($build_result->data)>0)
				{

					$built_delete_button = "<a class='btn btn-default btn-rounded show-tooltip' title='Delete' href='".$delete_href."' onclick='return confirm_action(this,event,\"Do you really want to delete this record ?\")' ><i class='fa fa-trash' ></i></a>";

					$action_button = $built_delete_button;
					$id            = isset($data->id)? base64_encode($data->id) :'';
					$email         = isset($data->email)? $data->email :'';
					$created_at    = isset($data->created_at)? get_formated_created_date($data->created_at) :'';

					$build_result->data[$key]->id                  = $id;				
					$build_result->data[$key]->email               = $email;				
					$build_result->data[$key]->created_at          = $created_at;
					$build_result->data[$key]->built_action_button = $action_button;

				}
			}
			return response()->json($build_result);
		}
	}


	/*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 18/05/2018
    | Output    : export to csv
    */

	public function export_csv(Request $request)
	{
		$start_date = $request->input('start_date');
		$end_date = $request->input('end_date');
		$data = array();

		$obj_users  = $this->BaseModel;

		// serach filter for reports
		if(isset($start_date) && $start_date!="" && isset($end_date) && $end_date!="")
		{
			$obj_users = $obj_users->whereRaw("((DATE('".date('c',strtotime($start_date))."') BETWEEN DATE(created_at) AND DATE(created_at)) OR (DATE('".date('c', strtotime($end_date))."') BETWEEN DATE(created_at) AND DATE(created_at)) OR (DATE(created_at) BETWEEN DATE('".date('c',strtotime($start_date))."') AND DATE('".date('c', strtotime($end_date))."')) OR (DATE(created_at) BETWEEN DATE('".date('c',strtotime($start_date))."') AND DATE('".date('c', strtotime($end_date))."'))) ");
		}

        if($obj_users)
        {
            $arr_user = $obj_users->get()->toArray();

            foreach ($arr_user as $key => $user) 
            {
                $data['Sr. No.']            = ($key+1);
                $data['Email']  			= isset($user['email'])? $user['email']:'NA';
                $data['Subscribe On']       = isset($user['created_at'])? $user['created_at'] :'';

                array_push($this->arr_data, $data);    
            }
        }

        $data = $this->arr_data;
        $type = 'CSV';

        return Excel::create('Subscribers', function($excel) use ($data) {

            // Set the title
            $excel->setTitle('Subscribers Reports');

            // Chain the setters
            $excel->setCreator(config('app.project.name'))
            	  ->setCompany(config('app.project.name'));

            // Call them separately
            $excel->setDescription('Subscribers Reports');

            $excel->sheet('Subscribers', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });

        })->download($type);

	} // end export_csv
}
