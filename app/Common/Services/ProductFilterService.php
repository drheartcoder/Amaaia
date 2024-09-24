<?php 
namespace App\Common\Services;

use App\Models\MetalsModel;
use App\Models\MetalColorModel;
use App\Models\MetalQualityModel;
use App\Models\GemStoneModel;
use App\Models\GemstoneColorModel;
use App\Models\GemstoneQualitiesModel;
use App\Models\GemstoneShapesModel;
use App\Models\OccasionsModel;
use App\Models\CollectionModel;
use App\Models\LookModel;
use App\Models\ProductsModel;
use App\Models\SettingModel;
use App\Models\MetalDetailingModel;
use App\Models\ShankTypeModel;
use App\Models\RingShoulderModel;
use App\Models\BandSettingModel;
use App\Models\ProductSizesModel;
use App\Models\ProductMetalsModel;
use App\Models\ProductImagesModel;
use App\Models\ProductGemStoneModel;

class ProductFilterService
{
	public function __construct(
									MetalsModel            $metalstype_model,
									MetalColorModel        $metalscolor_model,
									MetalQualityModel      $metalsquality_model,
									GemStoneModel          $gemstonetype_model,
									GemstoneColorModel     $gemstonecolor_model,
									GemstoneQualitiesModel $gemstonequality_model,
									GemstoneShapesModel    $gemstoneshape_model,
									OccasionsModel         $occasions_model,
									CollectionModel        $collection_model,
									LookModel              $look_model,
									ProductsModel          $products_model,
									SettingModel           $setting_model,
									MetalDetailingModel    $metaldetailing_model,
									ShankTypeModel         $shanktype_model,
									RingShoulderModel      $ringshoulder_model,
									BandSettingModel       $bandsetting_model,
									ProductSizesModel      $product_sizes_model,
									ProductMetalsModel     $product_metals_model,
									ProductImagesModel     $product_images_model,
									ProductGemStoneModel   $product_gem_stone_model
								)
	{
		$this->MetalsModel            = $metalstype_model;
		$this->MetalsColorModel       = $metalscolor_model;
		$this->MetalsQualityModel     = $metalsquality_model;
		$this->GemStoneModel          = $gemstonetype_model;
		$this->GemStoneColorModel     = $gemstonecolor_model;
		$this->GemstoneQualitiesModel = $gemstonequality_model;
		$this->GemstoneShapesModel    = $gemstoneshape_model;
		$this->OccasionsModel         = $occasions_model;
		$this->CollectionModel        = $collection_model;
		$this->LookModel              = $look_model;
		$this->SettingModel           = $setting_model;
		$this->MetalDetailingModel    = $metaldetailing_model;
		$this->ShankTypeModel         = $shanktype_model;
		$this->RingShoulderModel      = $ringshoulder_model;
		$this->BandSettingModel       = $bandsetting_model;
		$this->ProductsModel          = $products_model;
		$this->ProductGemStoneModel   = $product_gem_stone_model;
	}


	/*
    | Function  : Get all the product filters data
    | Author    : Deepak Arvind Salunke
    | Date      : 23/05/2018
    | Output    : Send all the product filters data
    */

