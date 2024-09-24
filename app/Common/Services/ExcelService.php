<?php 
namespace App\Common\Services;

use App\Models\ProductLinesModel;
use App\Models\SubCategoryModel;
use App\Models\ShankTypeModel;
use App\Models\CategoryModel;
use App\Models\SettingModel;
use App\Models\BandSettingModel;
use App\Models\RingShoulderModel;
use App\Models\MetalDetailingModel;
use App\Models\BrandModel;
use App\Models\LookModel;
use App\Models\ProductsModel;
use App\Models\OccasionsModel;
use App\Models\CollectionModel;
use App\Models\MetalsModel;
use App\Models\MetalColorModel;
use App\Models\MetalQualityModel;
use App\Models\GemStoneModel;
use App\Models\GemstoneColorModel;
use App\Models\GemstoneQualitiesModel;
use App\Models\GemstoneShapesModel;

use App\Models\ProductImagesModel;
use App\Models\ProductOccasionsModel;
use App\Models\ProductCollectionsModel;
use App\Models\ProductMetalsModel;
use App\Models\ProductGemStoneModel;
use App\Models\ProductSizesModel;


class ExcelService
{
	public function __construct(
		LookModel              $look_model,
		BrandModel             $brand_model,
		SettingModel           $setting_model,
		ProductsModel          $products_model,
		CategoryModel          $category_model,
		ShankTypeModel         $shank_type_model,
		SubCategoryModel       $subcategory_model,
		BandSettingModel       $band_setting_model,
		ProductLinesModel      $product_lines_model,
		RingShoulderModel      $ring_shoulder_model,
		MetalDetailingModel    $metal_detailing_model,
		OccasionsModel         $occasions_model,
		CollectionModel        $collection_model,
		MetalsModel            $metals_model,
		MetalColorModel        $metal_color_model,
		MetalQualityModel      $metal_quality_model,
		GemStoneModel          $gemstone_model,
		GemstoneColorModel     $gemstone_color_model,
		GemstoneQualitiesModel $gemstone_qualities_model,
		GemstoneShapesModel    $gemstone_shapes_model,

		ProductImagesModel      $product_images_model,
		ProductOccasionsModel   $product_occasions_model,
		ProductCollectionsModel $product_collections_model,
		ProductMetalsModel      $product_metals_model,
		ProductGemStoneModel    $product_gemstone_model,
		ProductSizesModel       $product_sizes_model
		)
	{
		$this->arr_view_data          = [];
		$this->LookModel              = $look_model;
		$this->BrandModel             = $brand_model;
		$this->SettingModel           = $setting_model;
		$this->CategoryModel          = $category_model;	
		$this->ProductsModel          = $products_model;
		$this->OccasionsModel         = $occasions_model;
		$this->ShankTypeModel         = $shank_type_model;
		$this->SubCategoryModel       = $subcategory_model;
		$this->BandSettingModel       = $band_setting_model;
		$this->ProductLinesModel      = $product_lines_model;
		$this->RingShoulderModel      = $ring_shoulder_model;
		$this->MetalDetailingModel    = $metal_detailing_model;
		$this->CollectionModel        = $collection_model;
		$this->MetalsModel            = $metals_model;
		$this->MetalColorModel        = $metal_color_model;
		$this->MetalQualityModel      = $metal_quality_model;
		$this->GemStoneModel          = $gemstone_model;
		$this->GemstoneColorModel     = $gemstone_color_model;
		$this->GemstoneQualitiesModel = $gemstone_qualities_model;
		$this->GemstoneShapesModel    = $gemstone_shapes_model;

		$this->ProductImagesModel      = $product_images_model;
		$this->ProductOccasionsModel   = $product_occasions_model;
		$this->ProductCollectionsModel = $product_collections_model;
		$this->ProductMetalsModel      = $product_metals_model;
		$this->ProductGemStoneModel    = $product_gemstone_model;
		$this->ProductSizesModel       = $product_sizes_model;
	}

