<!-- Page container -->
<div class="page-container">

  <!-- Page content -->
  <div class="page-content">

    <!-- Main sidebar -->
    <div class="sidebar sidebar-main">
      <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
          <div class="category-content">
            <div class="media">
              <a href="{{url('/')}}/admin/account_setting" class="media-left">
                @php 
                $admin_profile_img =  isset($shared_admin_details['profile_image'])  ? $shared_admin_details['profile_image'] : "";
                $profile_image_src = ""; 
                @endphp
                @if(isset($admin_profile_img) &&  $admin_profile_img!="" && file_exists($profile_image_base_img_path.$admin_profile_img))
                @php
                $profile_image_src = $profile_image_public_img_path.$admin_profile_img;
                @endphp
                @else
                @php
                $profile_image_src =url('/')."/uploads/admin/default_image/default-profile.png";
                @endphp
                @endif
                <img src="{{$profile_image_src}}" class="img-circle img-sm" alt="Profile Image"></a>
                <div class="media-body">
                  <span class="media-heading text-semibold">{{$shared_admin_details['first_name'] or ''}} {{$shared_admin_details['last_name'] or ''}}</span>
                  <div class="text-size-mini text-muted">
                    <i class="icon-pin text-size-small"></i> &nbsp;{{$shared_admin_details['address'] or ''}}
                  </div>
                </div>

                <div class="media-right media-middle">
                  <ul class="icons-list">
                    <li>
                      <a href="{{url('/')}}/admin/site_setting"><i class="icon-cog3"></i></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- /user menu -->


          <!-- Main navigation -->
          <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
              <ul class="navigation navigation-main navigation-accordion">

                <!-- Main -->
                <li class="@if(Request::segment(2) == 'dashboard') active @endif"><a href="{{url('/')}}/admin/dashboard"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
                <li class="@if(Request::segment(2) == 'account_setting') active @endif"><a href="{{url('/')}}/admin/account_setting"><i class="fa fa-cogs"></i> <span>Account Setting</span></a></li>
                <li class="@if(Request::segment(2) == 'site_setting') active @endif"><a href="{{url('/')}}/admin/site_setting"><i class="fa fa-cog"></i> <span>Site Setting</span></a></li>

                <li class="@if(Request::segment(2) == 'api_credentials') active @endif"><a href="{{url('/')}}/admin/api_credentials"><i class="fa fa-key"></i> <span>Api Credentials</span></a></li>

                <li class="@if(Request::segment(2) == 'front_pages') active @endif">
                  <a href="javascript:void(0)">
                    <i class="fa fa-file-text"></i>
                    <span>Front Pages</span>
                  </a>
                  <ul class="submenu">
                    <li style="display: block;" class="@if(Request::segment(2) == 'front_pages' && Request::segment(3) != 'create') active @endif"><a href="{{ url($admin_panel_slug.'/front_pages')}}">Manage </a></li>
                    <li style="display: block;" class="@if(Request::segment(2) == 'front_pages' && Request::segment(3) == 'create') active @endif"><a href="{{ url($admin_panel_slug.'/front_pages/create')}}">Create </a></li>
                  </ul>
                </li>
                <li class="@if(Request::segment(2) == 'categories') active @endif">
                  <a href="javascript:void(0)">
                    <i class="fa fa-newspaper-o"></i>
                    <span>Category</span>
                  </a>
                  <ul class="submenu">
                    <li style="display: block;" class="@if(Request::segment(2) == 'categories' && Request::segment(3) != 'create') active @endif"><a href="{{ url($admin_panel_slug.'/categories')}}">Manage </a></li>
                    <li style="display: block;" class="@if(Request::segment(2) == 'categories' && Request::segment(3) == 'create') active @endif"><a href="{{ url($admin_panel_slug.'/categories/create')}}">Create </a></li>
                  </ul>
                </li>

                <li class="@if(Request::segment(2) == 'sub_categories') active @endif">
                  <a href="javascript:void(0)">
                    <i class="fa fa-file-text"></i>
                    <span>Sub Category</span>
                  </a>
                  <ul class="submenu">
                    <li style="display: block;" class="@if(Request::segment(2) == 'sub_categories' && Request::segment(3) != 'create') active @endif"><a href="{{ url($admin_panel_slug.'/sub_categories')}}">Manage </a></li>
                    <li style="display: block;" class="@if(Request::segment(2) == 'sub_categories' && Request::segment(3) == 'create') active @endif"><a href="{{ url($admin_panel_slug.'/sub_categories/create')}}">Create </a></li>
                  </ul>
                </li>

                <li class="@if(Request::segment(2) == 'user') active @endif">
                  <a href="javascript:void(0)">
                    <i class="fa fa-user"></i>
                    <span>Users</span>
                  </a>
                  <ul class="submenu">
                    <li style="display: block;" class="@if(Request::segment(2) == 'user' && Request::segment(3) == 'customers') active @endif"><a href="{{ url($admin_panel_slug.'/user/customers')}}">Customers </a></li>
                    <li style="display: block;" class="@if(Request::segment(2) == 'user' && Request::segment(3) == 'suppliers') active @endif"><a href="{{ url($admin_panel_slug.'/user/suppliers')}}">Suppliers </a></li>
                  </ul>
                </li>

                <li
                class="@if(
                Request::segment(2) == 'metals' |
                Request::segment(2) == 'occasions' |
                Request::segment(2) == 'collections' |
                Request::segment(2) == 'look' |
                Request::segment(2) == 'setting' |
                Request::segment(2) == 'metal_detailing' |
                Request::segment(2) == 'brands'
                
                ) active @endif">

                <a href="javascript:void(0)">
                  <i class="fa fa-cart-arrow-down"></i>
                  <span>Product Attributes</span>
                </a>

                <ul class="submenu">
                  <li class="@if(Request::segment('2') == 
                  'metals' || Request::segment('2') == 'metal_colors'
                  ) active @endif">
                  <a href="javascript:void(0)">
                    <span>Metals</span>
                  </a>
                  <ul class="submenu">
                    <li style="display: block;" class="@if(Request::segment(2) == 'metals') active @endif"><a href="{{ url($admin_panel_slug.'/metals/manage')}}">Type </a></li>
                    <li style="display: block;" class="@if(Request::segment(2) == 'metal_colors') active @endif"><a href="{{ url($admin_panel_slug.'/metal_colors')}}">Color </a></li>
                    <li style="display: block;" class="@if(Request::segment(2) == 'metal_qualities') active @endif"><a href="{{ url($admin_panel_slug.'/metal_qualities')}}">Quality </a></li>
                  </ul>
                </li>

                <li class="@if(Request::segment(2) == 'gemstone') active @endif">
                  <a href="javascript:void(0)">
                    <span>Gemstone</span>
                  </a>
                  <ul class="submenu">
                    <li style="display: block;" class="@if(Request::segment(2) == 'gemstone') active @endif"><a href="{{ url($admin_panel_slug.'/gemstone')}}">Type </a></li>
                    <li style="display: block;" class="@if(Request::segment(2) == 'gemstone_colors') active @endif"><a href="{{ url($admin_panel_slug.'/gemstone_colors')}}">Color </a></li>
                    <li style="display: block;" class="@if(Request::segment(2) == 'gemstone_qualities') active @endif"><a href="{{ url($admin_panel_slug.'/gemstone_qualities')}}">Quality </a></li>
                    <li style="display: block;" class="@if(Request::segment(2) == 'gemstone_shapes') active @endif"><a href="{{ url($admin_panel_slug.'/gemstone_shapes')}}">Shape </a></li>
                  </ul>
                </li>

                <li style="display: block;" class="@if(Request::segment(2) == 'occasions') active @endif"><a href="{{ url($admin_panel_slug.'/occasions')}}">Occasions</a></li>

                <li style="display: block;" class="@if(Request::segment(2) == 'collections') active @endif"><a href="{{ url($admin_panel_slug.'/collections')}}">Collections</a></li>
                
                <li style="display: block;" class="@if(Request::segment(2) == 'look') active @endif"><a href="{{ url($admin_panel_slug.'/look')}}">Looks</a></li>
                
                <li style="display: block;" class="@if(Request::segment(2) == 'setting') active @endif"><a href="{{ url($admin_panel_slug.'/setting')}}">Setting</a></li>

                <li style="display: block;" class="@if(Request::segment(2) == 'metal_detailing') active @endif"><a href="{{ url($admin_panel_slug.'/metal_detailing/manage')}}">Metal Detailing</a></li>


                <li style="display: block;" class="@if(Request::segment(2) == 'brands') active @endif"><a href="{{ url($admin_panel_slug.'/brands/manage')}}">Brands</a></li>

                
                <li style="display: block;" class="@if(Request::segment(2) == 'product_line') active @endif"><a href="{{ url($admin_panel_slug.'/product_line')}}">Product Lines</a></li>

              </ul>
            </li>

            <li class="@if(

            Request::segment(2) == 'shank_types' |
            Request::segment(2) == 'ring_shoulder' |
            Request::segment(2) == 'bands_setting' 

            ) active @endif">
            <a href="javascript:void(0)">
              <i class="fa fa-circle-o-notch"></i>
              <span>Ring Attributes</span>
            </a>
            <ul class="submenu">
              <li style="display: block;" class="@if(Request::segment(2) == 'shank_types') active @endif"><a href="{{ url($admin_panel_slug.'/shank_types')}}">Shank Types</a></li>

              <li style="display: block;" class="@if(Request::segment(2) == 'ring_shoulder') active @endif"><a href="{{ url($admin_panel_slug.'/ring_shoulder')}}">Ring Shoulder</a></li> 

              <li style="display: block;" class="@if(Request::segment(2) == 'bands_setting') active @endif"><a href="{{ url($admin_panel_slug.'/bands_setting/manage')}}">Bands</a></li>

            </ul>
          </li>

          <li class="@if(Request::segment(2) == 'gift_card') active @endif">
            <a href="javascript:void(0)">
              <i class="fa fa-gift"></i>
              <span>Gift Card</span>
            </a>
            <ul class="submenu">
              <li style="display: block;" class="@if(Request::segment(2) == 'gift_card' && Request::segment(3) != 'create') active @endif"><a href="{{ url($admin_panel_slug.'/gift_card')}}">Manage </a></li>
              <li style="display: block;" class="@if(Request::segment(2) == 'gift_card' && Request::segment(3) == 'create') active @endif"><a href="{{ url($admin_panel_slug.'/gift_card/create')}}">Create </a></li>
            </ul>
          </li>

          <li class="@if(Request::segment(2) == 'insurance_details') active @endif">
            <a href="javascript:void(0)">
              <i class="fa fa-shield"></i>
              <span>Insurance Details</span>
            </a>
            <ul class="submenu">
              <li style="display: block;" class="@if(Request::segment(2) == 'insurance_details' && Request::segment(3) == 'manage') active @endif"><a href="{{ url($admin_panel_slug.'/insurance_details/manage')}}">Manage </a></li>
              <li style="display: block;" class="@if(Request::segment(2) == 'insurance_details' && Request::segment(3) == 'create') active @endif"><a href="{{ url($admin_panel_slug.'/insurance_details/create')}}">Create </a></li>
            </ul>
          </li>

          <li class="@if(Request::segment(2) == 'blog_categories') active @endif">
            <a href="javascript:void(0)">
              <i class="fa fa-rss"></i>
              <span>Blogs</span>
            </a>
            <ul class="submenu">
              <li style="display: block;" class="@if(Request::segment(2) == 'blogs' && Request::segment(3) == 'create') active @endif"><a href="{{ url($admin_panel_slug.'/blog_categories/manage')}}">Blog Categories </a></li>
              <li style="display: block;" class="@if(Request::segment(2) == 'blogs' && Request::segment(3) == 'manage') active @endif"><a href="{{ url($admin_panel_slug.'/blogs/manage')}}">Manage Blogs</a></li>
            </ul>
          </li> 

          <li class="@if(Request::segment(2) == 'faq') active @endif">
            <a href="javascript:void(0)">
              <i class="fa fa-question-circle"></i>
              <span>FAQ</span>
            </a>
            <ul class="submenu">
              <li style="display: block;" class="@if(Request::segment(2) == 'faq' && Request::segment(3) != 'create') active @endif"><a href="{{ url($admin_panel_slug.'/faq')}}">Manage </a></li>
              <li style="display: block;" class="@if(Request::segment(2) == 'faq' && Request::segment(3) == 'create') active @endif"><a href="{{ url($admin_panel_slug.'/faq/create')}}">Create </a></li>
            </ul>
          </li>

          <li class="@if(Request::segment(2) == 'contact_enquiry') active @endif">
            <a href="{{url('/')}}/admin/contact_enquiry"><i class="fa fa-envelope-square"></i> <span>Contact Enquiries</span>
            </a>
          </li> 
          <li class="@if(Request::segment(2) == 'email_template') active @endif">
            <a href="{{url('/')}}/admin/email_template"><i class="fa fa-envelope-square"></i> <span>Email Templates</span>
            </a>
          </li>
          <li class="@if(Request::segment(2) == 'notification_template') active @endif">
            <a href="{{url('/')}}/admin/notification_template"><i class="fa fa-bell-o"></i> <span>Notification Templates</span>
            </a>
          </li>

          <li class="@if(Request::segment(2) == 'subscribers') active @endif">
            <a href="{{url('/')}}/admin/subscribers"><i class="fa fa-comments-o"></i> <span>Subscribers</span>
            </a>
          </li>

          <li class="@if(Request::segment(2) == 'notifications') active @endif">
            <a href="{{url($admin_panel_slug)}}/notifications"><i class="fa fa-bell"></i> <span>Notifications</span>
            </a>
          </li>

          <li class="@if(Request::segment(2) == 'products') active @endif">
            <a href="javascript:void(0)">
              <i class="fa fa-diamond"></i>
              <span>Products</span>
            </a>
            <ul>
              <li class="@if(Request::segment(2) == 'products' && Request::segment(3) == 'supplier') active @endif">
                <a href="{{url($admin_panel_slug)}}/products/supplier">Suppliers Products</a>
              </li>

              <li class="">
                <a href="javascript:void(0)">Own Products</a>
                <ul>
                  <li class="@if(Request::segment(2) == 'products') && Request::segment(3) == '') active @endif">
                    <a href="#">Jewellery</a>
                    <ul>
                      <li class="@if(Request::segment(2) == 'products' && Request::segment(3) != 'jewellery' && Request::segment(3) != 'supplier' ) active @endif"><a href="{{url($admin_panel_slug)}}/products">Manage</a></li>
                      <li class="@if(Request::segment(2) == 'products' && Request::segment(3) == 'jewellery' && Request::segment(4) == 'create') active @endif"><a href="{{url($admin_panel_slug)}}/products/jewellery/create">Create</a></li>
                    </ul>
                  </li>

                  {{-- <li class="@if(Request::segment(3) == 'users') active @endif">
                    <a href="#">Diamond</a>
                    <ul>
                      <li class=""><a href="javascript:void(0)">Manage</a></li>
                      <li class=""><a href="javascript:void(0)">Create</a></li>
                    </ul>
                  </li> --}}
                </ul>
              </li>
            </ul>

          </li>

          <li class="@if(Request::segment(2) == 'reports') active @endif">
            <a href="javascript:void(0)">
              <i class="fa fa-file-text"></i>
              <span>Reports</span>
            </a>
            <ul>
              <li class="@if(Request::segment(2) == 'reports' && Request::segment(3) == 'users') active @endif">
                <a href="#">Users</a>
                <ul>
                  <li class="@if(Request::segment(2) == 'reports' && Request::segment(3) == 'users' && Request::segment(4) == 'customers') active @endif"><a href="{{url($admin_panel_slug)}}/reports/users/customers">Customers</a></li>
                  <li class="@if(Request::segment(2) == 'reports' && Request::segment(3) == 'users' && Request::segment(4) == 'suppliers') active @endif"><a href="{{url($admin_panel_slug)}}/reports/users/suppliers">Suppliers</a></li>
                </ul>
              </li>
              <li class="@if(Request::segment(2) == 'reports' && Request::segment(3) == 'orders') active @endif"><a href="{{url($admin_panel_slug)}}/reports/orders">Orders</a></li>
              
              <li class="@if(Request::segment(2) == 'reports' && Request::segment(3) == 'shopping-cart') active @endif"><a href="{{url($admin_panel_slug)}}/reports/shopping-cart">Shopping Cart</a></li>

              <li class="@if(Request::segment(2) == 'reports' && Request::segment(3) == 'products' && Request::segment(4)=='') active @endif"><a href="{{url($admin_panel_slug)}}/reports/products">Products</a></li>

              <li class="@if(Request::segment(2) == 'reports' && Request::segment(3) == 'product-reviews') active @endif"><a href="{{url($admin_panel_slug)}}/reports/product-reviews">Product Reviews</a></li>
              
              <li class="@if(Request::segment(2) == 'reports' && Request::segment(3) == 'refund') active @endif"><a href="{{url($admin_panel_slug)}}/reports/refund">Refund</a></li>

              <li class="@if(Request::segment(2) == 'reports' && Request::segment(3) == 'cancellation-return') active @endif"><a href="{{url($admin_panel_slug)}}/reports/cancellation-return">Cancellation & Return</a></li>

              <li class="@if(Request::segment(2) == 'reports' && Request::segment(3) == 'replacement') active @endif"><a href="{{url($admin_panel_slug)}}/reports/replacement">Replacement</a></li>
              
              <li class="@if(Request::segment(2) == 'reports' && Request::segment(4) == 'most_viewed_product') active @endif"><a href="{{url($admin_panel_slug)}}/reports/products/most_viewed_product">Most Viewed Product</a></li>

            </ul>

          </li>

          <li class="@if(Request::segment(2) == 'shopping-cart') active @endif">
            <a href="javascript:void(0)">
              <i class="fa fa-shopping-cart"></i>
              <span>Shopping Cart</span>
            </a>
            <ul>
              <li class="@if(Request::segment(3) == 'abandoned') active @endif"><a href="{{url($admin_panel_slug)}}/shopping-cart/abandoned">Abandoned Shopping Cart</a></li>
            </ul>

          </li>

          <li class="@if(Request::segment(2) == 'orders') active @endif">
            <a href="javascript:void(0)">
              <i class="fa fa-shopping-cart"></i>
              <span>Orders</span>
            </a>
            <ul>
              <!-- <li class="@if(Request::segment(3) == 'manage') active @endif"><a href="{{url($admin_panel_slug)}}/orders">Manage</a></li> -->
              <li class="@if(Request::segment(2) == 'orders' && Request::segment(3) == 'new' || Request::segment(4) == 'new') active @endif"><a href="{{url($admin_panel_slug)}}/orders/new">New</a></li>
              <li class="@if(Request::segment(2) == 'orders' && Request::segment(3) == 'past' || Request::segment(4) == 'past') active @endif"><a href="{{url($admin_panel_slug)}}/orders/past">Past</a></li>
              <li class="@if(Request::segment(2) == 'orders' && Request::segment(3) == 'cancelled' || Request::segment(4) == 'cancelled') active @endif"><a href="{{url($admin_panel_slug)}}/orders/cancelled">Cancelled</a></li>
            </ul>

          </li>

          <li class="@if(Request::segment(2) == 'my_orders') active @endif">
            <a href="javascript:void(0)">
              <i class="fa fa-shopping-cart"></i>
              <span>My Orders</span>
            </a>
            <ul>
              <li class="@if(Request::segment(2) == 'my_orders' && Request::segment(3) == 'new') active @endif"><a href="{{url($admin_panel_slug)}}/my_orders/new">New</a></li>
              <li class="@if(Request::segment(2) == 'my_orders' && Request::segment(3) == 'past') active @endif"><a href="{{url($admin_panel_slug)}}/my_orders/past">Past</a></li>
              <li class="@if(Request::segment(2) == 'my_orders' && Request::segment(3) == 'cancelled') active @endif"><a href="{{url($admin_panel_slug)}}/my_orders/cancelled">Cancelled</a></li>
              <li class="@if(Request::segment(2) == 'my_orders' && Request::segment(3) == 'return') active @endif"><a href="{{url($admin_panel_slug)}}/my_orders/return">Return</a></li>
            </ul>

          </li>


          <li class="@if(Request::segment(2) == 'transaction') active @endif">
            <a href="javascript:void(0)">
              <i class="fa fa-money"></i>
              <span>Transaction</span>
            </a>
            <ul>
              <li class="@if(Request::segment(3) == 'wallet') active @endif"><a href="{{url($admin_panel_slug)}}/transaction/wallet">Wallet</a></li>
              <li class="@if(Request::segment(3) == 'product') active @endif"><a href="{{url($admin_panel_slug)}}/transaction/product">Product</a></li>
            </ul>

          </li>

          <li class="@if(Request::segment(2) == 'return_product') active @endif">
            <a href="{{url($admin_panel_slug)}}/return_product"><i class="fa fa-repeat"></i> <span>Product Return Requests</span>
            </a>
          </li>

          <li class="@if(Request::segment(2) == 'replacement_products') active @endif">
            <a href="{{url($admin_panel_slug)}}/replacement_products"><i class="fa fa-refresh"></i> <span>Product Replacement Requests</span>
            </a>
          </li>

          <li class="@if(Request::segment(2) == 'valuation') active @endif">
            <a href="{{url($admin_panel_slug)}}/valuation"><i class="fa fa-ship"></i> <span>Valuation</span>
            </a>
          </li>

          <li class="@if(Request::segment(2) == 'earnings') active @endif">
            <a href="{{url($admin_panel_slug)}}/earnings"><i class="fa fa-money"></i> <span>My Earnings</span>
            </a>
          </li>

          <li class="@if(Request::segment(2) == 'bulk-upload') active @endif">
                  <a href="javascript:void(0)"><i class="fa fa-upload"></i> <span>Bulk Upload</span>
                  </a>
                   <ul>
                    
                    <li class="@if(Request::segment(3) == 'products') active @endif"><a href="{{url($admin_panel_slug)}}/bulk-upload/products">Products</a></li>
                    
                    <li class="@if(Request::segment(3) == 'images') active @endif"><a href="{{url($admin_panel_slug)}}/bulk-upload/images">Images</a></li>
                  </ul>
                </li>


        </ul>
      </div>
    </div>

  </div>
</div>
<div class="content-wrapper {{theme_color()}}">

