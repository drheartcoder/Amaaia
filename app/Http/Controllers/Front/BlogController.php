<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\BlogModel;
use App\Models\BlogCommentModel;
use App\Models\BlogCategoriesModel;
use Validator;
use Session;

class BlogController extends Controller
{
   public function __construct(BlogModel            $blog_model,
                               BlogCommentModel     $blog_comment_model,
                               BlogCategoriesModel  $blog_category_model)
   {
    $this->arr_view_data          = [];
    $this->module_title           = "Home";
    $this->module_view_folder     = "front.blog.";
    $this->BlogModel              = $blog_model;
    $this->BlogCommentModel       = $blog_comment_model;
    $this->BlogCategoriesModel    = $blog_category_model;

    $this->blog_image_base_path   = base_path().config('app.project.img_path.blog_image');
    $this->blog_image_public_path = url('/').config('app.project.img_path.blog_image');

    $this->user_profile_image_base_path   = base_path().config('app.project.img_path.user_profile_image');
    $this->user_profile_image_public_path = url('/').config('app.project.img_path.user_profile_image');
    
    $this->front_url_path         = url('/');
    $this->module_url_path        = $this->front_url_path."/blog";


}

    /*
    | Name : Deepak Bari
    | Date : 10th May, 2018
    | Function - Display listing of blogs along with category.
    */

    public  function index(Request $request)
    {
        $arr_blog = $arr_blog_categories = [];

        $obj_blog = $this->BlogModel->where('status','1')
                                    ->whereHas('blog_category', function($query){
                                        $query->where('status','1');
                                    })
                                    ->with('comment_details')
                                    ->select('id','title','slug','blog_image','no_of_views','description','created_at')
                                    ->orderBy('created_at','DESC');

        if($request->search != null && $request->search != '')
        {
            $obj_blog = $obj_blog->where('title', 'like', '%'.$request->search.'%');

            $this->arr_view_data['search_keyword'] = $request->search;
        }

        $obj_blog = $obj_blog->paginate(10);

        if($obj_blog)
        {
            $arr_blog = $obj_blog->toArray();
            $obj_pagination = clone $obj_blog;
        }

        $arr_blog_categories   = $this->blog_categories_data();
        $arr_blog_recent_posts = $this->recent_posts();

        $this->arr_view_data['module_url_path']        = $this->module_url_path;
        $this->arr_view_data['blog_image_base_path']   = $this->blog_image_base_path;
        $this->arr_view_data['blog_image_public_path'] = $this->blog_image_public_path;
        $this->arr_view_data['page_title']             = 'Blog';
        $this->arr_view_data['arr_blog']               = $arr_blog;
        $this->arr_view_data['arr_blog_categories']    = $arr_blog_categories;
        $this->arr_view_data['arr_blog_recent_posts']  = $arr_blog_recent_posts;
        $this->arr_view_data['arr_pagination']         = $obj_pagination;

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }


    /*
    | Function  : Get all the blogs under this category
    | Author    : Deepak Arvind Salunke
    | Date      : 15/05/2018
    | Output    : Show list of all the blogs under this category
    */

    public function category_blog($slug = false)
    {
        $arr_blog = $arr_blog_categories = [];

        if($slug != false)
        {

            $obj_blog = $this->BlogModel->where('status','1')
                                        ->whereHas('blog_category', function($query) use($slug){
                                            $query->where('slug', $slug);
                                            $query->where('status','1');
                                        })
                                        ->with('comment_details')
                                        ->select('id','title','slug','blog_image','no_of_views','description','created_at')
                                        ->orderBy('created_at','DESC');

            $obj_blog = $obj_blog->paginate(10);

            if($obj_blog)
            {
                $arr_blog = $obj_blog->toArray();
                $obj_pagination = clone $obj_blog;
            }

            $arr_blog_categories   = $this->blog_categories_data();
            $arr_blog_recent_posts = $this->recent_posts();

            $this->arr_view_data['module_url_path']        = $this->module_url_path;
            $this->arr_view_data['blog_image_base_path']   = $this->blog_image_base_path;
            $this->arr_view_data['blog_image_public_path'] = $this->blog_image_public_path;
            $this->arr_view_data['page_title']             = 'Blog';
            $this->arr_view_data['arr_blog']               = $arr_blog;
            $this->arr_view_data['arr_blog_categories']    = $arr_blog_categories;
            $this->arr_view_data['arr_blog_recent_posts']  = $arr_blog_recent_posts;
            $this->arr_view_data['arr_pagination']         = $obj_pagination;

            return view($this->module_view_folder.'.index',$this->arr_view_data);

        }
        else
        {
            return redirect()->back()->with('error','Something went to wrong.');
        }
    } // end category_blog

