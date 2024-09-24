<?php

namespace App\Http\Controllers\Supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Common\Traits\MultiActionTrait;

use App\Models\MetalsModel;
use App\Models\SettingModel;
use App\Models\ShankTypeModel;
use App\Models\BandSettingModel;
use App\Models\MetalDetailingModel;
use App\Models\OccasionsModel;
use App\Models\BrandModel;
use App\Models\RingShoulderModel;
use App\Models\ProductsModel;
use App\Models\ProductOccasionsModel;
use App\Models\ProductImagesModel;
use App\Models\CollectionModel;
use App\Models\ProductCollectionsModel;
use App\Models\LookModel;
use App\Models\GemStoneModel;
use App\Models\ProductMetalsModel;
use App\Models\ProductGemStoneModel;
use App\Models\ProductSizesModel;
use App\Models\MetalColorModel;
use App\Models\MetalQualityModel;
use App\Models\GemstoneColorModel;
use App\Models\GemstoneQualitiesModel;
use App\Models\GemstoneShapesModel;
use App\Models\SubCategoryModel;
use App\Models\SupplierModel;

use App\Common\Services\NotificationService;

use Validator;
use Session;
use DataTables;

class JewelleryProductController extends Controller
{

	use MultiActionTrait;	
	public function __construct(
		MetalsModel               $metals_model,
		SettingModel              $setting_model,
		ShankTypeModel            $shank_type_model,
		BandSettingModel          $band_setting_model,
		MetalDetailingModel       $metal_detailing_model,
		OccasionsModel            $occasions_model,
		BrandModel                $brand_model,
		RingShoulderModel         $ring_shoulder_model,
		ProductsModel             $product_smodel,
		ProductOccasionsModel     $product_occasions_model,
		ProductImagesModel        $product_images_model,
		CollectionModel           $collection_model,
		ProductCollectionsModel   $product_collections_model,
		NotificationService       $notification_service,
		LookModel                 $look_model,
		GemStoneModel             $gemstone_model,
		ProductMetalsModel        $product_metals_model,
		ProductGemStoneModel      $product_gemstone_model,
		ProductSizesModel         $product_sizes_model,
		MetalColorModel           $metal_color_model,
		MetalQualityModel         $metal_quality_model,
		GemstoneColorModel        $gemstone_color_model,
		GemstoneQualitiesModel    $gemstone_qualities_model,
		GemstoneShapesModel       $gemstone_shapes_model,
		SubCategoryModel          $sub_category_model,
		SupplierModel             $supplier_model
	)
	{
		$this->arr_view_data             = [];
		
		$this->admin_panel_slug          = config('app.project.supplier_panel_slug');
		$this->supplier_url_path         = url(config('app.project.supplier_panel_slug'));
		$this->module_url_path           = $this->supplier_url_path."/product/jewellery";
		$this->module_title              = "Jewellery Product";
		$this->module_view_folder        = "supplier.Jewellery_product";
		$this->module_icon               = "fa fa-calendar";
		$this->BaseModel                 = $product_smodel;

		$this->MetalsModel               = $metals_model;
		$this->SettingModel              = $setting_model;
		$this->ShankTypeModel            = $shank_type_model;
		$this->BandSettingModel          = $band_setting_model;
		$this->MetalDetailingModel       = $metal_detailing_model;
		$this->OccasionsModel            = $occasions_model;
		$this->BrandModel                = $brand_model;
		$this->RingShoulderModel         = $ring_shoulder_model;
		$this->ProductsModel             = $product_smodel;
		$this->ProductOccasionsModel     = $product_occasions_model;
		$this->ProductImagesModel        = $product_images_model;
		$this->CollectionModel           = $collection_model;
		$this->ProductCollectionsModel   = $product_collections_model;
		$this->LookModel                 = $look_model;
		$this->GemStoneModel             = $gemstone_model;
		$this->ProductMetalsModel        = $product_metals_model;
		$this->ProductGemStoneModel      = $product_gemstone_model;
		$this->ProductSizesModel         = $product_sizes_model;
		$this->MetalColorModel           = $metal_color_model;
		$this->MetalQualityModel         = $metal_quality_model;
		$this->GemstoneColorModel        = $gemstone_color_model;
		$this->GemstoneQualitiesModel    = $gemstone_qualities_model;
		$this->GemstoneShapesModel       = $gemstone_shapes_model;
		$this->SupplierModel             = $supplier_model;

		$this->SubCategoryModel          = $sub_category_model;

		$this->NotificationService       = $notification_service;

		$this->product_image_base_path   = base_path().config('app.project.img_path.product_images');
		$this->product_image_public_path = url('/').config('app.project.img_path.product_images');



		$this->classic_jewellery_rings_sub_category_slug = config('app.project.slug.classic_jewellery_rings_sub_category_slug');

		$this->classic_fashion_jewellery_rings_sub_category_slug = config('app.project.slug.classic_fashion_jewellery_rings_sub_category_slug');

	}

	public function index()
	{
		$this->arr_view_data['parent_module_icon']   = "icon-home2";
		$this->arr_view_data['parent_module_title']  = "Dashboard";
		$this->arr_view_data['parent_module_url']    = $this->supplier_url_path.'/dashboard';
		$this->arr_view_data['page_title']           = "Manage ".str_plural($this->module_title);
		$this->arr_view_data['module_title']         = "Manage ".str_plural($this->module_title);
		$this->arr_view_data['module_icon']          = $this->module_icon;
		$this->arr_view_data['module_url_path']      = $this->module_url_path;
		$this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
		
		return view($this->module_view_folder.'.index',$this->arr_view_data);

	}

	public function create()
	{
		$this->arr_view_data = $this->get_product_attributes();

		$this->arr_view_data['parent_module_icon']  = "icon-home2";
		$this->arr_view_data['parent_module_title'] = "Dashboard";
		$this->arr_view_data['parent_module_url']   = $this->supplier_url_path.'/dashboard';
		$this->arr_view_data['page_title']          = "Manage ".str_plural($this->module_title);
		$this->arr_view_data['module_title']        = "Manage ".str_plural($this->module_title);
		$this->arr_view_data['module_icon']         = $this->module_icon;
		$this->arr_view_data['module_url']     	    = $this->module_url_path;
		$this->arr_view_data['module_url_path']     = $this->module_url_path;
		$this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
		$this->arr_view_data['sub_module_title']    = 'Add '.str_singular($this->module_title);
		$this->arr_view_data['sub_module_icon']     = 'fa fa-plus';

		$this->arr_view_data['classic_jewellery_rings_sub_category_slug']     = $this->classic_jewellery_rings_sub_category_slug;
		$this->arr_view_data['classic_fashion_jewellery_rings_sub_category_slug']     = $this->classic_fashion_jewellery_rings_sub_category_slug;

		return view($this->module_view_folder.'.create',$this->arr_view_data);
	}

