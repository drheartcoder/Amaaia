<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <title>{{config('app.project.name')}} | {{$page_title or '404'}}</title>
    
    <!-- ======================================================================== -->
    <!--    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">-->
    <link rel="icon" href="{{url('/front')}}/images/favicon.ico" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="{{url('/front')}}/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <!--font-awesome-css-start-here-->
    <link href="{{url('/front')}}/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!--Custom Css-->
    <link href="{{url('/front')}}/css/amaaia.css" rel="stylesheet" type="text/css" />

    {{-- <link href="{{url('/front')}}/css/animate.css" rel="stylesheet" type="text/css" /> --}}
    <link href="{{url('/front')}}/css/sweetalert.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="{{url('/')}}/front/css/easy-responsive-tabs.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/front/css/custom.css">
    <link href="{{url('/front')}}/css/loading_animate.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{url('/front')}}/css/range-slider.css" />
    <link href="{{url('/front')}}/css/ninja-slider.css" rel="stylesheet" />
    <link href="{{url('/front')}}/css/thumbnail-slider.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/front')}}/css/jquery-ui.css" rel="stylesheet" type="text/css" />


    <!--Main JS-->
    <script type="text/javascript" src="{{url('/front')}}/js/jquery-1.11.3.min.js"></script>
    <script src="{{url('/front')}}/js/ninja-slider.js"></script>
    <script src="{{url('/front')}}/js/thumbnail-slider.js" type="text/javascript"></script>
    <!--tabing-css-js-start-here-->
    <script src="{{url('/front')}}/js/easyResponsiveTabs.js" type="text/javascript"></script>
    <script type="text/javascript" language="javascript" src="{{url('/front')}}/js/bootstrap.min.js"></script> 

    <!--common header footer script end-->
</head>

<body>

    <div id="main"></div>
    <!--Header section start here-->
    <header>
        <div id="header-home">
            <!--<div class="main-banner-block">-->
            <div class="header header-home">
                <div class="container-fluid">
                    <div class="row">
                        
                        @php $is_login = validate_login('user'); @endphp

                        <div class="col-md-3 col-lg-2 hidden-xs hidden-sm hide-from-sticky">
                            @if(isset($is_login) && $is_login == true)
                                @php
                                    $obj_user = '';
                                    $obj_user = login_user_details('user');
                                    $user_image_base_path   = base_path().config('app.project.img_path.user_profile_image');
                                    $user_image_public_path = url('/').config('app.project.img_path.user_profile_image');
                                @endphp
                                <div class="user-profile-name">
                                    <a href="{{url('/')}}/user/dashboard"> 
                                        <span class="innr-user">
                                            @if(isset($obj_user->profile_image) && !empty($obj_user->profile_image) && File::exists($user_image_base_path.$obj_user->profile_image))
                                                @php
                                                    $profile_image_src = get_resized_image($obj_user->profile_image, $user_image_base_path, 40, 38);
                                                @endphp
                                            @else
                                                @php 
                                                    $profile_image_src = url('/').'/uploads/front/user/default_image/default-profile.png';
                                                @endphp
                                            @endif
                                            <img src="{{$profile_image_src or ''}}" alt="Profile picture" />
                                        </span>
                                        <span class="inr-txt">{{$obj_user->first_name or ''}}</span>
                                    </a>
                                </div>
                            @else
                                <div class="login-links-header">
                                    <a href="{{url('/').'/login'}}" class="login-after-line">Login</a>
                                <a href="{{url('/').'/signup'}}">Sign Up</a>
                                </div>
                            @endif
<!--
                            <div class="change-currency-links none-inner">
                                <a class="currency-links change_currency @if(Session::get('get_currency') == 'INR') active @elseif(Session::get('get_currency') != 'USD') active @endif" data-currency="INR" ><i class="fa fa-inr"></i> INR</a>
                                <a class="currency-links change_currency @if(Session::get('get_currency') == 'USD') active @endif" data-currency="USD"><i class="fa fa-usd"></i> USD</a>
                            </div>
-->
                        </div>
                        
                        <div class="col-xs-6 col-sm-3 col-md-6 col-lg-8 hide-from-sticky stiky-heads">
                            <div class="logo-block" style="text-align: center;">
                                <a href="{{url('/')}}">
                                    <img src="{{url('/front')}}/images/ammaia-logo.png" alt="amaaia" class="main-logo" />
                                </a>
                            </div>
                        </div>
                        
                        
                            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-2 right-section-cols stiky-heads-right">
                              
                            
                               <form id="formSearchProducts" method="GET" action="{{ url('/') }}/products">
                                 <div class="login-links-header">
                                <a class="login-after-line inr-cls change_currency @if(Session::get('get_currency') == 'INR') active @elseif(Session::get('get_currency') != 'USD') active @endif" data-currency="INR" ><i class="fa fa-inr"></i> INR</a>
