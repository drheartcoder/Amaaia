<?php

namespace App\Http\Controllers\Front\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\NewsletterModel;

class DiamondController extends Controller
{
	public function __construct(NewsletterModel $newsletter_model)
	{
		$this->arr_view_data      = [];
		$this->module_title       = "Diamond";
		$this->module_view_folder = "front.products";

		$this->NewsletterModel    = $newsletter_model;
	}


	public function index()
	{
		$this->arr_view_data['page_title'] = 'Diamond';
		return view($this->module_view_folder.'.dimond_landing',$this->arr_view_data);		
	}

	
	/*
    | Function  : Get all the products under this sub category
    | Author    : Deepak Arvind Salunke
    | Date      : 15/05/2018
    | Output    : Listing all the products under this sub category
    */

    public function sub_category_products($sub_category_slug = false)
    {

    	return view($this->module_view_folder.'.diamond',$this->arr_view_data);
	} // end sub_category_products



	/*
    | Function  : Get all the products under this sub category
    | Author    : Deepak Arvind Salunke
    | Date      : 15/05/2018
    | Output    : Listing all the products under this sub category
    */

    public function product_line_products($sub_category_slug = false, $product_line_slug = false)
    {

	} // end product_line_products

}