	public function store(Request $request)
	{
		$arr_rules      = $arr_product = $arr_metal = $arr_gemstone = $arr_size  =  array();
		$status         = false;

		$supplier_id    = $is_product_exist = $first_name = $last_name = $supplier_name = $sub_category_id = "";

		if(isset($request->category_slug) && $request->category_slug == 'jewellery')
		{
			$arr_rules['product_line']            =  "required";

			$product_line_id = $request->input('product_line', 0);
		}

		if(isset($request->subcategory_slug) && $request->subcategory_slug == $this->classic_jewellery_rings_sub_category_slug || $request->subcategory_slug == $this->classic_fashion_jewellery_rings_sub_category_slug)
		{
			$arr_rules['shank_type']          =  "required";
			$arr_rules['band_setting']  	  =  "required";
			$arr_rules['ring_shoulder_type']  =  "required";

			$shank_type                       = $request->input('shank_type', null);
			$band_setting                     = $request->input('band_setting', null);
			$ring_shoulder_type               = $request->input('ring_shoulder_type', null);

			$arr_product['shank_type_id']     = isset($shank_type) && !empty($shank_type) ? $shank_type : 0;
			$arr_product['band_setting_id']   = isset($band_setting) && !empty($band_setting) ? $band_setting : 0;
			$arr_product['ring_shoulder_id']  = isset($ring_shoulder_type) && !empty($ring_shoulder_type) ? $ring_shoulder_type : 0;
		}

		$arr_rules['product_type']            =  "required";
		$arr_rules['category_name']           =  "required";
		$arr_rules['product_name']            =  "required";
		$arr_rules['product_model']           =  "required";
		
		$arr_rules['metal_name']              =  "required";
		$arr_rules['metal_color']             =  "required";
		$arr_rules['metal_quality']           =  "required";

		$arr_rules['metal_weight']            =  "required";
		
		$arr_rules['total_images']            =  "required";
		$arr_rules['subcategory_name']        =  "required";
		$arr_rules['product_description']     =  "required";
		$arr_rules['product_specification']   =  "required";
		$arr_rules['quantity']                =  "required";
		$arr_rules['product_price']           =  "required";
		$arr_rules['occasion_name']  	      =  "required";
		$arr_rules['collection']  	          =  "required";
		$arr_rules['look']  	              =  "required";
		$arr_rules['gemstone_type']  	      =  "required";
		$arr_rules['gemstone_color']  	      =  "required";
		$arr_rules['gemstone_quality']  	  =  "required";
		$arr_rules['gemstone_shape']  	      =  "required";
		$arr_rules['delivery_date']  	      =  "required";

		$arr_rules['home_trial']  		      =  "required";
		$arr_rules['product_image']  	      =  "required";

		$validator = validator::make($request->all(),$arr_rules);

		if ($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}



		$supplier_id = login_user_id('supplier');

		$arr_product['product_type']               = $request->input('product_type', null);
		$arr_product['product_name']               = $request->input('product_name', null);
		$arr_product['product_brand_id']           = $request->input('brand', null);
		$arr_product['category_id']                = $request->input('category_name', null);
		$arr_product['subcategory_id']             = $request->input('subcategory_name', null);
		$arr_product['setting_id']                 = $request->input('setting', null);
		
		$arr_product['product_metal_detailing_id'] = $request->input('metal_detailing', null);
		
		$arr_compare = $arr_product;

		/*$sub_category_id = $request->input('subcategory_name', null);

		$obj_sub_cat = $this->SubCategoryModel->where('id',$sub_category_id)->select('id','market_orientation_markup')->first();

		if($obj_sub_cat)
		{
			$arr_product['sub_category_market_orientation']     = isset($obj_sub_cat->sub_category_market_orientation) ? $obj_sub_cat->sub_category_market_orientation : 0 ;
		}*/
		
		
		$arr_product['added_by_user_id']           = $supplier_id;
		$arr_product['added_by_user_type']         = '3';
		$arr_product['metal_weight']               = $request->input('metal_weight', null);
		$arr_product['product_height']             = $request->input('height', null);
		$arr_product['product_width']              = $request->input('width', null);
		$arr_product['product_length']             = $request->input('length', null);
		$arr_product['quantity']                   = $request->input('quantity', null);
		$arr_product['product_price']              = $request->input('product_price', null);
		$arr_product['product_line_id']            = isset($product_line_id) ? $product_line_id : 0;
		$arr_product['product_code']               = $request->input('product_model', null);
		$arr_product['keywords']                   = '';
		$arr_product['product_description']        = $request->input('product_description', null);
		$arr_product['product_specification']      = $request->input('product_specification', null);
		$arr_product['admin_approval']             = '0';
		$arr_product['status']                     = '1';
		$arr_product['allow_product_home_trial']   = $request->input('home_trial', null);
		$arr_product['delivery_date']              = $request->input('delivery_date', null);
		$arr_product['look_id']                    = $request->input('look', null);
		$arr_product['video_url']                  = $request->input('video_url', null);
		$arr_product['status']                     = '1';

		
		$is_product_exist = $this->check_product_duplication($arr_compare);

		if($is_product_exist == 'yes') 
		{
			Session::flash('error','This '.$this->module_title.' is already exist.');
			return redirect()->back()->withInput();
		}

		if(isset($request->occasion_name) && !empty($request->occasion_name))
		{
			$arr_occassions           = $request->occasion_name;
		}

		if(isset($request->collection) && !empty($request->collection))
		{
			$arr_collection            = $request->collection;
		}


		if(isset($request->is_size) && $request->is_size)
		{
			if(isset($request->size) && !empty($request->size))
			{
				$arr_size            = $request->size;

				$arr_size = array_filter($arr_size);
			}	
		}


		$arr_metal[0]['metal_name_id']         = $request->input('metal_name', null);
		$arr_metal[0]['metal_color_id']        = $request->input('metal_color', null);
		$arr_metal[0]['metal_quality_id']      = $request->input('metal_quality', null);


		if(isset($request->metal_name_2) && isset($request->metal_color_2) && isset($request->metal_quality_2))
		{
			$arr_metal[1]['metal_name_id']     = $request->input('metal_name_2', null);
		    $arr_metal[1]['metal_color_id']    = $request->input('metal_color_2', null);
		    $arr_metal[1]['metal_quality_id']  = $request->input('metal_quality_2', null);	
		}


		if(isset($request->metal_name_2) && isset($request->metal_color_2) && isset($request->metal_quality_2))
		{
			$arr_metal[1]['metal_name_id']     = $request->input('metal_name_2', null);
		    $arr_metal[1]['metal_color_id']    = $request->input('metal_color_2', null);
		    $arr_metal[1]['metal_quality_id']  = $request->input('metal_quality_2', null);	
		}

		$arr_gemstone[0]['gemstone_type']         = $request->input('gemstone_type', null);
		$arr_gemstone[0]['gemstone_color']        = $request->input('gemstone_color', null);
		$arr_gemstone[0]['gemstone_quality']      = $request->input('gemstone_quality', null);
		$arr_gemstone[0]['gemstone_shape']        = $request->input('gemstone_shape', null);


		if(isset($request->gemstone_type_2) && isset($request->gemstone_color_2) && isset($request->gemstone_quality_2)  && isset($request->gemstone_shape_2))
		{
			$arr_gemstone[1]['gemstone_type']     = $request->input('gemstone_type_2', null);
		    $arr_gemstone[1]['gemstone_color']    = $request->input('gemstone_color_2', null);
		    $arr_gemstone[1]['gemstone_quality']  = $request->input('gemstone_quality_2', null);	
		    $arr_gemstone[1]['gemstone_shape']    = $request->input('gemstone_shape_2', null);	
		}

		if(isset($request->gemstone_type_3) && isset($request->gemstone_color_3) && isset($request->gemstone_quality_3)  && isset($request->gemstone_shape_3))
		{
			$arr_gemstone[2]['gemstone_type']     = $request->input('gemstone_type_3', null);
		    $arr_gemstone[2]['gemstone_color']    = $request->input('gemstone_color_3', null);
		    $arr_gemstone[2]['gemstone_quality']  = $request->input('gemstone_quality_3', null);	
		    $arr_gemstone[2]['gemstone_shape']  = $request->input('gemstone_shape_3', null);	
		}



		//dd($arr_gemstone);


		$slug  = str_slug($arr_product['product_name']);

		$model = "ProductsModel";

		$slug = get_slug($model,$slug);

		$uid = get_product_unique_uid();

		$arr_product['slug'] = isset($slug) ? $slug : '';
		$arr_product['uid']  = isset($uid) ? $uid : '';

		$status = $this->BaseModel->create($arr_product);

		if($status)
		{

			update_final_price();

			if(isset($arr_occassions) && !empty($arr_occassions))
			{
				foreach($arr_occassions as $val)
				{
					$this->ProductOccasionsModel->create([
						'product_id' => $status->id,
						'occasion_id' => $val,
					]);
				}
			}

			if(isset($arr_collection) && !empty($arr_collection))
			{
				foreach($arr_collection as $val)
				{
					$this->ProductCollectionsModel->create([
						'product_id' => $status->id,
						'collection_id' => $val,
					]);
				}
			}

			if(isset($arr_metal) && !empty($arr_metal))
			{
				foreach($arr_metal as $val)
				{
					$this->ProductMetalsModel->create([
						'product_id'         => $status->id,
						'metal_name_id'      => $val['metal_name_id'],
						'metal_color_id'     => $val['metal_color_id'],
						'metal_quality_id'   => $val['metal_quality_id']
					]);
				}
			}

			if(isset($arr_gemstone) && !empty($arr_gemstone))
			{
				foreach($arr_gemstone as $val)
				{
					$this->ProductGemStoneModel->create([
						'product_id' => $status->id,
						'gemstone_type_id' => $val['gemstone_type'],
						'gemstone_color_id' => $val['gemstone_color'],
						'gemstone_quality_id' => $val['gemstone_quality'],
						'gemstone_shape_id' => $val['gemstone_shape'],
					]);
				}
			}

			if(isset($arr_size) && !empty($arr_size))
			{
				foreach($arr_size as $val)
				{
					$this->ProductSizesModel->create([
						'product_id' => $status->id,
						'size_name' => $val,
					]);
				}
			}

			if(isset($request->product_image) && !empty($request->product_image))
			{
				foreach($request->product_image as $key => $file) 
				{
					if($file != NULL)
					{
						$filename = rand(1111,9999);
						$fileExt  = $file->getClientOriginalExtension();
						$fileName = sha1(uniqid().$filename.uniqid()).'.'.$fileExt;
						if(in_array($fileExt,['png','jpg','jpeg','pdf']))
						{
							$upload_success = $file->move($this->product_image_base_path, $fileName);

							if($upload_success)
							{
								$arr_certificate['product_id']           = $status->id;
								$arr_certificate['image']                = $fileName;
								$this->ProductImagesModel->create($arr_certificate);
							}
						}
						else
						{
							Session::flash('error','Invalid file extension.');
							return redirect()->back();
						}
					} 
				}
			}

			if(isset($arr_product['product_type']) && $arr_product['product_type'] == 1)
			{
				$product_type = 'Classic';
			}
			elseif(isset($arr_product['product_type']) && $arr_product['product_type'] == 2)
			{
				$product_type = 'Luxure';
			}

			$supplier_details = login_user_details('supplier');
			
			$first_name = isset($supplier_details->first_name) ? $supplier_details->first_name : '';
			$last_name = isset($supplier_details->last_name) ? $supplier_details->last_name : '';

			$supplier_name = $first_name.' '.$last_name;

			$arr_noti['receiver_user_id']                =  '1';  //receiver user id
			$arr_noti['receiver_user_type_id']  =  '1';
			$arr_noti['product_type']           =  $product_type or '';
			$arr_noti['product_name']           =  $arr_product['product_name'];
			$arr_noti['url']                    =  "products/supplier/view/".base64_encode($status->id);
			$arr_noti['supplier_name']          =  $supplier_name or '';

			$status = $this->NotificationService->store_new_product_add_notification($arr_noti);

			Session::flash('success', $this->module_title.' added successfully.');
			return redirect($this->module_url_path);
		}

		Session::flash('error', 'Error while adding '.$this->module_title.'.');
		return redirect()->back();
	}

