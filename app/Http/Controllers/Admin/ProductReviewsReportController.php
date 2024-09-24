<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Common\Traits\MultiActionTrait;

use App\Models\ReviewAndRatingModel;

Use Validator;
Use Session;
use DataTables;
use Excel;

class ProductReviewsReportController extends Controller
{
	use MultiActionTrait;
	public function __construct(ReviewAndRatingModel $review_rating_model)
	{
		$this->arr_view_data      = [];
		$this->admin_panel_slug   = config('app.project.admin_panel_slug');
		$this->admin_url_path     = url(config('app.project.admin_panel_slug'));
		$this->module_url_path    = $this->admin_url_path."/reports/product-reviews";
		$this->module_title       = "Products Reviews Report";
		$this->module_view_folder = "admin.reports.product_reviews";
		$this->module_icon        = "fa fa-file-text";

		$this->BaseModel          = $review_rating_model;
	}


	/*
    | Function  : Get all the orders data
    | Author    : Deepak Arvind Salunke
    | Date      : 08/06/2018
    | Output    : Show all orders listing
    */

	public function index()
	{
		$this->arr_view_data['page_title']            = str_plural($this->module_title);
		$this->arr_view_data['parent_module_icon']    = "icon-home2";
		$this->arr_view_data['parent_module_title']   = "Dashboard";
		$this->arr_view_data['parent_module_url']     = url('/').'/admin/dashboard';
		$this->arr_view_data['module_icon']           = $this->module_icon;
		$this->arr_view_data['module_title']          = str_plural($this->module_title);

		$this->arr_view_data['module_url_path']       = $this->module_url_path;
		$this->arr_view_data['admin_panel_slug']      = $this->admin_panel_slug;
		
		return view($this->module_view_folder.'.index',$this->arr_view_data);
	} // end index


	public function load_data(Request $request)
	{
		$build_verification_btn = $btn_class = $order_status = "";

		$arr_search_column      = $request->input('column_filter');
		$start_date             = $arr_search_column['start_date'];
		$end_date               = $arr_search_column['end_date'];

		$obj_reports            = $this->BaseModel;

		if(isset($arr_search_column['q_product_id']) && $arr_search_column['q_product_id']!="")
		{
			$search_id = $arr_search_column['q_product_id'];
			$obj_reports = $obj_reports->whereHas('products_details', function($query) use($search_id){
											$query->where('uid', 'LIKE', "%".$search_id."%");
										});;	
		}

		if(isset($arr_search_column['q_product_name']) && $arr_search_column['q_product_name']!="")
		{
			$search_name = $arr_search_column['q_product_name'];
			$obj_reports = $obj_reports->whereHas('products_details', function($query) use($search_name){
											$query->where('product_name', 'LIKE', "%".$search_name."%");
										});
		}

		// dates filter for reports
		if(isset($start_date) && $start_date!="" && isset($end_date) && $end_date!="")
		{
			$obj_reports = $obj_reports->whereRaw("((DATE('".date('c',strtotime($start_date))."') BETWEEN DATE(created_at) AND DATE(created_at)) OR (DATE('".date('c', strtotime($end_date))."') BETWEEN DATE(created_at) AND DATE(created_at)) OR (DATE(created_at) BETWEEN DATE('".date('c',strtotime($start_date))."') AND DATE('".date('c', strtotime($end_date))."')) OR (DATE(created_at) BETWEEN DATE('".date('c',strtotime($start_date))."') AND DATE('".date('c', strtotime($end_date))."'))) ");
		}


		$obj_reports = $obj_reports->select('id','product_id', \DB::raw('avg(rating) as avg_rating'), \DB::raw('count(rating) as no_of_reviews'))
									->with(['products_details' => function($query){
									 	$query->select('id', 'uid', 'product_name');
								 	}])
								 	->groupBy('product_id')
								 	->orderBy('avg_rating', 'DESC');

		if($obj_reports)
		{
			$json_result  = DataTables::of($obj_reports)->make(true);
			$build_result = $json_result->getData();

			foreach ($build_result->data as $key => $data) 
			{
				if(isset($build_result->data) && sizeof($build_result->data)>0)
				{
					$id = isset($data->id)? base64_encode($data->id) :'';

					$build_result->data[$key]->id            = $id;
					$build_result->data[$key]->product_id    = isset($data->products_details->uid) ? $data->products_details->uid : 'NA';
					$build_result->data[$key]->product_name  = isset($data->products_details->product_name) ? $data->products_details->product_name : 'NA';
					$build_result->data[$key]->avg_rating    = isset($data->avg_rating) ? round($data->avg_rating) :'';
					$build_result->data[$key]->no_of_reviews = isset($data->no_of_reviews) ? $data->no_of_reviews :'';
				}
			}
			return response()->json($build_result);
		}
	}

	/*
    | Function  : Get all the orders data as per filter and generate csv
    | Author    : Deepak Arvind Salunke
    | Date      : 11/05/2018
    | Output    : export to csv
    */

	public function export_csv(Request $request)
	{
		$start_date = $request->input('start_date');
		$end_date   = $request->input('end_date');
		$data       = array();

		$obj_reports = $this->BaseModel->select('id','product_id', \DB::raw('avg(rating) as avg_rating'), \DB::raw('count(rating) as no_of_reviews'))
										->with(['products_details' => function($query){
										 	$query->select('id', 'uid', 'product_name');
									 	}])
									 	->groupBy('product_id')
									 	->orderBy('avg_rating', 'DESC');

		// dates filter for reports
		if(isset($start_date) && $start_date!="" && isset($end_date) && $end_date!="")
		{
			$obj_reports = $obj_reports->whereRaw("((DATE('".date('c',strtotime($start_date))."') BETWEEN DATE(created_at) AND DATE(created_at)) OR (DATE('".date('c', strtotime($end_date))."') BETWEEN DATE(created_at) AND DATE(created_at)) OR (DATE(created_at) BETWEEN DATE('".date('c',strtotime($start_date))."') AND DATE('".date('c', strtotime($end_date))."')) OR (DATE(created_at) BETWEEN DATE('".date('c',strtotime($start_date))."') AND DATE('".date('c', strtotime($end_date))."'))) ");
		}

        if($obj_reports)
        {
            $arr_reports = $obj_reports->get()->toArray();

            foreach ($arr_reports as $key => $reports) 
            {
                $data['Sr. No.']        = ($key+1);
                $data['Product ID']     = isset($reports['products_details']['uid']) ? $reports['products_details']['uid']:'NA';
                $data['Product Name']   = isset($reports['products_details']['product_name']) ? $reports['products_details']['product_name']:'NA';
                $data['No of Reviews']  = isset($reports['no_of_reviews'])? $reports['no_of_reviews']:'NA';
                $data['Average Rating'] = isset($reports['avg_rating'])? $reports['avg_rating']:'';
                
                array_push($this->arr_view_data, $data);    
            }
        }

        $data = $this->arr_view_data;
        $type = 'CSV';

        return Excel::create('Products Reviews', function($excel) use ($data) {

            // Set the title
            $excel->setTitle('Products Reviews Reports');

            // Chain the setters
            $excel->setCreator(config('app.project.name'))
            	  ->setCompany(config('app.project.name'));

            // Call them separately
            $excel->setDescription('Products Reviews Reports');

            $excel->sheet('Products Reviews', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });

        })->download($type);

	} // end export_csv

}
