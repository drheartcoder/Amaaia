<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NewsletterModel;
use App\Models\WishListModel;
use App\Models\SubCategoryModel;

use Session;

class HomeController extends Controller
{
    public function __construct(
                                NewsletterModel  $newsletter_model,
                                SubCategoryModel $sub_category_model
                                )
    {
        $this->arr_view_data                  = [];
        $this->module_title                   = "Home";
        $this->module_view_folder             = "front.";
        $this->NewsletterModel                = $newsletter_model;
        $this->SubCategoryModel               = $sub_category_model;

        $this->sub_category_image_base_path   = base_path().config('app.project.img_path.sub_category_image');
        $this->sub_category_image_public_path = url('/').config('app.project.img_path.sub_category_image');
    }
    public  function index()
    {
        $arr_sub_categories = '';

        $obj_jewellery = $this->SubCategoryModel->where('status', '1')
                                                ->where('category_id', '2')
                                                ->orderByRaw("RAND()")
                                                ->take(6)
                                                ->get();
        if($obj_jewellery)
        {
            $arr_jewellery = $obj_jewellery->toArray();
        }

        $this->arr_view_data['arr_jewellery']                  = $arr_jewellery;
        $this->arr_view_data['sub_category_image_base_path']   = $this->sub_category_image_base_path;
        $this->arr_view_data['sub_category_image_public_path'] = $this->sub_category_image_public_path;

        $this->arr_view_data['page_title']                     = 'Home';

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    public  function subscribe(Request $request)
    {
        $data['error'] = 'Error while subscribing email.';
        $email = $request->input('email', null);
        
        if($email != null)
        {
            $count = $this->NewsletterModel->where('email', $email)->count();

            if($count > 0)
            {
                unset($data);
                $data['error'] = 'You are already subscribed.';
                return response()->json($data);
            }

            $status = $this->NewsletterModel->create(['email'=>$email]);

            if($status)
            {
                unset($data);
                $data['success'] = 'You are subscribed successfully.';
            }
            else
            {
                unset($data);
                $data['error'] = 'Error while subscribing email.';
            }
        }

        return response()->json($data);

    }

    /*
    | Author    : Deepak Bari
    | Date      : 18/05/2018
    | Function  : Get count of wishlist products of login user.
    */

    public function get_wishlist_count()
    {
        $count = '';
        if(validate_login('user'))
        {
            $login_user_id =  login_user_id('user');            $count = WishListModel::where([
                                            'user_id'      => $login_user_id,
                                            'product_type' => '1'
                                            
                                         ])
                                         ->count();
            return $count;
        }
        else
        {
            return 0;
        }
    }


    /*
    | Function  : switch website currency
    | Author    : Deepak Arvind Salunke
    | Date      : 23/04/2018
    | Output    : Success or Error
    */

    public function set_currency($currency = false)
    {
        $arr_json['status'] = 'error';

        if($currency == 'USD')
        {
            Session::forget('get_currency');
            Session::put('get_currency', 'USD');

            $arr_json['status'] = 'success';
        }
        else
        {
            Session::forget('get_currency');
            Session::put('get_currency', 'INR');

            $arr_json['status'] = 'success';
        }

        return response()->json($arr_json);
    } // end set_currency
}
