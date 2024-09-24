<?php

namespace App\Http\Controllers\Front\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\UserWalletModel;

class MyWalletController extends Controller
{
	function __construct(
                         UserWalletModel $user_wallet_model
                      )
    {
        $this->module_title       = "My Wallet";
        $this->module_url_path    = url('/user/my_wallet');
        $this->module_view_folder = "front.user.my_wallet";
        $this->user_panel_slug    = config('app.project.user_panel_slug');

        $this->UserWalletModel    = $user_wallet_model;
    }


    /*
    | Function  : Get all the wallet transaction for the login user
    | Author    : Deepak Arvind Salunke
    | Date      : 28/05/2018
    | Output    : Show all the wallet transaction for the login user
    */

    public function index()
    {
        $arr_order  = $arr_pagination = [];
        $id         = '';
        $id         = login_user_id('user');

        $obj_wallet = $this->UserWalletModel->where('user_id', $id)
                                            ->orderBy('id','DESC')
                                            ->paginate(10);
        if($obj_wallet)
        {
          $arr_wallet     = $obj_wallet->toArray();
          $arr_pagination = clone $obj_wallet;
        }

        $this->arr_view_data['wallet_total']        = wallet_total($id);
        $this->arr_view_data['arr_wallet']          = $arr_wallet;
        $this->arr_view_data['arr_pagination']      = $arr_pagination;

        $this->arr_view_data['parent_module_title'] = "Home";
        $this->arr_view_data['page_title']          = $this->module_title;
        $this->arr_view_data['module_title']        = $this->module_title;
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['user_panel_slug']     = $this->user_panel_slug;
        $this->arr_view_data['parent_module_url']   = url('/').'/user/dashboard';

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    } // end index


    /*
    | Function  : Get data for detail page for the selected transaction
    | Author    : Deepak Arvind Salunke
    | Date      : 07/06/2018
    | Output    : Show data detail page for the selected transaction
    */

    public function view($enc_id)
    {
        $user_id = login_user_id('user');

        if(isset($enc_id) && !empty($enc_id) && !empty($user_id) && $user_id != null)
        {
            $id         = base64_decode($enc_id);

            $obj_wallet = $this->UserWalletModel->where('user_id', $user_id)
                                                ->where('id', $id)
                                                ->first();
            if($obj_wallet)
            {
                $arr_wallet     = $obj_wallet->toArray();
            }
            //dd($arr_wallet);

            $this->arr_view_data['arr_wallet']          = $arr_wallet;

            $this->arr_view_data['parent_module_title'] = "Home";
            $this->arr_view_data['page_title']          = $this->module_title;
            $this->arr_view_data['module_title']        = $this->module_title;
            $this->arr_view_data['module_url_path']     = $this->module_url_path;
            $this->arr_view_data['user_panel_slug']     = $this->user_panel_slug;
            $this->arr_view_data['parent_module_url']   = url('/').'/user/dashboard';

            return view($this->module_view_folder.'.view',$this->arr_view_data);
        }
        else
        {
            return redirect()->back();
        }
    }
}
