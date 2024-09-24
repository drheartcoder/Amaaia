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
        @php
          //dump($arr_order['data']);
        @endphp
        @if(isset($arr_order['data']) && !empty($arr_order['data']))
        @foreach($arr_order['data'] as $val)
        <div class="order-box-main">
          <div class="order-id-listss">
            <span>Order Id :</span> {{$val['order_id'] or 'NA'}}
          </div>
          <div class="row">
            <div class="col-md-3 col-lg-3">
              <div class="imgorder-list">
                <div class="img-section-orders-box">
                  @php
                  $product_images = [];
                  $img = $image = '';

                  $product_images = isset($val['order_products'][0]['product_details']['product_images']) ? $val['order_products'][0]['product_details']['product_images'] : '';

                  $image = isset($product_images['0']['image']) ? $product_images['0']['image'] : '';
                  $img = get_resized_image($image, $product_image_base_path, 176, 190 );
                  @endphp
                  <img src="{{$img or ''}}" alt="" />
                </div>
              </div>
            </div>

            <div class="col-md-5 col-lg-5">
              <a href="{{$module_url_path}}/{{$val['order_id'] or ''}}" class="title-order-usr"> &nbsp;
                @if(isset($val['order_fname']) && isset($val['order_lname']))
                {{title_case($val['order_fname']). ' ' .title_case($val['order_lname'])}}
                @endif
              </a>
              <div class="price-section-user-order">
                @php 
                $current_currency = '';
                $current_currency = Session::get('get_currency');
                @endphp

                @if($current_currency == 'USD')
                @if(isset($val['order_cost']) && isset($val['order_usd_value']))
                @php
                $final_amt_in_usd = $val['order_cost'] / $val['order_usd_value'];
                @endphp
                {{isset($final_amt_in_usd) ? '$ '.number_format((float)$final_amt_in_usd, 2, '.', '') : 'NA'}}
                @endif
                @else
                <i class="fa fa-inr"></i> {{isset($val['order_cost']) ? $val['order_cost'] : 'NA'}} 
                @endif
                <span>
                  @if($current_currency == 'USD')
                  @if(isset($val['order_cost']) && isset($val['order_usd_value']))
                  @php
                  $without_discount_amt = $val['order_base_cost'] / $val['order_usd_value'];
                  @endphp

                  @endif 
                  @else
                  @if(isset($val['order_base_cost']) && !empty($val['order_base_cost']))
                  <i class="fa fa-inr"></i> {{  number_format($val['order_base_cost'],2)}}
                  @endif
                  @endif
                </span>
                @if(isset($val['order_products'][0]['total_discount_percent']) && !empty($val['order_products'][0]['total_discount_percent']))
                @if(isset($val['order_products'][0]['total_products']) && $val['order_products'][0]['total_products'] != '')
                @php
                $discount_avg = $val['order_products'][0]['total_discount_percent'] / $val['order_products'][0]['total_products'];
                @endphp
                @else
                @php
                $discount_avg = $val['order_products'][0]['total_discount_percent'];
                @endphp
                @endif
                &nbsp;<span class="off-icn-odrs">{{isset($discount_avg) ? number_format($discount_avg).'% Off' : 'NA'}} </span>
                @endif

              </div>

              <div class="category-lable-main">
                <div class="category-lable-left">Payment Method : </div>
                <div class="category-lable-right"> {{isset($val['order_payment_method']) && $val['order_payment_method'] == '1' ? 'Online' :'' }}{{isset($val['order_payment_method']) && $val['order_payment_method'] == '2' ? 'Wire Transfer' : '' }}</div>
                <div class="clearfix"></div>
              </div>

              <div class="category-lable-main">
                <div class="category-lable-left">Payment Status : </div>
                <div class="category-lable-right"> 
                  @if(isset($val['transaction']['payment_status']) && $val['transaction']['payment_status'] =='1')
                  Success
                  @elseif(isset($val['transaction']['payment_status']) && $val['transaction']['payment_status'] =='2')
                  Failed
                  @elseif(isset($val['transaction']['payment_status']) && $val['transaction']['payment_status'] =='3')
                  Aborted
                  @elseif(isset($val['transaction']['payment_status']) && $val['transaction']['payment_status'] =='4')
                  Invalid
                  @elseif(isset($val['transaction']['payment_status']) && $val['transaction']['payment_status'] =='5')
                  Pending
                  @endif
                </div>
                <div class="clearfix"></div>
              </div>
              @if(isset($val['order_wallet']['used_wallet_balance']) && !empty($val['order_wallet']['used_wallet_balance']))
              <div class="category-lable-main">
                <div class="category-lable-left">Amount Paid by wallet : </div>
                <div class="category-lable-right">
                  @if($current_currency == 'USD')
                  @if(isset($val['order_wallet']['used_wallet_balance']) && isset($val['order_wallet']['used_wallet_balance']))
                  @php
                  $final_amt_in_usd = $val['order_wallet']['used_wallet_balance'] / $val['order_usd_value'];
                  @endphp
                  @endif
                  {!!isset($final_amt_in_usd) ? '<i class="fa fa-usd"></i> '.number_format((float)$final_amt_in_usd, 2, '.', '') : 'NA'!!}



                  @else
                  <i class="fa fa-inr"></i> {{isset($val['order_wallet']['used_wallet_balance']) ? number_format($val['order_wallet']['used_wallet_balance'], 2) : 'NA'}} 
                  @endif

                </div>
                <div class="clearfix"></div>
              </div>
              @endif

              @if(isset($val['order_giftcard']['gift_card_code']) && !empty($val['order_giftcard']['gift_card_code']))
              <div class="category-lable-main">
                <div class="category-lable-left">Gift Card Code : </div>
                <div class="category-lable-right">

                  {{isset($val['order_giftcard']['gift_card_code']) ? $val['order_giftcard']['gift_card_code'] : 'NA'}} 


                </div>
                <div class="clearfix"></div>
              </div>
              @endif

              @if(isset($val['order_giftcard']['amount']) && !empty($val['order_giftcard']['amount']))
              <div class="category-lable-main">
                <div class="category-lable-left">Amount Paid By Gift Card : </div>
                <div class="category-lable-right">
                  @if($current_currency == 'USD')
                  @if(isset($val['order_giftcard']['amount']) && isset($val['order_giftcard']['amount']))
                  @php
                  $final_amt_in_usd = $val['order_giftcard']['amount'] / $val['order_usd_value'];
                  @endphp
                  @endif
                  {!!isset($final_amt_in_usd) ? '<i class="fa fa-usd"></i> '.number_format((float)$final_amt_in_usd, 2, '.', '') : 'NA'!!}



                  @else
                  <i class="fa fa-inr"></i> {{isset($val['order_giftcard']['amount']) ? number_format($val['order_giftcard']['amount'],2) : 'NA'}} 
                  @endif

                </div>
                <div class="clearfix"></div>
              </div>
              @endif

              @if(isset($val['cancellation_reason']) && !empty($val['cancellation_reason']) && isset($val['status']) && $val['status'] == '6')
              <div class="category-lable-left">Cancellation Reason : </div>
              <div class="category-lable-right"> {{$val['cancellation_reason'] or 'NA'}}</div>
              <div class="clearfix"></div>
            </div>


            <div class="category-lable-main">
              @endif

            </div>

            <div class="col-md-4 col-lg-4">

             @if(isset($val['status']) && $val['status'] == '4')
             <div class="compl-orders">
              <span class="compl-img-all compl-img imgnone"> <img src="{{url('/')}}/front/images/completed--icns-replacment.png" alt=""></span>

              <span class="compl-text">Delivered</span>
            </div>

            @elseif(isset($val['status']) && $val['status'] == '5')
            <div class="compl-orders">
              <span class="compl-img-all compl-img imgnone"> <img src="{{url('/')}}/front/images/completed--icns-replacment.png" alt=""></span>

              <span class="compl-text">Completed</span>
            </div>
            @elseif(isset($val['status']) && $val['status'] == '0')
            <div class="compl-orders">
              <span class="compl-img-all pending-img"></span>
              <span class="compl-text">Pending</span>
            </div>
            @elseif(isset($val['status']) && $val['status'] == '1')
            <div class="compl-orders">
              <span class="compl-img-all pending-img"></span>
              <span class="compl-text">In-process</span>
            </div>
            @elseif(isset($val['status']) && $val['status'] == '2')
            <div class="compl-orders">
              <span class="compl-img-all pending-img"></span>
              <span class="compl-text">Confirmed</span>
            </div>
            @elseif(isset($val['status']) && $val['status'] == '3')
            <div class="compl-orders">
              <span class="compl-img-all pending-img"></span>
              <span class="compl-text">Dispatched</span>
            </div>
            @elseif(isset($val['status']) && $val['status'] == '6')
            <div class="compl-orders">
              <span class="compl-img-all pending-img"></span>
              <span class="compl-text">Cancelled</span>
            </div>
            @endif
            <div class="clearfix"></div>

            <a class="button-shop user-btns-odr" href="{{$module_url_path}}/{{$val['order_id'] or ''}}">
              <span>View</span>
            </a>

            @php
            $return_request_status = '';
            $return_request_status = isset($val['return_request']['status']);
            @endphp
            <div class="clearfix"></div>
                   {{--  @if(isset($val['order']['status']) && $val['order']['status'] != '5' && $return_request_status == '')
                      <div class="track-order-link">
                        <a href="user-track-order.html">
                          <i class="fa fa-map-marker"></i>
                          <span>Track Order</span>
                        </a>
                      </div>
                      @endif --}}
                    </div>
                  </div>
                  <div class="order-box-main-footer">
                    <div class="oder-footer-icn">
                      <span class="icn-oder-place"></span>
                      <div class="usr-ords">
                        <div class="oder-innrs">Order Placed Date :</div>
                        <div class="time-date-odr">{{isset($val['created_at'] ) ? date('d M Y, h.i a',strtotime($val['created_at'])) : 'NA'}}</div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
                @endforeach
                @else
                <div class="col-lg-12 text-center">
                  <h4>No orders found.</h4>
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