	public function get_category_details($category_name=null, $product_type=null)
	{
		$arr_category = [];
		$arr_data     = [];
		$status       = FALSE;

		if($category_name!=null && $product_type!=null)
		{
			$category_name = trim($category_name);
			$category_name = strtolower($category_name);
			$obj_category  = $this->CategoryModel->where(['category_name'=> $category_name, 'product_type'=>$product_type])->select(['id','category_name'])->first();

			if($obj_category)
			{
				$arr_category              = $obj_category->toArray();

				$arr_data['status']        = TRUE;
				$arr_data['category_name'] = $arr_category['category_name'];
				$arr_data['category_id']   = $arr_category['id'];
				return $arr_data;
			}

			$arr_data['status'] = $status;
			$arr_data['msg']    = 'Invalid category name';
			return $arr_data;

		}
		$arr_data['status'] = $status;
		$arr_data['msg']    = 'Please enter category name';
		return $arr_data;
	}

	public function get_subcategory_details($subcategory_name=null, $category_id=null, $product_type=null)
	{
		$arr_data        = [];
		$arr_subcategory = [];
		$status          = FALSE;

		if($subcategory_name!=null && $category_id!=null && $product_type!=null)
		{
			$subcategory_name = trim($subcategory_name);
			$subcategory_name = strtolower($subcategory_name);
			$obj_subcategory  = $this->SubCategoryModel->select(['id', 'category_id', 'subcategory_name'])->where(['subcategory_name'=>$subcategory_name, 'category_id'=>$category_id, 'product_type'=>$product_type])->first();

			if($obj_subcategory)
			{
				$arr_subcategory = $obj_subcategory->toArray();
				$arr_data['status']        = TRUE;
				$arr_data['subcategory_id']   = $arr_subcategory['id'];
				$arr_data['category_id']      = $arr_subcategory['category_id'];
				$arr_data['subcategory_name'] = $arr_subcategory['subcategory_name'];
				return $arr_data;
			}
			$arr_data['status'] = $status;
			$arr_data['msg']    = 'Invalid subcategory name';
			return $arr_data;

		}

		$arr_data['status'] = $status;
		$arr_data['msg']    = 'Please enter subcategory name';
		return $arr_data;
	}

	public function get_product_line_details($product_line=null, $subcategory_id=null)
	{
		$status           = FALSE;
		$arr_product_line = [];
		$arr_data = [];
		if($product_line!=null && $subcategory_id!=null)
		{
			$product_line     = trim($product_line);
			$product_line     = strtolower($product_line);

			$obj_product_line = $this->ProductLinesModel->select(['id', 'product_line_name'])->where(['sub_category_id'=>$subcategory_id, 'product_line_name'=>$product_line])->first();

			if($obj_product_line)
			{
				$arr_product_line = $obj_product_line->toArray();

				$arr_data['status']            = TRUE;
				$arr_data['product_line_id']   = $arr_product_line['id'];
				$arr_data['product_line_name'] = $arr_product_line['product_line_name'];
				return $arr_data;
			}

			$arr_data['status'] = $status;
			$arr_data['msg']    = 'Invalid product line name';
			return $arr_data;
		}

		$arr_data['status'] = $status;
		$arr_data['msg']    = 'Please enter product line';
		return $arr_data;
	}

	public function get_product_setting_details($product_setting=null)
	{
		$status = TRUE;
		$arr_data = [];
		if($product_setting!=null)
		{
			$product_setting = trim($product_setting);
			$product_setting = strtolower($product_setting);
			$obj_setting     = $this->SettingModel->select(['id', 'setting'])->where('setting', $product_setting)->first();

			if($obj_setting)
			{
				$arr_setting = $obj_setting->toArray();

				$arr_data['status']       = TRUE;
				$arr_data['setting_id']   = $arr_setting['id'];
				$arr_data['setting_name'] = $arr_setting['setting'];
				return $arr_data;
			}

			$arr_data['status'] = $status;
			$arr_data['msg']    = 'Invalid product setting';
			return $arr_data;
		}

		$arr_data['status'] = $status;
		$arr_data['msg']    = 'Please enter product setting';
		return $arr_data;
	}