	public function edit($enc_id)
	{
		$id = base64_decode($enc_id);
		$arr_product = [];
		
		$arr_product = get_prduct_attributes_data($id);

		$this->arr_view_data = $this->get_product_attributes();
		
		$this->arr_view_data['arr_product']         = $arr_product;
		$this->arr_view_data['id']                  = $enc_id;
		$this->arr_view_data['page_title']          = "Edit ".str_singular($this->module_title);
		$this->arr_view_data['parent_module_icon']  = "icon-home2";
		$this->arr_view_data['parent_module_title'] = "Dashboard";
		$this->arr_view_data['parent_module_url']   = $this->supplier_url_path.'/dashboard';
		$this->arr_view_data['module_title']        = str_plural($this->module_title);
		$this->arr_view_data['module_icon']         = $this->module_icon;
		$this->arr_view_data['module_icon']         = $this->module_icon;
		$this->arr_view_data['module_url']          = $this->module_url_path;
		$this->arr_view_data['admin_panel_slug']    = $this->admin_panel_slug;
		$this->arr_view_data['sub_module_title']    = 'Edit '.str_singular($this->module_title);
		$this->arr_view_data['sub_module_icon']     = 'fa fa-pencil-square-o';

		$this->arr_view_data['module_url_path']     = $this->module_url_path;

		$this->arr_view_data['product_image_base_path']      = $this->product_image_base_path;
		$this->arr_view_data['product_image_public_path']    = $this->product_image_public_path;

		$this->arr_view_data['classic_jewellery_rings_sub_category_slug']     = $this->classic_jewellery_rings_sub_category_slug;
		$this->arr_view_data['classic_fashion_jewellery_rings_sub_category_slug']     = $this->classic_fashion_jewellery_rings_sub_category_slug;

		return view($this->module_view_folder.'.edit',$this->arr_view_data);
	}

