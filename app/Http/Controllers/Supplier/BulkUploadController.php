<?php

namespace App\Http\Controllers\Supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Services\ExcelService;

use App\Models\ProductImagesModel;
use App\Models\ProductOccasionsModel;
use App\Models\ProductCollectionsModel;
use App\Models\ProductMetalsModel;
use App\Models\ProductGemStoneModel;
use App\Models\ProductSizesModel;
use App\Models\ProductsModel;

use App\Models\MetalColorModel;
use App\Models\MetalsModel;
use App\Models\MetalQualityModel;
use App\Models\GemstoneColorModel;

use App\Models\CategoryModel;
use App\Models\GemStoneModel;
use App\Models\GemstoneQualitiesModel;
use App\Models\GemstoneShapesModel;

use App\Models\ShankTypeModel;
use App\Models\RingShoulderModel;
use App\Models\BandSettingModel;

use App\Models\LookModel;
use App\Models\MetalDetailingModel;
use App\Models\CollectionModel;
use App\Models\OccasionsModel;
use App\Models\SettingModel;	
use App\Models\BrandModel;

use Validator;

class BulkUploadController extends Controller
{
	public function __construct(
		LookModel               $look_model,
		MetalsModel             $metals_model,
		BrandModel              $brand_model,
		SettingModel            $setting_model,
		ExcelService            $excel_service,
		ProductsModel           $products_model,
		CategoryModel           $category_model,
		GemStoneModel           $gemstone_model,
		OccasionsModel          $occasions_model,
		CollectionModel         $collection_model,
		ShankTypeModel          $shank_type_model,
		MetalColorModel         $metal_color_model,
		BandSettingModel        $band_setting_model,
		MetalQualityModel       $metal_quality_model,
		ProductSizesModel       $product_sizes_model,
		RingShoulderModel       $ring_shoulder_model,
		ProductImagesModel      $product_images_model,
		GemstoneColorModel      $gemstone_color_model,
		ProductMetalsModel      $product_metals_model,
		MetalDetailingModel     $metal_detailing_model,
		GemstoneShapesModel     $gemstone_shapes_model,
		ProductGemStoneModel    $product_gemstone_model,
		ProductOccasionsModel   $product_occasions_model,
		GemstoneQualitiesModel  $gemstone_qualities_model,
		ProductCollectionsModel $product_collections_model
		)
	{
		$this->module_title                  = "Bulk Upload";
		$this->module_url_path               = url('/supplier/bulk-upload');
		$this->module_view_folder            = "supplier.bulk_upload";
		$this->module_icon                   = "fa fa-upload";

		$this->LookModel               = $look_model;
		$this->BrandModel              = $brand_model;
		$this->MetalsModel             = $metals_model;
		$this->SettingModel            = $setting_model;
		$this->ExcelService            = $excel_service;
		$this->GemStoneModel           = $gemstone_model;
		$this->ProductsModel           = $products_model;
		$this->CategoryModel           = $category_model;
		$this->OccasionsModel          = $occasions_model;
		$this->ShankTypeModel          = $shank_type_model;
		$this->CollectionModel         = $collection_model;
		$this->MetalColorModel         = $metal_color_model;
		$this->BandSettingModel        = $band_setting_model;
		$this->RingShoulderModel       = $ring_shoulder_model;
		$this->MetalQualityModel       = $metal_quality_model;
		$this->ProductSizesModel       = $product_sizes_model;
		$this->GemstoneColorModel      = $gemstone_color_model;
		$this->ProductImagesModel      = $product_images_model;
		$this->ProductMetalsModel      = $product_metals_model;
		$this->GemstoneShapesModel     = $gemstone_shapes_model;
		$this->MetalDetailingModel     = $metal_detailing_model;
		$this->ProductGemStoneModel    = $product_gemstone_model;
		$this->ProductOccasionsModel   = $product_occasions_model;
		$this->GemstoneQualitiesModel  = $gemstone_qualities_model;
		$this->ProductCollectionsModel = $product_collections_model;

		$this->supplier_panel_slug           = config('app.project.supplier_panel_slug');
		$this->profile_image_base_img_path   = base_path().config('app.project.img_path.supplier_profile_image');
		$this->profile_image_public_img_path = url('/').config('app.project.img_path.supplier_profile_image');

	}

	public function products()
	{
		$this->arr_view_data['page_title']           = $this->module_title;
		$this->arr_view_data['parent_module_icon']   = "fa fa-home";
		$this->arr_view_data['parent_module_title']  = "Dashboard";
		$this->arr_view_data['parent_module_url']    = url('/').'/supplier/dashboard';
		$this->arr_view_data['sub_module_title']     =  'Bulk Upload : Products';
		$this->arr_view_data['sub_module_icon']      =  'fa fa-upload';
		$this->arr_view_data['supplier_panel_slug']  = $this->supplier_panel_slug;
		$this->arr_view_data['module_url_path']     = $this->module_url_path;

		return view($this->module_view_folder.'.products',$this->arr_view_data);
	}

	public function images()
	{
		$this->arr_view_data['page_title']          = $this->module_title;
		$this->arr_view_data['parent_module_icon']  = "fa fa-home";
		$this->arr_view_data['parent_module_title'] = "Dashboard";
		$this->arr_view_data['parent_module_url']   = url('/').'/supplier/dashboard';
		$this->arr_view_data['sub_module_title']    = 'Bulk Upload : Images';
		$this->arr_view_data['sub_module_icon']     = 'fa fa-upload';
		$this->arr_view_data['supplier_panel_slug'] = $this->supplier_panel_slug;
		$this->arr_view_data['module_url_path']     = $this->module_url_path;

		return view($this->module_view_folder.'.images',$this->arr_view_data);
	}