<!--                                <a class="login-after-line inr-cls change_currency @if(Session::get('get_currency') == 'USD') active @endif" data-currency="USD"><i class="fa fa-usd"></i> USD</a>-->
                          
                              </div>
                                <div class="icon-right-headers">
                                    @if(isset($is_login) && $is_login == true)
                                        <div class="commen-link-icn wishlist-link">
                                            <div class="conut-circles wish_list_product_count"></div>
                                            <a href="{{url('/')}}/user/wishlist"></a>
                                        </div>
                                    @endif
                                    <div class="commen-link-icn cart-link">
                                        <div class="conut-circles cart_count">{{get_cart_count()}}</div>
                                        <a href="{{url('/shopping_cart')}}"></a>
                                    </div>
                                    <div class="commen-link-icn search-icns-header">
                                        <button id="buttonsearch" type="button"></button>
                                        <div id="effectsearch" class="ui-corner-allss">
                                            <input type="text" placeholder="Search" id="txt_search" name="search" />
                                        </div>
                                    </div>
                                </div>
                                 </form>
                            </div>
                       

                    <div class="col-xs-2 col-sm-2 col-md-10 col-lg-7 linkhomes">
                        <div class="normal-logo-show">
                            <div class="logo-block">
                                <a href="{{url('/')}}">
                                    <img src="{{url('/front')}}/images/ammaia-logo.png" alt="amaaia" class="main-logo" />
                                </a>
                            </div>
                        </div>
                        <div class="main-middal-menusection-header">
                            <span class="menu-icon" onclick="openNav()">&#9776;</span>
                            <!--Menu Start-->
                            <div class="sidenav">
                                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                                <div class="banner-img-block">

                                    <img src="{{url('/front')}}/images/ammaia-logo.png" alt="Logo" />
                                    <div class="img-responsive-logo"></div>
                                </div>
                            </div>
                            <div class="main-middal-menusection-header">
                                <span class="menu-icon" onclick="openNav()">&#9776;</span>
                                <!--Menu Start-->
                                <div id="mySidenav" class="sidenav">
                                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                                    <div class="banner-img-block">

                                        <img src="{{url('/front')}}/images/ammaia-logo.png" alt="Logo" />
                                        <div class="img-responsive-logo"></div>
                                    </div>
                                    <ul class="min-menu">

                                        @if(isset($arr_menu_categories) && !empty($arr_menu_categories))
                                        @foreach($arr_menu_categories as $arr_category)

                                        <li class="sub-menu"><a href="{{url('/'.str_slug($arr_category['category_name']))}}">{{ $arr_category['category_name'] }}</a>

                                            @php
                                            $arr_subcategories_productline = get_subcategories_productline($arr_category['id'],$arr_category['product_type']);
                                            @endphp

                                            @if(isset($arr_subcategories_productline) && !empty($arr_subcategories_productline))

                                            <ul class="su-menu">

                                                @foreach($arr_subcategories_productline as $sub_line)

                                                <li 
                                                @if(isset($sub_line['arr_product_lines']) && !empty($sub_line['arr_product_lines']))
                                                class="submenus"
                                                @endif
                                                ><a href="{{ url('/') }}/{{ $arr_category['slug'] }}/{{ $sub_line['subcategory_slug'] }}">{{ $sub_line['subcategory_name'] }}</a>

                                                    @if(isset($sub_line['arr_product_lines']) && !empty($sub_line['arr_product_lines']))

                                                    <ul class="su-submenus">

                                                        @foreach($sub_line['arr_product_lines'] as $arr_product_lines)

                                                        <li><a href="{{ url('/') }}/{{ $arr_category['slug'] }}/{{ $sub_line['subcategory_slug'] }}/{{ $arr_product_lines['slug'] }}">{{ $arr_product_lines['product_line_name'] }}</a></li>

                                                        @endforeach

                                                    </ul>

                                                    @endif

                                                </li>

                                                @endforeach

                                            </ul>

                                            @endif

                                        </li>

                                        @endforeach

                                        @endif

                                        <li class="mega-menu sub-menu"><a href="{{url('/')}}/services">Services</a>
                                            <ul class="su-menu">
                                              <div class="container">
                                               <div class="col-md-3 col-lg-3">
