@extends('front.layout.master')   
@section('main_content')

<!-- Page breadcrumb -->  
@include('front.user.layout.breadcrumb')
<!-- /page breadcrumb -->

<div class="inner-page-main min-hieght-class">
  <div class="container">
    <div class="row">
      <div id="left-bar">
              @include('front.user.layout.sidebar')
          </div>
          <div class="col-md-8 col-lg-9">
            <div class="shop-now-btn giftbtsts">
              <a class="button-shop" href="{{$module_url_path}}/send_request">
                <span>New Request</span></a>
            </div>
          </div>
      <div class="col-md-8 col-lg-9">

        @include('front.layout._operation_status')
        @if(isset($arr_valuation['data']) && !empty($arr_valuation['data']))
          @foreach($arr_valuation['data'] as $val)
            <div class="order-box-main">
             
              <div class="row">
                <div class="col-md-3 col-lg-3">
                  <div class="imgorder-list">
                    <div class="img-section-orders-box">
                      @php
                        $product_images = [];
                        $img = $image = '';

                        $image = isset($val['product_image']) ? $val['product_image'] : '';
                        
                        $img = get_resized_image($image, $valuation_img_base_path, 176, 190 );
                        
                      @endphp
                      <img src="{{$img or ''}}" alt="" />
                    </div>
                  </div>
                </div>
                <div class="col-md-5 col-lg-5">
                  <a href="javascript:void(0)" class="title-order-usr" style="cursor:default;">{{$val['user_details']['first_name'] or ''}} {{$val['user_details']['last_name'] or ''}}</a>
                  <div class="price-section-user-order">
                   
                    <i class="fa fa-calendar"></i> {{isset($val['appointment_date']) ? date('d M,Y',strtotime($val['appointment_date'])) : 'NA'}} 
                    
                    <span style="text-decoration:none;">
                      <i class="fa fa-clock-o"></i>
                      {{isset($val['appointment_time']) ? date('h:i a',strtotime($val['appointment_time'])) : 'NA'}} 
                    </span>

                  </div>
                  <div class="category-lable-main">
                    <div class="category-lable-left"> <i class="fa fa-mobile-phone"></i> </div>
                    <div class="category-lable-right"> {{$val['mobile_number'] or 'NA'}}</div>
                    <div class="clearfix"></div>
                  </div>
                  
                </div>
                <div class="col-lg-12">
                  <div class="category-lable-main">
                    <div class="category-lable-left"> Product Description </div>
                    <div class="category-lable-right" style="width: 100%"> {{$val['product_description'] or 'NA'}}</div>
                    <div class="clearfix"></div>
                  </div>
                </div>
                
              </div>
              <div class="order-box-main-footer">
                <div class="oder-footer-icn">
                  <span class="icn-oder-place"></span>
                  <div class="usr-ords">
                    <div class="oder-innrs">Valuation Request Date :</div>
                    <div class="time-date-odr">{{isset($val['created_at'] ) ? date('d M Y, h.m a',strtotime($val['created_at'])) : 'NA'}}</div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          @endforeach
         @else
           <div class="col-lg-12 text-center">
                    <h4>No valuation requests found.</h4>
           </div>
        @endif
         @if(isset($arr_pagination) && $arr_pagination != null)
            @include('front.common.pagination')
         @endif

      </div>
    </div>
  </div>
</div>

@endsection