	public function upload_products(Request $request)
	{
		$type                     = '1';
		$arr_final_metals         = [];
		$arr_final_product        = [];
		$arr_final_occasions      = [];
		$arr_final_collections    = [];
		$arr_final_gemstones      = [];
		$product_final_sizes      = [];
		$arr_final_product_images = [];

		if($request->hasFile('file'))
		{
			$file    = $request->file('file');
		}
		else
		{
			$this->arr_view_data['msg']  = 'Please select file to upload.';
			return back()->with('data', $this->arr_view_data);
		}

		$validator = Validator::make(['file' => $file,], [ 'file' => 'required', ] );

		if($validator->fails())
		{
			return redirect()->back()->withErrors($validator)->withInput($request->all());
		}

		$fileExtension = strtolower($file->getClientOriginalExtension()); 
		
		if($fileExtension != 'xls')
		{
			$this->arr_view_data['status'] = 'error';
			$this->arr_view_data['msg']    = 'Invalid file extension';
			return back()->with('data', $this->arr_view_data);	
		}


		$results = \Excel::load($file, function($reader) {})->get();

		if($results)
		{
			$record_count = count($results);
			
			if($record_count>100)
			{
				$this->arr_view_data['msg']  = 'Only 100 records are allowed to upload.';
				$this->arr_view_data['status'] = 'error';
				return back()->with('data', $this->arr_view_data);
			}

			if($record_count==0)
			{
				$this->arr_view_data['msg']  = 'Please insert atlist one record';
				$this->arr_view_data['status'] = 'error';
				return back()->with('data', $this->arr_view_data);
			}

			foreach ($results as $key => $product) 
			{
				$arr_compare    = [];
				$upload_product = [];
				$product_type   = isset($product['product_type'])? $product['product_type'] :'';

				if($product_type!='')
				{
					$product_type = trim($product_type);
					$product_type = strtolower($product_type);

					if($product_type =='classic')
					{
						$upload_product['product_type'] = '1';
						$arr_compare['product_type']    = '1';
					}
					elseif($product_type =='luxure')
					{
						$this->arr_view_data['line'] = $key+1;
						$this->arr_view_data['msg']  = 'This type of product site will comming soon';
						$this->arr_view_data['status'] = 'error';
						return back()->with('data', $this->arr_view_data);	
					}
					else
					{
						$this->arr_view_data['line'] = $key+1;
						$this->arr_view_data['msg']  = 'Please enter product type';
						$this->arr_view_data['status'] = 'error';
						return back()->with('data', $this->arr_view_data);	
					}
				}
				else
				{
					$this->arr_view_data['line'] = $key+1;
						$this->arr_view_data['msg']  = 'Please enter product type';
						$this->arr_view_data['status'] = 'error';
						return back()->with('data', $this->arr_view_data);	
				}

				$upload_product['uid']                = $this->generate_random_product_uid();
				$upload_product['added_by_user_type'] = '3';
				$upload_product['added_by_user_id']   = login_user_id('supplier');
				$product['added_by_user_id']          = '1';

				$category_name    = isset($product['category_name'])? $product['category_name']:'';

				
				$category_details = $this->ExcelService->get_category_details($category_name, $upload_product['product_type']);

				if($category_details['status'])
				{
					$upload_product['category_id'] = $category_details['category_id'];
					$arr_compare['category_id']    = $category_details['category_id'];

					$subcategory_name              = isset($product['subcategory_name'])? $product['subcategory_name']:'';

					$subcategory_details           = $this->ExcelService->get_subcategory_details($subcategory_name, $category_details['category_id'],$upload_product['product_type']);

					if($subcategory_details['status'])
					{
						$upload_product['subcategory_id'] = $subcategory_details['subcategory_id'];
						$arr_compare['subcategory_id']    = $subcategory_details['subcategory_id'];
						$product_line                     = isset($product['product_line'])? $product['product_line']:'';

						$product_line_details = $this->ExcelService->get_product_line_details($product_line, $upload_product['subcategory_id']);

						if($product_line_details['status'])
						{
							$upload_product['product_line_id'] = $product_line_details['product_line_id'];
							$arr_compare['product_line_id']    = $product_line_details['product_line_id'];
						}
						else
						{
							$this->arr_view_data['line'] = $key+1;
							$this->arr_view_data['status'] = 'error';
							$this->arr_view_data['msg']  = $product_line_details['msg'];
							return back()->with('data', $this->arr_view_data);
						}
					}
					else
					{
						$this->arr_view_data['line'] = $key+1;
						$this->arr_view_data['status'] = 'error';
						$this->arr_view_data['msg']  = $subcategory_details['msg'];
						return back()->with('data', $this->arr_view_data);		
					}
				}
				else
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['status'] = 'error';
					$this->arr_view_data['msg']  = $category_details['msg'];
					return back()->with('data', $this->arr_view_data);
				}

				$product_setting         = isset($product['product_setting'])? $product['product_setting']:'';
				$product_setting_details = $this->ExcelService->get_product_setting_details($product_setting);

				if($product_setting_details['status'])
				{
					$upload_product['setting_id']= isset($product_setting_details['setting_id'])? $product_setting_details['setting_id']:'';
					$arr_compare['setting_id']    = $upload_product['setting_id'];
				}
				else
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['status'] = 'error';
					$this->arr_view_data['msg']  = $product_setting_details['msg'];
					return back()->with('data', $this->arr_view_data);
				}

				$shank_type         = isset($product['shank_type'])? $product['shank_type']:'';
				$shank_type_details = $this->ExcelService->get_shank_type_details($shank_type, $subcategory_details['subcategory_id']);

				if($shank_type_details['status'])
				{
					$upload_product['shank_type_id'] = isset($shank_type_details['shank_type_id'])? $shank_type_details['shank_type_id']:'';
				}
				else
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['status'] = 'error';
					$this->arr_view_data['msg']  = $shank_type_details['msg'];
					return back()->with('data', $this->arr_view_data);
				}

				$band_setting         = isset($product['band_setting'])? $product['band_setting']:'';
				$band_setting_details = $this->ExcelService->get_band_setting_details($band_setting, $subcategory_details['subcategory_id']);