	public function get_filters_data()
	{
		$filters = [];

		// get metal type filters data
		$obj_product_metalstype                 = $this->MetalsModel->where("status", "1")
													       	    	->orderBy('metal_name', 'ASC')
													       			->get();
    	if($obj_product_metalstype)
    	{
		$filters['arr_product_metalstype']      = $obj_product_metalstype->toArray();
    	}

    	// get metal color filters data
		$obj_product_metalscolor                = $this->MetalsColorModel->where("status", "1")
														       	    	->orderBy('metal_color', 'ASC')
														       			->get();
    	if($obj_product_metalscolor)
    	{
		$filters['arr_product_metalscolor']     = $obj_product_metalscolor->toArray();
    	}

    	// get metal quality filters data
		$obj_product_metalsquality              = $this->MetalsQualityModel->where("status", "1")
														       	    		->orderBy('quality_name', 'ASC')
														       				->get();
    	if($obj_product_metalsquality)
    	{
		$filters['arr_product_metalsquality']   = $obj_product_metalsquality->toArray();
    	}

		// get gemstone type filters data
		$obj_product_gemstonetype               = $this->GemStoneModel->where("status", "1")
															     		->orderBy('type', 'ASC')
															     		->get();
    	if($obj_product_gemstonetype)
    	{
		$filters['arr_product_gemstonetype']    = $obj_product_gemstonetype->toArray();
    	}

    	// get gemstone color filters data
		$obj_product_gemstonecolor              = $this->GemStoneColorModel->where("status", "1")
																     		->orderBy('gemstone_color', 'ASC')
																     		->get();
    	if($obj_product_gemstonecolor)
    	{
		$filters['arr_product_gemstonecolor']   = $obj_product_gemstonecolor->toArray();
    	}

    	// get gemstone quality filters data
		$obj_product_gemstonequality            = $this->GemstoneQualitiesModel->where("status", "1")
																	     		->orderBy('gemstone_quality', 'ASC')
																	     		->get();
    	if($obj_product_gemstonequality)
    	{
		$filters['arr_product_gemstonequality'] = $obj_product_gemstonequality->toArray();
    	}

    	// get gemstone shape filters data
		$obj_product_gemstoneshape              = $this->GemstoneShapesModel->where("status", "1")
																     		->orderBy('shape_name', 'ASC')
																     		->get();
    	if($obj_product_gemstonetype)
    	{
		$filters['arr_product_gemstoneshape']   = $obj_product_gemstoneshape->toArray();
    	}

		// get occasions filters data
		$obj_product_occasions                  = $this->OccasionsModel->where("status", "1")
															    	  ->orderBy('occasion_name', 'ASC')
															    	  ->get();
    	if($obj_product_occasions)
    	{
		$filters['arr_product_occasions']       = $obj_product_occasions->toArray();
    	}

		// get collection filters data
		$obj_product_collection                 = $this->CollectionModel->where("status", "1")
																       ->orderBy('name', 'ASC')
																       ->get();
    	if($obj_product_collection)
    	{
		$filters['arr_product_collection']      = $obj_product_collection->toArray();
    	}

		// get look filters data
		$obj_product_look                       = $this->LookModel->where("status", "1")
														    	 ->orderBy('look', 'ASC')
														    	 ->get();
    	if($obj_product_look)
    	{
		$filters['arr_product_look']            = $obj_product_look->toArray();
    	}

		// get setting filters data
		$obj_product_setting                    = $this->SettingModel->where("status", "1")
															    	->orderBy('setting', 'ASC')
															    	->get();
    	if($obj_product_setting)
    	{
		$filters['arr_product_setting']         = $obj_product_setting->toArray();
    	}

		// get metaldetailing filters data
		$obj_product_metaldetailing             = $this->MetalDetailingModel->where("status", "1")
																	    	->orderBy('metal_detailing_name', 'ASC')
																	    	->get();
    	if($obj_product_metaldetailing)
    	{
		$filters['arr_product_metaldetailing']  = $obj_product_metaldetailing->toArray();
    	}

		// get shanktype filters data
		$obj_product_shanktype                  = $this->ShankTypeModel->where("status", "1")
																		->orderBy('shank_type', 'ASC')
																		->get();
		if($obj_product_shanktype)
		{
		$filters['arr_product_shanktype']       = $obj_product_shanktype->toArray();
		}

		// get ringshoulder filters data
		$obj_product_ringshoulder               = $this->RingShoulderModel->where("status", "1")
																		->orderBy('ring_shoulder_type', 'ASC')
																		->get();
		if($obj_product_ringshoulder)
		{
		$filters['arr_product_ringshoulder']    = $obj_product_ringshoulder->toArray();
		}

		// get band setting filters data
		$obj_product_bandsetting                = $this->BandSettingModel->where("status", "1")
																		->orderBy('band_setting', 'ASC')
																		->get();
		if($obj_product_bandsetting)
		{
		$filters['arr_product_bandsetting']     = $obj_product_bandsetting->toArray();
		}

		return $filters;
	} // end get_filters_data


	/*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 23/05/2018
    | Output    : 
    */

