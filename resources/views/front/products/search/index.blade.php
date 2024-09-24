@extends('front.layout.master')
@section('main_content')

@php
    $category_name               = isset($category['category_name']) ? $category['category_name'] : '';
    $sub_category_name           = isset($sub_category['subcategory_name']) ? $sub_category['subcategory_name'] : '';

    $category_slug               = isset($category['slug']) ? $category['slug'] : '';
    $sub_category_slug           = isset($sub_category['slug']) ? $sub_category['slug'] : '';
    $active_product_line_slug    = isset($product_line['slug']) ? $product_line['slug'] : '';

    $arr_products_data           = isset($arr_products['data']) ? $arr_products['data'] : '';
    $count_products              = isset($arr_products['data']) ? count($arr_products['data']) : 0;

    // For products filter 
    $arr_product_metalstype      = isset($arr_productfilters['arr_product_metalstype']) ? $arr_productfilters['arr_product_metalstype'] : '';
    $arr_product_metalscolor     = isset($arr_productfilters['arr_product_metalscolor']) ? $arr_productfilters['arr_product_metalscolor'] : '';
    $arr_product_metalsquality   = isset($arr_productfilters['arr_product_metalsquality']) ? $arr_productfilters['arr_product_metalsquality'] : '';
    $arr_product_gemstonetype    = isset($arr_productfilters['arr_product_gemstonetype']) ? $arr_productfilters['arr_product_gemstonetype'] : '';
    $arr_product_gemstonecolor   = isset($arr_productfilters['arr_product_gemstonecolor']) ? $arr_productfilters['arr_product_gemstonecolor'] : '';
    $arr_product_gemstonequality = isset($arr_productfilters['arr_product_gemstonequality']) ? $arr_productfilters['arr_product_gemstonequality'] : '';
    $arr_product_gemstoneshape   = isset($arr_productfilters['arr_product_gemstoneshape']) ? $arr_productfilters['arr_product_gemstoneshape'] : '';
    $arr_product_occasions       = isset($arr_productfilters['arr_product_occasions']) ? $arr_productfilters['arr_product_occasions'] : '';
    $arr_product_collection      = isset($arr_productfilters['arr_product_collection']) ? $arr_productfilters['arr_product_collection'] : '';
    $arr_product_look            = isset($arr_productfilters['arr_product_look']) ? $arr_productfilters['arr_product_look'] : '';
    $arr_product_setting         = isset($arr_productfilters['arr_product_setting']) ? $arr_productfilters['arr_product_setting'] : '';
    $arr_product_metaldetailing  = isset($arr_productfilters['arr_product_metaldetailing']) ? $arr_productfilters['arr_product_metaldetailing'] : '';
    $arr_product_shanktype       = isset($arr_productfilters['arr_product_shanktype']) ? $arr_productfilters['arr_product_shanktype'] : '';
    $arr_product_ringshoulder    = isset($arr_productfilters['arr_product_ringshoulder']) ? $arr_productfilters['arr_product_ringshoulder'] : '';
    $arr_product_bandsetting     = isset($arr_productfilters['arr_product_bandsetting']) ? $arr_productfilters['arr_product_bandsetting'] : '';

    // For products filter data
    $filter_metaltype            = isset($result_filters['filter_metaltype']) ? $result_filters['filter_metaltype'] : '';
    $filter_metalcolor           = isset($result_filters['filter_metalcolor']) ? $result_filters['filter_metalcolor'] : '';
    $filter_metalquality         = isset($result_filters['filter_metalquality']) ? $result_filters['filter_metalquality'] : '';
    $filter_gemstonetype         = isset($result_filters['filter_gemstonetype']) ? $result_filters['filter_gemstonetype'] : '';
    $filter_gemstonecolor        = isset($result_filters['filter_gemstonecolor']) ? $result_filters['filter_gemstonecolor'] : '';
    $filter_gemstonequality      = isset($result_filters['filter_gemstonequality']) ? $result_filters['filter_gemstonequality'] : '';
    $filter_gemstoneshape        = isset($result_filters['filter_gemstoneshape']) ? $result_filters['filter_gemstoneshape'] : '';
    $filter_occasions            = isset($result_filters['filter_occasions']) ? $result_filters['filter_occasions'] : '';
    $filter_collection           = isset($result_filters['filter_collection']) ? $result_filters['filter_collection'] : '';
    $filter_look                 = isset($result_filters['filter_look']) ? $result_filters['filter_look'] : '';
    $filter_setting              = isset($result_filters['filter_setting']) ? $result_filters['filter_setting'] : '';
    $filter_metaldetailing       = isset($result_filters['filter_metaldetailing']) ? $result_filters['filter_metaldetailing'] : '';
    $filter_shanktype            = isset($result_filters['filter_shanktype']) ? $result_filters['filter_shanktype'] : '';
    $filter_ringshoulder         = isset($result_filters['filter_ringshoulder']) ? $result_filters['filter_ringshoulder'] : '';
    $filter_bandsetting          = isset($result_filters['filter_bandsetting']) ? $result_filters['filter_bandsetting'] : '';
    $filter_delivery_days        = isset($result_filters['filter_delivery_days']) ? $result_filters['filter_delivery_days'] : '';
    $filter_min_price            = isset($result_filters['filter_min_price']) ? $result_filters['filter_min_price'] : '';
    $filter_max_price            = isset($result_filters['filter_max_price']) ? $result_filters['filter_max_price'] : '';
    $filter_min_weight           = isset($result_filters['filter_min_weight']) ? $result_filters['filter_min_weight'] : '';
    $filter_max_weight           = isset($result_filters['filter_max_weight']) ? $result_filters['filter_max_weight'] : '';
    $filter_sort_by              = isset($result_filters['filter_sort_by']) ? $result_filters['filter_sort_by'] : '';

    // for range slider for default price and weight
        $min_price           = '0';
        $max_price           = '2500000';
        $min_weight          = '0';
        $max_weight          = '20';

    if($filter_min_price != null && $filter_max_price != null)
    {
        $selected_min_price  = $filter_min_price;
        $selected_max_price  = $filter_max_price;
    }
    else
    {
        $selected_min_price  = $min_price;
        $selected_max_price  = $max_price;
    }

    if($filter_min_weight != null && $filter_max_weight != null)
    {
        $selected_min_weight = $filter_min_weight;
        $selected_max_weight = $filter_max_weight;
    }
    else
    {
        $selected_min_weight = $min_weight;
        $selected_max_weight = $max_weight;
    }