				if($band_setting_details['status'])
				{
					$upload_product['band_setting_id'] = isset($band_setting_details['band_setting_id'])? $band_setting_details['band_setting_id']:'';	
				}
				else
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['status'] = 'error';
					$this->arr_view_data['msg']  = $band_setting_details['msg'];
					return back()->with('data', $this->arr_view_data);
				}

				$ring_shoulder_type = isset($product['ring_shoulder_type'])? $product['ring_shoulder_type']:'';

				$ring_shoulder_type_details = $this->ExcelService->get_ring_shoulder_type_details($ring_shoulder_type, $subcategory_details['subcategory_id']);

				if($ring_shoulder_type_details['status'])
				{
					$upload_product['ring_shoulder_id'] = isset($ring_shoulder_type_details['ring_shoulder_type_id'])? $ring_shoulder_type_details['ring_shoulder_type_id']:'';	
				}
				else
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['status'] = 'error';
					$this->arr_view_data['msg']  = $ring_shoulder_type_details['msg'];
					return back()->with('data', $this->arr_view_data);
				}

				$metal_detailing                              = isset($product['metal_detailing'])? $product['metal_detailing'] :'';
				$metal_detailing_details                      = $this->ExcelService->get_metal_detailing_details($metal_detailing);

				if($metal_detailing_details['status'])
				{
					$upload_product['product_metal_detailing_id'] = isset($metal_detailing_details['metal_detailing_id'])? $metal_detailing_details['metal_detailing_id']:'';
					$arr_compare['product_metal_detailing_id']    = $upload_product['product_metal_detailing_id'];
				}
				else
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['status'] = 'error';
					$this->arr_view_data['msg']  = $metal_detailing_details['msg'];
					return back()->with('data', $this->arr_view_data);
				}

				$brand         = isset($product['brand'])? $product['brand']:'';
				$brand_details = $this->ExcelService->get_brand_details($brand);


				if($brand_details['status'])
				{
					$upload_product['product_brand_id']	= isset($brand_details['brand_id'])? $brand_details['brand_id']:'';
					$arr_compare['product_brand_id']    = $upload_product['product_brand_id'];
				}
				else
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['status'] = 'error';
					$this->arr_view_data['msg']  = $brand_details['msg'];
					return back()->with('data', $this->arr_view_data);
				}

				$look = isset($product['look'])? $product['look']:'';

				$look_details = $this->ExcelService->get_look_details($look);

				if($look_details['status'])
				{
					$upload_product['look_id']	= isset($look_details['look_id'])? $look_details['look_id']:'';
				}
				else
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['status'] = 'error';
					$this->arr_view_data['msg']  = $look_details['msg'];
					return back()->with('data', $this->arr_view_data);
				}

				$name = isset($product['name'])? $product['name']:'';

				if($name=='')
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['status'] = 'error';
					$this->arr_view_data['msg']  = 'Please enter product name';
					return back()->with('data', $this->arr_view_data);	
				}

				$upload_product['product_name'] = $name;
				$arr_compare['product_name']    = $name;

				$metal_weight = isset($product['metal_weight'])? $product['metal_weight']:'';

				if($metal_weight=='')
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['status'] = 'error';
					$this->arr_view_data['msg']  = 'Please enter metal weight';
					return back()->with('data', $this->arr_view_data);	
				}

				if(is_float($metal_weight))
				{
					$upload_product['metal_weight'] = $metal_weight;
				}
				else
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['status'] = 'error';
					$this->arr_view_data['msg']  = 'Please enter valid metal weight';
					return back()->with('data', $this->arr_view_data);
				}


				$product_height   = isset($product['product_height'])? $product['product_height']:'';

				if($product_height!='' && is_float($product_height))
				{
					$upload_product['product_height'] = $product_height;
				}
				else
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['status'] = 'error';
					$this->arr_view_data['msg']  = 'Please enter valid product height';
					return back()->with('data', $this->arr_view_data);
				}

				$product_width    = isset($product['product_width'])? $product['product_width']:'';

				if($product_width!='' && is_float($product_width))
				{
					$upload_product['product_width'] = $product_width;
				}
				else
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['status'] = 'error';
					$this->arr_view_data['msg']  = 'Please enter valid product width';
					return back()->with('data', $this->arr_view_data);
				}

				$product_length   = isset($product['product_length'])? $product['product_length']:'';

				if($product_length!='' && is_float($product_length))
				{
					$upload_product['product_length'] = $product_length;
				}
				else
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['status'] = 'error';
					$this->arr_view_data['msg']  = 'Please enter valid product length';
					return back()->with('data', $this->arr_view_data);
				}

				$product_quantity = isset($product['product_quantity'])? $product['product_quantity']:'';

				$upload_product['quantity']       = $product_quantity;

				$product_price = isset($product['product_price'])? $product['product_price'] :'';

				if($product_price=='')
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['status'] = 'error';
					$this->arr_view_data['msg']  = 'Please enter product price';
					return back()->with('data', $this->arr_view_data);	
				}
				elseif(is_float($product_price))
				{
					$upload_product['product_price'] = $product_price;
				}
				else
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['status'] = 'error';
					$this->arr_view_data['msg']  = 'Please enter valid product price';
					return back()->with('data', $this->arr_view_data);	
				}

				$upload_product['quantity']      = $product_quantity;

				$product_code               = isset($product['product_code'])? $product['product_code']:'';

				if(	$product_code!='')
				{
					$count_product = $this->ProductsModel->where('product_code',$product_code)->count();

					if($count_product>0)
					{
					
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['status'] = 'error';
					$this->arr_view_data['msg']  = 'Please enter unique product code';
					return back()->with('data', $this->arr_view_data);	
					}
				}

				// $arr_compare['product_code']    = $upload_product['product_code'];

				if($product_code=='')
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['status'] = 'error';
					$this->arr_view_data['msg']  = 'Please enter product code';
					return back()->with('data', $this->arr_view_data);
				}

				$upload_product['product_code'] = $product_code;

				$product_description = isset($product['description'])? $product['description'] :'';

				if($product_description=='')
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['status'] = 'error';
					$this->arr_view_data['msg']  = 'Please enter product description';
					return back()->with('data', $this->arr_view_data);
				}

				$upload_product['product_description'] = $product_description;
				// $upload_product['keywords'] = isset($product['keywords'])? $product['keywords'] :'';;

				$product_specification = isset($product['specification'])? $product['specification']:'';

				if($product_specification=='')
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['status'] = 'error';
					$this->arr_view_data['msg']  = 'Please enter product specification';
					return back()->with('data', $this->arr_view_data);
				}			

				$upload_product['product_specification'] = $product_specification;
				$video_url                               = isset($product['video_url'])? $product['video_url']:'';
				$upload_product['video_url']             = $video_url;
				$upload_product['type']                  = $type;

				$allow_product_home_trial = isset($product['allow_home_trial'])? $product['allow_home_trial']:'';

				if($allow_product_home_trial=='')
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['status'] = 'error';
					$this->arr_view_data['msg']  = 'Please enter allow product home trial';
					return back()->with('data', $this->arr_view_data);
				}
				else
				{
					$allow_product_home_trial = trim($allow_product_home_trial);
					$allow_product_home_trial = strtolower($allow_product_home_trial);

					if($allow_product_home_trial=='yes')
					{
						$upload_product['allow_product_home_trial'] = '1';
					}
					elseif($allow_product_home_trial=='no')
					{
						$upload_product['allow_product_home_trial'] = '2';
					}
					else
					{
						$this->arr_view_data['line'] = $key+1;
						$this->arr_view_data['status'] = 'error';
						$this->arr_view_data['msg']  = 'Please enter valid allow product home trial';
						return back()->with('data', $this->arr_view_data);
					}
				}

				$delivery_date = isset($product['delivery_date'])? $product['delivery_date']:'';

				if($delivery_date=='')
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['status'] = 'error';
					$this->arr_view_data['msg']  = 'Please enter delivery date';
					return back()->with('data', $this->arr_view_data);
				}

				$delivery_date = trim($delivery_date);
				$delivery_date = strtolower($delivery_date);

				$upload_product['delivery_date'] = $delivery_date;

				$product_slug = $this->ExcelService->get_product_slug($name);

				$upload_product['slug'] = $product_slug;

