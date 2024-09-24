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
        @include('front.layout._operation_status')
        @if(isset($arr_replacement['data']) && !empty($arr_replacement['data']))
          @foreach($arr_replacement['data'] as $val)
            <div class="order-box-main">
              <div class="order-id-listss">
                <span>Order Id :</span> {{$val['order_product_details']['order_id'] or 'NA'}}
              </div>
              <div class="row">
                <div class="col-md-3 col-lg-3">
                  <div class="imgorder-list">
                    <div class="img-section-orders-box">
                      @php
                        $product_images = [];
                        $img = $image = '';

                        $product_images = isset($val['order_product_details']['product_details']['product_images']) ? $val['order_product_details']['product_details']['product_images'] : '';

                        $image = isset($product_images['0']['image']) ? $product_images['0']['image'] : '';
                        
                        $img = get_resized_image($image, $product_image_base_path, 176, 190 );
                        
                      @endphp
                      <img src="{{$img or ''}}" alt="" />
                    </div>
                  </div>
                </div>
                <div class="col-md-5 col-lg-5">
                  <a href="{{$module_url_path.'/details'}}/{{ isset($val['order_product_details']['id']) ? base64_encode($val['order_product_details']['id']) : ''}}" class="title-order-usr">{{$val['order_product_details']['product_name'] or 'NA'}}</a>
                  <div class="price-section-user-order">
                    @php 
                      $current_currency = '';
                      $current_currency = Session::get('get_currency');
                    @endphp

                    @if($current_currency == 'USD')
                        @if(isset($val['order_product_details']['product_final_price']) && isset($val['order_product_details']['order']['order_usd_value']))
                          @php
                                  $final_amt_in_usd = $val['order_product_details']['product_final_price'] / $val['order_product_details']['order']['order_usd_value'];
                          @endphp
                          {{isset($final_amt_in_usd) ? '$ '.number_format((float)$final_amt_in_usd, 2, '.', '') : 'NA'}}
                        @endif
                    @else
                      <i class="fa fa-inr"></i> {{isset($val['order_product_details']['product_final_price']) ? $val['order_product_details']['product_final_price'] : 'NA'}} 
                    @endif
                    <span>
                      @if($current_currency == 'USD')
                         @if(isset($val['order_product_details']['product_final_price']) && isset($val['order_product_details']['order']['order_usd_value']))
                            @php
                                    $without_discount_amt = $val['order_product_details']['product_base_price'] / $val['order_product_details']['order']['order_usd_value'];
                            @endphp
                            
                            {{isset($without_discount_amt) ? '$ '.number_format((float)$without_discount_amt, 2, '.', '') : 'NA'}}
                          @endif 
                      @else
                      <i class="fa fa-inr"></i> {{isset($val['order_product_details']['product_base_price']) ? $val['order_product_details']['product_base_price'] : 'NA'}}
                      @endif
                    </span>
                    &nbsp;<span class="off-icn-odrs">{{isset($val['order_product_details']['product_discount']) ? $val['order_product_details']['product_discount'].'% Off' : 'NA'}} </span>

                  </div>
                  <div class="category-lable-main">
                    <div class="category-lable-left">Item No : </div>
                    <div class="category-lable-right"> {{$val['order_product_details']['item_number'] or 'NA'}}</div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="category-lable-main">
                    <div class="category-lable-left">Category : </div>
                    <div class="category-lable-right"> {{$val['order_product_details']['product_category_name'] or 'NA'}}</div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="category-lable-main">
                    <div class="category-lable-left">Sub-Category : </div>
                    <div class="category-lable-right"> {{$val['order_product_details']['product_subcategory_name'] or 'NA'}}</div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="category-lable-main">
                    <div class="category-lable-left">Replacement Reason : </div>
                    <div class="category-lable-right"> {{$val['reason'] or 'NA'}}</div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="category-lable-main">
                    <div class="category-lable-left">Delivery Method : </div>
                    <div class="category-lable-right"> {{$val['delivery_method'] or 'NA'}}</div>
                    <div class="clearfix"></div>
                  </div>
                  @if(isset($val['wallet_details']['amount_credited']) && !empty($val['wallet_details']['amount_credited']))
                    <div class="category-lable-main">
                      <div class="category-lable-left">Replacement Amount : </div>
                      <div class="category-lable-right"> 
                        @if($current_currency == 'USD')
                          @if(isset($val['wallet_details']['amount_credited']) && isset($val['usd_value']))
                         @php
                          $replacement_final_amt_in_usd = $val['wallet_details']['amount_credited'] / $val['usd_value'];
                         @endphp
                          {{isset($replacement_final_amt_in_usd) ? '$ '.number_format((float)$replacement_final_amt_in_usd, 2, '.', '') : 'NA'}}
                         @endif
                        @else
                          <i class="fa fa-inr"></i> {{$val['wallet_details']['amount_credited'] or 'NA'}}
                        @endif
                      </div>
                      <div class="clearfix"></div>
                    </div>
                  @endif
                  
                </div>
                <div class="col-md-4 col-lg-4">
                 <div class="compl-orders">
                    @if(isset($val['status']) && !empty($val['status']))
                      
                      @if($val['status'] == '1')
                        <span class="compl-img-all pending-img"></span>
                        <span class="compl-text">Applied</span>
                      @elseif($val['status'] == '2')
                        <span class="compl-img-all compl-img imgnone">
                          <img src="{{url('/')}}/front/images/request-accept.png" alt="">
                        </span>
                        <span class="compl-text">Request Accepted</span>
                      @elseif($val['status'] == '3')
                        <span class="compl-img-all compl-img imgnone">
                          <img src="{{url('/')}}/front/images/request-reject.png" alt="">
                        </span>
                        <span class="compl-text">Request Rejected</span>
                      @elseif($val['status'] == '4')
                        <span class="compl-img-all compl-img imgnone">
                          <img src="{{url('/')}}/front/images/completed-icns-replacment.png" alt="">
                        </span>
                        <span class="compl-text">Replaced</span>
                      @elseif($val['status'] == '5')
                        <span class="compl-img-all compl-img imgnone">
                           <img src="{{url('/')}}/front/images/request-reject.png" alt="">
                        </span>
                        <span class="compl-text">Product Rejected</span>
                      @endif
                    @endif
                </div>
                <div class="clearfix"></div>
                </div>
              </div>
              <div class="order-box-main-footer">
                <div class="oder-footer-icn">
                  <span class="icn-oder-place"></span>
                  <div class="usr-ords">
                    <div class="oder-innrs">Replacement Request Date :</div>
                    <div class="time-date-odr">{{isset($val['created_at'] ) ? date('d M Y, h.m a',strtotime($val['created_at'])) : 'NA'}}</div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          @endforeach
         @else
           <div class="col-lg-12 text-center">
                    <h4>No Replacement requests found.</h4>
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