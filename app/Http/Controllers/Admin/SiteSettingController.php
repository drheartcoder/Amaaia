<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\SiteSettingModel;

use Validator;
use Session;

class SiteSettingController extends Controller
{
    public function __construct(SiteSettingModel $site_setting_model)
    {
    	$this->arr_view_data        = [];
      $this->admin_url_path       = url(config('app.project.admin_panel_slug'));
      $this->admin_panel_slug     = config('app.project.admin_panel_slug');
      $this->module_url_path      = $this->admin_url_path."/site_setting";
      $this->module_view_folder   = "admin.site_setting";

      $this->module_title         = "Site Setting";
      $this->module_icon          = 'fa fa-cog';

      $this->SiteSettingModel    = $site_setting_model;
  }

  public function index()
  {
    $arr_site_settings = [];
    $obj_site_settings = $this->SiteSettingModel->first();

    if($obj_site_settings) 
    {
        $arr_site_settings = $obj_site_settings->toArray();
    }

    $this->arr_view_data['page_title']           = $this->module_title;
    $this->arr_view_data['parent_module_icon']   = "fa fa-home";
    $this->arr_view_data['parent_module_title']  = "Dashboard";
    $this->arr_view_data['parent_module_url']    = url('/').'/admin/dashboard';
    $this->arr_view_data['module_icon']          = $this->module_icon;
    $this->arr_view_data['module_title']         = $this->module_title;

    $this->arr_view_data['arr_site_settings']    = $arr_site_settings;

    $this->arr_view_data['admin_panel_slug']     = $this->admin_panel_slug;
    return view($this->module_view_folder.'.index',$this->arr_view_data);
}

public function update(Request $request)
{
    $status_update = $status_create = $latitude = $longitude = '';
    $arr_rules     = $arr_data      = array();

    $arr_rules['site_name']           = "required";
    $arr_rules['site_address']        = "required";
    $arr_rules['site_email_address']  = "required";
    $arr_rules['site_contact_number'] = "required";
    $arr_rules['currency_rate']       = "required";
    $arr_rules['transaction_charges'] = "required";
    $arr_rules['gst']                 = "required";
    $arr_rules['product_return_days'] = "required";
    $arr_rules['meta_keyword']        = "required";
    $arr_rules['meta_description']    = "required";
    $arr_rules['facebook_url']        = "required";
    $arr_rules['twitter_url']         = "required";
    $arr_rules['google_plus_url']     = "required";
    $arr_rules['linkedin_url']        = "required";
    $arr_rules['instagram_url']       = "required";
    $arr_rules['pintrest_url']        = "required";

    $validator = Validator::make($request->all(),$arr_rules);
    if($validator->fails())
    {       
        return redirect()->back()->withErrors($validator)->withInput();  
    }
    if($request->input('site_address') != '') 
    {
        $complete_address = str_replace (" ", "+", $request->input('site_address'));
        $details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=" . $complete_address . "&sensor=false";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $details_url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

        $content = curl_exec($ch);
        curl_close($ch);
            $metadata = json_decode($content, true); //json decoder
            $result = array();
            
            if(count($metadata['results']))
            {
                $result = $metadata['results'][0];                              
                if(sizeof($result)>0)
                {
                    $latitude     = $request->input('lat') != '' && $request->input('lat') != null ? $request->input('lat') : $result['geometry']['location']['lat'];
                    $longitude    = $request->input('long') != '' && $request->input('long') != null ? $request->input('long') : $result['geometry']['location']['lng'];                   
                }
            } 
        }

        $arr_data['site_name']           = trim($request->input('site_name',''));
        $arr_data['site_address']        = $request->input('site_address',1);
        $arr_data['site_email_address']  = $request->input('site_email_address');
        $arr_data['lat']                 = $latitude;
        $arr_data['lon']                 = $longitude;
        $arr_data['site_contact_number'] = $request->input('site_contact_number');
        $arr_data['currency_rate']       = $request->input('currency_rate',1);
        $arr_data['transaction_charges'] = $request->input('transaction_charges','');
        $arr_data['gst']                 = $request->input('gst',1);
        $arr_data['site_status']         = $request->input('site_status','');
        $arr_data['meta_desc']           = $request->input('meta_description','');
        $arr_data['meta_keyword']        = $request->input('meta_keyword','');
        $arr_data['fb_url']              = $request->input('facebook_url','');
        $arr_data['twitter_url']         = $request->input('twitter_url','');
        $arr_data['google_plus_url']     = $request->input('google_plus_url','');
        $arr_data['linkedin_url']        = $request->input('linkedin_url','');
        $arr_data['instagram_url']       = $request->input('instagram_url','');
        $arr_data['pintrest_url']        = $request->input('pintrest_url','');
        $arr_data['product_return_days'] = $request->input('product_return_days','');

        $obj_data = $this->SiteSettingModel->first();
        
        if($obj_data)
        {
            $status_update = $obj_data->update($arr_data);
        }
        else
        {
            $status_create = $this->SiteSettingModel->create($arr_data);
        }
        if($status_update) 
        {
            Session::flash('success',str_singular($this->module_title).' details updated successfully.');
        }
        elseif($status_create)
        {
            Session::flash('success',str_singular($this->module_title).' details added successfully.');
        }
        else
        {
            Session::flash('error','Problem Occurred, While Updating '.str_singular($this->module_title));
        }
                                                                                                                                                                                                                                                                                                                                                                                         update_final_price();
        return redirect()->back();

    }
}