// -----------------------------------------------------------------------------------------
				$occasions =isset($product['occasions'])? $product['occasions']:'';

				$occasions_detail = $this->ExcelService->get_occasions_detail($occasions);

				if($occasions_detail['status'])
				{
					unset($occasions_detail['status']);
					$upload_product_occasions = $occasions_detail;	
				}
				else
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['status'] = 'error';
					$this->arr_view_data['msg']  = $occasions_detail['msg'];
					return back()->with('data', $this->arr_view_data);
				}

// -----------------------------------------------------------------------------------------


				$collections = isset($product['collections'])? $product['collections']:'';

				$collections_detail = $this->ExcelService->get_collections_detail($collections);

				if($collections_detail['status'])
				{
					unset($collections_detail['status']);
					$upload_product_collections = $collections_detail;	
				}
				else
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['status'] = 'error';
					$this->arr_view_data['msg']  = $collections_detail['msg'];
					return back()->with('data', $this->arr_view_data);
				}
// -----------------------------------------------------------------------------------------

				$metal_details = [];

				$metal_1 = isset($product['metal_1'])? $product['metal_1']:'';
				$metal_2 = isset($product['metal_2'])? $product['metal_2']:'';

				if($metal_1=='' && $metal_2=='')
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['status'] = 'error';
					$this->arr_view_data['msg']  = 'Please enter one metal details';
					return back()->with('data', $this->arr_view_data);
				}

				$metal_1_detail = $this->ExcelService->get_metals_detail($metal_1);

				if($metal_1_detail['status'])
				{
					unset($metal_1_detail['status']);

					if(!empty($metal_1_detail))	
					{
						array_push($metal_details, $metal_1_detail);
					}
				}
				else
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['status'] = 'error';
					$this->arr_view_data['msg']  = $metal_1_detail['msg'];

					return back()->with('data', $this->arr_view_data);
				}


				$metal_2_detail = $this->ExcelService->get_metals_detail($metal_2);

				if($metal_2_detail['status'])
				{
					unset($metal_2_detail['status']);

					if(!empty($metal_2_detail))
					{
						array_push($metal_details, $metal_2_detail);
					}
				}
				else
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['status'] = 'error';
					$this->arr_view_data['msg']  = $metal_2_detail['msg'];

					return back()->with('data', $this->arr_view_data);
				}

// -----------------------------------------------------------------------------------------
				$gemstone_details = [];
				$gemstone_1 = isset($product['gemstone_1'])? $product['gemstone_1']:'';
				$gemstone_2 = isset($product['gemstone_2'])? $product['gemstone_2']:'';
				$gemstone_3 = isset($product['gemstone_3'])? $product['gemstone_3']:'';

				if($gemstone_1==''&& $gemstone_2==''&& $gemstone_3=='')
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['msg']  = 'Please enter one gemstone details';
					return back()->with('data', $this->arr_view_data);
				}

				$gemstone_1_detail = $this->ExcelService->get_gemstone_detail($gemstone_1);

				if($gemstone_1_detail['status'])
				{
					unset($gemstone_1_detail['status']);

					if(!empty($gemstone_1_detail))
					{
						array_push($gemstone_details, $gemstone_1_detail);
					}
				}
				else
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['status'] = 'error';
					$this->arr_view_data['msg']  = $gemstone_1_detail['msg'];

					return back()->with('data', $this->arr_view_data);
				}

				$gemstone_2_detail = $this->ExcelService->get_gemstone_detail($gemstone_2);

				if($gemstone_2_detail['status'])
				{
					unset($gemstone_2_detail['status']);

					if(!empty($gemstone_2_detail))
					{
						array_push($gemstone_details, $gemstone_2_detail);
					}
				}
				else
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['status'] = 'error';
					$this->arr_view_data['msg']  = $gemstone_2_detail['msg'];

					return back()->with('data', $this->arr_view_data);
				}

				$gemstone_3_detail = $this->ExcelService->get_gemstone_detail($gemstone_3);

				if($gemstone_3_detail['status'])
				{
					unset($gemstone_3_detail['status']);

					if(!empty($gemstone_3_detail))
					{
						array_push($gemstone_details, $gemstone_3_detail);
					}
				}
				else
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['status'] = 'error';
					$this->arr_view_data['msg']  = $gemstone_3_detail['msg'];

					return back()->with('data', $this->arr_view_data);
				}