	public function get_shank_type_details($shank_type = null, $subcategory_id=null)
	{
		$status         = TRUE;
		$arr_shank_type = [];
		$arr_data = [];
		if($shank_type!=null && $subcategory_id!=null)
		{
			$count = $this->SubCategoryModel->where('id', $subcategory_id)->where('subcategory_name', 'like', '%ring%')->count();

			if($count>0)
			{
				$shank_type = trim($shank_type);
				$shank_type = strtolower($shank_type);

				$obj_shank_type = $this->ShankTypeModel->where('shank_type',$shank_type)->select(['id', 'shank_type'])->first();

				if($obj_shank_type)
				{
					$arr_shank_type = $obj_shank_type->toArray();

					$arr_data['status']          = TRUE;
					$arr_data['shank_type_id']   = $arr_shank_type['id'];
					$arr_data['shank_type_name'] = $arr_shank_type['shank_type'];
					return $arr_data;
				}

				$arr_data['status'] = FALSE;
				$arr_data['msg']    = 'Invalid shank type';
				return $arr_data;
			}

			$arr_data['status'] = $status;
			$arr_data['msg']    = 'Invalid shank type';
			return $arr_data;
		}

		$arr_data['status'] = $status;
		$arr_data['msg']    = 'Invalid shank type';
		return $arr_data;
	}

	public function get_band_setting_details($band_setting = null, $subcategory_id=null)
	{
		$status         = TRUE;
		$arr_data = [];
		if($band_setting!=null && $subcategory_id!=null)
		{
			$count = $this->SubCategoryModel->where('id', $subcategory_id)->where('subcategory_name', 'like', '%ring%')->count();

			if($count>0)
			{
				$band_setting = trim($band_setting);
				$band_setting = strtolower($band_setting);

				$obj_band_setting = $this->BandSettingModel->where('band_setting',$band_setting)->select(['id', 'band_setting'])->first();

				if($obj_band_setting)
				{
					$arr_band_setting = $obj_band_setting->toArray();

					$arr_data['status']            = TRUE;
					$arr_data['band_setting_id']   = $arr_band_setting['id'];
					$arr_data['band_setting_name'] = $arr_band_setting['band_setting'];
					return $arr_data;
				}

				$arr_data['status'] = FALSE;
				$arr_data['msg']    = 'Invalid band setting';
				return $arr_data;
			}

			$arr_data['status'] = $status;
			$arr_data['msg']    = 'Invalid band setting';
			return $arr_data;
		}

		$arr_data['status'] = $status;
		$arr_data['msg']    = 'Invalid band setting';
		return $arr_data;
	}

	public function get_ring_shoulder_type_details($ring_shoulder_type=null, $subcategory_id=null)
	{
		$arr_data = [];
		$status         = TRUE;

		if($ring_shoulder_type!=null && $subcategory_id!=null)
		{
			$count = $this->SubCategoryModel->where('id', $subcategory_id)->where('subcategory_name', 'like', '%ring%')->count();

			if($count>0)
			{
				$ring_shoulder_type = trim($ring_shoulder_type);
				$ring_shoulder_type = strtolower($ring_shoulder_type);

				$obj_ring_shoulder_type = $this->RingShoulderModel->where('ring_shoulder_type',$ring_shoulder_type)->select(['id', 'ring_shoulder_type'])->first();

				if($obj_ring_shoulder_type)
				{
					$arr_ring_shoulder_type = $obj_ring_shoulder_type->toArray();

					$arr_data['status']            = TRUE;
					$arr_data['ring_shoulder_type_id']   = $arr_ring_shoulder_type['id'];
					$arr_data['ring_shoulder_type_name'] = $arr_ring_shoulder_type['ring_shoulder_type'];
					return $arr_data;
				}

				$arr_data['status'] = FALSE;
				$arr_data['msg']    = 'Invalid ring shoulder type';
				return $arr_data;
			}

			$arr_data['status'] = $status;
			$arr_data['msg']    = 'Invalid ring shoulder type';
			return $arr_data;
		}

		$arr_data['status'] = $status;
		$arr_data['msg']    = 'Invalid ring shoulder type';
		return $arr_data;
	}