	public function update(Request $request, $enc_id)
	{
		$arr_rules      = $arr_product = $arr_metal = $arr_gemstone = $arr_size  = array();
		$status         = false;

		$is_product_exist = "";

		$id         = base64_decode($enc_id);

		if(isset($request->category_slug) && $request->category_slug == 'jewellery')
		{
			$arr_rules['product_line']            =  "required";

			$product_line_id = $request->input('product_line', 0);
		}

		if(isset($request->subcategory_slug) && $request->subcategory_slug == $this->classic_jewellery_rings_sub_category_slug || $request->subcategory_slug == $this->classic_fashion_jewellery_rings_sub_category_slug)
		{
			$arr_rules['shank_type']          =  "required";
			$arr_rules['band_setting']  	  =  "required";
			$arr_rules['ring_shoulder_type']  =  "required";

			$shank_type                       = $request->input('shank_type', null);
			$band_setting                     = $request->input('band_setting', null);
			$ring_shoulder_type               = $request->input('ring_shoulder_type', null);

			$arr_product['shank_type_id']     = isset($shank_type) && !empty($shank_type) ? $shank_type : 0;
			$arr_product['band_setting_id']   = isset($band_setting) && !empty($band_setting) ? $band_setting : 0;
			$arr_product['ring_shoulder_id']  = isset($ring_shoulder_type) && !empty($ring_shoulder_type) ? $ring_shoulder_type : 0;
		}
		else
		{
			$arr_product['shank_type_id']     = 0;
			$arr_product['band_setting_id']   = 0;
			$arr_product['ring_shoulder_id']  = 0;
		}

		$arr_rules['product_type']            =  "required";
		$arr_rules['category_name']           =  "required";
		$arr_rules['product_name']            =  "required";
		$arr_rules['product_model']           =  "required";
		$arr_rules['product_line']            =  "required";
		$arr_rules['metal_name']              =  "required";
		$arr_rules['metal_color']             =  "required";
		$arr_rules['metal_quality']           =  "required";
		$arr_rules['metal_weight']            =  "required";
		
		$arr_rules['subcategory_name']        =  "required";
		$arr_rules['product_description']     =  "required";
		$arr_rules['product_specification']   =  "required";
		$arr_rules['quantity']                =  "required";
		$arr_rules['product_price']           =  "required";

		$arr_rules['occasion_name']  	      =  "required";
		$arr_rules['collection']  	          =  "required";
		$arr_rules['look']  	              =  "required";
		$arr_rules['gemstone_type']  	      =  "required";
		$arr_rules['gemstone_color']  	      =  "required";
		$arr_rules['gemstone_quality']  	  =  "required";
		$arr_rules['gemstone_shape']  	      =  "required";
		$arr_rules['delivery_date']  	      =  "required";

		$arr_rules['home_trial']  		      =  "required";

		if(isset($request->total_images) && $request->total_images > 0)
		{

		}
		else
		{
			$arr_rules['product_image']  	      =  "required";
		}
		

		$validator = validator::make($request->all(),$arr_rules);

		if ($validator->fails()) 
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$arr_product['product_type']               = $request->input('product_type', null);
		$arr_product['product_name']               = $request->input('product_name', null);
		$arr_product['product_brand_id']           = $request->input('brand', null);
		$arr_product['category_id']                = $request->input('category_name', null);
		$arr_product['subcategory_id']             = $request->input('subcategory_name', null);
		$arr_product['setting_id']                 = $request->input('setting', null);
		
		$arr_product['product_metal_detailing_id'] = $request->input('metal_detailing', null);
		
		$arr_compare = $arr_product;
		
		$arr_product['metal_weight']               = $request->input('metal_weight', null);
		$arr_product['product_height']             = $request->input('height', null);
		$arr_product['product_width']              = $request->input('width', null);
		$arr_product['product_length']             = $request->input('length', null);
		$arr_product['quantity']                   = $request->input('quantity', null);
		$arr_product['product_line_id']            = isset($product_line_id) ? $product_line_id : 0;
		$arr_product['product_price']              = $request->input('product_price', null);
		/*$arr_product['discount']                   = $request->input('discount', '');
		$arr_product['additional_markup']          = $request->input('additional_markup', null);*/
		$arr_product['product_code']               = $request->input('product_model', null);
		$arr_product['keywords']                   = '';
		$arr_product['product_description']        = $request->input('product_description', null);
		$arr_product['product_specification']      = $request->input('product_specification', null);
		
		$arr_product['allow_product_home_trial']   = $request->input('home_trial', null);

		$arr_product['delivery_date']              = $request->input('delivery_date', null);
		$arr_product['look_id']                    = $request->input('look', null);
		$arr_product['video_url']                  = $request->input('video_url', null);



		// Check whether product with similar attributes available or not.
		$is_product_exist = $this->check_product_duplication($arr_compare,$id);

		if($is_product_exist == 'yes') 
		{
			Session::flash('error','This '.$this->module_title.' is already exist.');
			return redirect()->back()->withInput();
		}

		if(isset($request->occasion_name) && !empty($request->occasion_name))
		{
			$arr_occassions           = $request->occasion_name;
		}

		if(isset($request->collection) && !empty($request->collection))
		{
			$arr_collection            = $request->collection;
		}

		if(isset($request->metal) && !empty($request->metal))
		{
			$arr_metal            = $request->metal;
		}

		if(isset($request->gemstone) && !empty($request->gemstone))
		{
			$arr_gemstone            = $request->gemstone;
		}

		if(isset($request->is_size) && $request->is_size)
		{
			if(isset($request->size) && !empty($request->size))
			{
				$arr_size            = $request->size;

				$arr_size = array_filter($arr_size);
			}	
		}

		$arr_metal[0]['metal_name_id']         = $request->input('metal_name', null);
		$arr_metal[0]['metal_color_id']        = $request->input('metal_color', null);
		$arr_metal[0]['metal_quality_id']      = $request->input('metal_quality', null);


		if(isset($request->metal_name_2) && isset($request->metal_color_2) && isset($request->metal_quality_2))
		{
			$arr_metal[1]['metal_name_id']     = $request->input('metal_name_2', null);
		    $arr_metal[1]['metal_color_id']    = $request->input('metal_color_2', null);
		    $arr_metal[1]['metal_quality_id']  = $request->input('metal_quality_2', null);	
		}


		if(isset($request->metal_name_2) && isset($request->metal_color_2) && isset($request->metal_quality_2))
		{
			$arr_metal[1]['metal_name_id']     = $request->input('metal_name_2', null);
		    $arr_metal[1]['metal_color_id']    = $request->input('metal_color_2', null);
		    $arr_metal[1]['metal_quality_id']  = $request->input('metal_quality_2', null);	
		}

		$arr_gemstone[0]['gemstone_type']         = $request->input('gemstone_type', null);
		$arr_gemstone[0]['gemstone_color']        = $request->input('gemstone_color', null);
		$arr_gemstone[0]['gemstone_quality']      = $request->input('gemstone_quality', null);
		$arr_gemstone[0]['gemstone_shape']        = $request->input('gemstone_shape', null);


		if(isset($request->gemstone_type_2) && isset($request->gemstone_color_2) && isset($request->gemstone_quality_2)  && isset($request->gemstone_shape_2))
		{
			$arr_gemstone[1]['gemstone_type']     = $request->input('gemstone_type_2', null);
		    $arr_gemstone[1]['gemstone_color']    = $request->input('gemstone_color_2', null);
		    $arr_gemstone[1]['gemstone_quality']  = $request->input('gemstone_quality_2', null);	
		    $arr_gemstone[1]['gemstone_shape']    = $request->input('gemstone_shape_2', null);	
		}

		if(isset($request->gemstone_type_3) && isset($request->gemstone_color_3) && isset($request->gemstone_quality_3)  && isset($request->gemstone_shape_3))
		{
			$arr_gemstone[2]['gemstone_type']     = $request->input('gemstone_type_3', null);
		    $arr_gemstone[2]['gemstone_color']    = $request->input('gemstone_color_3', null);
		    $arr_gemstone[2]['gemstone_quality']  = $request->input('gemstone_quality_3', null);	
		    $arr_gemstone[2]['gemstone_shape']  = $request->input('gemstone_shape_3', null);	
		}

		$slug       = str_slug($arr_product['product_name']);

		$model = "ProductsModel";

		$slug = get_slug($model,$slug);

		$arr_product['slug'] = isset($slug) ? $slug : '';

		$status = $this->BaseModel->where('id',$id)->update($arr_product);

		if($status)
		{

			update_final_price();

			if(isset($arr_occassions) && !empty($arr_occassions))
			{
				// Delete the product occasions before adding.
				$this->ProductOccasionsModel->where('product_id',$id)->delete();

				foreach($arr_occassions as $val)
				{
					$this->ProductOccasionsModel->create([
						'product_id' => $id,
						'occasion_id' => $val,
					]);
				}
			}

			if(isset($arr_collection) && !empty($arr_collection))
			{
				// Delete the product collection before adding.
				$this->ProductCollectionsModel->where('product_id',$id)->delete();

				foreach($arr_collection as $val)
				{
					$this->ProductCollectionsModel->create([
						'product_id' => $id,
						'collection_id' => $val,
					]);
				}
			}


			if(isset($arr_metal) && !empty($arr_metal))
			{
				// Delete the product metal before adding.
				$this->ProductMetalsModel->where('product_id',$id)->delete();
				foreach($arr_metal as $val)
				{
					$this->ProductMetalsModel->create([
						'product_id'         => $id,
						'metal_name_id'      => $val['metal_name_id'],
						'metal_color_id'     => $val['metal_color_id'],
						'metal_quality_id'   => $val['metal_quality_id']
					]);
				}
			}

			if(isset($arr_gemstone) && !empty($arr_gemstone))
			{
				// Delete the product gemstone before adding.
				$this->ProductGemStoneModel->where('product_id',$id)->delete();

				foreach($arr_gemstone as $val)
				{
					$this->ProductGemStoneModel->create([
						'product_id'          => $id,
						'gemstone_type_id'    => $val['gemstone_type'],
						'gemstone_color_id'   => $val['gemstone_color'],
						'gemstone_quality_id' => $val['gemstone_quality'],
						'gemstone_shape_id'   => $val['gemstone_shape'],
					]);
				}
			}


			// Delete the product gemstone before adding.
			$this->ProductSizesModel->where('product_id',$id)->delete();

			if(isset($arr_size) && !empty($arr_size))
			{
				

				foreach($arr_size as $val)
				{
					$this->ProductSizesModel->create([
						'product_id' => $id,
						'size_name' => $val,
					]);
				}
			}

			if(isset($request->product_image) && !empty($request->product_image))
			{
				foreach($request->product_image as $key => $file) 
				{
					if($file != NULL)
					{
						$filename = rand(1111,9999);
						$fileExt  = $file->getClientOriginalExtension();
						$fileName = sha1(uniqid().$filename.uniqid()).'.'.$fileExt;
						if(in_array($fileExt,['png','jpg','jpeg','pdf']))
						{
							$upload_success = $file->move($this->product_image_base_path, $fileName);

							if($upload_success)
							{
								$arr_images['product_id']           = $id;
								$arr_images['image']                = $fileName;
								$this->ProductImagesModel->create($arr_images);
							}
						}
						else
						{
							Session::flash('error','Invalid file extension.');
							return redirect()->back();
						}
					} 
				}
			}

			Session::flash('success', $this->module_title.' updated successfully.');
			return redirect($this->module_url_path);
		}

		Session::flash('error', 'Error while adding '.$this->module_title.'.');
		return redirect()->back();
	}

