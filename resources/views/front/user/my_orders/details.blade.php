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

        @php
          $return_order_status = '';
          $return_order_status = isset($arr_order['return_request']['status']) ? $arr_order['return_request']['status'] : '';
        @endphp

       <div class="order-box-main space-o-box">
        <div class="row">
          <div class="col-md-3 col-lg-3">
            <div class="imgorder-list">
             <div class="img-section-orders-box">
                @php
                  $product_images = [];
                  $img = $image = '';

                  $product_images = isset($arr_order['product_details']['product_images']) ? $arr_order['product_details']['product_images'] : '';

                  $image = isset($product_images['0']['image']) ? $product_images['0']['image'] : '';
                  
                  $img = get_resized_image($image, $product_image_base_path, 176, 190 );
                  
                @endphp
             <img src="{{$img or ''}}" alt="Product image" />
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-6">
          <div class="title-order-usr">
          @if(isset($arr_order['product_name']) && $arr_order['product_name']!='')
          {{title_case($arr_order['product_name'])}}
          @endif
          </div>
          <div class="price-section-user-order">
              @php 
                $current_currency = '';
                $current_currency = Session::get('get_currency');
              @endphp

              @if($current_currency == 'USD')
                  @if(isset($arr_order['product_final_price']) && isset($arr_order['order']['order_usd_value']))
                    @php
                            $final_amt_in_usd = $arr_order['product_final_price'] / $arr_order['order']['order_usd_value'];
                    @endphp
                    {{isset($final_amt_in_usd) ? '$ '.number_format((float)$final_amt_in_usd, 2, '.', '') : 'NA'}}
                  @endif
              @else
                <i class="fa fa-inr"></i> {{isset($arr_order['product_final_price']) ? $arr_order['product_final_price'] : 'NA'}} 
              @endif
              <span>
                @if(isset($arr_order['product_discount']) && !empty($arr_order['product_discount']))
                  @if($current_currency == 'USD')
                     @if(isset($arr_order['product_base_price']) && isset($arr_order['order']['order_usd_value']))
                        @php
                                $without_discount_amt = $arr_order['product_base_price'] / $arr_order['order']['order_usd_value'];
                        @endphp
                        
                        {{isset($without_discount_amt) ? '$ '.number_format((float)$without_discount_amt, 2, '.', '') : 'NA'}}
                      @endif 
                  @else
                  <i class="fa fa-inr"></i> {{isset($arr_order['product_base_price']) ? $arr_order['product_base_price'] : 'NA'}}
                  @endif
                @endif
              </span>
              &nbsp;<span class="off-icn-odrs">{{isset($arr_order['product_discount']) && !empty($arr_order['product_discount']) ? $arr_order['product_discount'].'% Off' : ''}} </span>

            </div>
          <div class="category-lable-main">
            <div class="category-lable-left">Order ID : </div> <div class="category-lable-right"> {{$arr_order['order']['order_id'] or 'NA'}}</div>
            <div class="clearfix"></div>
          </div>
           <div class="category-lable-main">
            <div class="category-lable-left">Type : </div> <div class="category-lable-right"> {{ isset($arr_order['product_details']['product_type']) && $arr_order['product_details']['product_type'] == '1' ? 'Classic' : '' }} {{ isset($arr_order['product_details']['product_type']) && $arr_order['product_details']['product_type'] == '2' ? 'Luxure' : '' }}</div>
            <div class="clearfix"></div>
          </div>
          <div class="category-lable-main">
            <div class="category-lable-left">Category : </div> <div class="category-lable-right"> {{$arr_order['product_category_name'] or 'NA'}}</div>
            <div class="clearfix"></div>
          </div>

          @if(isset($arr_order['name_on_product']) && !empty($arr_order['name_on_product']))
            <div class="category-lable-main">
              <div class="category-lable-left">Name On Product  : </div> <div class="category-lable-right"> {{$arr_order['name_on_product'] or 'NA'}}</div>
              <div class="clearfix"></div>
            </div>
          @endif
         
          <div class="category-lable-main">
            <div class="category-lable-left">Order Placed Date : </div> <div class="category-lable-right"> {{isset($arr_order['order']['created_at'] ) ? date('d M Y, h.m a',strtotime($arr_order['order']['created_at'])) : 'NA'}}</div>
            <div class="clearfix"></div>
          </div>
           @if(isset($arr_order['order']['status']) && $arr_order['order']['status'] == '5')
            
               @php 
                  $product_return_status = '';
                  $product_return_status = isset($arr_order['return_request']['status']) ? $arr_order['return_request']['status'] : '';
                  

               @endphp

             @if(isset($arr_order['replacement_request']['status']))
                      @if($arr_order['replacement_request']['status'] == '1')
                      <div class="replace-to-product-link">
                          <a class="flipdashboard" href="javascript:void(0)" style="cursor: default;">
                              Replacement request sent
                          </a>
                        </div>
                      @elseif($arr_order['replacement_request']['status'] == '2')

                        <div class="replace-to-product-link">
                          <a class="flipdashboard" href="javascript:void(0)" style="cursor: default;">
                              Replacement Request Accepted
                          </a>
                        </div>
                       @elseif($arr_order['replacement_request']['status'] == '3')
                         <div class="replace-to-product-link">
                          <a class="flipdashboard" href="javascript:void(0)" style="cursor: default;">
                              Replacement Request Rejected
                          </a>
                        </div>
                       @elseif($arr_order['replacement_request']['status'] == '4')
                        
                        <div class="replace-to-product-link">
                          <a class="flipdashboard" href="javascript:void(0)" style="cursor: default;">
                              Product Replaced
                          </a>
                        </div>
                       @elseif($arr_order['replacement_request']['status'] == '5')
                        <div class="replace-to-product-link">
                          <a class="flipdashboard" href="javascript:void(0)" style="cursor: default;">
                              Product Rejected
                          </a>
                        </div>
                      @else
                      @if($return_order_status != '1' && $return_order_status != '2' &&  $return_order_status != '4')
                        <div class="replace-to-product-link">
                          <a class="flipdashboard" href="{{url('/')}}/user/replacement/replace_product/{{isset($arr_order['id']) ? base64_encode($arr_order['id']) : ''}}">
                              Want to Replace this product?
                          </a>
                        </div>
                      @endif
                      @endif
                    @else
                    @if($return_order_status != '1' && $return_order_status != '2' &&  $return_order_status != '4')
                      <div class="replace-to-product-link">
                        <a class="flipdashboard" href="{{url('/')}}/user/replacement/replace_product/{{isset($arr_order['id']) ? base64_encode($arr_order['id']) : ''}}">
                            Want to Replace this product?
                        </a>
                      </div>
                    @endif
                    @endif

          @endif
        </div>
        <div class="col-md-3 col-lg-3">

             @php
                 $product_return_status = '';
                 $product_return_status = isset($arr_order['return_request']['status']) ?  $arr_order['return_request']['status'] : 0;

                 $product_replacement_status = '';
                 $product_replacement_status = isset($arr_order['replacement_request']['status']) ? $arr_order['replacement_request']['status'] : 0;

            @endphp

           @if(isset($arr_order['order']['status']) && $arr_order['order']['status'] == '5'  &&  $product_return_status != '4' &&  $product_replacement_status != '4')
              <div class="compl-orders">
                <span class="compl-img-all compl-img"></span>
                <span class="compl-text">Completed</span>
              </div>
            @elseif(isset($arr_order['order']['status']) && $arr_order['order']['status'] == '0')
              <div class="compl-orders">
                  <span class="compl-img-all pending-img"></span>
                  <span class="compl-text">Pending</span>
              </div>
            @elseif(isset($arr_order['order']['status']) && $arr_order['order']['status'] == '1')
              <div class="compl-orders">
                  <span class="compl-img-all pending-img"></span>
                  <span class="compl-text">In-process</span>
              </div>
            @elseif(isset($arr_order['order']['status']) && $arr_order['order']['status'] == '2')
              <div class="compl-orders">
                  <span class="compl-img-all pending-img"></span>
                  <span class="compl-text">Confirmed</span>
              </div>
            @elseif(isset($arr_order['order']['status']) && $arr_order['order']['status'] == '3')
              <div class="compl-orders">
                  <span class="compl-img-all pending-img"></span>
                  <span class="compl-text">Dispatched</span>
              </div>
             @elseif(isset($arr_order['order']['status']) && $arr_order['order']['status'] == '4')
               <div class="compl-orders">
                  <span class="compl-img-all compl-img imgnone"> <img src="{{url('/')}}/front/images/completed--icns-replacment.png" alt=""></span>

                  <span class="compl-text">Delivered</span>
                </div>
               @elseif(isset($arr_order['order']['status']) && $arr_order['order']['status'] == '6')
                <div class="compl-orders">
                  <span class="compl-img-all pending-img"></span>
                  <span class="compl-text">Cancelled</span>
                </div>
            @endif
          <div class="clearfix"></div>

        </div>
      </div>
      <div class="paneldashboard">
        <div class="order-detail-my-txt">Replace this product</div>

        <div class="box-form">
         <label>Replacement Reason</label>
         <div class="select-style select2 udated-select">
          <select class="frm-select">
            <option>Select Reason for Replacement</option>
            <option>Select Reason for Replacement</option>
            <option>Select Reason for Replacement</option>
            <option>Select Reason for Replacement</option>
          </select>
        </div>
      </div>

      <div class="box-form">
       <label for="address">Message</label>
       <textarea name="address" id="address" placeholder="Write a Message"></textarea>
     </div>
     <div class="button-section-user-aacount">
       <div class="fullfil-button">
         <a class="button-shop" href="javascript:void(0)"><span>Send</span></a>
       </div>
     </div>

   </div>
   <div class="clearfix"></div>



   <div class="description-ttl-order">
    Description
  </div>
  <div class="description-ttx-order">
    {{$arr_order['product_details']['product_description'] or 'NA'}}
  </div>

  <div class="border-details-odr"></div>
  <div class="description-ttl-order">
   Delivery information
 </div>
 <div class="shipping-address-cls">Shipping Address</div> 
 <div class="main-addressdelivery">
  <div class="username-order">{{$arr_order['order']['order_fname'] or ''}} {{$arr_order['order']['order_lname'] or ''}}</div>
  <div class="category-lable-main">
    <div class="category-lable-left">Address: </div> <div class="category-lable-right"> {{isset($arr_order['order']['order_flat_no']) ? $arr_order['order']['order_flat_no'].',' : ''}}{{isset($arr_order['order']['order_building_name']) ? $arr_order['order']['order_building_name'].',' : ''}}{{isset($arr_order['order']['order_city']) ? $arr_order['order']['order_city'].', ' : ''}}{{isset($arr_order['order']['city']) ? $arr_order['order']['city'].', ' : ''}}{{isset($arr_order['order']['order_state']) ? $arr_order['order']['order_state'].', ' : ''}}{{isset($arr_order['order']['order_country']) ? $arr_order['order']['order_country'] : ''}}</div>
    <div class="clearfix"></div>
  </div>

  <div class="category-lable-main">
    <div class="category-lable-left">Zip Code: </div> <div class="category-lable-right"> {{$arr_order['order']['order_post_code'] or 'NA'}}</div>
    <div class="clearfix"></div>
  </div>
  <div class="category-lable-main">
    <div class="category-lable-left">Mobile: </div> <div class="category-lable-right"> {{$arr_order['order']['order_contact_no'] or 'NA'}}</div>
    <div class="clearfix"></div>
  </div>
  

