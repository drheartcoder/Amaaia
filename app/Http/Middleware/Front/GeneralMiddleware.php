<?php

namespace App\Http\Middleware\Front;

use App\Models\SiteSettingModel;
use App\Models\NotificationsModel;
use App\Models\CategoryModel;
use App\Models\CollectionModel;

use Closure;
use Sentinel;
use Request;
use Session;

class GeneralMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $site_settings = [];

      $site_setting = SiteSettingModel::first();
      if($site_setting)
      {
        $arr_site_settings = $site_setting->toArray();
        if(isset($arr_site_settings['site_status']) && $arr_site_settings['site_status']==0)
        {
         return response(view('errors.under_construction'));
       }
     }

     /*route handling*/
     $current_url_route = app()->router->getCurrentRoute()->uri();

     $arr_except[] = 'login';
     $arr_except[] = 'validate_login';
     $arr_except[] = 'forget_password';
     $arr_except[] = 'password_reset';
     $arr_except[] = 'set_currency';

     $arr_site_data = array();
     $obj_site_data = SiteSettingModel::select('*')->first();
     if($obj_site_data)
     {   
       $arr_site_data = $obj_site_data->toArray();
     }
     
     view()->share('arr_global_site_setting',$arr_site_data);
     // update_final_price();
     

     // Get Category for menu section
     $arr_categories = [];
     $obj_categories = CategoryModel::where('status', '1')
     ->where('slug', 'diamond')
     ->orWhere('slug', 'jewellery')
     ->orWhere('slug', 'fashion-jewellery')
     ->get();
     if($obj_categories)
     {
      $arr_categories = $obj_categories->toArray();
    }
    view()->share('arr_menu_categories',$arr_categories);

      // Get Collection for menu section
    $arr_collection = [];
    $obj_collection = CollectionModel::where("status", "1")->orderBy('name', 'ASC')->get();
    if($obj_collection)
    {
      $arr_collection = $obj_collection->toArray();
    }
    view()->share('arr_menu_collection',$arr_collection);

     // Sagar Pawar 
     // Deletes all the images in the cache folder
    /*if(date('i', time())==1)
    {
     $cached_files = glob(base_path().'/uploads/resize_cache/'. '/*');
     
     foreach ($cached_files as $key => $cached_file) 
     {
       @unlink($cached_file);
     }
   }*/


   return $next($request);    
 }

}