	public function get_metal_detailing_details($metal_detailing=null)
	{
		$arr_data = [];

		if($metal_detailing!=null)
		{
			$metal_detailing     = trim($metal_detailing);
			$metal_detailing     = strtolower($metal_detailing);
			$obj_metal_detailing = $this->MetalDetailingModel->where('metal_detailing_name', $metal_detailing)->select(['id', 'metal_detailing_name'])->first();
			
			if($obj_metal_detailing)
			{
				$arr_metal_detailing = $obj_metal_detailing->toArray();

				$arr_data['status']            = TRUE;
				$arr_data['metal_detailing_id']   = $arr_metal_detailing['id'];
				$arr_data['metal_detailing_name'] = $arr_metal_detailing['metal_detailing_name'];
				return $arr_data;
			}
			$arr_data['status'] = FALSE;
			$arr_data['msg']    = 'Invalid metal detailing name';
			return $arr_data;
		}

		$arr_data['status'] = TRUE;
		return $arr_data;
	}

	public function get_brand_details($brand=null)
	{
		$arr_brand = [];

		if($brand!=null)
		{
			$brand = trim($brand);
			$brand = strtolower($brand);

			$obj_brand = $this->BrandModel->select(['id', 'brand_name'])->where('brand_name',$brand)->first();

			if($obj_brand)
			{
				$arr_brand = $obj_brand->toArray();

				$arr_data['status']     = TRUE;
				$arr_data['brand_id']   = $arr_brand['id'];
				$arr_data['brand_name'] = $arr_brand['brand_name'];
				return $arr_data;
			}
			$arr_data['status'] = FALSE;
			$arr_data['msg']    = 'Invalid brand name';
			return $arr_data;

		}

		$arr_data['status'] = TRUE;
		return $arr_data;
	}

	public function get_look_details($look=null)
	{
		$arr_look = [];

		if($look!=null)
		{
			$look     = trim($look);
			$look     = strtolower($look);
			$obj_look = $this->LookModel->where('look', $look)->select(['id','look'])->first();

			if($obj_look)
			{
				$arr_look = $obj_look->toArray();				

				$arr_data['status']     = TRUE;
				$arr_data['look_id']   = $arr_look['id'];
				$arr_data['look_name'] = $arr_look['look'];
				return $arr_data;				
			}

			$arr_data['status'] = FALSE;
			$arr_data['msg']    = 'Invalid look name';
			return $arr_data;
		}

		$arr_data['status'] = FALSE;
		$arr_data['msg']    = 'Please enter look';
		return $arr_data;
	}

	public function get_product_slug($name='')
	{
		$slug  = '';
		$count = '0';

		if($name!='')
		{
			$slug = str_slug($name);
			$count = $this->ProductsModel->where('slug',$slug)->count();

			if($count=='0')
			{
				return $slug;
			}

			return $slug.'-'.$count+1;
		}
		return $slug;
	}

	public function get_occasions_detail($occations='')
	{
		$arr_occations = [];
		$arr_data = [];

		if($occations!='')
		{
			$arr_occations = explode(',', $occations);

			if(isset($arr_occations) && is_array($arr_occations) && sizeof($arr_occations)>0)
			{

				foreach ($arr_occations as $key => $occation) 
				{
					$occation = trim($occation);
					$occation = strtolower($occation);

					$obj_occasion = $this->OccasionsModel->select(['occasion_name','id'])->where('occasion_name', $occation)->first();

					if($obj_occasion)
					{
						$arr_occation = $obj_occasion->toArray();
						array_push($arr_data, $arr_occation);
					}
					else
					{
						$arr_data['status'] = FALSE;
						$arr_data['msg']    = 'Invalid occation name';
						return $arr_data;
					}
				}
				
				$arr_data['status'] = TRUE;
				return $arr_data;
			}

			$arr_data['status'] = FALSE;
			$arr_data['msg']    = 'Invalid occation name';
			return $arr_data;
		}

		$arr_data['status'] = FALSE;
		$arr_data['msg']    = 'Please enter occation name';
		return $arr_data;
	}

