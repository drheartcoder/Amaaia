<?php 
namespace App\Common\Services;
use App\Models\ShoppingCartModel;
use App\Models\CartProductModel;
use App\Models\UserGiftCardModel;
use App\Models\CartGiftCardModel;

class CartService
{
	public function __construct(ShoppingCartModel $shopping_cart_model, CartProductModel $cart_product_model)
	{
		$this->ShoppingCartModel = $shopping_cart_model;
		$this->CartProductModel  = $cart_product_model;
	}

	function store($arr_data)
	{
		$dose_cart_exist = $this->ShoppingCartModel->where('user_id',$arr_data['user_id'])->first();

		if($dose_cart_exist)
		{
			$cart_id = $dose_cart_exist['id'];	
		}
		else
		{
			$cart = $this->ShoppingCartModel->create(['user_id'=>$arr_data['user_id']]);
			$cart_id = $cart['id'];	
		}
		$dose_product_exist = $this->CartProductModel
		->where([
			'cart_id'             => $cart_id,
			// 'user_id'             => $arr_data['user_id'],
			'product_id'          => $arr_data['product_id'],
			'product_size_id'     => $arr_data['product_size_id'],
			'product_metal_id'    => $arr_data['product_metal'],
			'product_gemstone_id' => $arr_data['product_gemstone']
			])->first();

		if($dose_product_exist)
		{
			$status = $this->CartProductModel->where('id', $dose_product_exist->id)->increment('product_quantity', $arr_data['quantity']);
			$update_status = $this->CartProductModel->where('id', $dose_product_exist->id)->update([
				'product_insurance_id' => isset($arr_data['insurance_id'])? $arr_data['insurance_id']:null,
				'name_on_product'      => $arr_data['name_on_product']
				]);
			if($status)
			{
				$cart_count = $this->CartProductModel->where(['cart_id' => $cart_id])->count();
				return $cart_count;
			}
			return false;

		}
		else
		{
			$status = $this->CartProductModel->create([
				'cart_id'              => $cart_id,
				'user_id'              => $arr_data['user_id'],
				'product_id'           => $arr_data['product_id'],
				'product_size_id'      => $arr_data['product_size_id'],
				'product_metal_id'     => $arr_data['product_metal'],
				'product_gemstone_id'  => $arr_data['product_gemstone'],
				'product_insurance_id' => isset($arr_data['insurance_id'])? $arr_data['insurance_id']:null,
				'product_quantity'     => $arr_data['quantity'],
				'name_on_product'      => $arr_data['name_on_product']
				]);
			
			if($status)
			{
				$cart_count = $this->CartProductModel->where(['cart_id' => $cart_id])->count();
				return $cart_count;
			}
			return false;
		}
		return false;
	}

	public function store_gift_card($arr_data=null)
	{

		$arr_gift_card = [];
		$arr_user_cart = [];

		if($arr_data!=null)
		{
			$obj_gift_card = UserGiftCardModel::where(['user_to_email'=>$arr_data['email'], 'gift_card_code'=>$arr_data['code'], 'is_used' => '0'])->first();
			
			if($obj_gift_card)
			{
				$arr_gift_card = $obj_gift_card->toArray();
				$obj_user_cart = $this->ShoppingCartModel->where('user_id', $arr_data['user_id'])->first();
				
				if($obj_user_cart)
				{
					$arr_user_cart = $obj_user_cart->toArray();
					$cart_total = get_cart_subtotal();

					if($cart_total > $arr_gift_card['amount'])
					{
						$cart_gift_card['cart_id']           = $arr_user_cart['id'];
						$cart_gift_card['user_id']           = $arr_data['user_id'];
						$cart_gift_card['user_gift_card_id'] = $arr_gift_card['id'];
						$cart_gift_card['gift_card_code']    = $arr_data['code'];
						$cart_gift_card['amount']            = $arr_gift_card['amount'];

						$obj_applied_gift_card = CartGiftCardModel::where(['user_id'=>$arr_user_cart['id'],'cart_id'=>$arr_user_cart['id']])->first();
						
						if($obj_applied_gift_card)
						{
							$arr_applied_gift_card = $obj_applied_gift_card->toArray();

							$remove_card = UserGiftCardModel::where(['id'=>$arr_applied_gift_card['user_gift_card_id']])->update(['is_used'=>'0']);

							$obj_store_gift_card = CartGiftCardModel::where(['id'=>$arr_applied_gift_card['id']])->update($cart_gift_card);

							$update_card = UserGiftCardModel::where(['id'=>$cart_gift_card['user_gift_card_id']])->update(['is_used'=>'1']);

							if($obj_store_gift_card)
							{
								$arr_return_data['status'] = 'success';
								$arr_return_data['message'] = 'Gift card applied successfully.';
								return $arr_return_data;
							}
							$arr_return_data['status'] = 'error';
							$arr_return_data['message'] = 'Something went wrong, Please try again.';
							return $arr_return_data;

						}
						else
						{
							$obj_store_gift_card = CartGiftCardModel::create($cart_gift_card);

							if($obj_store_gift_card)
							{
								$update_card = UserGiftCardModel::where(['id'=>$cart_gift_card['user_gift_card_id']])->update(['is_used'=>'1']);

								$arr_return_data['status'] = 'success';
								$arr_return_data['message'] = 'Gift card applied successfully.';
								return $arr_return_data;
							}
							$arr_return_data['status'] = 'error';
							$arr_return_data['message'] = 'Something went wrong, Please try again.';
							return $arr_return_data;
						}
						$arr_return_data['status'] = 'error';
						$arr_return_data['message'] = 'Something went wrong, Please try again.';
						return $arr_return_data;

					}
					$arr_return_data['status'] = 'error';
					$arr_return_data['message'] = 'Please add more items to apply this giftcard.';
					return $arr_return_data;
				}
				$arr_return_data['status'] = 'error';
				$arr_return_data['message'] = 'Something went wrong, Please try again.';
				return $arr_return_data;
			}
			$arr_return_data['status'] = 'error';
			$arr_return_data['message'] = 'Giftcard already used, please use another giftcard.';
			return $arr_return_data;
		}
		$arr_return_data['status'] = 'error';
		$arr_return_data['message'] = 'Something went wrong, Please try again.';
		return $arr_return_data;
	}

	public function empty_cart($user_id=null)
	{
		$status = false;
		if($user_id!=null)
		{
			$obj_cart = $this->ShoppingCartModel->where('user_id',$user_id)->first();
			
			if($obj_cart)
			{
				$cart_gift_card_status = CartGiftCardModel::where('cart_id',$obj_cart->id)->delete();
				$cart_product_status   = $this->CartProductModel->where('cart_id',$obj_cart->id)->delete();
				$status                = $this->ShoppingCartModel->where('user_id',$user_id)->delete();
			}
		}
		return $status;
	}
}
