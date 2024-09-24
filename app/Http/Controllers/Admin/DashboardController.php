<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\SupplierModel;
use App\Models\OrdersModel;
use App\Models\ProductsModel;
use App\Models\ValuationModel;
use App\Models\ReturnProductRequestModel;
use App\Models\NotificationsModel;
use App\Models\ReplacementProductRequestModel;

use DB;

class DashboardController extends Controller
{
	public function __construct(UserModel $user_model, SupplierModel $supplier_model, OrdersModel $orders_model, ProductsModel $products_model, ReplacementProductRequestModel $replacement_product_request_model)
	{
		$this->arr_view_data                  = [];
		$this->OrdersModel                    = $orders_model;
		$this->UserModel                      = $user_model;
		$this->SupplierModel                  = $supplier_model;
		$this->ProductsModel                  = $products_model;
		$this->ReplacementProductRequestModel = $replacement_product_request_model;

		$this->module_title       = "Dashboard";
		$this->module_view_folder = "admin.dashboard";		
		$this->admin_url_path     = url(config('app.project.admin_panel_slug'));
		$this->admin_panel_slug   = config('app.project.admin_panel_slug');
	}

	public function index()
	{
		$arr_users_yearly_count = [];

		$users_yearly_count     = $this->UserModel->
		selectRaw("month(created_at) as month")->
		selectRaw("MONTHNAME(STR_TO_DATE(month(created_at), '%m')) as month_name")->
		groupBy("month")->
		selectRaw("count(id) as count")
		->whereRaw("year(`created_at`)=?", array(date('Y')))->
		where(['is_email_verified'=>'1'])->
		get();

		if($users_yearly_count){

			$arr_users_yearly_count = $users_yearly_count->toArray();
			// dd($arr_users_yearly_count);
		}
		$arr_orders_yearly_count = [];

		$orders_yearly_count     = $this->OrdersModel->

		selectRaw("month(created_at) as month")->
		selectRaw("MONTHNAME(STR_TO_DATE(month(created_at), '%m')) as month_name")->
		groupBy("month")->
		selectRaw("count(order_id) as count")
		->with('transaction')
		->whereHas('transaction',function($q){
			$q->where('payment_status','!=','0');
		})
		->whereRaw("year(`created_at`)=?", array(date('Y')))
		->get();

		if($orders_yearly_count)
		{
			$arr_orders_yearly_count = $orders_yearly_count->toArray();
// dd($arr_orders_yearly_count);
		}

		$date = strtotime('- 30 days', time()) ;
		$date = date('Y-m-d', $date);

		//$user_count         = $this->UserModel->whereRaw('date(created_at) >= '.$date)->count();

		//$supplier_count     = $this->SupplierModel->whereRaw('date(created_at) >= '.$date)->count();

		//$orders_count       = $this->OrdersModel->whereRaw('date(created_at) >= '.$date)->count();

		//$products_count     = $this->ProductsModel->whereRaw('date(created_at) >= '.$date)->count();

		//$valuation_count    = ValuationModel::whereRaw('date(created_at) >= '.$date)->count();

		//$return_count       = ReturnProductRequestModel::whereRaw('date(created_at) >= '.$date)->count();

		$notification_count = NotificationsModel::where(['receiver_user_type'=>'1', 'is_read'=>'0'])->count();

		//$replacement_count  =  $this->ReplacementProductRequestModel->whereRaw('date(created_at) >= '.$date)->count();


		$orders_count       = $this->OrdersModel->whereIn('status',['0','1','2','3','4'])->count();

		$products_count     = $this->ProductsModel->where('added_by_user_type','1')->count();

		$user_count         = $this->UserModel->count();

		$supplier_count     = $this->SupplierModel->count();

		$replacement_count  =  $this->ReplacementProductRequestModel->count();

		$return_count       = ReturnProductRequestModel::count();

		$valuation_count    = ValuationModel::count();

		$this->arr_view_data['replacement_count']  = $replacement_count;
		$this->arr_view_data['notification_count'] = $notification_count;
		
		$this->arr_view_data['user_count']      = $user_count;
		$this->arr_view_data['supplier_count']  = $supplier_count;
		$this->arr_view_data['orders_count']    = $orders_count;
		$this->arr_view_data['products_count']  = $products_count;
		$this->arr_view_data['valuation_count'] = $valuation_count;
		$this->arr_view_data['return_count']    = $return_count;
		$this->arr_view_data['order_data']      = $arr_orders_yearly_count;
		$this->arr_view_data['user_data']       = $arr_users_yearly_count;

		$this->arr_view_data['page_title']           = $this->module_title;
		$this->arr_view_data['parent_module_icon']   = "icon-home2";
		$this->arr_view_data['parent_module_title']  = "Dashboard";
		$this->arr_view_data['parent_module_url']    = url('/').'/admin/dashboard';
		$this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;

		return view($this->module_view_folder.'.index',$this->arr_view_data);
	}
}
