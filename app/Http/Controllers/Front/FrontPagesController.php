<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\FrontPagesModel;
use App\Models\SiteSettingModel;
use App\Models\WebAdminModel;

class FrontPagesController extends Controller
{

	public function __construct(
		SiteSettingModel $site_settings_model,
		FrontPagesModel  $front_pages_model,
		WebAdminModel    $web_admin_model
		)
	{
		$this->array_view_data    = [];
		$this->module_title       = 'Front Pages';
		$this->module_view_folder = 'front.pages';
		$this->module_url_path    = url('/info');
		$this->FrontPagesModel    = $front_pages_model;
		$this->SiteSettingModel   = $site_settings_model;
		$this->WebAdminModel      = $web_admin_model;
	}

	public function index($slug)
	{
		if($slug =='education')
		{
			$this->array_view_data['module_url_path']	= $this->module_url_path.'education';
			$this->array_view_data['page_title'] 		= 'Education';
			return view($this->module_view_folder.'.education', $this->array_view_data);

		}

		if($slug =='career')
		{
			$obj_admin = $this->WebAdminModel->select('email')->first();
			
			$this->array_view_data['module_url_path']	= $this->module_url_path.'career';
			$this->array_view_data['page_title'] 		= 'Career';
			$this->array_view_data['email'] 		= $obj_admin->email;
			
			return view($this->module_view_folder.'.career', $this->array_view_data);
		}

		if($slug =='engagement-moments')
		{
			$obj_admin = $this->WebAdminModel->select('email')->first();
			
			$this->array_view_data['module_url_path']	= $this->module_url_path.'engagement_moments';
			$this->array_view_data['page_title'] 		= 'Engagement Moments';
			
			return view($this->module_view_folder.'.engagement_moments', $this->array_view_data);
		}

		if($slug =='why-buy-amaaia')
		{
			$obj_admin = $this->WebAdminModel->select('email')->first();
			
			$this->array_view_data['module_url_path']	 = $this->module_url_path.'why_buy_amaaia';
			$this->array_view_data['page_title'] 		 = 'Why Buy Amaaia';
			
			return view($this->module_view_folder.'.why_buy_amaaia', $this->array_view_data);
		}

		$arr_page = [];
		$obj_page = $this->FrontPagesModel->where('slug',$slug)->first();

		if($obj_page)
		{
			$arr_page = $obj_page->toArray();
			if($arr_page['status']!='1')
			{
				return response()->view('errors.404', [], 404);
			}
		}
		else
		{
			return response()->view('errors.404', [], 404);
		}

		$this->array_view_data['arr_page']			= $arr_page;
		$this->array_view_data['module_url_path']	= isset($arr_page['slug'])? $this->module_url_path.'/'.$arr_page['slug']:'' ;		

		$this->array_view_data['page_title'] 		= isset($arr_page['page_title'])? $arr_page['page_title']:'Demo Pages';
		return view($this->module_view_folder.'.static_pages', $this->array_view_data);
	}


	public function about_us()
	{
		$arr_site_setting = [];
		$obj_site_setting = $this->SiteSettingModel->first();
		if(isset($obj_site_setting) && $obj_site_setting!=null)
		{
			$arr_site_setting = $obj_site_setting->toArray();
		}
		
		$this->array_view_data['site_data']    = $arr_site_setting;
		$this->array_view_data['page_title']   = 'About Us';

		return view($this->module_view_folder.'.about_us', $this->array_view_data);
	}

	public function tieup()
	{
		
		$this->array_view_data['page_title']   = 'Tieup';
		return view($this->module_view_folder.'.tieup', $this->array_view_data);
	}

	public function curation()
	{
		$this->array_view_data['page_title']   = 'Curation';
		return view($this->module_view_folder.'.curation', $this->array_view_data);
	}


}