</div>
<div class="clearfix"></div>
 @if(isset($arr_order['return_request']) && !empty($arr_order['return_request'])) 
  <div class="border-details-odr"></div>
  <div class="description-ttl-order">
   Product Return Request Details
 </div>
 <div class="main-addressdelivery">
  <div class="username-order">{{$arr_order['order']['order_fname'] or ''}} {{$arr_order['order']['order_lname'] or ''}}</div>
  <div class="category-lable-main">
    <div class="category-lable-left">Item No: </div> <div class="category-lable-right"> {{$arr_order['item_number'] or 'NA'}}</div>
    <div class="clearfix"></div>
  </div>

  <div class="category-lable-main">
    <div class="category-lable-left">Reason: </div> <div class="category-lable-right"> {{$arr_order['return_request']['reason'] or 'NA'}}</div>
    <div class="clearfix"></div>
  </div>
  <div class="category-lable-main">
    <div class="category-lable-left">Delivery Method: </div> <div class="category-lable-right"> {{$arr_order['return_request']['delivery_method'] or 'NA'}}</div>
    <div class="clearfix"></div>
  </div>

  <div class="category-lable-main">
    <div class="category-lable-left">Refund Payment Method: </div> <div class="category-lable-right">
      {{isset($arr_order['return_request']['refund_payment_method']) && $arr_order['return_request']['refund_payment_method'] == '1' ? 'Add In Amaaia Wallet' : '' }}
      {{isset($arr_order['return_request']['refund_payment_method']) && $arr_order['return_request']['refund_payment_method'] == '2' ? 'Add in Bank Account' : '' }}
    </div>
    <div class="clearfix"></div>
  </div>