@endphp


<div class="bradcrum-inner">
    <div class="pul-left-title">
       {{ $page_title }}
    </div>
    <div class="pul-right-sublink">
        <a href="{{ url('/') }}">Home</a>
    </div>
    <div class="clearfix"></div>
</div>
<div class="min-hieght-class">

<div class="container-fluid">

 <div class="col-md-12">
    <div  class="menu-filter-menu">
       <span class="municnons" onclick="openNavs()">Filters By &#9776;</span>
        <div id="filterID" class="sidenav show-menu">
        <form id="formProductFilter" method="GET" action="{{ $module_url_path }}">
            
        <input type="hidden" name="search" value="{{ $serach_keyword }}">

        <ul class="min-menu">
            <li class="filtersbye">Filters By</li>
            
            <!-- Metal Start-->
            <li class="mega-menu sub-menu"><a href="javascript:void(0)">Metal <span class="arrows-list"></span></a> 
                <!--Add Active class to the anchor tag "active"-->
                
                <ul class="su-menu">
                    <li>
                        
                    @if(isset($arr_product_metalstype) && !empty($arr_product_metalstype))
                        <div class="min-sublist">
                            <div class="type-maib-su">
                                <div class="type-left-su">
                                    Type
                                </div>
                                <div class="type-right-su">
                                    <div class="row">
                                        
                                        @foreach($arr_product_metalstype as $metalstype)
                                        @php
                                            $metaltype_id = isset($metalstype['id']) ? $metalstype['id'] : '';
                                            $metal_name = isset($metalstype['metal_name']) ? $metalstype['metal_name'] : '';
                                        @endphp
                                            <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                <div class="radio-btn">
                                                    <input type="radio" id="metal_type_{{ $metaltype_id }}" name="metalstype" value="{{ $metal_name }}" @if($filter_metaltype == $metal_name) checked @endif>
                                                    <label for="metal_type_{{ $metaltype_id }}">{{ $metal_name }}</label>
                                                    <div class="check"></div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(isset($arr_product_metalscolor) && !empty($arr_product_metalscolor))
                        <div class="min-sublist">
                            <div class="type-maib-su">
                                <div class="type-left-su">
                                    Color
                                </div>
                                <div class="type-right-su">
                                    <div class="row">
                                        
                                        @foreach($arr_product_metalscolor as $metalscolor)
                                        @php
                                            $metalcolor_id = isset($metalscolor['id']) ? $metalscolor['id'] : '';
                                            $metal_color = isset($metalscolor['metal_color']) ? $metalscolor['metal_color'] : '';
                                        @endphp
                                            <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                <div class="radio-btn">
                                                    <input type="radio" id="metal_color_{{ $metalcolor_id }}" name="metalscolor" value="{{ $metal_color }}" @if($filter_metalcolor == $metal_color) checked @endif>
                                                    <label for="metal_color_{{ $metalcolor_id }}">{{ $metal_color }}</label>
                                                    <div class="check"></div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(isset($arr_product_metalsquality) && !empty($arr_product_metalsquality))    
                        <div class="min-sublist">
                            <div class="type-maib-su">
                                <div class="type-left-su">
                                    Quality
                                </div>
                                <div class="type-right-su">
                                    <div class="row">
                                        
                                        @foreach($arr_product_metalsquality as $metalsquality)
                                        @php
                                            $metalquality_id = isset($metalsquality['id']) ? $metalsquality['id'] : '';
                                            $metal_quality = isset($metalsquality['quality_name']) ? $metalsquality['quality_name'] : '';
                                        @endphp
                                            <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                <div class="radio-btn">
                                                    <input type="radio" id="metal_quality_{{ $metalquality_id }}" name="metalsquality" value="{{ $metal_quality }}" @if($filter_metalquality == $metal_quality) checked @endif>
                                                    <label for="metal_quality_{{ $metalquality_id }}">{{ $metal_quality }}</label>
                                                    <div class="check"></div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    </li>
                </ul>
            </li>
            <!-- Metal End-->
        

        
        
            <!-- Gemstone Start-->
            <li class="mega-menu sub-menu"><a href="javascript:void(0)">Gemstone <span class="arrows-list"></span></a>
                <ul class="su-menu">
                    <li>
                        
                    @if(isset($arr_product_gemstonetype) && !empty($arr_product_gemstonetype))
                        <div class="min-sublist">
                            <div class="type-maib-su">
                                <div class="type-left-su">
                                    Type
                                </div>
                                <div class="type-right-su">
                                    <div class="row">
                                        
                                        @foreach($arr_product_gemstonetype as $gemstonetype)
                                        @php
                                            $gemstonetype_id = isset($gemstonetype['id']) ? $gemstonetype['id'] : '';
                                            $gemstone_type = isset($gemstonetype['type']) ? $gemstonetype['type'] : '';
                                        @endphp
                                            <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                <div class="radio-btn">
                                                    <input type="radio" id="gemstone_type_{{ $gemstonetype_id }}" name="gemstonetype" value="{{ $gemstone_type }}" @if($filter_gemstonetype == $gemstone_type) checked @endif>
                                                    <label for="gemstone_type_{{ $gemstonetype_id }}">{{ $gemstone_type }}</label>
                                                    <div class="check"></div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    @if(isset($arr_product_gemstonecolor) && !empty($arr_product_gemstonecolor))
                        <div class="min-sublist">
                            <div class="type-maib-su">
                                <div class="type-left-su">
                                    Color
                                </div>
                                <div class="type-right-su">
                                    <div class="row">

                                        @foreach($arr_product_gemstonecolor as $gemstonecolor)
                                        @php
                                            $gemstonecolor_id = isset($gemstonecolor['id']) ? $gemstonecolor['id'] : '';
                                            $gemstone_color = isset($gemstonecolor['gemstone_color']) ? $gemstonecolor['gemstone_color'] : '';
                                        @endphp
                                            <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                <div class="radio-btn">
                                                    <input type="radio" id="gemstone_color_{{ $gemstonecolor_id }}" name="gemstonecolor" value="{{ $gemstone_color }}" @if($filter_gemstonecolor == $gemstone_color) checked @endif>
                                                    <label for="gemstone_color_{{ $gemstonecolor_id }}">{{ $gemstone_color }}</label>
                                                    <div class="check"></div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(isset($arr_product_gemstonequality) && !empty($arr_product_gemstonequality))
                        <div class="min-sublist">
                            <div class="type-maib-su">
                                <div class="type-left-su">
                                    Quality
                                </div>
                                <div class="type-right-su">
                                    <div class="row">
                                        
                                        @foreach($arr_product_gemstonequality as $gemstonequality)
                                        @php
                                            $gemstonequality_id = isset($gemstonequality['id']) ? $gemstonequality['id'] : '';
                                            $gemstone_quality = isset($gemstonequality['gemstone_quality']) ? $gemstonequality['gemstone_quality'] : '';
                                        @endphp
                                            <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                <div class="radio-btn">
                                                    <input type="radio" id="gemstone_quality_{{ $gemstonequality_id }}" name="gemstonequality" value="{{ $gemstone_quality }}" @if($filter_gemstonequality == $gemstone_quality) checked @endif>
                                                    <label for="gemstone_quality_{{ $gemstonequality_id }}">{{ $gemstone_quality }}</label>
                                                    <div class="check"></div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                        
                    @if(isset($arr_product_gemstoneshape) && !empty($arr_product_gemstoneshape))
                        <div class="min-sublist">
                            <div class="type-maib-su">
                                <div class="type-left-su">
                                    Shape
                                </div>
                                <div class="type-right-su">
                                    <div class="row">
                                        
                                        @foreach($arr_product_gemstoneshape as $gemstoneshape)
                                        @php
                                            $gemstoneshape_id = isset($gemstoneshape['id']) ? $gemstoneshape['id'] : '';
                                            $gemstone_shape = isset($gemstoneshape['shape_name']) ? $gemstoneshape['shape_name'] : '';
                                        @endphp
                                            <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                <div class="radio-btn">
                                                    <input type="radio" id="gemstone_shape_{{ $gemstoneshape_id }}" name="gemstoneshape" value="{{ $gemstone_shape }}" @if($filter_gemstoneshape == $gemstone_shape) checked @endif>
                                                    <label for="gemstone_shape_{{ $gemstoneshape_id }}">{{ $gemstone_shape }}</label>
                                                    <div class="check"></div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    </li>
                </ul>
            </li>
            <!-- Gemstone End-->
             
             
            @if(isset($arr_product_occasions) && !empty($arr_product_occasions))
                <!-- Occasion Start-->
                <li class="mega-menu sub-menu"><a href="javascript:void(0)">Occasion <span class="arrows-list"></span></a>
                    <ul class="su-menu">
                        <li>
                            
                            <div class="min-sublist">
                                <div class="type-maib-su">
                                    <div class="type-right-su">
                                        <div class="row">
                                            
                                            @foreach($arr_product_occasions as $arr_occasions)
                                            @php
                                                $occasions_checked = "";
                                                $occasions_id = isset($arr_occasions['id']) ? $arr_occasions['id'] : '';
                                                $occasions_name = isset($arr_occasions['occasion_name']) ? $arr_occasions['occasion_name'] : '';
                                                $occasions_slug = isset($arr_occasions['slug']) ? $arr_occasions['slug'] : '';

                                                if(null !== $filter_occasions && !empty($filter_occasions))
                                                {
                                                    if(in_array($occasions_slug, $filter_occasions))
                                                    {
                                                        $occasions_checked = "checked";
                                                    }
                                                }
                                            @endphp
                                                <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                    <div class="check-box inline-checkboxs">
                                                        <input type="checkbox" id="occasions_{{ $occasions_id }}" class="filled-in occasions_checkbox" value="{{ $occasions_slug }}" data-id="{{ $occasions_id }}" data-slug="{{ $occasions_slug }}" {{ $occasions_checked }} />
                                                        <label for="occasions_{{ $occasions_id }}">{{ $occasions_name }}</label>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <input type="hidden" name="occasions" id="occasions_selected_checkbox">

                                        </div>
                                    </div>
                                </div>
                            </div>
                                    
                        </li>
                    </ul>
                </li>
                <!-- Occasion End-->
            @endif
              
              
            @if(isset($arr_product_collection) && !empty($arr_product_collection))
                <!-- Collection Start-->
                <li class="mega-menu sub-menu"><a href="javascript:void(0)">Collection <span class="arrows-list"></span></a>
                    <ul class="su-menu">
                        <li>
                            <div class="min-sublist">
                                <div class="type-maib-su">
                                    <div class="type-right-su">
                                        <div class="row">
                                            
                                            @foreach($arr_product_collection as $arr_collection)
                                            @php
                                                $collection_checked = "";
                                                $collection_id = isset($arr_collection['id']) ? $arr_collection['id'] : '';
                                                $collection_name = isset($arr_collection['name']) ? $arr_collection['name'] : '';
                                                $collection_slug = isset($arr_collection['slug']) ? $arr_collection['slug'] : '';

                                                if(null !== $filter_collection && !empty($filter_collection))
                                                {
                                                    if(in_array($collection_slug, $filter_collection))
                                                    {
                                                        $collection_checked = "checked";
                                                    }
                                                }
                                            @endphp
                                            <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                <div class="check-box inline-checkboxs">
                                                    <input type="checkbox" id="collection_{{ $collection_id }}" class="filled-in collection_checkbox" value="{{ $collection_name }}" data-id="{{ $collection_id }}" data-slug="{{ $collection_slug }}" {{ $collection_checked }} />
                                                    <label for="collection_{{ $collection_id }}">{{ $collection_name }}</label>
                                                </div>
                                            </div>
                                            @endforeach

                                            <input type="hidden" name="collection" id="collection_selected_checkbox">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Collection End-->
            @endif
              
              
            @if(isset($arr_product_look) && !empty($arr_product_look))
                <!-- Look Start-->
                <li class="mega-menu sub-menu"><a href="javascript:void(0)">Look <span class="arrows-list"></span></a>
                    <ul class="su-menu">
                        <li>
                            <div class="min-sublist">
                                <div class="type-maib-su">
                                    <div class="type-right-su">
                                        <div class="row">
                                            
                                            @foreach($arr_product_look as $arr_look)
                                            @php
                                                $look_checked = "";

                                                $look_id = isset($arr_look['id']) ? $arr_look['id'] : '';
                                                $look_name = isset($arr_look['look']) ? $arr_look['look'] : '';
                                                $look_slug = isset($arr_look['slug']) ? $arr_look['slug'] : '';

                                                if(null !== $filter_look && !empty($filter_look))
                                                {
                                                    if(in_array($look_slug, $filter_look))
                                                    {
                                                        $look_checked = "checked";
                                                    }
                                                }
                                            @endphp
                                            <div class="col-sx-12 col-sm-6 col-md-4 col-lg-3">
                                                <div class="check-box inline-checkboxs">
                                                    <input type="checkbox" id="look_{{ $look_id }}" class="filled-in look_checkbox" value="{{ $look_name }}" data-id="{{ $look_id }}" data-slug="{{ $look_slug }}" {{ $look_checked }} />
                                                    <label for="look_{{ $look_id }}">{{ $look_name }}</label>
                                                </div>
                                            </div>
                                            @endforeach

                                            <input type="hidden" name="look" id="look_selected_checkbox">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Look End-->
            @endif
            
            
            <!-- Price Start-->
            <li class="mega-menu sub-menu"><a href="javascript:void(0)">Price <span class="arrows-list"></span></a>
                <ul class="su-menu">
                    <li>
                        <div class="min-sublist">
                            <div class="type-maib-su">
                                <div class="type-right-su">
                                    <div class="row">
                                        
                                        <div class="main-list-box-settings">
                                            <div class="range-t input-bx" for="amount">
                                                <div class="slider-rang slider-price-range" id="slider-price-range"></div>
                                                <div class="amount-no slider_price_range_txt" id="slider_price_range_txt"></div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="min_price" id="min_price">
                                        <input type="hidden" name="max_price" id="max_price">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
            <!-- Price End-->
             
            <!-- Additional Filter Start-->
            <li class="additional-filter"><a id="flipdashboard-addistional" href="javascript:void(0)">Additional Filter</a></li>
            <!-- Additional Filter End-->
              
            <li class="fzcleafilter">
                <button type="submit" id="btn_products_filter" class="button-shop-filter" ><span>Apply Filters</span></button>
                <a id="btn_form_reset" class="button-shop-filter" href="javascript:void(0)"><span>Clear Filters</span></a>
            </li>
        </ul>
        </div>

        <div id="paneldashboard-addistional" class="pannel-content-lisitng">
            
            <div class="row">
                
                @if(isset($arr_product_setting) && !empty($arr_product_setting))
                    <div class="col-md-4">
                        <div class="title-setting-adistional-filter">
                           Setting 
                        </div>
                        <div class="main-list-box-settings">
                            
                            @foreach($arr_product_setting as $arr_setting)
                            @php
                                $setting_checked = "";

                                $setting_id = isset($arr_setting['id']) ? $arr_setting['id'] : '';
                                $setting_name = isset($arr_setting['setting']) ? $arr_setting['setting'] : '';
                                $setting_slug = isset($arr_setting['slug']) ? $arr_setting['slug'] : '';

                                if(null !== $filter_setting && !empty($filter_setting))
                                {
                                    if(in_array($setting_slug, $filter_setting))
                                    {
                                        $setting_checked = "checked";
                                    }
                                }
                            @endphp
                                <div class="check-box inline-checkboxs">
                                    <input type="checkbox" id="setting_{{ $setting_id }}" class="filled-in setting_checkbox" value="{{ $setting_slug }}" data-id="{{ $setting_id }}" data-slug="{{ $setting_slug }}" {{ $setting_checked }} />
                                    <label for="setting_{{ $setting_id }}">{{ $setting_name }}</label>
                                </div>
                            @endforeach

                            <input type="hidden" name="setting" id="setting_selected_checkbox">

                        </div>
                    </div>
                @endif

                <div class="col-md-4">
                    <div class="title-setting-adistional-filter">
                       Delivery Date
                    </div>
                    @php
                        $delivery_days_05_checked = "";
                        $delivery_days_510_checked = "";
                        $delivery_days_1020_checked = "";
                        $delivery_days_2030_checked = "";

                        if(null !== $filter_delivery_days && !empty($filter_delivery_days))
                        {
                            if(in_array("0-5", $filter_delivery_days))
                            {
                                $delivery_days_05_checked = "checked";
                            }
                            if(in_array("5-10", $filter_delivery_days))
                            {
                                $delivery_days_510_checked = "checked";
                            }
                            if(in_array("10-20", $filter_delivery_days))
                            {
                                $delivery_days_1020_checked = "checked";
                            }
                            if(in_array("20-30", $filter_delivery_days))
                            {
                                $delivery_days_2030_checked = "checked";
                            }
                        }
                    @endphp
                    <div class="main-list-box-settings">
                        <div class="check-box inline-checkboxs">
                            <input class="filled-in delivery_days_checkbox" type="checkbox" id="delivery_days_05" value="0-5" {{ $delivery_days_05_checked }} />
                            <label for="delivery_days_05">0-5 Days</label>
                            <div class="check"></div>
                        </div>
                        <div class="check-box inline-checkboxs">
                            <input class="filled-in delivery_days_checkbox" type="checkbox" id="delivery_days_510" value="5-10" {{ $delivery_days_510_checked }} />
                            <label for="delivery_days_510">5-10 Days</label>
                            <div class="check"><div class="inside"></div></div>
                        </div>
                        <div class="check-box inline-checkboxs">
                            <input class="filled-in delivery_days_checkbox" type="checkbox" id="delivery_days_1020" value="10-20" {{ $delivery_days_1020_checked }} />
                            <label for="delivery_days_1020">10-20 Days</label>
                            <div class="check"></div>
                        </div>
                        <div class="check-box inline-checkboxs">
                            <input class="filled-in delivery_days_checkbox" type="checkbox" id="delivery_days_2030" value="20-30" {{ $delivery_days_2030_checked }} />
                            <label for="delivery_days_2030">20-30 Days</label>
                            <div class="check"></div>
                        </div>

                        <input type="hidden" name="delivery_days" id="delivery_days_selected_checkbox">

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="title-setting-adistional-filter">
                       Weight
                    </div>
                    <div class="main-list-box-settings">
                        
                        <div class="range-t input-bx" for="amount">
                            <div id="slider-weight-range" class="slider-rang slider-price-range"></div>
                            <div class="amount-no slider_price_range_txt" id="slider_weight_range_txt"></div>
                        </div>

                        <input type="hidden" name="min_weight" id="min_weight">
                        <input type="hidden" name="max_weight" id="max_weight">

                    </div>
                </div>
                
                @if(isset($arr_product_metaldetailing) && !empty($arr_product_metaldetailing))
                    <div class="col-md-4">
                        <div class="title-setting-adistional-filter">
                          Metal Detailing
                        </div>
                        <div class="main-list-box-settings">
                                
                            @foreach($arr_product_metaldetailing as $arr_metaldetailing)
                            @php
                                $metaldetailing_checked = "";

                                $metaldetailing_id = isset($arr_metaldetailing['id']) ? $arr_metaldetailing['id'] : '';
                                $metaldetailing_name = isset($arr_metaldetailing['metal_detailing_name']) ? $arr_metaldetailing['metal_detailing_name'] : '';
                                $metaldetailing_slug = isset($arr_metaldetailing['slug']) ? $arr_metaldetailing['slug'] : '';

                                if(null !== $filter_metaldetailing && !empty($filter_metaldetailing))
                                {
                                    if(in_array($metaldetailing_slug, $filter_metaldetailing))
                                    {
                                        $metaldetailing_checked = "checked";
                                    }
                                }
                            @endphp
                                <div class="check-box inline-checkboxs">
                                    <input class="filled-in metaldetailing_checkbox" type="checkbox" id="metaldetailing_{{ $metaldetailing_id }}" value="{{ $metaldetailing_slug }}" data-id="{{ $metaldetailing_id }}" data-slug="{{ $metaldetailing_slug }}" {{ $metaldetailing_checked }} />
                                    <label for="metaldetailing_{{ $metaldetailing_id }}">{{ $metaldetailing_name }}</label>
                                    <div class="check"></div>
                                </div>
                            @endforeach

                            <input type="hidden" name="metaldetailing" id="metaldetailing_selected_checkbox">

                        </div>
                    </div>
                @endif

                @if(isset($arr_product_shanktype) && !empty($arr_product_shanktype))
                    <div class="col-md-4">
                        <div class="title-setting-adistional-filter">
                          Shank Type
                        </div>
                        <div class="main-list-box-settings">
                                
                            @foreach($arr_product_shanktype as $arr_shanktype)
                            @php
                                $shanktype_checked = "";

                                $shanktype_id = isset($arr_shanktype['id']) ? $arr_shanktype['id'] : '';
                                $shanktype_name = isset($arr_shanktype['shank_type']) ? $arr_shanktype['shank_type'] : '';
                                $shanktype_slug = isset($arr_shanktype['slug']) ? $arr_shanktype['slug'] : '';

                                if(null !== $filter_shanktype && !empty($filter_shanktype))
                                {
                                    if(in_array($shanktype_slug, $filter_shanktype))
                                    {
                                        $shanktype_checked = "checked";
                                    }
                                }
                            @endphp
                                <div class="check-box inline-checkboxs">
                                    <input class="filled-in shanktype_checkbox" type="checkbox" id="shanktype_{{ $shanktype_id }}" value="{{ $shanktype_slug }}" data-id="{{ $shanktype_id }}" data-slug="{{ $shanktype_slug }}" {{ $shanktype_checked }} />
                                    <label for="shanktype_{{ $shanktype_id }}">{{ $shanktype_name }}</label>
                                    <div class="check"></div>
                                </div>
                            @endforeach

                            <input type="hidden" name="shanktype" id="shanktype_selected_checkbox">

                        </div>
                    </div>
                @endif

                @if(isset($arr_product_ringshoulder) && !empty($arr_product_ringshoulder))
                    <div class="col-md-4">
                        <div class="title-setting-adistional-filter">
                          Ring Shoulder
                        </div>
                        <div class="main-list-box-settings">
                                
                            @foreach($arr_product_ringshoulder as $arr_ringshoulder)
                            @php
                                $ringshoulder_checked = "";

                                $ringshoulder_id = isset($arr_ringshoulder['id']) ? $arr_ringshoulder['id'] : '';
                                $ringshoulder_type_name = isset($arr_ringshoulder['ring_shoulder_type']) ? $arr_ringshoulder['ring_shoulder_type'] : '';
                                $ringshoulder_slug = isset($arr_ringshoulder['slug']) ? $arr_ringshoulder['slug'] : '';

                                if(null !== $filter_ringshoulder && !empty($filter_ringshoulder))
                                {
                                    if(in_array($ringshoulder_slug, $filter_ringshoulder))
                                    {
                                        $ringshoulder_checked = "checked";
                                    }
                                }
                            @endphp
                                <div class="check-box inline-checkboxs">
                                    <input class="filled-in ringshoulder_checkbox" type="checkbox" id="ringshoulder_{{ $ringshoulder_id }}" value="{{ $ringshoulder_slug }}" data-id="{{ $ringshoulder_id }}" data-slug="{{ $ringshoulder_slug }}" {{ $ringshoulder_checked }} />
                                    <label for="ringshoulder_{{ $ringshoulder_id }}">{{ $ringshoulder_type_name }}</label>
                                    <div class="check"></div>
                                </div>
                            @endforeach

                            <input type="hidden" name="ringshoulder" id="ringshoulder_selected_checkbox">

                        </div>
                    </div>
                @endif

                @if(isset($arr_product_bandsetting) && !empty($arr_product_bandsetting))
                    <div class="col-md-4">
                        <div class="title-setting-adistional-filter">
                          Band Setting
                        </div>
                        <div class="main-list-box-settings">
                                
                            @foreach($arr_product_bandsetting as $arr_bandsetting)
                            @php
                                $bandsetting_checked = "";

                                $bandsetting_id = isset($arr_bandsetting['id']) ? $arr_bandsetting['id'] : '';
                                $bandsetting_name = isset($arr_bandsetting['band_setting']) ? $arr_bandsetting['band_setting'] : '';
                                $bandsetting_slug = isset($arr_bandsetting['slug']) ? $arr_bandsetting['slug'] : '';

                                if(null !== $filter_bandsetting && !empty($filter_bandsetting))
                                {
                                    if(in_array($bandsetting_slug, $filter_bandsetting))
                                    {
                                        $bandsetting_checked = "checked";
                                    }
                                }
                            @endphp
                                <div class="check-box inline-checkboxs">
                                    <input class="filled-in bandsetting_checkbox" type="checkbox" id="bandsetting_{{ $bandsetting_id }}" value="{{ $bandsetting_slug }}" data-id="{{ $bandsetting_id }}" data-slug="{{ $bandsetting_slug }}" {{ $bandsetting_checked }} />
                                    <label for="bandsetting_{{ $bandsetting_id }}">{{ $bandsetting_name }}</label>
                                    <div class="check"></div>
                                </div>
                            @endforeach

                            <input type="hidden" name="bandsetting" id="bandsetting_selected_checkbox">

                        </div>
                    </div>
                @endif
                
            </div>
        </div>


    </div>
    </div>
    <div class="col-md-12">
    <div class="list-margin-bottm">
    <div class="more-popular-most">
        <span>{{ $count_products }}</span> Results
    </div>
    <div class="sortbye-txt">
        <div class="sorting-block">
            <span>Sort By </span>
            <div class="select-style select2">
                <select class="frm-select" id="cmb_sort_by" name="sort_by">
                    <option value="">Select</option>
                    <option value="low_to_high" @if($filter_sort_by == 'low_to_high') selected @endif>Price Low to High</option>
                    <option value="high_to_low" @if($filter_sort_by == 'high_to_low') selected @endif>Price High to Low</option>
                </select>
            </div>
        </div>
    </div>
    </form>
    <div class="clearfix"></div>
    </div>
    </div>
    </div>
    <div class="list-box-sectionstart">
       <div class="container-fluid">
        <div class="">
            
            @if(isset($arr_products_data) && !empty($arr_products_data))
            
                @foreach($arr_products_data as $key => $arr_data)
                    
                    @php
                        $product_images    = [];
                        $images_1          = $images_2 = '';

                        $product_name      = isset($arr_data['product_name']) ? ucwords($arr_data['product_name']) : '';
                        $product_id        = isset($arr_data['id']) ? $arr_data['id'] : '';
                        $product_uid       = isset($arr_data['uid']) ? $arr_data['uid'] : '';
                        $product_slug      = isset($arr_data['slug']) ? $arr_data['slug'] : '';
                        $base_price        = isset($arr_data['base_price']) ? number_format($arr_data['base_price'], 2, '.', '') : '';
                        $final_price       = isset($arr_data['final_price']) ? number_format($arr_data['final_price'], 2, '.', '') : '';
                        $discount          = isset($arr_data['discount']) ? $arr_data['discount'].'% Off' : '';

                        $category_slug     = isset($arr_data['category']['slug']) ? $arr_data['category']['slug'] : '';
                        $sub_category_slug = isset($arr_data['sub_category']['slug']) ? $arr_data['sub_category']['slug'] : '';
                        $product_line_slug = isset($arr_data['product_line']['slug']) ? $arr_data['product_line']['slug'] : '';

                        $product_images    = isset($arr_data['product_images']) ? $arr_data['product_images'] : '';

                        $product_images_1  = isset($product_images['0']['image']) ? $product_images['0']['image'] : '';
                        $product_images_2  = isset($product_images['1']['image']) ? $product_images['1']['image'] : '';

                        $images_1          = get_resized_image($product_images_1, $product_image_base_path, 176, 190 );
                        $images_2          = get_resized_image($product_images_2, $product_image_base_path, 176, 190 );

                        
                        // For background color of the products or for css classes starts
                        $classes = array(0 => 'color-box-one', 1 => 'color-box-two', 2 => 'color-box-three', 3 => 'color-box-four');
                        
                        $curr_class = $classes[0];
                        
                        $remainder = $key % 4;
                        
                        if ($remainder==0) 
                        {
                            $classes = array_reverse($classes);
                        }
                        $curr_class = $classes[$remainder];
                        // ends

                    @endphp

                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="listmain-box {{ $curr_class }}">
                            <div class="listmain-box-img">
                                <img class="listmain-box-img-defualt" src="{{ $images_1 }}" alt="" />
                                <a href="{{ url('/') }}/{{ $category_slug }}/{{ $sub_category_slug }}/{{ $product_slug }}"><img class="listmain-box-img-hover" src="{{ $images_2 }}" alt="" /></a>
                            </div>
                            <div class="listmain-box-content">
                               <div class="subhover-cnts">
                                <a href="{{ url('/') }}/{{ $category_slug }}/{{ $sub_category_slug }}/{{ $product_slug }}" class="list-title-box">{{ $product_name }}</a>
                                <div class="list-price-box">
                                    <div class="compare-img-price">
                                        {!! session_currency($final_price) !!}
                                        <span class="compare-img-old-pri">{!! session_currency($base_price) !!}</span>
                                        <span class="compare-img-discount">{{ $discount }}</span>
                                    </div>
                                </div>
                                </div>
                                <div class="list-icons-box">
                                    <?php
                                        if(Session::has('arr_compare') && !empty(Session::get('arr_compare')))
                                        {
                                            $arr_compare = Session::get('arr_compare');
                                            $arr_compare_product_id = array_column($arr_compare, 'product_id');
                                        }
                                        if(isset($arr_compare_product_id) && !empty($arr_compare_product_id) && in_array($product_id, $arr_compare_product_id))
                                        {
                                            $compare_style = 'background-color:#f6929b';
                                            //$compare_href = url('/').'/compare_list/view';
                                            $compare_href = "javascript:void(0)";
                                        }
                                        else
                                        {
                                            $compare_style = '';
                                            $compare_href = "javascript:void(0)";
                                        }

                                        if(isset($arr_wishlist) && !empty($arr_wishlist))
                                        {
                                            $arr_wishlist_product_id = array_column($arr_wishlist, 'product_id');
                                        }

                                        if(isset($arr_wishlist) && !empty($arr_wishlist) && in_array($product_id, $arr_wishlist_product_id))
                                        {
                                            $wishlist_style = 'background-color:#f6929b';
                                        }
                                        else
                                        {
                                            $wishlist_style = '';
                                        }
                                    ?>
                                    <a href="{{ url('/') }}/{{ $category_slug }}/{{ $sub_category_slug }}/{{ $product_slug }}" class="cirlce-llist cart-list"></a>

                                    <a href="javascript:void(0)" data-product-id="{{isset($arr_data['id']) ? base64_encode($arr_data['id']): 0 }}" class="cirlce-llist heart-list btn_add_wish_list" style="{{ $wishlist_style }}"></a>
                                    
                                    <a href="{{ $compare_href }}" class="cirlce-llist compare-list btn_compare_product " data-compare-product-id='{{isset($product_id) ? base64_encode($product_id) : '0'}}' data-img="{{ base64_encode($images_1) }}" style="{{ $compare_style }}"></a>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach

            @else
                <div class="col-md-12">
                    <div class="title-product-likes" style="text-align: center;">No Products Found</div>
                </div>
            @endif

        </div>
       </div>
    </div>
    
    @if(isset($arr_pagination) && $arr_pagination != null)
        @include('front.common.pagination')
    @endif