	public function load_data(Request $request)
	{
		$arr_search_column      = $request->input('column_filter');
		$supplier_id = '';
		$supplier_id = login_user_id('supplier');

		$obj_products = $this->BaseModel;
		if(isset($arr_search_column['q_product_name']) && $arr_search_column['q_product_name']!="")
		{
			$obj_products = $obj_products->where('product_name', 'LIKE', "%".$arr_search_column['q_product_name']."%");	
		}
		
		if(isset($arr_search_column['q_category']) && $arr_search_column['q_category']!="")
		{
			$category_search = $arr_search_column['q_category'];

			$obj_products = $obj_products->whereHas('category', function($query) use($category_search){
				$query->where('category_name', 'LIKE', "%".$category_search."%");
			});	
		}

		$obj_products = $obj_products->select(['id', 'product_name', 'status', 'created_at','category_id','subcategory_id','product_type'])
		->with(['category' => function($query){
			$query->select('id','category_name');
		}])
		->with(['sub_category' => function($query){
			$query->select('id','subcategory_name');
		}])
		->where([
			'added_by_user_id' => $supplier_id,
			'added_by_user_type' => '3'
		]);
		

		if($obj_products)
		{
			$json_result  = DataTables::of($obj_products)->make(true);
			$build_result = $json_result->getData();

			foreach ($build_result->data as $key => $data) 
			{
				$built_edit_href   = $this->module_url_path.'/edit/'.base64_encode($data->id);

				$built_delete_btn_href   = $this->module_url_path.'/delete/'.base64_encode($data->id);

				$built_view_btn_href   = $this->module_url_path.'/view/'.base64_encode($data->id);

				if(isset($build_result->data) && sizeof($build_result->data)>0)
				{
					if($data->status != null && $data->status == "0")
					{   
						$build_status_btn = '<a class="btn btn-xs btn-danger" title="Block" href="javascript:void(0)" style="cursor:text">Inactive</a>';
					}
					elseif($data->status != null && $data->status == "1")
					{
						$build_status_btn = '<a class="btn btn-xs btn-success" title="Unblock" href="javascript:void(0)" style="cursor:text">Active</a>';
					}

					$built_delete_button = "<a class='btn btn-default btn-rounded show-tooltip' title='Delete' href='".$built_delete_btn_href."'  data-original-title='View Bank Details' onclick='return confirm_action(this,event,\"Do you really want to delete this record ?\")' ><i class='fa fa-trash' ></i></a>";

					$built_edit_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_edit_href."' title='Edit' data-original-title='Edit'><i class='fa fa-pencil-square-o' ></i></a>";

					$built_view_button = "<a class='btn btn-default btn-rounded show-tooltip' href='".$built_view_btn_href."' title='View' data-original-title='View'><i class='fa fa-eye'></i></a>";

					if(isset($data->product_type) && $data->product_type == '1')
					{
						$product_type = 'Classic';
					}
					elseif(isset($data->product_type) && $data->product_type == '2')
					{
						$product_type = 'Luxure';
					}

					$action_button = $built_edit_button.'	'.$built_view_button.'  '.$built_delete_button;

					$id = isset($data->id)? base64_encode($data->id) :'';

					$build_result->data[$key]->id                  = $id;				
					$build_result->data[$key]->product_name        = isset($data->product_name)? $data->product_name :'';				
					$build_result->data[$key]->product_type        = isset($product_type)? $product_type :'NA';				
					$build_result->data[$key]->category            = isset($data->category->category_name)? $data->category->category_name :'NA';				
					$build_result->data[$key]->sub_category            = isset($data->sub_category->subcategory_name)? $data->sub_category->subcategory_name :'NA';				
					$build_result->data[$key]->status              = isset($data->status)? $data->status :'';
					$build_result->data[$key]->created_at          = isset($data->created_at)? get_formated_created_date($data->created_at) :'';

					$build_result->data[$key]->build_status_check  = $build_status_btn;
					$build_result->data[$key]->built_action_button = $action_button;

				}
			}
			return response()->json($build_result);
		}
	}

