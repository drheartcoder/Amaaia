<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\GiftCardModel;
use App\Models\OrdersModel;

use App\Common\Services\MailService;
use App\Models\UserGiftCardModel;
use App\Models\AddressesModel;

use App\Common\Services\CcavenuePaymentService;
use App\Common\Services\WalletService;
use App\Common\Services\GiftCardService;
use App\Common\Services\CartService;
use App\Common\Services\OrderService;
use App\Common\Services\NotificationService;

use Indipay;
use Session;
use Validator;

class PaymentController extends Controller
{
    public function __construct(
        GiftCardModel          $GiftCardModel,
        CcavenuePaymentService $ccavenue_payment_service,
        UserGiftCardModel      $user_gift_card_model,
        MailService            $mail_service,
        OrdersModel            $orders_model,
        GiftCardService        $gift_card_service,
        WalletService          $wallet_service,
        CartService            $cart_service,
        OrderService           $order_service,
        NotificationService    $notification_service,
        AddressesModel        $addresses_model
        )
    {
        $this->arr_view_data          = [];
        $this->module_title           = "Home";
        $this->module_view_folder     = "front.payment.";
        $this->BaseModel              = $GiftCardModel;
        $this->UserGiftCardModel      = $user_gift_card_model;
        $this->AddressesModel         = $addresses_model;

        $this->CcavenuePaymentService = $ccavenue_payment_service;
        $this->MailService            = $mail_service;
        $this->OrdersModel            = $orders_model;
        $this->WalletService          = $wallet_service;
        $this->GiftCardService        = $gift_card_service;
        $this->CartService            = $cart_service;
        $this->OrderService           = $order_service;
        $this->NotificationService    = $notification_service;

        $this->gift_card_image_base_path   = base_path().config('app.project.img_path.gift_card_image');
        $this->gift_card_image_public_path = url('/').config('app.project.img_path.gift_card_image');

        $this->front_url_path         = url('/');
        $this->module_url_path        = $this->front_url_path."/gift_cards";
    }

    public function gift_card_payment(Request $request)
    {
        $arr_rules = $arr_user_data = array();

        $arr_rules['email']                 = "required|email";
        $arr_rules['confirm_email']         = "required|email";

        $arr_rules['country_code']          = "required";
        $arr_rules['mobile_no']             = "required|min:7|max:16";
        $arr_rules['confirm_mobile_no']     = "required|min:7|max:16";
        $arr_rules['amt_in_rs']             = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {       
            return redirect()->back()->withErrors($validator)->withInput();  
        }

        $login_user_id = login_user_id('user');

        Session::put('arr_gift_card',$request->all());

        $amt = isset($request->amt_in_rs) ? $request->amt_in_rs : 0;

        $obj_address = $this->AddressesModel->where(['id' => $login_user_id,'default_address' => '2'])->select('id','address','city','post_code','state','country')->first();

        if($obj_address)
        {
            $arr_user_data =$obj_address->toArray();
        }

        $arr_user_data['amount'] = $amt;
        $arr_user_data['user_id'] = $login_user_id;

        $parameters = $this->CcavenuePaymentService->gift_card_payment($arr_user_data);

        $order = Indipay::prepare($parameters);

        return Indipay::process($order);
    }

    public function AddSession(Request $request)
    {
        $sess = $request->except('_token');
// $request->session()->put('product_details', $sess);
    }