</div>
 @if(isset($arr_order['return_request']['receipt']) && !empty($arr_order['return_request']['receipt']) && file_exists($bank_receipt_file_base_path.$arr_order['return_request']['receipt']))
    <div class="category-lable-main">
      <div class="category-lable-left">Receipt: </div> <div class="category-lable-right"> 
         
            <a target="_blank" href="{{$bank_receipt_file_public_path.$arr_order['return_request']['receipt']}}">View</a>
          
      </div>
      <div class="clearfix"></div>
    </div>
@endif

 @if(isset($arr_order['return_request']['refund_payment_method']) && $arr_order['return_request']['refund_payment_method'] == '2' && isset($arr_order['return_request']['bank_transferred_amt']) && !empty($arr_order['return_request']['bank_transferred_amt']))
    <div class="category-lable-main">
      <div class="category-lable-left">Transferred Amount In Bank A/c: </div> <div class="category-lable-right"> 
         
           @if($current_currency == 'USD')
               @if(isset($arr_order['return_request']['bank_transferred_amt']) && isset($arr_order['return_request']['usd_value']))
                 @php
                  $bank_transferred_amt = $arr_order['return_request']['bank_transferred_amt'] / $arr_order['return_request']['usd_value'];
                 @endphp
                  {{isset($bank_transferred_amt) ? '$ '.number_format((float)$bank_transferred_amt, 2, '.', '') : 'NA'}}
               @endif
           @else
              <i class="fa fa-inr"></i> {{$arr_order['return_request']['bank_transferred_amt'] or ''}}
           @endif
          
      </div>
      <div class="clearfix"></div>
    </div>