	public function get_category_by_product_type(Request $request)
	{
		if(isset($request->product_type_id) && !empty($request->product_type_id))
		{
			$arr_categories = [];
			$arr_categories = get_category_by_product_type($request->product_type_id);

			return $arr_categories;
		}
	}

	public function load_subcategory(Request $request)
	{
		$selected = '';
		$data         = '<option value="">Select Subcategory</option>';
		$category_id = $request->input('category_id',null);

		if($category_id!=null)
		{
			$arr_sub_categories = get_sub_categories($category_id);

			foreach ($arr_sub_categories as $key => $sub_category) 
			{
				if(isset($request->sub_category_id) && $request->sub_category_id == $sub_category['id'])
				{
					$selected = 'selected';
				}
				else
				{
					$selected = '';
				}

				$data .="<option ".$selected." value='".$sub_category['id']."' data-slug='".$sub_category['slug']."'>".$sub_category['subcategory_name']."</option>";
			}
		}
		return response()->json($data);
	}

	public function view($enc_id = false)
	{
		$arr_product = [];

		$admin_commission_percent = $gst_percent = '';

		if($enc_id != false)
		{
			$id = base64_decode($enc_id);

			$arr_product = get_prduct_attributes_data($id);
			// dd($arr_product);
			$this->arr_view_data['arr_product']         = $arr_product;

			$login_user_id = login_user_id('supplier');

			$obj_admin_commission = $this->SupplierModel->where('id',$login_user_id)->select('id','admin_commission')->first();

			if($obj_admin_commission)
			{
				$admin_commission_percent =  isset($obj_admin_commission->admin_commission) && !empty($obj_admin_commission->admin_commission) ? $obj_admin_commission->admin_commission : 0 ;
			}

			$gst_percent = get_gst_percent();
						
			$this->arr_view_data['gst_percent']                = $gst_percent;
			$this->arr_view_data['admin_commission_percent']   = $admin_commission_percent;
			$this->arr_view_data['product_image_base_path']    = $this->product_image_base_path;
			$this->arr_view_data['product_image_public_path']  = $this->product_image_public_path;

			$this->arr_view_data['parent_module_icon']         = "icon-home2";
			$this->arr_view_data['parent_module_title']        = "Dashboard";
			$this->arr_view_data['parent_module_url']          = $this->supplier_url_path.'/dashboard';
			$this->arr_view_data['page_title']                 = "View ".str_plural($this->module_title);
			$this->arr_view_data['module_title']               = "Manage ".str_plural($this->module_title);
			$this->arr_view_data['module_icon']                = $this->module_icon;
			$this->arr_view_data['module_url']     	           = $this->module_url_path;
			$this->arr_view_data['module_url_path']            = $this->module_url_path;
			$this->arr_view_data['admin_panel_slug']           = $this->admin_panel_slug;
			$this->arr_view_data['sub_module_title']           = 'View '.str_singular($this->module_title);
			$this->arr_view_data['sub_module_icon']            = 'fa fa-eye';

			return view($this->module_view_folder.'.view',$this->arr_view_data);
			
		}
		else
		{
			Session::flash('error','Something went to wrong! Please try again later.');
			return redirect()->back();
		}	
	}