    public function get_response(Request $request)
    {
        $response = [];
        $payment_for = '';
        $user_id     = login_user_id('user');
//For default Gateway
        $response = Indipay::response($request);
// For Otherthan Default Gateway
        $response             = Indipay::gateway('CCAvenue')->response($request);
        $payment_for          = isset($response['merchant_param2']) && !empty($response['merchant_param2']) ? $response['merchant_param2'] : '';


        if(isset($response['order_status']) && $response['order_status'] == 'Success')
        {
            
               if(isset($payment_for) && $payment_for == 'gift_card')
               {
                $user_gift_card_id = $this->store_gift_card_details(); 

                $response['user_gift_card_id'] = isset($user_gift_card_id) ? $user_gift_card_id : ''; 
                $response['trans_type'] = '2'; 
                $response['user_id']    = login_user_id('user');

                $transaction_response = $this->CcavenuePaymentService->store_gift_card_transaction($response);
            }
            elseif(isset($payment_for) && $payment_for == 'product')
            {
                $response['trans_type'] = '2';
                $transaction_response = $this->CcavenuePaymentService->update_transaction($response);
            }
        }
    


    if(isset($transaction_response) && $transaction_response=='1')
    {
     if(isset($payment_for) && $payment_for == 'product')
     {
        $arr_order['order_status'] = $response['order_status'];
        $arr_order['order_id']     = $response['order_id'];

        $order_status = $this->update_order($arr_order);

        if($order_status)
        {
            $arr_wallet['user_id']      = $user_id;
            $arr_wallet['order_id']     = $response['order_id'];
            $arr_wallet['order_status'] = $response['order_status'];

            $wallet_status              = $this->WalletService->update_wallet($arr_wallet);
            $giftcard_status            = $this->GiftCardService->update_giftcard($arr_wallet);
            $email_data                 = $this->OrderService->get_order_email_details($response['order_id']);
            $send_email                 = $this->MailService->order_send_mail($email_data);

            $arr_wallet['order_mobile'] = isset($response['billing_tel'])? $response['billing_tel']:''; 
            $send_email                 = $this->NotificationService->new_order_notification($arr_wallet);
            $empty_cart                 = $this->CartService->empty_cart($user_id);
            
            return redirect(url('order/success'));
        }
    }
    else
    {
        Session::flash('success', 'Gift card sent successfully');
        return redirect($this->module_url_path);
    }

}
elseif(isset($response) && $response=='2')
{
    Session::flash('error', 'Sorry, unfortunately your payment fail.');
}
elseif(isset($response) && $response=='3')
{
    Session::flash('error', 'Sorry, unfortunately we were unable to process your card. Please try another card.');
}
elseif(isset($response) && $response=='4')
{
    Session::flash('error', 'Sorry, unfortunately invalid your transaction.');
}
elseif(isset($response) && $response=='0')
{
    Session::flash('error', 'Unknown error occurred');
}

Session::forget('arr_gift_card');

return redirect(url('payment/error'));
} 

public function store_gift_card_details()
{
    $gift_card_code = $country_code = $number = $mobile_no = '';
    $arr_gift_card  = $arr_store = [];
    $arr_gift_card  = Session::get('arr_gift_card');
    $gift_card_code = get_unique_gift_card_code();
    $phone_code     = isset($arr_gift_card['country_code']) ? base64_decode($arr_gift_card['country_code']) : 0;
    $number         = isset($arr_gift_card['mobile_no']) ? $arr_gift_card['mobile_no'] : '';
    $mobile_no      = '+'.$phone_code.''.$number;
    $gift_card_id   = isset($arr_gift_card['gift_card_id']) ? base64_decode($arr_gift_card['gift_card_id']) : 0;

    $arr_store['from_user_id']     = login_user_id('user');
    $arr_store['gift_card_id']     = isset($gift_card_id) ? $gift_card_id : 0 ;
    $arr_store['user_to_email']    = isset($arr_gift_card['email']) ? $arr_gift_card['email'] : '';
    $arr_store['user_to_phone']    = $mobile_no;

    $arr_store['gift_card_code']   = isset($gift_card_code) ? $gift_card_code : '';
    $arr_store['amount']           = isset($arr_gift_card['amt_in_rs']) ? $arr_gift_card['amt_in_rs'] : '';
    $arr_store['is_used']          = '0';

    $user_gift_card_status = $this->UserGiftCardModel->create($arr_store);

        // Send email to receiver regarding gift card.

    $sender_first_name = $sender_last_name = $sender_name = $card_name = '';

    $sender_details = login_user_details('user');

    $sender_first_name = isset($sender_details->first_name) ? $sender_details->first_name : '';
    $sender_last_name =  isset($sender_details->last_name) ? $sender_details->last_name : '';

    $sender_name = $sender_first_name.' '.$sender_last_name;

    $obj_card = $this->BaseModel->where('id',$gift_card_id)->select('title')->first();

    if($obj_card)
    {
        $card_name = isset($obj_card->title) ? $obj_card->title : '';
    }

    $arr_mail['sender_name'] = $sender_name;
    $arr_mail['to_email_id'] = isset($arr_gift_card['email']) ? $arr_gift_card['email'] : '';
    $arr_mail['card_name']   = $card_name;
    $arr_mail['amount']      = isset($arr_gift_card['amt_in_rs']) ? $arr_gift_card['amt_in_rs'] : '0';
    $arr_mail['code']        = isset($gift_card_code) ? $gift_card_code : '';
    $arr_mail['mobile_no']   = isset($mobile_no) ? $mobile_no : '';

    $status = $this->MailService->gift_card_send_mail($arr_mail);

    return $user_gift_card_status->id;
}

public function update_order($arr_data=null)
{
    $status = false;

    if($arr_data!=null)
    {
        $order_id     = $arr_data['order_id'];
        $order_status = ($arr_data['order_status']=='Success')? '1':'0';
        $status       = $this->OrdersModel->where('order_id', $order_id)->update(['status'=> $order_status]);
    }
    return $status;
}

public function payment_error()
{
    $this->arr_view_data['page_title'] = 'Error';
    return view($this->module_view_folder.'.error',$this->arr_view_data);
}
}
