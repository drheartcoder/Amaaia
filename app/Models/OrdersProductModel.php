<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdersProductModel extends Model
{
    protected $table = 'order_product';

    protected $fillable = [
    'user_id',
    'order_id',
    'product_id',
    'product_uid',
    'item_number',
    'product_supplier_id',
    'product_category_id',
    'product_subcategory_id',
    'product_line_id',
    'product_setting_id',
    'product_ring_shoulder_id',
    'product_metal_detailing_id',
    'product_brand_id',
    'product_band_setting_id',
    'product_shank_type_id',
    'product_shank_type_name',
    'product_band_setting_name',
    'product_brand_name',
    'product_look_id',
    'product_metal_id',
    'product_gemstone_id',
    'product_insurance_id',
    'product_name',
    'product_category_name',
    'product_subcategory_name',
    'product_line_name',
    'product_setting_name',
    'product_ring_shoulder_name',
    'product_metal_detailing_name',
    'product_look_name',
    'product_metal_weight',
    'product_height',
    'product_width',
    'product_length',
    'product_quantity',
    'product_code',
    'product_type',
    'product_delivery_date',
    'allow_product_home_trial',
    'name_on_product',
    'product_insurance_company',
    'product_discount',
    'product_additional_markup',
    'product_supplier_markup',
    'product_transaction_charges',
    'product_market_orientation',
    'product_gst',
    'product_insurance',
    'discount_on_product',
    'additional_markup_on_product',
    'supplier_markup_on_product',
    'transaction_charges_on_product',
    'market_orientation_on_product',
    'gst_on_product',
    'insurance_on_product',
    'product_price',
    'product_final_price',
    'product_metal_type',
    'product_metal_color',
    'product_metal_quality',
    'product_gemstone_type',
    'product_gemstone_color',
    'product_gemstone_quality',
    'product_gemstone_shape',
    'product_base_price'
    ];


    public function order()
    {
    	return $this->belongsTo('App\Models\OrdersModel','order_id','order_id');
    } 

    public function product_details()
    {
    	return $this->belongsTo('App\Models\ProductsModel','product_id','id');
    }                     

    public function supplier_details()
    {
        return $this->belongsTo('App\Models\SupplierModel','product_supplier_id','id');
    }

    public function return_request()
    { 
        return $this->belongsTo('App\Models\ReturnProductRequestModel','id','order_product_id');
    }

    public function replacement_request()
    { 
        return $this->belongsTo('App\Models\ReplacementProductRequestModel','id','order_product_id');
    }

    public function user_bank_details()
    {
        return $this->belongsTo('App\Models\BankDetailsModel','user_id','user_id');   
    }
}


