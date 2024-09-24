<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Common\Traits\MultiActionTrait;

use App\Models\OrdersModel;

Use Validator;
Use Session;
use DataTables;
use Excel;

class MostViewedProductReportController extends Controller
{
	use MultiActionTrait;
	public function __construct(OrdersModel $orders_model)
	{
		$this->arr_view_data      = [];
		$this->admin_panel_slug   = config('app.project.admin_panel_slug');
		$this->admin_url_path     = url(config('app.project.admin_panel_slug'));
		$this->module_url_path    = $this->admin_url_path."/reports/most_viewed_product";
		$this->module_title       = "Most Viewed Products Report";
		$this->module_view_folder = "admin.reports.orders";
		$this->module_icon        = "fa fa-eye";

		$this->OrdersModel        = $orders_model;
		$this->BaseModel          = $orders_model;
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
}
