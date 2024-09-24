<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ValuationModel;

use DataTables;
use Session;
use Validator;

class ValuationController extends Controller
{
    public function __construct(
    							ValuationModel           $valuation_model
    						)
	{
		$this->BaseModel  			        = $valuation_model;

		$this->arr_view_data                = [];
		$this->admin_panel_slug             = config('app.project.admin_panel_slug');
		$this->admin_url_path               = url(config('app.project.admin_panel_slug'));
		$this->module_url_path              = $this->admin_url_path."/valuation";
		$this->module_title                 = "Valuation Requests";
		$this->module_view_folder           = "admin.valuation";
		$this->module_icon                  = "fa fa-calendar";

		$this->valuation_img_base_path   = base_path().config('app.project.img_path.valuation_image');
        $this->valuation_img_public_path = url('/').config('app.project.img_path.valuation_image');
        
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

	public function load_data(Request $request)
	{
		$customer_first_name = $customer_last_name = $customer_name = $product_name = '';

		$arr_search_column      = $request->input('column_filter');

		$obj_return_request = $this->BaseModel;
		if(isset($arr_search_column['q_user_name']) && $arr_search_column['q_user_name']!="")
		{
			$user_name = $arr_search_column['q_user_name'];
			$obj_return_request = $obj_return_request->wherehas('user_details',function($query) use($user_name){
				$query->where('first_name', 'LIKE', "%".$user_name."%");
				$query->orWhere('last_name', 'LIKE', "%".$user_name."%");
			});
		}

		$obj_return_request = $obj_return_request->select('*')
									   			->with(['user_details' => function($query){
									   				$query->select('id','first_name','last_name');
									   			}])
									   			->orderBy('created_at','DESC')->get();


		if($obj_return_request)
		{
			$json_result  = DataTables::of($obj_return_request)->make(true);
			$build_result = $json_result->getData();

			foreach ($build_result->data as $key => $data) 
			{
				$order_product_id     = '';
				$order_product_id     = isset($data->order_product_details->id)? base64_encode($data->order_product_details->id) :'';

				$built_view_href   = $this->module_url_path.'/view/'.base64_encode($data->id).'/'.$order_product_id;

				if(isset($build_result->data) && sizeof($build_result->data)>0)
				{
					

					$built_view_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_view_href."' title='View' data-original-title='View'><i class='fa fa-eye' ></i></a>";

					$action_button = $built_view_button;

					$customer_first_name   = isset($data->user_details->first_name)? $data->user_details->first_name :'';				
					$customer_last_name    = isset($data->user_details->last_name)? $data->user_details->last_name :'';			

					$customer_name         = $customer_first_name.' '.$customer_last_name;	


					$id = isset($data->id)? base64_encode($data->id) :'';

					$build_result->data[$key]->id                 = $id;				
					
					$build_result->data[$key]->customer_name      = isset($customer_name)? $customer_name :'NA';	
					$build_result->data[$key]->mobile_number      = isset($data->mobile_number)? $data->mobile_number :'NA';

					$build_result->data[$key]->appointment_date   = isset($data->appointment_date)? get_formated_created_date($data->appointment_date) :'NA';
					$build_result->data[$key]->appointment_time   = isset($data->appointment_time)? date('h:i a',strtotime($data->appointment_time)) :'NA';

					$build_result->data[$key]->created_at         = isset($data->created_at)? get_formated_created_date($data->created_at) :'';	
					
					$build_result->data[$key]->built_action_button= $action_button;

				}
			}
			return response()->json($build_result);
		}
	}

	function view($valuation_enc_id)
	{
		if($valuation_enc_id != false)
		{
			$valuation_id = base64_decode($valuation_enc_id);
			
			
			$arr_valuation = [];
			$obj_valuation = $this->BaseModel->where('id',$valuation_id)
									  ->with(['user_details' => function($query){
									   				$query->select('id','first_name','last_name');
									   		}])
									  ->first();
			if($obj_valuation)
			{
				$arr_valuation = $obj_valuation->toArray();	
			}

			$this->arr_view_data['valuation_img_base_path']    = $this->valuation_img_base_path;
			$this->arr_view_data['valuation_img_public_path']  = $this->valuation_img_public_path;

			$this->arr_view_data['arr_valuation']   		   = $arr_valuation;
			$this->arr_view_data['page_title']                 = "View ".$this->module_title;
			$this->arr_view_data['parent_module_icon']         = "icon-home2";
			$this->arr_view_data['parent_module_title']        = "Dashboard";
			$this->arr_view_data['parent_module_url']          = $this->admin_url_path.'/dashboard';
			$this->arr_view_data['module_title']               = str_plural($this->module_title);
			$this->arr_view_data['module_url']                 = $this->module_url_path;
			$this->arr_view_data['module_icon']                = $this->module_icon;
			$this->arr_view_data['admin_panel_slug']           = $this->admin_panel_slug;
			$this->arr_view_data['sub_module_title']           = 'View '.$this->module_title;
			$this->arr_view_data['sub_module_icon']            = 'fa fa-eye';
			$this->arr_view_data['module_url_path']            = $this->module_url_path;

			return view($this->module_view_folder.'.view',$this->arr_view_data);
		}
		else
		{
			Session::flash('error','Something went to wrong ! Please try again later.');
			return redirect()->back();
		}
	}


}