@endif

  @if(isset($arr_order['return_request']['wallet_details']['amount_credited']) && !empty($arr_order['return_request']['wallet_details']['amount_credited']))
      @if($current_currency == 'USD')
        <div class="category-lable-main">
          <div class="category-lable-left">Amount Credited in Wallet: </div> 
          <div class="category-lable-right"> 

               @if(isset($arr_order['return_request']['wallet_details']['amount_credited']) && isset($arr_order['return_request']['usd_value']))
                 @php
                  $return_final_amt_in_usd = $arr_order['return_request']['wallet_details']['amount_credited'] / $arr_order['return_request']['usd_value'];
                 @endphp
                  {{isset($return_final_amt_in_usd) ? '$ '.number_format((float)$return_final_amt_in_usd, 2, '.', '') : 'NA'}}
               @endif

          </div>
          <div class="clearfix"></div>
        </div>
      @else
        <div class="category-lable-main">
          <div class="category-lable-left">Amount Credited in Wallet: </div> <div class="category-lable-right"> <i class="fa fa-inr"></i> {{$arr_order['return_request']['wallet_details']['amount_credited']}}</div>
          <div class="clearfix"></div>
        </div>
      @endif
  @endif

 <div class="category-lable-main">
    <div class="category-lable-left">Comment: </div> <div class="category-lable-right"> {{$arr_order['return_request']['comment'] or ''}} </div>
    <div class="clearfix"></div>
 </div>
 <div class="category-lable-main">
    <div class="category-lable-left">Request Date: </div> <div class="category-lable-right"> {{isset($arr_order['return_request']['created_at']) ? date('d M,Y',strtotime($arr_order['return_request']['created_at'])) : 'NA'}}</div>
    <div class="clearfix"></div>
  </div>