// -----------------------------------------------------------------------------------------

				$product_size_details= [];
				$sizes = isset($product['product_sizes'])? $product['product_sizes']:'';

				if($sizes!='')
				{
					$product_size_details = explode(',', $sizes);
				}

// -----------------------------------------------------------------------------------------


				$images        = $product['product_images'];
				$images_detail = $this->ExcelService->get_images_details($images);

				if($images_detail['status'])
				{
					unset($images_detail['status']);

					foreach ($arr_final_product_images as $arr_final_images) 
					{
						if(array_intersect($images_detail, $arr_final_images))
						{
							$this->arr_view_data['line'] = $key+1;
							$this->arr_view_data['msg']  = 'Duplicate image name';
							$this->arr_view_data['status'] = 'error';
							return back()->with('data', $this->arr_view_data);
						}
					}

					$upload_product_images = $images_detail;
				}
				else
				{
					$this->arr_view_data['line'] = $key+1;

					$this->arr_view_data['status']  = 'error';
					$this->arr_view_data['msg']  = $images_detail['msg'];
					return back()->with('data', $this->arr_view_data);
				}
// -----------------------------------------------------------------------------------------
				$count = $this->ProductsModel->where($arr_compare)->count();

				if($count>0)
				{
					$this->arr_view_data['line'] = $key+1;
					$this->arr_view_data['msg']  = 'Product already exist';
					$this->arr_view_data['status'] = 'error';

					return back()->with('data', $this->arr_view_data);
				}

				foreach ($arr_final_product as $arr_product) 
				{
					if(array_intersect($arr_compare, $arr_product))
					{
						$this->arr_view_data['line'] = $key+1;
						$this->arr_view_data['status'] = 'error';
						$this->arr_view_data['msg']  = 'Duplicate product';
						return back()->with('data', $this->arr_view_data);
					}
				}



				isset($upload_product) && !empty($upload_product)? $arr_final_product[$key]                             = $upload_product             : NULL;
				isset($upload_product_occasions) && !empty($upload_product_occasions)? $arr_final_occasions[$key]       = $upload_product_occasions   : NULL;
				isset($upload_product_collections) && !empty($upload_product_collections)? $arr_final_collections[$key] = $upload_product_collections : NULL;
				isset($metal_details) && !empty($metal_details)? $arr_final_metals[$key]                                = $metal_details              : NULL;
				isset($gemstone_details) && !empty($gemstone_details) ? $arr_final_gemstones[$key]                      = $gemstone_details           : NULL;
				isset($product_size_details) && !empty($product_size_details)? $product_final_sizes[$key]               = $product_size_details       : NULL;
				isset($upload_product_images) && !empty($upload_product_images)? $arr_final_product_images[$key]        = $upload_product_images      : NULL;
			}

