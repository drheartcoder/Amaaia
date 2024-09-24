<!-- Page container -->
<div class="page-container">

  <!-- Page content -->
  <div class="page-content">

    <!-- Main sidebar -->
    <div class="sidebar sidebar-main {{supplier_sidebar_color()}}">
      <div class="sidebar-content">


        <!-- User menu -->
        <div class="sidebar-user">
          <div class="category-content">
            <div class="media">
              <a href="{{url('/')}}/supplier/account_setting/personal" class="media-left">
                @php 
                $supplier_profile_img =  isset($shared_supplier_details['profile_image'])  ? $shared_supplier_details['profile_image'] : "";
                $profile_image_src = ""; 
                @endphp
                @if(isset($supplier_profile_img) &&  $supplier_profile_img!="" && file_exists($profile_image_base_img_path.$supplier_profile_img))
                @php
                $profile_image_src = $profile_image_public_img_path.$supplier_profile_img;
                @endphp
                @else
                @php
                $profile_image_src =url('/')."/uploads/supplier/default_image/default-profile.png";
                @endphp
                @endif
                <img src="{{$profile_image_src}}" class="img-circle img-sm" alt="Profile Image"></a>
                <div class="media-body">
                  <span class="media-heading text-semibold">{{$shared_supplier_details['first_name'] or ''}} {{$shared_supplier_details['last_name'] or ''}}</span>
                  <div class="text-size-mini text-muted">
                    <i class="icon-pin text-size-small"></i> &nbsp;{{$shared_supplier_details['address'] or ''}}
                  </div>
                </div>

                <div class="media-right media-middle">
                  <ul class="icons-list">
                    <li>
                      <a href="{{url('/')}}/supplier/account_setting/personal"><i class="icon-cog3"></i></a>
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
                <li class="@if(Request::segment(2) == 'dashboard') active @endif"><a href="{{url('/')}}/supplier/dashboard"><i class="icon-home4"></i> <span>Dashboard</span></a></li>

                <li class="@if(Request::segment(2) == 'categories') active @endif">
                  <a href="javascript:void(0)">
                    <i class="fa fa-cogs"></i>
                    <span>Account Setting</span>
                  </a>
                  <ul class="submenu">
                    <li style="display: block;" class="@if(Request::segment(2) == 'account_setting' && Request::segment(3) == 'personal') active @endif"><a href="{{ url($supplier_panel_slug.'/account_setting/personal')}}">Personal Details</a></li>
                    <li style="display: block;" class="@if(Request::segment(2) == 'account_setting' && Request::segment(3) == 'business') active @endif"><a href="{{ url($supplier_panel_slug.'/account_setting/business')}}">Business Details </a></li>
                    <li style="display: block;" class="@if(Request::segment(2) == 'account_setting' && Request::segment(3) == 'financial') active @endif"><a href="{{ url($supplier_panel_slug.'/account_setting/financial')}}">Financial Details </a></li>
                  </ul>
                </li>
                <li class="@if(Request::segment(2) == 'product') active @endif">
                  <a href="#"><i class="icon-pencil3"></i> <span>Products</span></a>
                  <ul>
                    <li class="@if(Request::segment(2) == 'product' && Request::segment(3) == 'jewellery') active @endif">
                      <a href="#">Jewellery</a>
                      <ul>
                        <li class="@if(Request::segment(2) == 'product' && Request::segment(3) == 'jewellery' && Request::segment(4) != 'create') active @endif"><a href="{{url($supplier_panel_slug)}}/product/jewellery">Manage</a></li>
                        <li class="@if(Request::segment(3) == 'jewellery' && Request::segment(4) == 'create') active @endif"><a href="{{url($supplier_panel_slug)}}/product/jewellery/create">Create</a></li>
                      </ul>
                    </li>
                    {{-- <li>
                      <a href="#">Diamond</a>
                      <ul>
                        <li><a href="javascript:void(0)">Manage</a></li>
                        <li><a href="javascript:void(0)">Create</a></li>

                      </ul>
                    </li> --}}
                  </ul>
                </li>

                <li class="@if(Request::segment(2) == 'notifications') active @endif">
                  <a href="{{url($supplier_panel_slug)}}/notifications"><i class="fa fa-bell"></i> <span>Notifications</span>
                  </a>
                </li>

                <li class="@if(Request::segment(2) == 'orders') active @endif">
                  <a href="javascript:void(0)">
                    <i class="fa fa-shopping-cart"></i>
                    <span>My Orders</span>
                  </a>
                  <ul>
                    <!-- <li class="@if(Request::segment(3) == 'manage') active @endif"><a href="{{url($supplier_panel_slug)}}/orders">Manage</a></li> -->
                    <li class="@if(Request::segment(3) == 'new' || Request::segment(3) == 'order_product' && Request::segment(4) == 'new') active @endif"><a href="{{url($supplier_panel_slug)}}/orders/new">New</a></li>
                    <li class="@if(Request::segment(3) == 'past' || Request::segment(3) == 'order_product' && Request::segment(4) == 'past') active @endif"><a href="{{url($supplier_panel_slug)}}/orders/past">Past</a></li>
                    <li class="@if(Request::segment(3) == 'cancelled' || Request::segment(3) == 'order_product' && Request::segment(4) == 'cancelled') active @endif"><a href="{{url($supplier_panel_slug)}}/orders/cancelled">Cancelled</a></li>
                    <li class="@if(Request::segment(3) == 'return' || Request::segment(3) == 'order_product' && Request::segment(4) == 'return') active @endif"><a href="{{url($supplier_panel_slug)}}/orders/return">Return</a></li>
                  </ul>

                </li>

                <li class="@if(Request::segment(2) == 'earnings') active @endif">
                  <a href="{{url($supplier_panel_slug)}}/earnings"><i class="fa fa-money"></i> <span>My Earnings</span>
                  </a>
                </li>

                <li class="@if(Request::segment(2) == 'bulk-upload') active @endif">
                  <a href="javascript:void(0)"><i class="fa fa-upload"></i> <span>Bulk Upload</span>
                  </a>
                   <ul>
                    
                    <li class="@if(Request::segment(3) == 'products') active @endif"><a href="{{url($supplier_panel_slug)}}/bulk-upload/products">Products</a></li>
                    
                    <li class="@if(Request::segment(3) == 'images') active @endif"><a href="{{url($supplier_panel_slug)}}/bulk-upload/images">Images</a></li>
                  </ul>
                </li>
                
              </ul>
            </div>
          </div>

        </div>
      </div>
      <div class="content-wrapper {{supplier_body_color()}}">