<div class="clearfix"></div>
@endif

@if(isset($arr_order['replacement_request']) && !empty($arr_order['replacement_request'])) 
  <div class="border-details-odr"></div>
  <div class="description-ttl-order">
   Product Replacement Request Details
 </div>
 <div class="main-addressdelivery">
  <div class="username-order">{{$arr_order['order']['order_fname'] or ''}} {{$arr_order['order']['order_lname'] or ''}}</div>
  <div class="category-lable-main">
    <div class="category-lable-left">Item No: </div> <div class="category-lable-right"> {{$arr_order['item_number'] or 'NA'}}</div>
    <div class="clearfix"></div>
  </div>

  <div class="category-lable-main">
    <div class="category-lable-left">Reason: </div> <div class="category-lable-right"> {{$arr_order['replacement_request']['reason'] or 'NA'}}</div>
    <div class="clearfix"></div>
  </div>

  <div class="category-lable-main">
    <div class="category-lable-left">Delivery Method: </div> <div class="category-lable-right"> {{$arr_order['replacement_request']['delivery_method'] or 'NA'}}</div>
    <div class="clearfix"></div>
  </div>

  @if(isset($arr_order['replacement_request']['wallet_details']['amount_credited']) && !empty($arr_order['replacement_request']['wallet_details']['amount_credited']))
      @if($current_currency == 'USD')
        <div class="category-lable-main">
          <div class="category-lable-left">Amount Credited in Wallet: </div> 
          <div class="category-lable-right"> 

               @if(isset($arr_order['replacement_request']['wallet_details']['amount_credited']) && isset($arr_order['replacement_request']['usd_value']))
                 @php
                  $replacement_final_amt_in_usd = $arr_order['replacement_request']['wallet_details']['amount_credited'] / $arr_order['replacement_request']['usd_value'];
                 @endphp
                  {{isset($replacement_final_amt_in_usd) ? '$ '.number_format((float)$replacement_final_amt_in_usd, 2, '.', '') : 'NA'}}
               @endif

          </div>
          <div class="clearfix"></div>
        </div>
      @else
        <div class="category-lable-main">
          <div class="category-lable-left">Amount Credited in Wallet: </div> <div class="category-lable-right"> <i class="fa fa-inr"></i> {{$arr_order['replacement_request']['wallet_details']['amount_credited']}}</div>
          <div class="clearfix"></div>
        </div>
      @endif
  @endif

  <div class="category-lable-main">
    <div class="category-lable-left">Comment: </div> <div class="category-lable-right"> {{$arr_order['replacement_request']['comment'] or ''}} </div>
    <div class="clearfix"></div>
 </div>

 <div class="category-lable-main">
    <div class="category-lable-left">Request Date: </div> <div class="category-lable-right"> {{isset($arr_order['replacement_request']['created_at']) ? date('d M,Y',strtotime($arr_order['replacement_request']['created_at'])) : 'NA'}}</div>
    <div class="clearfix"></div>
  </div>
</div>



<div class="clearfix"></div>
@endif

@if(isset($arr_order['order']['cancellation_reason']) && !empty($arr_order['order']['cancellation_reason']) && isset($arr_order['order']['status']) && $arr_order['order']['status'] == '6')
    
  <div class="border-details-odr"></div>
  <div class="description-ttl-order">
   Order Cancellation Reason
 </div>
    <div class="category-lable-main">
         
           {{$arr_order['order']['cancellation_reason']}}
      </div>
      <div class="clearfix"></div>
    </div>
@endif

</div>
<div class="clearfix"></div>
</div>
</div>
</div>
</div>

@endsection