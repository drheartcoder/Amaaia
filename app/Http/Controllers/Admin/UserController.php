<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
   	public function __construct()
	{
        $this->arr_view_data        = [];
		$this->admin_url_path       = url(config('app.project.admin_panel_slug'));
		$this->admin_panel_slug     = config('app.project.admin_panel_slug');
		$this->module_url_path      = $this->admin_url_path."/ui_languages";
		$this->module_view_folder   = "admin.users";
		
		$this->module_title         = "Users";
		$this->module_icon          = 'fa-language';
		$this->arr_view_data        = [];
	}


    public function demo()
    {
    	$this->arr_view_data['module_icon']  = $this->module_icon;
		$this->arr_view_data['module_title'] = $this->module_title;
		$this->arr_view_data['languages']    = [];
		$this->arr_view_data['count']        = 10;
		$this->arr_view_data['page_title']   = 'Manage '.$this->module_title;
        $this->arr_view_data['module_icon']  = $this->module_icon;
        $this->arr_view_data['admin_panel_slug']  = $this->admin_panel_slug;
        $this->arr_view_data['module_url_path']  = $this->module_url_path;
    	return view($this->module_view_folder.'.index',$this->arr_view_data);
    }
}