	public function get_collections_detail($collections='')
	{
		$arr_collections = [];
		$arr_data = [];

		if($collections!='')
		{
			$arr_collections = explode(',', $collections);

			if(isset($arr_collections) && is_array($arr_collections) && sizeof($arr_collections)>0)
			{

				foreach ($arr_collections as $key => $collection) 
				{
					$collection = trim($collection);
					$collection = strtolower($collection);

					$obj_collection = $this->CollectionModel->select(['name','id'])->where('name', $collection)->first();

					if($obj_collection)
					{
						$arr_collection = $obj_collection->toArray();
						array_push($arr_data, $arr_collection);
					}
					else
					{
						$arr_data['status'] = FALSE;
						$arr_data['msg']    = 'Invalid collection name';
						return $arr_data;
					}
				}
				
				$arr_data['status'] = TRUE;
				return $arr_data;
			}

			$arr_data['status'] = FALSE;
			$arr_data['msg']    = 'Invalid occation name';
			return $arr_data;
		}

		$arr_data['status'] = FALSE;
		$arr_data['msg']    = 'Please enter occation name';
		return $arr_data;
	}

	public function get_metals_detail($metal=null)
	{
		if($metal!=null)
		{
			$arr_metal = explode(',', $metal);

			if(isset($arr_metal['0']) && $arr_metal['0']!='')
			{
				$metal_name = trim($arr_metal['0']);
				$metal_name = strtolower($arr_metal['0']);

				$obj_metal = $this->MetalsModel->select('id', 'metal_name')->where('metal_name', trim($metal_name))->first();

				if($obj_metal)
				{
					$arr_metal_details = $obj_metal->toArray();
					$arr_data['metal'] = $arr_metal_details;
				}
				else
				{
					$arr_data['status'] = FALSE;
					$arr_data['msg']    = 'Invalid metal name';
					return $arr_data;
				}
			}
			else
			{
				$arr_data['status'] = FALSE;
				$arr_data['msg']    = 'Please enter metal name';
				return $arr_data;
			}

			if(isset($arr_metal['1']) && $arr_metal['1']!='')
			{
				$metal_color = trim($arr_metal['1']);
				$metal_color = strtolower($arr_metal['1']);

				$obj_color = $this->MetalColorModel->select(['id','metal_color'])->where('metal_color', trim($metal_color))->first();

				if($obj_color)
				{
					$arr_color         = $obj_color->toArray();
					$arr_data['color'] = $arr_color;
				}
				else
				{
					$arr_data['status'] = FALSE;
					$arr_data['msg']    = 'Invalid metal color';
					return $arr_data;
				}
			}
			else
			{
				$arr_data['status'] = FALSE;
				$arr_data['msg']    = 'Please enter metal color';
				return $arr_data;
			}

			if(isset($arr_metal['2']) && $arr_metal['2']!='')
			{
				$metal_quality = trim($arr_metal['2']);
				$metal_quality = strtolower($arr_metal['2']);
				
				$obj_quality = $this->MetalQualityModel->select(['id', 'quality_name'])->where('quality_name', trim($metal_quality))->first();

				if($obj_quality)
				{
					$arr_quality         = $obj_quality->toArray();
					$arr_data['quality'] = $arr_quality;
				}
				else
				{
					$arr_data['status'] = FALSE;
					$arr_data['msg']    = 'Invalid metal quality';
					return $arr_data;
				}
			}
			else
			{
				$arr_data['status'] = FALSE;
				$arr_data['msg']    = 'Please enter metal quality';
				return $arr_data;
			}
			$arr_data['status'] = TRUE;
			return $arr_data;
		}
		$arr_data['status'] = TRUE;
		return $arr_data;
	}