// ----------------------------upload_product----------------------------

			foreach ($arr_final_product as $key => $product_value) 
			{
				$obj_insert_product = $this->ProductsModel->create($product_value);

				if($obj_insert_product)
				{
					$product_images = isset($arr_final_product_images[$key])? $arr_final_product_images[$key]:'';

					foreach ($product_images as $product_image) 
					{
						$obj_image_status = $this->ProductImagesModel->create(['image'=>$product_image, 'product_id'=>$obj_insert_product->id]);
					}

					$product_occasions = isset($arr_final_occasions[$key])? $arr_final_occasions[$key] :'';
					
					foreach ($product_occasions as $product_occation) 
					{
						$obj_occasion_status = $this->ProductOccasionsModel->create(['product_id'=>$obj_insert_product->id, 'occasion_id'=>$product_occation['id']]);
					}

					$product_collections = isset($arr_final_collections[$key])? $arr_final_collections[$key]:'';

					foreach ($product_collections as $product_collection) 
					{
						$obj_collection_status = $this->ProductCollectionsModel->create([ 'product_id'=>$obj_insert_product->id, 'collection_id'=>$product_collection['id'] ]);
					}

					
					$product_metals = isset($arr_final_metals[$key])? $arr_final_metals[$key]:'';

					foreach ($product_metals as $product_metal) 
					{
						$product_metals_status = $this->ProductMetalsModel->create([
							'metal_name_id'    => $product_metal['metal']['id'],
							'metal_color_id'   => $product_metal['color']['id'],
							'metal_quality_id' => $product_metal['quality']['id'],
							'product_id'       => $obj_insert_product->id
							]);
					}

					$product_gemstones = isset($arr_final_gemstones[$key])? $arr_final_gemstones[$key]:'';

					foreach ($product_gemstones as $product_gemstone) 
					{

						$product_product_status = $this->ProductGemStoneModel->create([
							'gemstone_type_id'    => $product_gemstone['gemstone']['id'],
							'gemstone_color_id'   => $product_gemstone['color']['id'],
							'gemstone_quality_id' => $product_gemstone['quality']['id'],
							'gemstone_shape_id'   => $product_gemstone['shape']['id'],
							'product_id'          => $obj_insert_product->id
							]);

					}
					
					$product_sizes = isset($product_final_sizes[$key])? $product_final_sizes[$key]:'';

					foreach ($product_sizes as $key => $product_size) 
					{
						$product_sizes_status = $this->ProductSizesModel->create([
							'product_id'=>$obj_insert_product->id,
							'size_name'=>$product_size
							]);
					}
				}
			}

			$this->arr_view_data['msg']  = 'Products imported successfully';
			$this->arr_view_data['status'] = 'success';
			return back()->with('data', $this->arr_view_data);
		}

		$this->arr_view_data['status'] = 'error';
		$this->arr_view_data['msg']  = 'Error while importing products';
		return back()->with('data', $this->arr_view_data);
	}

	public function upload_images(Request $request)
	{

		$target_dir = base_path()."/uploads/product_images/";
		$files       = $request->file('file', null);

		if($files!=null)
		{
			foreach ($files as $key => $file) 
			{
				$fileExt       = $file->getClientOriginalExtension();
				$fileName      = $file->getClientOriginalName();
				$product_image = strtolower($fileName);

				$count = $this->ProductImagesModel->where('image',$product_image)->count();

				if($count=='0')
				{
					$data['status'] = 'error';
					$data['msg']    = 'Image '.$product_image.' not match with any product in the system.';
					return response()->json($data);
				}

			}

			foreach ($files as $key => $file) 
			{
				$fileExt        = $file->getClientOriginalExtension();
				$fileName       = $file->getClientOriginalName();				
				$upload_success = $file->move($target_dir, $fileName);
			}

			$data['status'] = 'success';
			$data['msg'] = 'Images uploded successfully.';
			return response()->json($data);
		}
	}

	public function generate_random_product_uid()
	{
		$size = 8;
		$alpha_key = '';
		$keys = range('a', 'z');

		for ($i = 0; $i < 2; $i++) {
			$alpha_key .= $keys[array_rand($keys)];
		}

		$length = $size - 2;

		$key = '';
		$keys = range(0, 9);

		for ($i = 0; $i < $length; $i++) {
			$key .= $keys[array_rand($keys)];
		}

		return $alpha_key . $key;
	}

	public function download_template()
	{

		\Excel::create('BULK-PRODUCT-UPLOAD',function($excel)
		{
			$excel->sheet('Template', function($sheet)
			{ 
				$i=1;
				$sheet->row($i,array(
					'Name',
					'Category Name',
					'Subcategory Name',
					'Product Line',
					'Product Setting',
					'Shank Type',
					'Band Setting',
					'Ring Shoulder Type',
					'Metal detailing',
					'Brand',
					'Look',
					'Metal weight',
					'Product height',
					'Product width',
					'Product length',
					'Product Price',
					'Product Code',
					'Video Url',
					'Product Type',
					'Allow Home Trial',
					'delivery Date',
					'occasions',
					'Collections',
					'Metal-1',
					'Metal-2',
					'Gemstone-1',
					'Gemstone-2',
					'Gemstone-3',
					'Product Sizes',
					'Product Images',
					'description',
					'Specification'
					));
			});


			$excel->setActiveSheetIndex(0);    
		})->export('xls');


	}

	public function suggetion()
	{
		$arr_data             = [];
		$data                 = [];
		$arr_metal_color      = [];
		$arr_category         = [];
		$arr_metal            = [];
		$arr_gemstone         = [];
		$arr_metal_quality    = [];
		$arr_gemstone_quality = [];
		$arr_shank_type       = [];
		$arr_ring_shoulder    = [];
		$arr_band_setting     = [];
		$arr_look             = [];
		$arr_metal_detailing  = [];
		$arr_collection       = [];
		$arr_brand            = [];
		$arr_setting          = [];
		$arr_occasion         = [];

		$obj_categories = $this->CategoryModel->where('status','1')->with('sub_categories.product_line')->get(['category_name', 'id']);

		if($obj_categories)
		{
			$arr_category = $obj_categories->toArray();	
		}
		$data = $arr_category;
		
		$obj_metal_color = $this->MetalColorModel->where('status','1')->select(['metal_color'])->get();

		if($obj_metal_color)
		{
			$arr_metal_color = $obj_metal_color->toArray();

		}

		$obj_metal = $this->MetalsModel->select(['metal_name'])->where('status', '1')->get();
		
		if($obj_metal)
		{
			$arr_metal = $obj_metal->toArray();
		}

		$obj_metal_quality = $this->MetalQualityModel->where('status', '1')->select(['quality_name'])->get();

		if($obj_metal_quality)
		{
			$arr_metal_quality = $obj_metal_quality->toArray();
		}

		$obj_gemstone = $this->GemStoneModel->where('status', '1')->get();
		if($obj_gemstone)
		{
			$arr_gemstone = $obj_gemstone->toArray();
		}

		$obj_gemstone_color = $this->GemstoneColorModel->where('status', '1')->get(['gemstone_color']);

		if($obj_gemstone_color)
		{
			$arr_gemstone_color = $obj_gemstone_color->toArray();
		}

		$obj_gemstone_quality = $this->GemstoneQualitiesModel->where('status', '1')->get(['gemstone_quality']);

		if($obj_gemstone_quality)
		{
			$arr_gemstone_quality = $obj_gemstone_quality->toArray();
		}

		$obj_gemstone_shape = $this->GemstoneShapesModel->where('status', '1')->get();
		
		if($obj_gemstone_shape)
		{
			$arr_gemstone_shape = $obj_gemstone_shape->toArray();
		}


		$obj_shank_type = $this->ShankTypeModel->select(['shank_type'])->where('status', '1')->get();

		if($obj_shank_type)
		{
			$arr_shank_type = $obj_shank_type->toArray();	
		}

		$obj_ring_shoulder = $this->RingShoulderModel->where('status', '1')->get(['ring_shoulder_type']);
		
		if($obj_ring_shoulder)
		{
			$arr_ring_shoulder = $obj_ring_shoulder->toArray();
		}

		$obj_band_setting = $this->BandSettingModel->where('status', '1')->get(['band_setting']);

		if($obj_band_setting)
		{
			$arr_band_setting = $obj_band_setting->toArray();
		}

		$obj_look = $this->LookModel->where('status', '1')->get(['look']);

		if($obj_look)
		{
			$arr_look = $obj_look->toArray();
		}

		$obj_metal_detailing = $this->MetalDetailingModel->where('status', '1')->get(['metal_detailing_name']);
		if($obj_metal_detailing)
		{
			$arr_metal_detailing = $obj_metal_detailing->toArray();
		}

		$obj_collection = $this->CollectionModel->where('status', '1')->get(['name']);

		if($obj_collection)
		{
			$arr_collection = $obj_collection->toArray();
		}

		$obj_brand    = $this->BrandModel->where('status', '1')->get(['brand_name']);
		
		if($obj_brand)
		{
			$arr_brand = $obj_brand->toArray();
		}
		$obj_setting  = $this->SettingModel->where('status', '1')->get(['setting']);

		if($obj_setting)
		{
			$arr_setting = $obj_setting->toArray();	
		}

		$obj_occasion = $this->OccasionsModel->where('status', '1')->get(['occasion_name']);

		if($obj_occasion)
		{
			$arr_occasion = $obj_occasion->toArray();
		}

		$data['category']          = $arr_category;
		

		\Excel::create('INSTRUCTIONS', function($excel) use(
			$data, 
			$arr_look,
			$arr_metal, 
			$arr_brand,
			$arr_setting,
			$arr_occasion,
			$arr_gemstone, 
			$arr_shank_type,
			$arr_collection,
			$arr_metal_color,  
			$arr_band_setting,
			$arr_ring_shoulder,
			$arr_metal_quality,
			$arr_gemstone_shape,
			$arr_gemstone_color, 
			$arr_metal_detailing,
			$arr_gemstone_quality
			){
			

			$excel->sheet('Sample Product', function($sheet)
			{

				$sheet->cells('A1:AF1', function($cell) {

					$cell->setFont(array(
						'family'     => 'Calibri',
						'size'       => '11',
						'bold'       =>  true
						));

				});

				$i=1;
				
				$sheet->row($i,array(
					'Name',
					'Category Name',
					'Subcategory Name',
					'Product Line',
					'Product Setting',
					'Shank Type',
					'Band Setting',
					'Ring Shoulder Type',
					'Metal Detailing',
					'Brand',
					'Look',
					'Metal Weight',
					'Product Height',
					'Product Width',
					'Product length',
					'Product Price',
					'Product Code',
					'Video Url',
					'Product Type',
					'Allow Home Trial',
					'delivery Date',
					'occasions',
					'Collections',
					'Metal-1',
					'Metal-2',
					'Gemstone-1',
					'Gemstone-2',
					'Gemstone-3',
					'Product Sizes',
					'Product Images',
					'description',
					'Specification'
					));
				
				$i++;

				$sheet->row($i,array(
					'Product Name',
					'Category Name',
					'Subcategory Name',
					'Product Line Name',
					'Product Setting Name',
					'Shank Type Name',
					'Band Setting Name',
					'Ring Shoulder Type Name',
					'Metal Detailing Name',
					'Brand Name',
					'Look1 Name, Look2 Name (Multiple)',
					'Metal Weight(in Gms)',
					'Product Height (in mm)',
					'Product width (in mm)',
					'Product Length (in mm)',
					'Product Price (in rupee)',
					'Product Code',
					'Video Url(embeded youtube url)',
					'Product Type(currently Classic Only)',
					'Allow Home Trial(Yes Or No)',
					'delivery Date(e.g 4-5 Days)',
					'Occation1 Name, occasions2 Name (Multiple)',
					'Collection1 Name, Collection2 Name (Multiple)',
					'Metal1 Type, Metal1 Color, Metal1 Quality',
					'Metal2 Type, Metal2 Color, Metal2 Quality',
					'Gemstone1 Type, Gemstone1 Color, Gesstone1 Quality, Gemstone1 Shape',
					'Gemstone2 Type, Gemstone2 Color, Gesstone2 Quality, Gemstone2 Shape',
					'Gemstone3 Type, Gemstone3 Color, Gesstone3 Quality, Gemstone3 Shape',
					'Sizes(e.g. 1,2,3)',
					'Image1 Name, Image2 Name, Image3 Name, Image4 Name, Image5 Name',
					'Product description',
					'Product Specification'
					));
			});

			$excel->sheet('Category-Subcat-Product lines', function($sheet) use($data)
			{
				$sheet->loadView($this->module_view_folder.'.excel',$data);
			});

			$excel->sheet('Metals & Gemstones', function($sheet) use(
				$arr_metal, 
				$arr_gemstone, 
				$arr_metal_color,
				$arr_metal_quality,
				$arr_gemstone_shape,
				$arr_gemstone_color, 
				$arr_gemstone_quality
				)
			{
				$sheet->cell('A1', function($cell){
					$cell->setFont(array(
						'family'     => 'Calibri',
						'size'       => '11',
						'bold'       =>  true
						));
					$cell->setValue('Metal Type');
				});

				$count = 2;
				foreach ($arr_metal as $key => $metal) {
					$sheet->cell('A'.$count, function($cell) use($metal) 
					{
						$cell->setValue($metal['metal_name']);
					});
					$count++;
				}

				$sheet->cell('B1', function($cell){
					$cell->setFont(array(
						'family'     => 'Calibri',
						'size'       => '11',
						'bold'       =>  true
						));
					$cell->setValue('Metal Color');
				});

				$count = 2;
				foreach ($arr_metal_color as $key => $color) {
					$sheet->cell('B'.$count, function($cell) use($color) 
					{
						$cell->setValue($color['metal_color']);
					});
					$count++;
				}


				$sheet->cell('C1', function($cell){
					$cell->setFont(array(
						'family'     => 'Calibri',
						'size'       => '11',
						'bold'       =>  true
						));
					$cell->setValue('Metal Quality');
				});

				
				$count = 2;
				foreach ($arr_metal_quality as $key => $quality) {
					$sheet->cell('C'.$count, function($cell) use($quality) 
					{
						$cell->setValue($quality['quality_name']);
					});
					$count++;
				}

				$sheet->cell('A10', function($cell){
					$cell->setFont(array(
						'family'     => 'Calibri',
						'size'       => '11',
						'bold'       =>  true
						));
					$cell->setValue('Gemstone Type');
				});

				
				$count = 11;
				foreach ($arr_gemstone as $key => $gemstone) {
					$sheet->cell('A'.$count, function($cell) use($gemstone) 
					{
						$cell->setValue($gemstone['type']);
					});
					$count++;
				}

				$sheet->cell('B10', function($cell){
					$cell->setFont(array(
						'family'     => 'Calibri',
						'size'       => '11',
						'bold'       =>  true
						));
					$cell->setValue('Gemstone Color');
				});

				
				$count = 11;
				foreach ($arr_gemstone_color as $key => $gemstone_color) {
					$sheet->cell('B'.$count, function($cell) use($gemstone_color) 
					{
						$cell->setValue($gemstone_color['gemstone_color']);
					});
					$count++;
				}

				$sheet->cell('C10', function($cell){
					$cell->setFont(array(
						'family'     => 'Calibri',
						'size'       => '11',
						'bold'       =>  true
						));
					$cell->setValue('Gemstone Quality');
				});

				
				$count = 11;
				foreach ($arr_gemstone_quality as $key => $gemstone_quality) {
					$sheet->cell('C'.$count, function($cell) use($gemstone_quality) 
					{
						$cell->setValue($gemstone_quality['gemstone_quality']);
					});
					$count++;
				}

				$sheet->cell('D10', function($cell){
					$cell->setFont(array(
						'family'     => 'Calibri',
						'size'       => '11',
						'bold'       =>  true
						));
					$cell->setValue('Gemstone Shape');
				});

				
				$count = 11;
				foreach ($arr_gemstone_shape as $key => $gemstone_shape) {
					$sheet->cell('D'.$count, function($cell) use($gemstone_shape) 
					{
						$cell->setValue($gemstone_shape['shape_name']);
					});
					$count++;
				}
			});
			$excel->sheet('Ring Attributes', function($sheet) use(
				$arr_shank_type, 
				$arr_ring_shoulder, 
				$arr_band_setting
				){

				$sheet->cell('A1', function($cell){
					$cell->setFont(array(
						'family'     => 'Calibri',
						'size'       => '11',
						'bold'       =>  true
						));
					$cell->setValue('Shank Type');
				});
				$count = '2';

				foreach ($arr_shank_type as $key => $shank_type) 
				{
					$sheet->cell('A'.$count, function($cell) use($shank_type) 
					{
						$cell->setValue($shank_type['shank_type']);
					});
					$count++;
				}


				$sheet->cell('B1', function($cell){
					$cell->setFont(array(
						'family'     => 'Calibri',
						'size'       => '11',
						'bold'       =>  true
						));
					$cell->setValue('Ring Shoulder Type');
				});

				$count = 2;
				foreach ($arr_ring_shoulder as $key => $ring_shoulder) 
				{
					$sheet->cell('B'.$count, function($cell) use($ring_shoulder) 
					{
						$cell->setValue($ring_shoulder['ring_shoulder_type']);
					});
					$count++;

				}

				$sheet->cell('C1', function($cell){
					$cell->setFont(array(
						'family'     => 'Calibri',
						'size'       => '11',
						'bold'       =>  true
						));
					$cell->setValue('Band Setting');
				});

				$count = 2;
				foreach ($arr_band_setting as $key => $band_setting) 
				{
					$sheet->cell('C'.$count, function($cell) use($band_setting) 
					{
						$cell->setValue($band_setting['band_setting']);
					});
					$count++;
				}
			});

			$excel->sheet('Other Attributes', function($sheet) use(
				$arr_look, 
				$arr_collection,
				$arr_metal_detailing,
				$arr_brand,
				$arr_setting,
				$arr_occasion
				){

				$sheet->cell('A1', function($cell){
					$cell->setFont(array(
						'family'     => 'Calibri',
						'size'       => '11',
						'bold'       =>  true
						));
					$cell->setValue('Look');
				});

				$count = 2;

				foreach ($arr_look as $key => $look) 
				{
					$sheet->cell('A'.$count, function($cell) use($look) 
					{
						$cell->setValue($look['look']);
					});
					$count++;
				}

				$sheet->cell('B1', function($cell){
					$cell->setFont(array(
						'family'     => 'Calibri',
						'size'       => '11',
						'bold'       =>  true
						));
					$cell->setValue('Metal Detailing');
				});

				$count = 2;

				foreach ($arr_metal_detailing as $key => $metal_detailing) 
				{
					$sheet->cell('B'.$count, function($cell) use($metal_detailing) 
					{
						$cell->setValue($metal_detailing['metal_detailing_name']);
					});
					$count++;
				}

				$sheet->cell('C1', function($cell){
					$cell->setFont(array(
						'family'     => 'Calibri',
						'size'       => '11',
						'bold'       =>  true
						));
					$cell->setValue('Collections');
				});	

				$count = 2;			

				foreach($arr_collection as $key => $collection)
				{
					$sheet->cell('C'.$count, function($cell) use($collection) 
					{
						$cell->setValue($collection['name']);
					});
					$count++;
				}

				$sheet->cell('D1', function($cell){
					$cell->setFont(array(
						'family'     => 'Calibri',
						'size'       => '11',
						'bold'       =>  true
						));
					$cell->setValue('occasions');
				});

				$count = 2;			

				foreach($arr_occasion as $key => $occation)
				{
					$sheet->cell('D'.$count, function($cell) use($occation) 
					{
						$cell->setValue($occation['occasion_name']);
					});
					$count++;
				}

				$sheet->cell('E1', function($cell){
					$cell->setFont(array(
						'family'     => 'Calibri',
						'size'       => '11',
						'bold'       =>  true
						));
					$cell->setValue('Setting');
				});

				$count = 2;			

				foreach($arr_setting as $key => $setting)
				{
					$sheet->cell('E'.$count, function($cell) use($setting) 
					{
						$cell->setValue($setting['setting']);
					});
					$count++;
				}	

				$sheet->cell('F1', function($cell){
					$cell->setFont(array(
						'family'     => 'Calibri',
						'size'       => '11',
						'bold'       =>  true
						));
					$cell->setValue('Brand');
				});	

				$count = 2;			

				foreach($arr_brand as $key => $brand)
				{
					$sheet->cell('F'.$count, function($cell) use($brand) 
					{
						$cell->setValue($brand['brand_name']);
					});
					$count++;
				}

			});
			$excel->setActiveSheetIndex(0); 
		})->download('xls');
}
}
// }
