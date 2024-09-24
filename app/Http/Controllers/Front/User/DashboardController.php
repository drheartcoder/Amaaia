<?php

namespace App\Http\Controllers\Front\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\UserModel;
use App\Models\NotificationsModel;
use App\Models\WishListModel;
use App\Models\UserGiftCardModel;
use App\Models\TransactionModel;

use Auth;
use Session;

class DashboardController extends Controller
{	
	public function __construct(
    UserModel          $user_model,
    NotificationsModel $notification_model,
    WishListModel      $wishlist_tmodel,
    UserGiftCardModel  $usergiftcard_model,
    TransactionModel   $transaction_model
    )
	{
    $this->arr_view_data      = [];
    $this->module_title       = 'Dashboard';
    $this->module_view_folder = "front.user.";
    $this->module_url_path    = url('/').'/translator';

    $this->UserModel          = $user_model;
    $this->NotificationsModel = $notification_model;

    $this->BaseModel          = $wishlist_tmodel;
    $this->WishListModel      = $wishlist_tmodel;
    $this->UserGiftCardModel  = $usergiftcard_model;
    $this->TransactionModel   = $transaction_model;
    
  }

  /*
  | Author    : Deepak Bari
  | Function  : Dashboard page.
  */

  public function index()
  {
    $arr_trasactions = [];
    $currency        = 'INR';
    $user_id         = login_user_id('user');

    if(Session::has('get_currency'))
    {
      $currency = Session::get('get_currency');
    }

    $obj_trasactions = $this->TransactionModel
                                ->where('user_id', $user_id)->where('payment_status','!=','0')->where('trans_type','1')
                                ->select(['transaction_id', 'tracking_id','order_id','amount','trans_type','payment_status','transaction_usd_value','updated_at'])
                                ->limit(5)->orderBy('transaction_id', 'DESC')
                                ->get();

    if($obj_trasactions)
    {
      $arr_trasactions = $obj_trasactions->toArray();
      // dd($arr_trasactions);
    }

    $notifications_count = $wishlist_product_count = $received_gift_card_count = '';

    // Get count of new notifications.
    $notifications_count    = $this->notifications_count();

    // Get count of wishlist products.
    $wishlist_product_count   = $this->wishlist_product_count();

    // Get count of received gift cards.
    $received_gift_card_count = $this->received_gift_card_count();
    
    $this->arr_view_data['currency']                 = $currency;
    $this->arr_view_data['notifications_count']      = $notifications_count;
    $this->arr_view_data['arr_trasactions']          = $arr_trasactions;
    $this->arr_view_data['wishlist_product_count']   = $wishlist_product_count;
    $this->arr_view_data['received_gift_card_count'] = $received_gift_card_count;

    $this->arr_view_data['page_title']               = $this->module_title;
    $this->arr_view_data['parent_module_title']      = "Home";
    $this->arr_view_data['parent_module_url']        = url('/').'/user/dashboard';
    $this->arr_view_data['module_title']             = $this->module_title;
    $this->arr_view_data['module_url_path']          = $this->module_url_path;

    return view($this->module_view_folder.'.dashboard')->with($this->arr_view_data);
  }

  /*
  | Author    : Deepak Bari
  | Function  : Get notification count.
  */
  public function notifications_count()
  {
    $notifications_count = '';
    $login_user_id = login_user_id('user');

    $notifications_count = $this->NotificationsModel->where([
      'receiver_user_type' => '2',
      'receiver_user_id'   => $login_user_id,
      'is_read'            => '0'
      ])
    ->count();

    return $notifications_count;                                                                
  }

  /*
  | Author    : Deepak Bari
  | Function  : Get wishlist products count.
  */

  public function wishlist_product_count()
  {
    $wishlist_product_count = '';
    $login_user_id = login_user_id('user');

    $wishlist_product_count = $this->WishListModel->where([
      'product_type' => '1',
      'user_id'   => $login_user_id
      ])
    ->count();

    return $wishlist_product_count;                                                          
  }

  /*
  | Author    : Deepak Bari
  | Function  : Get count of received gift cards.
  */

  public function received_gift_card_count()
  {
    $received_gift_card_count = $user_email = '';

    $user_email = login_user_email('user');

    $received_gift_card_count = $this->UserGiftCardModel->where('user_to_email', $user_email)->count();

    return $received_gift_card_count;                                                          
  }

}