</div>

<div class="clearfix"></div>

@include('front.products.compare')

<script type="text/javascript">
$(document).ready(function(){

    /*Hide Show Lisitng Page Start*/
    $("#flipdashboard-addistional").click(function(){
        $("#paneldashboard-addistional").slideToggle("slow");
    });
    /*Hide Show Lisitng Page End*/

    $("#cmb_sort_by").change(function(){
        var sort_by = $("#cmb_sort_by").val();
        if(sort_by != '')
        {
            $("#formProductFilter").submit();
        }
        else
        {
            window.location = window.location.href;
        }
    });

    // to reset search or filter form
    $("#btn_form_reset").click(function(){
        window.location = "{{ $search_url_path }}";
    });

    $("#btn_products_filter").click(function(){
        var occasions_checkbox      = [];
        var collection_checkbox     = [];
        var look_checkbox           = [];
        var setting_checkbox        = [];
        var metaldetailing_checkbox = [];
        var shanktype_checkbox      = [];
        var ringshoulder_checkbox   = [];
        var bandsetting_checkbox    = [];
        var delivery_days_checkbox  = [];

        $('.occasions_checkbox:checkbox:checked').each(function() {
            var occasions_id = $(this).data("id");
            var occasions_slug = $(this).data("slug");

            occasions_checkbox.push(occasions_slug);
            $("#occasions_selected_checkbox").val(occasions_checkbox);
        });

        $('.collection_checkbox:checkbox:checked').each(function() {
            var collection_id = $(this).data("id");
            var collection_slug = $(this).data("slug");

            collection_checkbox.push(collection_slug);
            $("#collection_selected_checkbox").val(collection_checkbox);
        });

        $('.look_checkbox:checkbox:checked').each(function() {
            var look_id = $(this).data("id");
            var look_slug = $(this).data("slug");

            look_checkbox.push(look_slug);
            $("#look_selected_checkbox").val(look_checkbox);
        });

        $('.setting_checkbox:checkbox:checked').each(function() {
            var setting_id = $(this).data("id");
            var setting_slug = $(this).data("slug");

            setting_checkbox.push(setting_slug);
            $("#setting_selected_checkbox").val(setting_checkbox);
        });

        $('.metaldetailing_checkbox:checkbox:checked').each(function() {
            var metaldetailing_id = $(this).data("id");
            var metaldetailing_slug = $(this).data("slug");

            metaldetailing_checkbox.push(metaldetailing_slug);
            $("#metaldetailing_selected_checkbox").val(metaldetailing_checkbox);
        });

        $('.shanktype_checkbox:checkbox:checked').each(function() {
            var shanktype_id = $(this).data("id");
            var shanktype_slug = $(this).data("slug");

            shanktype_checkbox.push(shanktype_slug);
            $("#shanktype_selected_checkbox").val(shanktype_checkbox);
        });

        $('.ringshoulder_checkbox:checkbox:checked').each(function() {
            var ringshoulder_id = $(this).data("id");
            var ringshoulder_slug = $(this).data("slug");

            ringshoulder_checkbox.push(ringshoulder_slug);
            $("#ringshoulder_selected_checkbox").val(ringshoulder_checkbox);
        });

        $('.bandsetting_checkbox:checkbox:checked').each(function() {
            var bandsetting_id = $(this).data("id");
            var bandsetting_slug = $(this).data("slug");

            bandsetting_checkbox.push(bandsetting_slug);
            $("#bandsetting_selected_checkbox").val(bandsetting_checkbox);
        });

        $('.delivery_days_checkbox:checkbox:checked').each(function() {
            var delivery_days_value = $(this).val();

            delivery_days_checkbox.push(delivery_days_value);
            $("#delivery_days_selected_checkbox").val(delivery_days_checkbox);
        });
    });

    // Add product to wish list.
    $('.btn_add_wish_list').click(function(){
        
        var ths = $(this);
        var enc_product_id = $(this).attr('data-product-id');

        if(enc_product_id != '')
        {
            $.ajax({
                url:'{{url('/')}}/jewellery/add_product_to_wish_list/'+enc_product_id,
                type:'get',
                success:function(data){
                    if(data)
                    {
                        // Update wishlist count at header.
                        get_wishlist_count();
                        swal('',data.msg,data.status);
                        ths.css('background-color',"#f6929b");
                    }
                    else
                    {
                        swal('','Something went to wrong! Please try again later.','error');
                    }

                }
            });
        }
        else
        {
            swal('','Something went to wrong! Please try again later.','error');
        }
    });

    $(function() {
        
        /*price range slider*/
        $("#slider-price-range").slider({
            range: true,
            min: {{ $min_price }},
            max: {{ $max_price }},
            values: [{{ $selected_min_price }}, {{ $selected_max_price }}],
            slide: function(event, ui) {
                $("#slider_price_range_txt").html("<span class='slider_price_min'>₹ " + ui.values[0] + "</span>  <span class='slider_price_max'>₹ " + ui.values[1] + " </span>");
            },
            change: function(event, ui) {
                $('#min_price').val(ui.values[0]);
                $('#max_price').val(ui.values[1]);
            }
        });
        $("#slider_price_range_txt").html("<span class='slider_price_min' > ₹ " + $("#slider-price-range").slider("values", 0) + "</span>  <span class='slider_price_max' >₹ " + $("#slider-price-range").slider("values", 1) + "</span>");


        /*weight range slider*/
        $("#slider-weight-range").slider({
            range: true,
            min: {{ $min_weight }},
            max: {{ $max_weight }},
            values: [{{ $selected_min_weight }}, {{ $selected_max_weight }}],
            slide: function(event, ui) {
                $("#slider_weight_range_txt").html("<span class='slider_price_min'>" + ui.values[0] + " Gms</span>  <span class='slider_price_max'>" + ui.values[1] + " Gms</span>");
            },
            change: function(event, ui) {
                $('#min_weight').val(ui.values[0]);
                $('#max_weight').val(ui.values[1]);
            }
        });
        $("#slider_weight_range_txt").html("<span class='slider_price_min'>" + $("#slider-weight-range").slider("values", 0) + " Gms</span>  <span class='slider_price_max'>" + $("#slider-weight-range").slider("values", 1) + " Gms</span>");
    });

});
</script>

@endsection
