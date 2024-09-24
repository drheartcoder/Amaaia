<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\GiftCardModel;
use App\Models\UserGiftCardModel;

use App\Common\Services\CcavenuePaymentService;
use App\Common\Services\MailService;

use Indipay;
use Session;
use Validator;
class GiftCardController extends Controller
{
    public function __construct(
    						    GiftCardModel            $GiftCardModel,
                                CcavenuePaymentService   $ccavenue_payment_service,
                                UserGiftCardModel        $user_gift_card_model,
                                MailService              $mail_service
                               )
    {
	    $this->arr_view_data          = [];
	    $this->module_title           = "Home";
	    $this->module_view_folder     = "front.gift_card.";
	    $this->BaseModel              = $GiftCardModel;
        $this->UserGiftCardModel      = $user_gift_card_model;

        $this->CcavenuePaymentService = $ccavenue_payment_service;
        $this->MailService            = $mail_service;

        $this->gift_card_image_base_path   = base_path().config('app.project.img_path.gift_card_image');
        $this->gift_card_image_public_path = url('/').config('app.project.img_path.gift_card_image');
	    
	    $this->front_url_path         = url('/');
	    $this->module_url_path        = $this->front_url_path."/gift_cards";
    }

    public function index()
    {

    	$arr_pagination = $arr_gift_cards = $arr_phonecode = [];

    	$obj_gift_cards = $this->BaseModel->where('status','1')->orderBy('created_at','DESC')->paginate(10);

    	if($obj_gift_cards)
    	{
    		$arr_pagination = clone $obj_gift_cards; 
    		$arr_gift_cards = $obj_gift_cards->toArray();
    	}

        $arr_phonecode                                        = get_phonecode();

        $this->arr_view_data['arr_phonecode']                 = $arr_phonecode;

        $this->arr_view_data['gift_card_image_base_path']   = $this->gift_card_image_base_path;
        $this->arr_view_data['gift_card_image_public_path'] = $this->gift_card_image_public_path;

        $this->arr_view_data['module_url_path']        = $this->module_url_path;
        $this->arr_view_data['page_title']             = 'Gift Cards';
        $this->arr_view_data['arr_gift_cards']         = $arr_gift_cards;
        $this->arr_view_data['arr_pagination']         = $arr_pagination;
        
        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }
}