<!-- <div class="title-services-nms">Services Title Here</div>-->
                                                <li><a href="{{url('/services/load_and_finance')}}">Loan &amp; Financing</a></li>
                                                <li><a href="{{url('/services/gift_certificate')}}">Gift Certificate</a></li>
                                                <li><a href="{{url('/services/payment_options')}}">Payment Options</a></li>
                                               </div>
                                               <div class="col-md-3 col-lg-3">
<!-- <div class="title-services-nms">Services Title Here</div>-->
                                                 <li><a href="{{url('/services/insurance')}}">Insurance</a></li>
                                                 <li><a href="{{url('/services/babu_service')}}">Babu Service</a></li>
                                                 <li><a href="{{url('/services/sst')}}">SST</a></li>
                                                </div>
                                                <div class="col-md-3 col-lg-3">
<!-- <div class="title-services-nms">Services Title Here</div>-->
                                                 <li><a href="{{url('/services/buy_back')}}">Buy Back and Sell Back</a></li>
                                                 <li><a href="{{url('/services/policy')}}">Delivery &amp; Return Policy</a></li>
                                                 <li><a href="{{url('/services/auction_bidding')}}">Auction / Bidding</a></li>
                                                 <li><a href="{{url('/services/story')}}">Story</a></li>
                                                </div>
                                                <div class="col-md-3 col-lg-3">
<!-- div class="title-services-nms">Services Title Here</div>-->
                                                 <li><a href="{{url('/services/valuation')}}">Valuation</a></li>
                                                 <li><a href="{{url('/services/cleaning')}}">Cleaning</a></li>
                                                 <li><a href="{{url('/services/recut')}}">Recut</a></li>
                                                </div>
                                                </div>
                                            </ul>
                                        </li>
                                        
                                        @if(isset($arr_menu_collection) && !empty($arr_menu_collection))
                                            <li class="sub-menu"><a href="{{url('/collection')}}">Collection</a>
                                                <ul class="su-menu">
                                                    @foreach($arr_menu_collection as $arr_collection)

                                                        @php
                                                            $collection_id = isset($arr_collection['id']) ? $arr_collection['id'] : '';
                                                            $collection_name = isset($arr_collection['name']) ? $arr_collection['name'] : '';
                                                            $collection_slug = isset($arr_collection['slug']) ? $arr_collection['slug'] : '';
                                                        @endphp
                                                        
                                                        <li><a href="{{ url('/') }}/collection/{{ $collection_slug }}">{{ $collection_name }}</a></li>
                                                        
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endif

                                        <li><a href="{{url('/curation')}}">Curation</a></li>
                                        <li><a href="{{url('/tieup')}}">Tieup</a></li>

                                        @if(isset($is_login) && $is_login == false)
                                        <li class="loginhides"><a href="{{url('/').'/login'}}">Login</a></li>
                                        <li class="loginhides"><a href="{{url('/').'/signup'}}">Sign Up</a></li>
                                        @else

                                        <li class="loginhides"><a href="{{url('/').'/user/dashboard'}}">{{$obj_user->first_name or ''}} {{$obj_user->last_name or ''}}</a></li>
                                        <li class="loginhides"><a href="{{url('/').'/user/logout'}}">Logout</a></li>

                                        @endif

                                    </ul>
                                    <div class="clr"></div>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>

                <div class="clr"></div>
            </div>
            <div class="clr"></div>

        </div>
        <div class="blank-div"></div>
    </header>

    <script>
        function get_wishlist_count()
        {
            $.ajax({
                url:'{{url('/')}}/get_wishlist_count',
                type:'get',
                success:function(data){
                    $('.wish_list_product_count').html(data);
                }
            });
        }
        get_wishlist_count();

        $("#effectsearch").click(function(){
            var txt_search = $("#txt_search").val();

            if($.trim(txt_search) !='' )

            {
                $("#formSearchProducts").submit();
            }
        });

        $(".change_currency").click(function()
        {
            var currency = $(this).data('currency');

            $.ajax({
                'url':'{{ url("/") }}/set_currency/'+currency,                    
                'type':'get',
                'data':{currency:currency},
                success:function(response)
                {
                    if(response.status == 'success')
                    {
                        location.reload();
                    }
                }
            });
        });
    </script> 