    public function apply_filters($form_data, $obj_products)
    {
    	$data = $applied_filters = [];

    	// for metal type filter
		if(isset($form_data['metalstype']) && !empty($form_data['metalstype']))
		{
			$metalstype = $form_data['metalstype'];
			$applied_filters['filter_metaltype'] = $metalstype;

			$obj_products = $obj_products->with("product_metals.metal_name")
			->whereHas("product_metals.metal_name", function($qmetal) use ($metalstype){
				$qmetal->where('metal_name', $metalstype);
			});
		}

		// for metal color filter
		if(isset($form_data['metalscolor']) && !empty($form_data['metalscolor']))
		{
			$metalscolor = $form_data['metalscolor'];
			$applied_filters['filter_metalcolor'] = $metalscolor;

			$obj_products = $obj_products->with("product_metals.metal_color")
			->whereHas("product_metals.metal_color", function($qmetal) use ($metalscolor){
				$qmetal->where('metal_color', $metalscolor);
			});
		}

		// for metal quality filter
		if(isset($form_data['metalsquality']) && !empty($form_data['metalsquality']))
		{
			$metalsquality = $form_data['metalsquality'];
			$applied_filters['filter_metalquality'] = $metalsquality;

			$obj_products = $obj_products->with("product_metals.metal_quality")
			->whereHas("product_metals.metal_quality", function($qmetal) use ($metalsquality){
				$qmetal->where('quality_name', $metalsquality);
			});
		}


		// for gemstone type filter
		if(isset($form_data['gemstonetype']) && !empty($form_data['gemstonetype']))
		{
			$gemstonetype = $form_data['gemstonetype'];
			$applied_filters['filter_gemstonetype'] = $gemstonetype;

			$obj_products = $obj_products->with("product_gemstones.gemstone_type")
			->whereHas("product_gemstones.gemstone_type", function($qgemstone) use ($gemstonetype){
				$qgemstone->where('type', $gemstonetype);
			});
		}

		// for gemstone color filter
		if(isset($form_data['gemstonecolor']) && !empty($form_data['gemstonecolor']))
		{
			$gemstonecolor = $form_data['gemstonecolor'];
			$applied_filters['filter_gemstonecolor'] = $gemstonecolor;

			$obj_products = $obj_products->with("product_gemstones.gemstone_color")
			->whereHas("product_gemstones.gemstone_color", function($qgemstone) use ($gemstonecolor){
				$qgemstone->where('gemstone_color', $gemstonecolor);
			});
		}

		// for gemstone quality filter
		if(isset($form_data['gemstonequality']) && !empty($form_data['gemstonequality']))
		{
			$gemstonequality = $form_data['gemstonequality'];
			$applied_filters['filter_gemstonequality'] = $gemstonequality;

			$obj_products = $obj_products->with("product_gemstones.gemstone_quality")
			->whereHas("product_gemstones.gemstone_quality", function($qgemstone) use ($gemstonequality){
				$qgemstone->where('gemstone_quality', $gemstonequality);
			});
		}

		// for gemstone shape filter
		if(isset($form_data['gemstoneshape']) && !empty($form_data['gemstoneshape']))
		{
			$gemstoneshape = $form_data['gemstoneshape'];
			$applied_filters['filter_gemstoneshape'] = $gemstoneshape;

			$obj_products = $obj_products->with("product_gemstones.gemstone_shape")
			->whereHas("product_gemstones.gemstone_shape", function($qgemstone) use ($gemstoneshape){
				$qgemstone->where('shape_name', $gemstoneshape);
			});
		}

		// for occasions filter
		if(isset($form_data['occasions']) && !empty($form_data['occasions']))
		{
			$occasions = explode(',', $form_data['occasions']);
			$applied_filters['filter_occasions'] = $occasions;

			$obj_products = $obj_products->with("product_occasions.occasion")
			->whereHas("product_occasions.occasion", function($qoccasions) use ($occasions){
				$qoccasions->whereIn('slug', $occasions);
			});
		}

		// for collection filter
		if(isset($form_data['collection']) && !empty($form_data['collection']))
		{
			$collection = explode(',', $form_data['collection']);
			$applied_filters['filter_collection'] = $collection;

			$obj_products = $obj_products->with("product_collections.collection")
			->whereHas("product_collections.collection", function($qcollection) use ($collection){
				$qcollection->whereIn('slug', $collection);
			});
		}

		// for look filter
		if(isset($form_data['look']) && !empty($form_data['look']))
		{
			$look = explode(',', $form_data['look']);
			$applied_filters['filter_look'] = $look;

			$obj_products = $obj_products->with("look")
			->whereHas("look", function($qlook) use ($look){
				$qlook->whereIn('slug', $look);
			});
		}

		// for setting filter
		if(isset($form_data['setting']) && !empty($form_data['setting']))
		{
			$setting = explode(',', $form_data['setting']);
			$applied_filters['filter_setting'] = $setting;

			$obj_products = $obj_products->with("setting")
			->whereHas("setting", function($qsetting) use ($setting){
				$qsetting->whereIn('slug', $setting);
			});
		}

		// for metaldetailing filter
		if(isset($form_data['metaldetailing']) && !empty($form_data['metaldetailing']))
		{
			$metaldetailing = explode(',', $form_data['metaldetailing']);
			$applied_filters['filter_metaldetailing'] = $metaldetailing;

			$obj_products = $obj_products->with("metal_detailing")
			->whereHas("metal_detailing", function($qmetaldetailing) use ($metaldetailing){
				$qmetaldetailing->whereIn('slug', $metaldetailing);
			});
		}

		// for shanktype filter
		if(isset($form_data['shanktype']) && !empty($form_data['shanktype']))
		{
			$shanktype = explode(',', $form_data['shanktype']);
			$applied_filters['filter_shanktype'] = $shanktype;

			$obj_products = $obj_products->with("shank_type")
			->whereHas("shank_type", function($qshanktype) use ($shanktype){
				$qshanktype->whereIn('slug', $shanktype);
			});
		}

		// for ringshoulder filter
		if(isset($form_data['ringshoulder']) && !empty($form_data['ringshoulder']))
		{
			$ringshoulder = explode(',', $form_data['ringshoulder']);
			$applied_filters['filter_ringshoulder'] = $ringshoulder;

			$obj_products = $obj_products->with("ring_shoulder")
			->whereHas("ring_shoulder", function($qringshoulder) use ($ringshoulder){
				$qringshoulder->whereIn('slug', $ringshoulder);
			});
		}

		// for bandsetting filter
		if(isset($form_data['bandsetting']) && !empty($form_data['bandsetting']))
		{
			$bandsetting = explode(',', $form_data['bandsetting']);
			$applied_filters['filter_bandsetting'] = $bandsetting;

			$obj_products = $obj_products->with("band_setting")
			->whereHas("band_setting", function($qbandsetting) use ($bandsetting){
				$qbandsetting->whereIn('slug', $bandsetting);
			});
		}

		// for delivery_days filter
		if(isset($form_data['delivery_days']) && !empty($form_data['delivery_days']))
		{
			$delivery_days = explode(',', $form_data['delivery_days']);
			$applied_filters['filter_delivery_days'] = $delivery_days;

			$obj_products = $obj_products->whereIn("delivery_date", $delivery_days);
		}

		// for max and min price filter
		if(isset($form_data['max_price']) && $form_data['min_price'] != null)
		{
			$max_price = $form_data['max_price'];
			$applied_filters['filter_max_price'] = $max_price;

			$min_price = $form_data['min_price'];
			$applied_filters['filter_min_price'] = $min_price;

			$obj_products = $obj_products->whereBetween('product_price', [$min_price, $max_price]);
		}

		// for max and min weight filter
		if(isset($form_data['max_weight']) && $form_data['min_weight'] != null)
		{
			$max_weight = $form_data['max_weight'];
			$applied_filters['filter_max_weight'] = $max_weight;

			$min_weight = $form_data['min_weight'];
			$applied_filters['filter_min_weight'] = $min_weight;

			$obj_products = $obj_products->whereBetween('metal_weight', [$min_weight, $max_weight]);
		}

		// for products sorting by price
		if(isset($form_data['sort_by']) && !empty($form_data['sort_by']))
		{
			$sort_by = $form_data['sort_by'];
			$applied_filters['filter_sort_by'] = $sort_by;

			if($sort_by == 'low_to_high')
			{
				$obj_products = $obj_products->orderBy("product_price",'ASC');
			}
			if($sort_by == 'high_to_low')
			{
				$obj_products = $obj_products->orderBy("product_price",'DESC');
			}
		}

		$data['applied_filters'] = $applied_filters;
		$data['obj_products']    = $obj_products;

		return $data;
    } // end apply_filters

}