	public function check_product_duplication($arr_product = false, $product_id = false)
	{
		$product_count = "";
		if($arr_product != false)
		{
			$product_count = $this->BaseModel->where($arr_product);
			if($product_id != false)
			{
				$product_count = $product_count->where('id','<>',$product_id);
			}

			$product_count = $product_count->count();

			if($product_count == 0)
			{
				return  'no';
			}
			else
			{
				return 'yes';
			}	
		}
		else
		{
			return '';
		}
		
	}


	// Get data of product attributes(metal,setting,shank type,band setting,metal detailing,occasion,brand,ring shoulder,collection)

	public function get_product_attributes()
	{
		$arr_metal = $arr_setting = $arr_shank_type = $arr_band_setting = $arr_metal_detailing = $arr_occassion = $arr_brand = $arr_collection = $arr_look = $arr_gemstone = $arr_metal_color = $arr_metal_quality =  $arr_gemstone_color = $arr_gemstone_quality = $arr_gemstone_shape =  [];


		// Get metals from db.
		$obj_metal = $this->MetalsModel->select('id','metal_name','metal_color','metal_quality')
		->where('status','1')
		->orderBy('metal_name','ASC')	
		->get();

		if($obj_metal)
		{
			$arr_metal = $obj_metal->toArray();
		}

		/////

		// Get settings from db.

		$obj_setting = $this->SettingModel->select('id','setting')
		->where('status','1')
		->orderBy('setting','ASC')	
		->get();

		if($obj_setting)
		{
			$arr_setting = $obj_setting->toArray();
		}

		/////

		// Get shank type from db.

		$obj_shank_type = $this->ShankTypeModel->select('id','shank_type')
		->where('status','1')
		->orderBy('shank_type','ASC')	
		->get();

		if($obj_shank_type)
		{
			$arr_shank_type = $obj_shank_type->toArray();
		}

		/////

		// Get band setting from db.

		$obj_band_setting = $this->BandSettingModel->select('id','band_setting')
		->where('status','1')
		->orderBy('band_setting','ASC')	
		->get();

		if($obj_band_setting)
		{
			$arr_band_setting = $obj_band_setting->toArray();
		}

		/////

		// Get metal detailing from db.

		$obj_metal_detailing = $this->MetalDetailingModel->select('id','metal_detailing_name')
		->where('status','1')
		->orderBy('metal_detailing_name','ASC')	
		->get();

		if($obj_metal_detailing)
		{
			$arr_metal_detailing = $obj_metal_detailing->toArray();
		}
		
		/////

		// Get occassion detailing from db.

		$obj_occassion = $this->OccasionsModel->select('id','occasion_name')
		->where('status','1')
		->orderBy('occasion_name','ASC')	
		->get();

		if($obj_occassion)
		{
			$arr_occassion = $obj_occassion->toArray();
		}

		/////

		// Get brands from db.

		$obj_brand = $this->BrandModel->select('id','brand_name')
		->where('status','1')
		->orderBy('brand_name','ASC')	
		->get();

		if($obj_brand)
		{
			$arr_brand = $obj_brand->toArray();
		}

		/////

		// Get ring shoulders from db.

		$obj_ring_shoulder = $this->RingShoulderModel->select('id','ring_shoulder_type')
		->where('status','1')
		->orderBy('ring_shoulder_type','ASC')	
		->get();

		if($obj_ring_shoulder)
		{
			$arr_ring_shoulder = $obj_ring_shoulder->toArray();
		}

		/////

		// Get collections from db.

		$obj_collection = $this->CollectionModel->select('id','name')
		->where('status','1')
		->orderBy('name','ASC')	
		->get();

		if($obj_collection)
		{
			$arr_collection = $obj_collection->toArray();
		}

		/////

		// Get look from db.

		$obj_look = $this->LookModel->select('id','look')
		->where('status','1')
		->orderBy('look','ASC')	
		->get();

		if($obj_look)
		{
			$arr_look = $obj_look->toArray();
		}

		/////

		// Get Gemstone from db.

		$obj_gemstone = $this->GemStoneModel->select('id','type','color','quality','shape')
		->where('status','1')
		->orderBy('type','ASC')	
		->get();

		if($obj_gemstone)
		{
			$arr_gemstone = $obj_gemstone->toArray();
		}

		/////

		// Get metal color from db.

		$obj_metal_color = $this->MetalColorModel->select('id','metal_color')
		->where('status','1')
		->orderBy('metal_color','ASC')	
		->get();

		if($obj_metal_color)
		{
			$arr_metal_color = $obj_metal_color->toArray();
		}

		/////

		// Get metal quality from db.

		$obj_metal_quality = $this->MetalQualityModel->select('id','quality_name')
		->where('status','1')
		->orderBy('quality_name','ASC')	
		->get();

		if($obj_metal_quality)
		{
			$arr_metal_quality = $obj_metal_quality->toArray();
		}

		/////

		// Get gemstone color from db.

		$obj_gemstone_color = $this->GemstoneColorModel->select('id','gemstone_color')
		->where('status','1')
		->orderBy('gemstone_color','ASC')	
		->get();

		if($obj_gemstone_color)
		{
			$arr_gemstone_color = $obj_gemstone_color->toArray();
		}

		/////
		// Get gemstone quality from db.

		$obj_gemstone_quality = $this->GemstoneQualitiesModel->select('id','gemstone_quality')
		->where('status','1')
		->orderBy('gemstone_quality','ASC')	
		->get();

		if($obj_gemstone_quality)
		{
			$arr_gemstone_quality = $obj_gemstone_quality->toArray();
		}

		/////

		// Get gemstone shape from db.

		$obj_gemstone_shape = $this->GemstoneShapesModel->select('id','shape_name')
		->where('status','1')
		->orderBy('shape_name','ASC')	
		->get();

		if($obj_gemstone_shape)
		{
			$arr_gemstone_shape = $obj_gemstone_shape->toArray();
		}


		/////


		$this->arr_view_data['arr_metal']             = $arr_metal;
		$this->arr_view_data['arr_setting']           = $arr_setting;
		$this->arr_view_data['arr_shank_type']        = $arr_shank_type;
		$this->arr_view_data['arr_band_setting']      = $arr_band_setting;
		$this->arr_view_data['arr_metal_detailing']   = $arr_metal_detailing;
		$this->arr_view_data['arr_occassion']         = $arr_occassion;
		$this->arr_view_data['arr_brand']             = $arr_brand;
		$this->arr_view_data['arr_ring_shoulder']     = $arr_ring_shoulder;
		$this->arr_view_data['arr_collection']        = $arr_collection;
		$this->arr_view_data['arr_look']              = $arr_look;
		$this->arr_view_data['arr_gemstone']          = $arr_gemstone;
		$this->arr_view_data['arr_metal_color']       = $arr_metal_color;
		$this->arr_view_data['arr_metal_quality']     = $arr_metal_quality;
		$this->arr_view_data['arr_gemstone_color']    = $arr_gemstone_color;
		$this->arr_view_data['arr_gemstone_quality']  = $arr_gemstone_quality;
		$this->arr_view_data['arr_gemstone_shape']    = $arr_gemstone_shape;

		return $this->arr_view_data;
	}