    /*
    | Name : Deepak Bari
    | Date : 11th May, 2018
    | Function - View details of specific blog.
    */

    public function view($slug = false)
    {
        $arr_blog =  $arr_blog_categories = [];
        $blog_id = '';

        if($slug != false)
        {
            $obj_blog = $this->BlogModel->where('slug',$slug)->first();
            if($obj_blog)
            {
                $arr_blog = $obj_blog->toArray();

                $blog_id = $arr_blog['id'];

                // update no of views for the blog
                $new_views = $arr_blog['no_of_views'] + 1;
                $obj_blog->update(['no_of_views' => $new_views]);
            }

            $obj_blog_comment = $this->BlogCommentModel->where('blog_id', $blog_id)->with('user_details')->get();
            if($obj_blog_comment)
            {
                $arr_blog_comment = $obj_blog_comment->toArray();
            }

            $arr_blog_categories   = $this->blog_categories_data();
            $arr_blog_recent_posts = $this->recent_posts();

            $this->arr_view_data['validate_login']         = validate_login("user");

            $this->arr_view_data['user_profile_image_base_path']     = $this->user_profile_image_base_path;
            $this->arr_view_data['user_profile_image_public_path']   = $this->user_profile_image_public_path;

            $this->arr_view_data['module_url_path']        = $this->module_url_path;
            $this->arr_view_data['blog_image_base_path']   = $this->blog_image_base_path;
            $this->arr_view_data['blog_image_public_path'] = $this->blog_image_public_path;
            $this->arr_view_data['page_title']             = 'Blog';
            $this->arr_view_data['arr_blog']               = $arr_blog;
            $this->arr_view_data['arr_blog_categories']    = $arr_blog_categories;
            $this->arr_view_data['arr_blog_recent_posts']  = $arr_blog_recent_posts;
            $this->arr_view_data['arr_blog_comment']       = $arr_blog_comment;

            return view($this->module_view_folder.'.view',$this->arr_view_data);
        }
        else
        {
            return redirect()->back()->with('error','Something went to wrong.');
        }
        
    }


    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 14/05/2018
    | Output    : Success or Error
    */

    public function blog_categories_data()
    {
        $arr_blog_categories = [];

        $obj_blog_categories = $this->BlogCategoriesModel->where('status','1')
                                                         ->orderBy('created_at','DESC')
                                                         ->withCount('blogs')
                                                         ->get();
        if($obj_blog_categories)
        {
            $arr_blog_categories = $obj_blog_categories->toArray();
        }

        return $arr_blog_categories;
    } // end blog_categories_data

    /*
    | Function  : 
    | Author    : Deepak Arvind Salunke
    | Date      : 14/05/2018
    | Output    : Success or Error
    */

    public function recent_posts()
    {
        $arr_blog = [];

        $obj_blog = $this->BlogModel->where('status','1')
                                    ->orderBy('created_at','DESC')
                                    ->take(3)->get();
        if($obj_blog)
        {
            $arr_blog = $obj_blog->toArray();
        }

        return $arr_blog;
    } // end recent_posts


    /*
    | Function  : Get commented data and store it
    | Author    : Deepak Arvind Salunke
    | Date      : 14/05/2018
    | Output    : Success or Error
    */

    public function comment_store(Request $request)
    {
        $arr_rules = $user_data = [];

        //$arr_rules['reviewtitle'] = "required";
        $arr_rules['reviewmsg']   = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        { 
            return redirect()->back()->withErrors($validator)->withInput();  
        }
        else
        {
            $validate_login = validate_login("user");
            if($validate_login)
            {
                $user_id = login_user_id("user");
            }
            else
            {
                $user_id = "";
            }

            $comment_data['blog_id'] = trim($request->input('blog_id'));
            $comment_data['user_id'] = $user_id;
            //$comment_data['title']   = trim($request->input('reviewtitle'));
            $comment_data['title']   = '';
            $comment_data['comment'] = trim($request->input('reviewmsg'));

            $status = $this->BlogCommentModel->create($comment_data);
            if($status)
            {
                Session::flash('success', 'Comment send successfully.');
                return redirect()->back();
            }
            else
            {
                Session::flash('error', 'Error while sending comment.');
                return redirect()->back();              
            }
        }
        Session::flash('error', 'Error while sending comment.');       
        return redirect()->back();
    } // end comment_store
}
