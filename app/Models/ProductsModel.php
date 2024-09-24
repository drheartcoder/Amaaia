<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsModel extends Model
{
    protected $table = 'products';
    protected $fillable = [
                            'uid',
                            'added_by_user_type',
                            'added_by_user_id',
    						'category_id',
                            'subcategory_id',
    						'product_line_id',
    						'setting_id',
    						'shank_type_id',
    						'band_setting_id',
    						'ring_shoulder_id',
    						'product_metal_detailing_id',
                            'product_brand_id',
                            'look_id',
    						'product_name',
    						'metal_weight',
    						'product_height',
    						'product_width',
                            'product_length',
    						'quantity',
                            'product_price',
                            'discount',
                            'discount_price',
                            'additional_markup',
    						'product_code',
    						'keywords',
                            'product_description',
                            'product_specification',
    						'video_url',
    						'product_type',
    						'type',
    						'admin_approval',
    						'status',
                            'allow_product_home_trial',
    						'slug',
    						'delivery_date',
                            'base_price',
                            'final_price',
                            'admin_price'
    					  ];

    public function category()
    {
        return $this->belongsTo('App\Models\CategoryModel','category_id','id');
    }

    public function sub_category()
    {
        return $this->belongsTo('App\Models\SubCategoryModel','subcategory_id','id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\BrandModel','product_brand_id','id');
    }

    public function product_metals()
    {
        return $this->hasMany('App\Models\ProductMetalsModel','product_id','id');
    }

    public function metal_detailing()
    {
        return $this->belongsTo('App\Models\MetalDetailingModel','product_metal_detailing_id','id');
    }

    public function setting()
    {
        return $this->belongsTo('App\Models\SettingModel','setting_id','id');
    }

    public function product_occasions()
    {
        return $this->hasMany('App\Models\ProductOccasionsModel','product_id','id');
    }

    public function shank_type()
    {
        return $this->belongsTo('App\Models\ShankTypeModel','shank_type_id','id');
    }
    public function band_setting()
    {
        return $this->belongsTo('App\Models\BandSettingModel','band_setting_id','id');
    }

    public function ring_shoulder()
    {
        return $this->belongsTo('App\Models\RingShoulderModel','ring_shoulder_id','id');
    }

    public function product_images()
    {
         return $this->hasMany('App\Models\ProductImagesModel','product_id','id');   
    }

    public function product_collections()
    {
        return $this->hasMany('App\Models\ProductCollectionsModel','product_id','id');
    }

    public function product_line()
    {
        return $this->belongsTo('App\Models\ProductLinesModel','product_line_id','id');
    }

    public function look()
    {
        return $this->belongsTo('App\Models\LookModel','look_id','id');
    }

    public function product_gemstones()
    {
        return $this->hasMany('App\Models\ProductGemStoneModel','product_id','id');
    }

    public function product_size()
    {
        return $this->hasMany('App\Models\ProductSizesModel','product_id','id');
    }

    public function supplier_details()
    {
        return $this->belongsTo('App\Models\SupplierModel','added_by_user_id','id');
    }

    public function review_and_rating()
    {
        return $this->belongsTo('App\Models\ReviewAndRatingModel','id','product_id');   
    }

    public function reviews_and_ratings()
    {
        return $this->hasMany('App\Models\ReviewAndRatingModel','product_id','id');   
    }

}
