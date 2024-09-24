<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrdersProductModel;
use App\Models\ProductViewsModel;
use DB;

class ProductReportController extends Controller
{
	function __construct(OrdersProductModel $order_product_model, ProductViewsModel $product_views_model){
		$this->arr_view_data           = [];
		$this->admin_panel_slug        = config('app.project.admin_panel_slug');
		$this->admin_url_path          = url(config('app.project.admin_panel_slug'));
		$this->module_url_path         = $this->admin_url_path."/reports/products";
		$this->module_title            = "Product Reports";
		$this->module_view_folder      = "admin.reports.products.";
		$this->module_icon             = "fa fa-line-chart";
		$this->OrdersProductModel = $order_product_model;
		$this->ProductViewsModel  = $product_views_model;

	}
	public function index()
	{
		$arr_products_sales       = [];
		$arr_products_subcategory = [];

		$obj_products_sales       = $this->OrdersProductModel->select('product_name',DB::raw('COUNT(order_product.product_id) AS occurrences'))->groupBy('order_product.product_id')
		->orderBy('occurrences', 'DESC')
		->limit(10)
		->get();

		if($obj_products_sales)
		{
			$arr_products_sales = $obj_products_sales->toArray();
		}

		$obj_products_subcategory = $this->OrdersProductModel->select('product_category_name', 'product_subcategory_name' ,DB::raw('COUNT(order_product.product_subcategory_id) AS occurrences'))->groupBy('order_product.product_subcategory_id')
		->orderBy('occurrences', 'DESC')
		->limit(10)
		->get();		

		if($obj_products_subcategory)
		{
			$arr_products_subcategory = $obj_products_subcategory->toArray();
		}

		$this->arr_view_data['parent_module_title']      = "Dashboard";
		$this->arr_view_data['parent_module_url']        = url('/').'/admin/dashboard';
		$this->arr_view_data['page_title']               = 'Product Reports';
		$this->arr_view_data['arr_products_sales']       = $arr_products_sales;
		$this->arr_view_data['obj_products_subcategory'] = $obj_products_subcategory;
		$this->arr_view_data['module_icon']              = $this->module_icon;
		$this->arr_view_data['module_title']             = $this->module_title;
		$this->arr_view_data['arr_products_sales']       = $arr_products_sales;
		$this->arr_view_data['arr_products_subcategory'] = $arr_products_subcategory;

		return view($this->module_view_folder.'index',$this->arr_view_data);

	}

	public function most_views()
	{

/*		$obj_products_sales       = $this->OrdersProductModel->select('product_name',DB::raw('COUNT(order_product.product_id) AS occurrences'))->groupBy('order_product.product_id')
		->orderBy('occurrences', 'DESC')
		->limit(10)
		->get();*/

		$obj_products_sales = $this->ProductViewsModel->select('product_id', DB::raw('COUNT(product_id) AS occurrences'))->with(['product_details'=> function($q)
					{
		$q->select('id','product_name');
					}])->groupBy('product_id')->orderBy('occurrences', 'DESC')
		->limit(10)
		->get();

				if($obj_products_sales)
		{
			$arr_products_sales = $obj_products_sales->toArray();
		}

		$this->arr_view_data['parent_module_title']      = "Dashboard";
		$this->arr_view_data['arr_products_sales']       = $arr_products_sales;
		$this->arr_view_data['parent_module_url']        = url('/').'/admin/dashboard';
		$this->arr_view_data['page_title']               = 'Product Most View Report';
		$this->arr_view_data['module_icon']              = $this->module_icon;
		$this->arr_view_data['module_title']             = $this->module_title;

		return view($this->module_view_folder.'views',$this->arr_view_data);
	}
}
