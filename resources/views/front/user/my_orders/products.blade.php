@extends('front.layout.master')   
@section('main_content')

<!-- Page breadcrumb -->  
@include('front.user.layout.breadcrumb')
<!-- /page breadcrumb -->

@php 
$current_currency = 'INR';
$current_currency = Session::get('get_currency');
if($current_currency=='')
{
  $current_currency = 'INR';
}
@endphp
<style type="text/css">
.button-shop.user-btns-odr{padding: 13px 25px 10px;}
</style>
<div class="inner-page-main min-hieght-class">
  <div class="container">
    <div class="row">
      <div id="left-bar">
        @include('front.user.layout.sidebar')
      </div>
      <div class="col-md-8 col-lg-9">
        @include('front.layout._operation_status')

        @if(isset($arr_order['data']) && !empty($arr_order['data']))
        @foreach($arr_order['data'] as $key=> $val)
        	 @php
	          $replacement_order_status = '';
	          $replacement_order_status = isset($val['replacement_request']['status']) ? $val['replacement_request']['status'] : '';
	          
	        @endphp

        <div class="order-box-main">
          <div class="order-id-listss">
            <span>Order Id :</span> {{$val['order']['order_id'] or 'NA'}}
          </div>
          <div class="row">
            <div class="col-md-3 col-lg-3">
              <div class="imgorder-list">
                <div class="img-section-orders-box">
                  @php
                  $product_images = [];
                  $img = $image = '';

                  $product_images = isset($val['product_details']['product_images']) ? $val['product_details']['product_images'] : '';

                  $image = isset($product_images['0']['image']) ? $product_images['0']['image'] : '';

                  $img = get_resized_image($image, $product_image_base_path, 176, 190 );

                  @endphp
                  <img src="{{$img or ''}}" alt="" />
                </div>
              </div>
            </div>
            
            <div class="col-md-5 col-lg-5">
              <a href="{{$module_url_path.'/details'}}/{{base64_encode($val['id'])}}" class="title-order-usr">
                @if(isset($val['product_name']) && $val['product_name']!='')
                {{title_case($val['product_name'])}}
                @endif
              </a>
              <div class="price-section-user-order">


                @if($current_currency == 'USD')
                @if(isset($val['product_final_price']) && isset($val['order']['order_usd_value']))
                @php
                $final_amt_in_usd = $val['product_final_price'] / $val['order']['order_usd_value'];
                @endphp
                {{isset($final_amt_in_usd) ? '$ '.number_format((float)$final_amt_in_usd, 2, '.', '') : 'NA'}}
                @endif
                @else
                <i class="fa fa-inr"></i> {{isset($val['product_final_price']) ? $val['product_final_price'] : 'NA'}} 
                @endif
                <span>
                  @if(isset($val['product_discount']) && !empty($val['product_discount']))
                    @if($current_currency == 'USD')
                      @if(isset($val['product_final_price']) && isset($val['order']['order_usd_value']))
                        @php
                        $without_discount_amt = $val['product_base_price'] / $val['order']['order_usd_value'];
                        @endphp

                        {{isset($without_discount_amt) ? '$ '.number_format((float)$without_discount_amt, 2, '.', '') : 'NA'}}
                      @endif 
                      @else
                        <i class="fa fa-inr"></i> {{isset($val['product_base_price']) ? $val['product_base_price'] : 'NA'}}
                      @endif
                  @endif
                </span>
                &nbsp;<span class="off-icn-odrs">{{isset($val['product_discount']) && !empty($val['product_discount']) ? $val['product_discount'].'% Off' : ''}} </span>

              </div>
              <div class="category-lable-main">
                <div class="category-lable-left">Category : </div>
                <div class="category-lable-right"> {{$val['product_category_name'] or 'NA'}}</div>
                <div class="clearfix"></div>
              </div>
              <div class="category-lable-main">
                <div class="category-lable-left">Sub-Category : </div>
                <div class="category-lable-right"> {{$val['product_subcategory_name'] or 'NA'}}</div>
                <div class="clearfix"></div>
              </div>

              <div class="category-lable-main">
                <div class="category-lable-left">Product Quantity : </div>
                <div class="category-lable-right"> {{$val['product_quantity'] or 'NA'}}</div>
                <div class="clearfix"></div>
              </div>

              

              @if(isset($val['product_insurance_company']) && !empty($val['product_insurance_company']))
              <div class="category-lable-main">
                <div class="category-lable-left">Insurance Company : </div>
                <div class="category-lable-right"> {{$val['product_insurance_company'] or 'NA'}}</div>
                <div class="clearfix"></div>
              </div>
              @endif
              @if(isset($val['insurance_on_product']) && !empty($val['insurance_on_product']))
              <div class="category-lable-main">
                <div class="category-lable-left">Insurance Amount : </div>
                <div class="category-lable-right"> 
                  @if($current_currency == 'USD')
                  @if(isset($val['insurance_on_product']) && isset($val['order']['order_usd_value']))
                  @php
                  $final_amt_in_usd = $val['insurance_on_product'] / $val['order']['order_usd_value'];
                  @endphp
                  {!!isset($final_amt_in_usd) ? '<i class="fa fa-usd"></i> '.number_format((float)$final_amt_in_usd, 2, '.', '') : 'NA'!!}
                  @endif
                  @else
                  <i class="fa fa-inr"></i> {{isset($val['insurance_on_product']) ? number_format((float)$val['insurance_on_product'], 2, '.', '') : 'NA'}} 
                  @endif
                </div>


                
              </div>
              @endif

              @php $insurance_final_amt = 0; @endphp

              @if(isset($val['insurance_on_product']) && !empty($val['insurance_on_product']))
                @if(isset($val['product_quantity']) && !empty($val['product_quantity']))
                  @php $insurance_final_amt = $val['insurance_on_product'] * $val['product_quantity']; @endphp
                @else 
                  @php $insurance_final_amt = $val['insurance_on_product']; @endphp
                @endif
              @endif

              @if(isset($insurance_final_amt) && !empty($insurance_final_amt) && isset($val['product_quantity']) && $val['product_quantity'] > 1)
                <div class="category-lable-main">
                  <div class="category-lable-left">Insurance Total Amount : </div>
                  <div class="category-lable-right"> {{$insurance_final_amt or 'NA'}}</div>
                  <div class="clearfix"></div>
                </div>
              @endif

              <div class="clearfix"></div>
              <div class="category-lable-main">
                <div class="category-lable-left">Total Price : </div>
                <div class="category-lable-right">

                  

                 @if($current_currency == 'INR')
                 <i class="fa fa-inr"></i>{{number_format($val['product_quantity']*$val['product_final_price']+ $insurance_final_amt, 2)}}
                 @elseif($current_currency == 'USD')

                 <i class="fa fa-usd"></i>{{number_format(($val['product_quantity']*$val['product_final_price'])/$val['order']['order_usd_value']+ $insurance_final_amt, 2)}}
                 @endif

               </div>
               <div class="clearfix"></div>
             </div>

           </div>
           <div class="col-md-4 col-lg-4">
            @php
            $product_return_status = '';
            $product_return_status = isset($val['return_request']['status']) ?  $val['return_request']['status'] : 0;

            $product_replacement_status = '';
            $product_replacement_status = isset($val['replacement_request']['status']) ? $val['replacement_request']['status'] : 0;
            @endphp
            @if(isset($val['order']['status']) && $val['order']['status'] == '4')
            <div class="compl-orders">
              <span class="compl-img-all compl-img imgnone"> <img src="{{url('/')}}/front/images/completed--icns-replacment.png" alt=""></span>

              <span class="compl-text">Delivered</span>
            </div>
            @elseif(isset($val['order']['status']) && $val['order']['status'] == '5' &&  $product_return_status != '4' &&  $product_replacement_status != '4')
            <div class="compl-orders">
              <span class="compl-img-all compl-img imgnone"> <img src="{{url('/')}}/front/images/completed--icns-replacment.png" alt=""></span>

              <span class="compl-text">Completed</span>
            </div>
            @elseif(isset($val['order']['status']) && $val['order']['status'] == '0')
            <div class="compl-orders">
              <span class="compl-img-all pending-img"></span>
              <span class="compl-text">Pending</span>
            </div>
            @elseif(isset($val['order']['status']) && $val['order']['status'] == '1')
            <div class="compl-orders">
              <span class="compl-img-all pending-img"></span>
              <span class="compl-text">In-process</span>
            </div>
            @elseif(isset($val['order']['status']) && $val['order']['status'] == '2')
            <div class="compl-orders">
              <span class="compl-img-all pending-img"></span>
              <span class="compl-text">Confirmed</span>
            </div>
            @elseif(isset($val['order']['status']) && $val['order']['status'] == '3')
            <div class="compl-orders">
              <span class="compl-img-all pending-img"></span>
              <span class="compl-text">Dispatched</span>
            </div>
            @elseif(isset($val['order']['status']) && $val['order']['status'] == '6')
            <div class="compl-orders">
              <span class="compl-img-all pending-img"></span>
              <span class="compl-text">Cancelled</span>
            </div>
            @endif
            <div class="clearfix"></div>
            @php
            $order_return_date = '';
            if(isset($val['order']['order_return_date']) && !empty($val['order']['order_return_date']))
            {
              $order_return_date = date('Y-m-d',strtotime($val['order']['order_return_date']));
            }

            $current_date = date('Y-m-d');



            @endphp

            @if(isset($val['order']['status']) && $val['order']['status'] == '5' && $order_return_date >= $current_date)
            @if(isset($val['return_request']['status']))
            @if( $val['return_request']['status'] == '1')
            <a class="button-shop user-btns-odr btn-returs" href="javascript:void(0)">
              <span>Return request sent</span>
            </a>
            @elseif( $val['return_request']['status'] == '2')
            <a class="button-shop user-btns-odr btn-returs" href="javascript:void(0)">
              <span>Return Request Accepted</span>
            </a>
            @elseif( $val['return_request']['status'] == '3')
            <a class="button-shop user-btns-odr btn-returs" href="javascript:void(0)">
              <span>Return Request Rejected</span>
            </a>
            @elseif( $val['return_request']['status'] == '4')
            <a class="button-shop user-btns-odr btn-returs" href="javascript:void(0)">
              <span>Product Returned</span>
            </a>
            @elseif( $val['return_request']['status'] == '5')
            <a class="button-shop user-btns-odr btn-returs" href="javascript:void(0)">
              <span>Product Rejected</span>
            </a>
            @else
            @if($product_replacement_status != '4')
            	@if($replacement_order_status != '1' && $replacement_order_status != '2' &&  $replacement_order_status != '4')
		            <a class="button-shop user-btns-odr" href="{{$module_url_path}}/return/{{base64_encode($val['id'])}}">
		              <span>Return</span>
		            </a>
	            @endif
            @elseif($product_replacement_status == '4')
            <a class="button-shop user-btns-odr" href="javascript:void(0)">
              <span>Product Replaced</span>
            </a>
            @endif
            @endif
            @else
            @if($product_replacement_status != '4')
            	@if($replacement_order_status != '1' && $replacement_order_status != '2' &&  $replacement_order_status != '4')
		            <a class="button-shop user-btns-odr" href="{{$module_url_path}}/return/{{base64_encode($val['id'])}}">
		              <span>Return</span>
		            </a>
		        @endif
            @elseif($product_replacement_status == '4')
            <a class="button-shop user-btns-odr" href="javascript:void(0)">
              <span>Product Replaced</span>
            </a>
            @endif
            @endif
            @endif
            @php
            $return_request_status = '';
            $return_request_status = isset($val['return_request']['status']);
            @endphp
            @if(isset($val['order']['status']) && $val['order']['status'] == '5')
            <div class="clearfix"></div>
            <a class="button-shop user-btns-odr" href="{{url('/')}}/review_and_rating/{{base64_encode($val['product_id'])}}/{{base64_encode($val['id'])}}">
              <span>Review and Rating</span>
            </a>

            @endif

            <div class="clearfix"></div>
          </div>
        </div>
        <div class="order-box-main-footer">
          <div class="oder-footer-icn">
            <span class="icn-oder-place"></span>
            <div class="usr-ords">
              <div class="oder-innrs">Order Placed Date :</div>
              <div class="time-date-odr">{{isset($val['order']['created_at'] ) ? date('d M Y, h.m a',strtotime($val['order']['created_at'])) : 'NA'}}</div>
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