	public function get_gemstone_detail($gemstone='')
	{
		$arr_data = [];

		if($gemstone!='')
		{
			$arr_gemstone = explode(',', $gemstone);

			if(isset($arr_gemstone['0']) && $arr_gemstone['0']!='')
			{
				$gemstone_type = trim($arr_gemstone['0']);	
				$gemstone_type = strtolower($gemstone_type);

				$obj_gemstone = $this->GemStoneModel->select(['id', 'type'])->where('type', trim($gemstone_type))->first();

				if($obj_gemstone)
				{
					$arr_data['gemstone'] = $obj_gemstone->toArray();
				}
				else
				{
					$arr_data['status'] = FALSE;
					$arr_data['msg']    = 'Invalid gemstone type';
					return $arr_data;	
				}
			}
			else
			{
				$arr_data['status'] = FALSE;
				$arr_data['msg']    = 'Please enter gemstone type';
				return $arr_data;
			}

			if(isset($arr_gemstone['1']) && $arr_gemstone['1']!='')
			{
				$color = trim($arr_gemstone['1']);
				$color = strtolower($color);

				$obj_color = $this->GemstoneColorModel->select('id', 'gemstone_color')->where('gemstone_color',trim($color))->first();

				if($obj_color)
				{
					$arr_data['color']= $obj_color->toArray();
				}
				else
				{
					$arr_data['status'] = FALSE;
					$arr_data['msg']    = 'Invalid gemstone color';
					return $arr_data;	
				}
			}
			else
			{
				$arr_data['status'] = FALSE;
				$arr_data['msg']    = 'Please enter gemstone color';
				return $arr_data;
			}

			if(isset($arr_gemstone['2']) && $arr_gemstone['2']!='')
			{
				$quality = trim($arr_gemstone['2']);
				$quality = strtolower($quality);

				$obj_quality = $this->GemstoneQualitiesModel->where('gemstone_quality', trim($quality))->select('id', 'gemstone_quality')->first();
				
				if($obj_quality)
				{
					$arr_data['quality'] = $obj_quality->toArray();
				}
				else
				{
					$arr_data['status'] = FALSE;
					$arr_data['msg']    = 'Invalid gemstone quality';
					return $arr_data;	
				}
			}
			else
			{
				$arr_data['status'] = FALSE;
				$arr_data['msg']    = 'Please enter gemstone quality';
				return $arr_data;
			}

			if(isset($arr_gemstone['3']) && $arr_gemstone['3']!='')
			{
				$shape = trim($arr_gemstone['3']);
				$shape = strtolower($arr_gemstone['3']);

				$obj_shape = $this->GemstoneShapesModel->where('shape_name',trim($shape))->select('id','shape_name')->first();
				
				if($obj_shape)
				{
					$arr_data['shape'] = $obj_shape->toArray();
				}
				else
				{
					$arr_data['status'] = FALSE;
					$arr_data['msg']    = 'Invalid gemstone shape';
					return $arr_data;
				}
			}
			else
			{
				$arr_data['status'] = FALSE;
				$arr_data['msg']    = 'Please enter gemstone shape';
				return $arr_data;
			}

			$arr_data['status'] = TRUE;
			return $arr_data;
		}

		$arr_data['status'] = TRUE;
		return $arr_data;
	}

	public function get_images_details($images='')
	{
		$arr_images = [];
		$arr_data = [];

		if($images!='')
		{
			$arr_images = explode(',', $images);
			$image_count = count($arr_images);
			if($image_count>5)
					{
						$arr_data['status'] = FALSE;
						$arr_data['msg']    = 'Only 5 images allowed per product';
						return $arr_data;
					}

			foreach ($arr_images as $key => $image) 
			{
				$image = trim($image);
				// $image = strtolower($image);
				$ext   = pathinfo($image, PATHINFO_EXTENSION);

				if($ext=='jpg'|$ext=='jpeg'|$ext=='png')
				{
					$count = $this->ProductImagesModel->where('image', $image)->count();

					if($count>0)
					{
						$arr_data['status'] = FALSE;
						$arr_data['msg']    = 'Image already exist in system';
						return $arr_data;
					}
					else
					{
						array_push($arr_data, $image);
					}
				}
				else
				{
					$arr_data['status'] = FALSE;
					$arr_data['msg']    = 'Invalid image type';
					return $arr_data;
				}

			}
			$arr_data['status'] = TRUE;
			return $arr_data;
		}
		$arr_data['status'] = FALSE;
		$arr_data['msg']    = 'Please enter image name';
		return $arr_data;

	}
}