	public function remove_product_img($enc_image_id = false,$enc_product_id = false)
	{
		$arr_img = [];
		if($enc_product_id == false)
		{
			if($enc_image_id != false)
			{
				$image_id = base64_decode($enc_image_id);

				$obj_img = $this->ProductImagesModel->where('id',$image_id)->first();

				if($obj_img)
				{
					$arr_img = $obj_img->toArray();

					if(isset($arr_img['image']) && !empty($arr_img['image']) && file_exists($this->product_image_base_path.'/'.$arr_img['image']))
					{
						@unlink($this->product_image_base_path.'/'.$arr_img['image']);
					} 
				}

				$res = $this->ProductImagesModel->where('id' , $image_id)->delete();
				if($res)
				{
					$arr_response['status']  = 'success';
					$arr_response['message'] = 'Image delete successfully.';
				}
				else
				{
					$arr_response['status']  = 'error';
					$arr_response['message'] = 'Problem occured while deleting image.';
				}

			}
			else
			{
				$arr_response['status']  = 'error';
				$arr_response['message'] = translation('problem_occured_while_deleting').' '.translation('certificate');
			}

			return response()->json($arr_response);
		}
		else
		{
			$product_id = base64_decode($enc_product_id);

			$obj_img = $this->ProductImagesModel->where('product_id',$product_id)->get();
			if($obj_img)
			{
				$arr_img = $obj_img->toArray();

				foreach ($arr_img as $val)
				{
					if(isset($val['image']) && !empty($val['image']) && file_exists($this->product_image_base_path.'/'.$val['image']))
					{
						@unlink($this->product_image_base_path.'/'.$val['image']);
					} 
				}
			}
			return true;
		}
	}

	public function delete($enc_id = FALSE)
	{
		if(!$enc_id)
		{
			return redirect()->back();
		}

		if($this->perform_delete(base64_decode($enc_id)))
		{
			Session::flash('success', str_singular($this->module_title). ' Deleted Successfully');
		}
		else
		{
			Session::flash('error', 'Problem Occured While '.str_singular($this->module_title).' Deletion ');
		}

		return redirect()->back();
	}

	public function perform_delete($id)
	{
		$delete= $this->BaseModel->where('id',$id)->delete();

		if($delete)
		{
			$this->remove_product_img(false,base64_encode($id));
			$this->ProductImagesModel->where('product_id',$id)->delete();
			$this->ProductOccasionsModel->where('product_id',$id)->delete();
			$this->ProductCollectionsModel->where('product_id',$id)->delete();

			return TRUE;
		}
		return FALSE;
	}

	/*
	| Name : Deepak Bari
	| Function : Get product lines by sub category.
	| Date : 14-05-2018
	*/

	public function get_product_lines_by_sub_category(Request $request)
	{
		if(isset($request->sub_category_id) && !empty($request->sub_category_id))
		{
			$arr_product_lines = [];
			$arr_product_lines = get_product_lines_by_sub_category($request->sub_category_id);
			
			return $arr_product_lines;
		}
	}

}
