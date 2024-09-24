<?php

namespace App\Http\Controllers\Front\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\UserGiftCardModel;

class GiftCardController extends Controller
{
	function __construct(UserGiftCardModel $usergiftcard_model)
    {
        $this->arr_view_data               = [];
        $this->module_title                = "Gift Card";
        $this->module_url_path             = url('/user/gift_card');
        $this->module_view_folder          = "front.user.gift_card";
        $this->user_panel_slug             = config('app.project.user_panel_slug');

        $this->gift_card_image_base_path   = base_path().config('app.project.img_path.gift_card_image');
        $this->gift_card_image_public_path = url('/').config('app.project.img_path.gift_card_image');

        $this->UserGiftCardModel           = $usergiftcard_model;
    }

    
    public function send()
    {
        $user_data = login_user_details('user');

        $obj_usergiftcard = $this->UserGiftCardModel->with('giftcard_details')->where('from_user_id', $user_data->id)->orderBy('id','DESC')->paginate('9');
        if($obj_usergiftcard)
        {
            $arr_usergiftcard = $obj_usergiftcard->toArray();
            $arr_pagination   = clone $obj_usergiftcard;
        }
        //dd($arr_usergiftcard['data']);

        $this->arr_view_data['arr_usergiftcard']            = $arr_usergiftcard;
        $this->arr_view_data['arr_pagination']              = $arr_pagination;

        $this->arr_view_data['parent_module_title']         = "Home";
        $this->arr_view_data['page_title']                  = $this->module_title;
        $this->arr_view_data['module_title']                = $this->module_title;
        $this->arr_view_data['module_url_path']             = $this->module_url_path;
        $this->arr_view_data['user_panel_slug']             = $this->user_panel_slug;
        $this->arr_view_data['parent_module_url']           = url('/').'/user/dashboard';

        $this->arr_view_data['gift_card_image_base_path']   = $this->gift_card_image_base_path;
        $this->arr_view_data['gift_card_image_public_path'] = $this->gift_card_image_public_path;

        return view($this->module_view_folder.'.send',$this->arr_view_data);
    } // end send


    public function received()
    {
        $user_email = login_user_email('user');

        $obj_usergiftcard = $this->UserGiftCardModel->with('giftcard_details', 'user_details')->where('user_to_email', $user_email)->orderBy('id','DESC')->paginate('9');
        if($obj_usergiftcard)
        {
            $arr_usergiftcard = $obj_usergiftcard->toArray();
            $arr_pagination   = clone $obj_usergiftcard;
        }
        //dd($arr_usergiftcard['data']);

        $this->arr_view_data['arr_usergiftcard']            = $arr_usergiftcard;
        $this->arr_view_data['arr_pagination']              = $arr_pagination;

        $this->arr_view_data['parent_module_title']         = "Home";
        $this->arr_view_data['page_title']                  = $this->module_title;
        $this->arr_view_data['module_title']                = $this->module_title;
        $this->arr_view_data['module_url_path']             = $this->module_url_path;
        $this->arr_view_data['user_panel_slug']             = $this->user_panel_slug;
        $this->arr_view_data['parent_module_url']           = url('/').'/user/dashboard';

        $this->arr_view_data['gift_card_image_base_path']   = $this->gift_card_image_base_path;
        $this->arr_view_data['gift_card_image_public_path'] = $this->gift_card_image_public_path;

        return view($this->module_view_folder.'.received',$this->arr_view_data);
    } // end received
}
