<?php 
namespace App\Common\Services;
use App\Models\CartGiftCardModel;
use App\Models\OrdersModel;
use App\Models\ShoppingCartModel;
use App\Models\CartProductModel;
use App\Models\OrdersProductModel;
use App\Models\OrderGiftCardModel;
use App\Models\SiteSettingModel;

class OrderService
{
	function __construct(
		OrdersModel        $orders_model,
		CartProductModel   $cart_product_model,
		SiteSettingModel   $site_setting_model,
		ShoppingCartModel  $shopping_cart_model,
		OrdersProductModel $orders_product_model,
		OrderGiftCardModel $order_gift_card_model,
		CartGiftCardModel  $cart_gift_card_model
		)
	{
		$this->OrdersModel        = $orders_model;
		$this->ShoppingCartModel  = $shopping_cart_model;
		$this->CartProductModel   = $cart_product_model;
		$this->SiteSettingModel   = $site_setting_model;
		$this->OrdersProductModel = $orders_product_model;
		$this->OrderGiftCardModel = $order_gift_card_model;
		$this->CartGiftCardModel  = $cart_gift_card_model;
	}

	public function create($arr_data = null)
	{	
	$arr_order_product = [];
		$arr_cart_product  = [];
		$arr_order_product = [];
		$status            = false;

		if($arr_data!=null)
		{
			$obj_orders = $this->OrdersModel->create($arr_data);

			if($obj_orders)
			{
				$obj_cart = $this->ShoppingCartModel->where('user_id', $arr_data['user_id'])->select('id')->first();

				if($obj_cart)
				{

					$obj_site_setting    = $this->SiteSettingModel->select(['transaction_charges','gst'])->first();
					$gst                 = $obj_site_setting->gst;
					$transaction_charges = $obj_site_setting->transaction_charges;

					$obj_cart_product = $this->CartProductModel
					->with([
						'product_details.category'=>function($q){$q->select(['id', 'category_name']);},
						'product_details.sub_category'=>function($q){$q->select(['id','subcategory_name','market_orientation_markup']);},
						'product_details.product_line'=>function($q){$q->select(['id','product_line_name']);},
						'product_details.setting'=>function($q){$q->select(['id','setting']);},
						'product_details.shank_type'=>function($q){$q->select(['id','shank_type']);},
						'product_details.band_setting'=>function($q){$q->select(['id','band_setting']);},
						'product_details.ring_shoulder'=>function($q){$q->select(['id','ring_shoulder_type']);},
						'product_details.metal_detailing'=>function($q){$q->select(['id','metal_detailing_name']);},
						'product_details.brand'=>function($q){$q->select(['id','brand_name']);},
						'product_details.look'=>function($q){$q->select(['id','look']);},	
						'product_details.supplier_details'=>function($q){$q->select(['id','admin_commission']);},	

						'insurance_details'=>function($q)
						{
							$q->select('id','price','company_name');
						}
						])->with(['product_image'=>function($q){
							$q->select('product_id','image');
						}])
						->with(['size_details'=>function($q){
							$q->select(['id','size_name']);
						}])

						->with(['product_metals.metal_name'=>function($q)
						{
							$q->select(['id', 'metal_name']);
						}
						,'product_metals.metal_color'=>function($q)
						{
							$q->select(['id', 'metal_color']);
						}
						,'product_metals.metal_quality'=>function($q)
						{
							$q->select(['id', 'quality_name']);
						}
						])

						->with(['product_gemstone.gemstone_type'=>function($q)
						{
							$q->select(['id', 'type']);
						}
						,'product_gemstone.gemstone_color'=>function($q)
						{
							$q->select(['id', 'gemstone_color']);
						}
						,'product_gemstone.gemstone_quality'=>function($q)
						{
							$q->select(['id', 'gemstone_quality']);
						},'product_gemstone.gemstone_shape'=>function($q)
						{
							$q->select(['id','shape_name']);
						}
						])

						->where('cart_id',$obj_cart->id)->get(['id','cart_id','product_id','product_size_id','product_insurance_id','product_quantity','product_metal_id', 'product_gemstone_id','name_on_product']);

						if($obj_cart_product)
						{
							$arr_cart_product = $obj_cart_product->toArray();
							foreach ($arr_cart_product as $key => $product) 
							{
								$arr_order_product['user_id']                        = isset($arr_data['user_id'])? $arr_data['user_id']:'';
								$arr_order_product['order_id']                       = isset($obj_orders->order_id)? $obj_orders->order_id:'';
								$arr_order_product['product_id']                     = isset($product['product_id'])? $product['product_id']:'';
								$arr_order_product['product_uid']                    = isset($product['product_details']['uid'])? $product['product_details']['uid']:'';
								$arr_order_product['item_number']                    = $this->create_item_number();
								$arr_order_product['product_supplier_id']            = isset($product['product_details']['added_by_user_id'])? $product['product_details']['added_by_user_id'] :'';
								$arr_order_product['product_category_id']            = isset($product['product_details']['category_id'])? $product['product_details']['category_id']:'';
								$arr_order_product['product_subcategory_id']         = isset($product['product_details']['subcategory_id'])? $product['product_details']['subcategory_id']:'';
								$arr_order_product['product_line_id']                = isset($product['product_details']['product_line_id'])? $product['product_details']['product_line_id']:'';
								$arr_order_product['product_setting_id']             = isset($product['product_details']['setting_id'])? $product['product_details']['setting_id']:'';
								$arr_order_product['product_ring_shoulder_id']       = isset($product['product_details']['ring_shoulder_id'])? $product['product_details']['ring_shoulder_id']:'';
								$arr_order_product['product_metal_detailing_id']     = isset($product['product_details']['product_metal_detailing_id'])? $product['product_details']['product_metal_detailing_id']:'';
								$arr_order_product['product_brand_id']               = isset($product['product_details']['product_brand_id'])? $product['product_details']['product_brand_id']:'';
								$arr_order_product['product_look_id']                = isset($product['product_details']['look_id'])? $product['product_details']['look_id']:'';
								$arr_order_product['product_metal_id']               = isset($product['product_metals']['id'])? $product['product_metals']['id']:'';	
								$arr_order_product['product_gemstone_id']            = isset($product['product_gemstone']['id'])? $product['product_gemstone']['id']:'';	
								$arr_order_product['product_insurance_id']           = isset($product['product_insurance_id'])? $product['product_insurance_id']:'';	
								$arr_order_product['product_name']                   = isset($product['product_details']['product_name'])? $product['product_details']['product_name']:'';	
								$arr_order_product['product_category_name']          = isset($product['product_details']['category']['category_name'])? $product['product_details']['category']['category_name']:'';
								$arr_order_product['product_subcategory_name']       = isset($product['product_details']['sub_category']['subcategory_name'])? $product['product_details']['sub_category']['subcategory_name']:'';
								$arr_order_product['product_line_name']              = isset($product['product_details']['product_line']['product_line_name'])? $product['product_details']['product_line']['product_line_name']:'';	
								$arr_order_product['product_brand_name']             = isset($product['product_details']['brand']['brand_name'])? $product['product_details']['brand']['brand_name']:'';	
								$arr_order_product['product_setting_name']           = isset($product['product_details']['setting']['setting'])? $product['product_details']['setting']['setting']:'';	
								$arr_order_product['product_ring_shoulder_name']     = isset($product['product_details']['ring_shoulder']['ring_shoulder_type'])? $product['product_details']['ring_shoulder']['ring_shoulder_type']:'';	
								$arr_order_product['product_metal_detailing_name']   = isset($product['product_details']['ring_shoulder']['ring_shoulder_type'])? $product['product_details']['ring_shoulder']['ring_shoulder_type']:'';
								$arr_order_product['product_band_setting_id']        = isset($product['product_details']['band_setting']['id'])? $product['product_details']['band_setting']['id']:'';	
								$arr_order_product['product_band_setting_name']      = isset($product['product_details']['band_setting']['band_setting'])? $product['product_details']['band_setting']['band_setting']:'';	
								$arr_order_product['product_shank_type_id']          = isset($product['product_details']['shank_type']['id'])? $product['product_details']['shank_type']['id']:'';	
								$arr_order_product['product_shank_type_name']        = isset($product['product_details']['shank_type']['shank_type'])? $product['product_details']['shank_type']['shank_type']:'';	
								$arr_order_product['product_look_name']              = isset($product['product_details']['look']['look'])? $product['product_details']['look']['look']:'';	
								$arr_order_product['product_metal_weight']           = isset($product['product_details']['metal_weight'])? $product['product_details']['metal_weight']:'0';	
								$arr_order_product['product_height']                 = isset($product['product_details']['product_height'])? $product['product_details']['product_height']:'0';	
								$arr_order_product['product_width']                  = isset($product['product_details']['product_width'])? $product['product_details']['product_width']:'0';	
								$arr_order_product['product_length']                 = isset($product['product_details']['product_length'])? $product['product_details']['product_length']:'0';	
								$arr_order_product['product_quantity']               = isset($product['product_quantity'])? $product['product_quantity']:'0';	
								$arr_order_product['product_code']                   = isset($product['product_details']['product_code'])? $product['product_details']['product_code']:'0';	
								$arr_order_product['product_type']                   = isset($product['product_details']['product_type'])?$product['product_details']['product_type']:'1';	
								$arr_order_product['product_delivery_date']          = isset($product['product_details']['delivery_date'])? $product['product_details']['delivery_date']:'';	
								$arr_order_product['allow_product_home_trial']       = isset($product['product_details']['allow_product_home_trial'])? $product['product_details']['allow_product_home_trial']:'';	
								$arr_order_product['name_on_product']                = isset($product['name_on_product'])? $product['name_on_product']:'';	
								$arr_order_product['product_insurance_company']      = isset($product['insurance_details']['company_name'])? $product['insurance_details']['company_name']:'';	
								$arr_order_product['product_discount']               = isset($product['product_details']['discount'])? $product['product_details']['discount']:'0';	
								$arr_order_product['product_additional_markup']      = isset($product['product_details']['additional_markup'])? $product['product_details']['additional_markup']:'0';
								$arr_order_product['product_supplier_markup']        = isset($product['product_details']['supplier_details']['admin_commission'])? $product['product_details']['supplier_details']['admin_commission']:'0';	
								$arr_order_product['product_transaction_charges']    = isset($transaction_charges)? $transaction_charges:'0';	
								$arr_order_product['product_market_orientation']     = isset($product['product_details']['sub_category']['market_orientation_markup'])? $product['product_details']['sub_category']['market_orientation_markup']:'0';	
								$arr_order_product['product_gst']                    = isset($gst)? $gst:'0';	
								$arr_order_product['product_insurance']              = isset($product['insurance_details']['price'])? $product['insurance_details']['price']:'0';	
								$product_price                                       = isset($product['product_details']['product_price'])? $product['product_details']['product_price']:'0';
								$arr_order_product['additional_markup_on_product']   = ($product_price*$arr_order_product['product_additional_markup']/100);	
								$arr_order_product['supplier_markup_on_product']     = ($product_price*$arr_order_product['product_supplier_markup']/100);	
								$arr_order_product['transaction_charges_on_product'] = ($product_price*$transaction_charges/100);	
								$arr_order_product['market_orientation_on_product']  = ($product_price*$arr_order_product['product_market_orientation']/100);	
								$arr_order_product['gst_on_product']                 = (($product_price +$arr_order_product['additional_markup_on_product'] +$arr_order_product['transaction_charges_on_product'] +$arr_order_product['supplier_markup_on_product']+$arr_order_product['market_orientation_on_product'])*$gst/100);
								$final_price                                         = isset($product['product_details']['final_price'])? $product['product_details']['final_price']:'0';
								$arr_order_product['discount_on_product']            = ($product['product_details']['base_price']-$final_price);	
								$arr_order_product['insurance_on_product']           = (($final_price)*$arr_order_product['product_insurance']/100);
								$arr_order_product['product_price']                  = $product_price;
								$arr_order_product['product_base_price']             = $product['product_details']['base_price'];
								$arr_order_product['product_final_price']            = $final_price;
								$arr_order_product['product_metal_type']             = isset($product['product_metals']['metal_name']['metal_name'])? $product['product_metals']['metal_name']['metal_name']:'';
								$arr_order_product['product_metal_color']            = isset($product['product_metals']['metal_color']['metal_color'])? $product['product_metals']['metal_color']['metal_color']:'';
								$arr_order_product['product_metal_quality']          = isset($product['product_metals']['metal_quality']['quality_name'])? $product['product_metals']['metal_quality']['quality_name']:'';
								$arr_order_product['product_gemstone_type']          = isset($product['product_gemstone']['gemstone_type']['type'])? $product['product_gemstone']['gemstone_type']['type']:'';
								$arr_order_product['product_gemstone_color']         = isset($product['product_gemstone']['gemstone_color']['gemstone_color'])? $product['product_gemstone']['gemstone_color']['gemstone_color']:'';
								$arr_order_product['product_gemstone_quality']       = isset($product['product_gemstone']['gemstone_quality']['gemstone_quality'])? $product['product_gemstone']['gemstone_quality']['gemstone_quality']:'';
								$arr_order_product['product_gemstone_shape']         = isset($product['product_gemstone']['gemstone_shape']['shape_name'])? $product['product_gemstone']['gemstone_shape']['shape_name']:'';

								$status = $this->OrdersProductModel->create($arr_order_product);

							}
							if($status)
							{
								$obj_cart_giftcard = $this->CartGiftCardModel->where('cart_id',$obj_cart->id)->first();

								if($obj_cart_giftcard)
								{
									$arr_order_gift_card['order_id']          = isset($obj_orders->order_id)? $obj_orders->order_id:'';
									$arr_order_gift_card['user_id']           = isset($arr_data['user_id'])? $arr_data['user_id']:$obj_cart_giftcard->user_id;
									$arr_order_gift_card['user_gift_card_id'] = isset($obj_cart_giftcard->user_gift_card_id)? $obj_cart_giftcard->user_gift_card_id:'';
									$arr_order_gift_card['gift_card_code']    = isset($obj_cart_giftcard->gift_card_code)? $obj_cart_giftcard->gift_card_code:'';
									$arr_order_gift_card['amount']            = isset($obj_cart_giftcard->amount)? $obj_cart_giftcard->amount:'0';
									$order_gift_card_status                   = $this->OrderGiftCardModel->create($arr_order_gift_card);
								}
								return $obj_orders;
							}
							return false;
						}
						return false;
					}
					return false;
				}
				return false;
			}
			return false;
		}


		public function get_order_email_details($order_id=null)
		{
			$status = false;
			$arr_order=[];

			if($order_id!=null)
			{
				$obj_order = $this->OrdersModel->where('order_id',$order_id)->select(['order_id', 'order_fname', 'order_lname', 'order_email', 'order_contact_no', 'order_flat_no', 'order_building_name', 'order_city', 'order_state', 'order_country', 'order_address', 'order_post_code', 'order_payment_method', 'order_cost','order_subtotal'])->with(['order_products'=>function($q){
					$q->select(['order_id','item_number','product_name','insurance_on_product','product_final_price','product_quantity']);
				},'order_giftcard'=>function($q){$q->select('order_id','amount','gift_card_code');},'order_wallet'=>function($q){$q->select('order_id', 'used_wallet_balance');}])->first();

				if($obj_order)
				{
				$arr_order = $obj_order->toArray();	
				}
				return $arr_order;
			}

			return $status;
		}

		public function create_item_number()
		{
			$secure      = TRUE;
			$bytes       = openssl_random_pseudo_bytes(8, $secure);
			$item_number = "AM-".bin2hex($bytes);
			$item_number = strtoupper("AM-".bin2hex($bytes));

			return $item_number;
		}
	}
