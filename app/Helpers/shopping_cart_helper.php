<?php 
use App\Models\ShoppingCartModel;
use App\Models\CartProductModel;
use App\Models\CartGiftCardModel;
use App\Models\ProductsModel;

function get_cart_count()
{
	$count = '0';
	$auth = auth()->guard('user')->user();
	
	if($auth)
	{
		$obj_cart = ShoppingCartModel::where('user_id',$auth->id)->select('id')->first();
		if($obj_cart)
		{
			$count = CartProductModel::where('cart_id',$obj_cart->id)->count();
		}
		else
		{
			$count = 0;		
		}
	}
	return $count;
}

function get_cart_subtotal()
{
	$count = '0';
	$auth = auth()->guard('user')->user();
	
	if($auth)
	{
		$obj_cart = ShoppingCartModel::where('user_id',$auth->id)->select('id')->first();
		$obj_product = CartProductModel::with(['product_details'=>function($q)
		{
			$q->select(['id', 'final_price']);
		}])->where('cart_id',$obj_cart->id)->get(['id', 'product_quantity','product_id']);
		
		if($obj_product)
		{
			$arr_products = $obj_product->toArray();
			foreach ($arr_products as $key => $product) 
			{
				$count += $product['product_quantity']*$product['product_details']['final_price'];
			}
		}
		return $count;

	}
	return $count;
}


function get_cart_total()
{
	$count = '0';
	$discount = 0;
	$auth = auth()->guard('user')->user();
	
	if($auth)
	{
		$obj_cart = ShoppingCartModel::where('user_id',$auth->id)->select('id')->first();
		$obj_product = CartProductModel::with(['product_details'=>function($q)
		{
			$q->select(['id', 'final_price']);
		}])->where('cart_id',$obj_cart->id)->get(['id', 'product_quantity','product_id']);

		$obj_cart_gift_card = CartGiftCardModel::where('cart_id',$obj_cart->id)->select(['amount'])->first();

		if($obj_cart_gift_card)
		{
			$discount = $obj_cart_gift_card->amount;
		}
		if($obj_product)
		{
			$arr_products = $obj_product->toArray();
			foreach ($arr_products as $key => $product) 
			{
				$count += $product['product_quantity']*$product['product_details']['final_price'];
			}
			$count = $count-$discount;
		}
		return $count;

	}
	return $count;
}

function get_cart_giftcard_discount()
{
	$discount = 0;
	$auth = auth()->guard('user')->user();
	
	if($auth)
	{
		$obj_cart = ShoppingCartModel::where('user_id',$auth->id)->select('id')->first();
		$obj_cart_gift_card = CartGiftCardModel::where('cart_id',$obj_cart->id)->select(['amount'])->first();

		if($obj_cart_gift_card)
		{
			$discount = $obj_cart_gift_card->amount;
		}
		return $discount;
	}
	return $discount;
}

function get_cart_discount_code()
{
	$code = '';
	$auth = auth()->guard('user')->user();
	
	if($auth)
	{
		$obj_cart = ShoppingCartModel::where('user_id',$auth->id)->select('id')->first();
		$obj_cart_gift_card = CartGiftCardModel::where('cart_id',$obj_cart->id)->select(['gift_card_code'])->first();

		if($obj_cart_gift_card)
		{
			$code = $obj_cart_gift_card->gift_card_code;
		}
		return $code;
	}
	return $code;
}

function get_cart_total_discount()
{
	$discount = 0;
	$count    = 0;
	$auth     = auth()->guard('user')->user();
	
	if($auth)
	{
		$obj_cart    = ShoppingCartModel::where('user_id',$auth->id)->select('id')->first();
		$obj_product_id = CartProductModel::where('cart_id',$obj_cart->id)->get(['product_id']);

		if($obj_product_id)
		{
			$arr_product_id = $obj_product_id->pluck('product_id')->toArray();
			if($arr_product_id)
			{
				$obj_product    = ProductsModel::whereIn('id', $arr_product_id)->
				select(DB::raw('sum(base_price - final_price) AS discount'))->first();
				
				if($obj_product)
				{
					return $obj_product->discount;
				}
				
				return $count;
			}
			return $count;
		}
		return $count;
	}
	return $count;
}

function get_cart_total_insurance()
{
	$insurance   = 0;
	$arr_product = [];
	$auth        = auth()->guard('user')->user();
	
	if($auth)
	{
		$obj_cart    = ShoppingCartModel::where('user_id',$auth->id)->select('id')->first();
		$obj_product = CartProductModel::where('cart_id',$obj_cart->id)->with(['insurance_details'=>function($q)
		{
			$q->select('id','price');
		},'product_details'=>function($q)
		{
			$q->select(['final_price','id']);
		}])->get(['product_insurance_id', 'product_quantity','product_id']);
		
		if($obj_product)
		{
			$arr_product = $obj_product->toArray();
			
			if($arr_product)
			{
				foreach ($arr_product as $key => $product) 
				{
					if($product['insurance_details']!=null)
					{
						$insurance += (($product['insurance_details']['price']/100)*$product['product_details']['final_price'])*$product['product_quantity'];

					}
				}
				return $insurance;
			}
			return $insurance;
		}
		return $insurance;
	}
	return $insurance;
}

?>