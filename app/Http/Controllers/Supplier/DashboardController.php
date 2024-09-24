<?php

namespace App\Http\Controllers\Supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ProductsModel;
use App\Models\OrdersModel;
use App\Models\OrdersProductModel;
use App\Models\NotificationsModel;

class DashboardController extends Controller
{
   public function __construct(
   								ProductsModel      $products_model,
   								OrdersModel        $orders_model,
   								OrdersProductModel $order_product,
   								NotificationsModel $notifications_model
   							  )
	{
		$this->arr_view_data       = [];
		$this->module_title        = "Dashboard";
		$this->module_view_folder  = "supplier.dashboard";		
		$this->supplier_url_path   = url(config('app.project.supplier_panel_slug'));
		$this->supplier_panel_slug = config('app.project.supplier_panel_slug');

		$this->ProductsModel       = $products_model;
		$this->OrdersModel         = $orders_model;
		$this->OrdersProductModel  = $order_product;
		$this->NotificationsModel  = $notifications_model;
	}

	public function index()
	{
		$supplier_id = login_user_id('supplier');

		$obj_products = $this->ProductsModel->where([
												'added_by_user_id' => $supplier_id,
												'added_by_user_type' => '3'
											])
											->count();

		$obj_notifications = $this->NotificationsModel->where([
															'is_read'            => '0',
															'receiver_user_type' => '3',
															'receiver_user_id'   => $supplier_id
														])
														->count();

		$obj_ordersproduct = $this->OrdersProductModel->select('id', 'order_id', 'product_id','product_supplier_id')
														->where('product_supplier_id', $supplier_id)
														->groupBy('order_id')
														->get();
		if($obj_ordersproduct)
		{
			$arr_ordersproduct = $obj_ordersproduct->toArray();
		}

		$obj_orders = $this->OrdersModel->select(['id', 'order_id', 'status'])
										 ->where(function($query){
		                                    $query->where('status', '5');
		                                 })
										 ->with(['order_products' => function($query) use ($supplier_id){
										 	$query->select('id', 'order_id', 'product_id','product_supplier_id');
										 	$query->where('product_supplier_id', $supplier_id);
										 	$query->selectRaw('sum(product_price) as total_amount');
										 	$query->groupBy('order_id');
										 }])
										 ->get();
		if($obj_orders)
		{
			$arr_orders = $obj_orders->toArray();
		}

		$this->arr_view_data['products_count']      = $obj_products;
		$this->arr_view_data['orders_count']        = count($arr_ordersproduct);
		$this->arr_view_data['arr_orders']          = $arr_orders;
		$this->arr_view_data['notifications_count'] = $obj_notifications;

		$this->arr_view_data['page_title']          = $this->module_title;
		$this->arr_view_data['parent_module_icon']  = "icon-home2";
		$this->arr_view_data['parent_module_title'] = "Dashboard";
		$this->arr_view_data['parent_module_url']   = url('/').'/supplier/dashboard';
        
		$this->arr_view_data['supplier_panel_slug'] = $this->supplier_panel_slug;

		return view($this->module_view_folder.'.index',$this->arr_view_data);
	}
}