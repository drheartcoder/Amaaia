@extends('front.layout.master')   
@section('main_content')

<!-- Page breadcrumb -->  
@include('front.user.layout.breadcrumb')
<!-- /page breadcrumb -->

<div class="inner-page-main min-hieght-class usergiftmain">
        <div class="container">           

            <div class="row">
                <div id="left-bar">
                  @include('front.user.layout.sidebar')
                </div>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="cart-login">
                         @include('front.layout._operation_status')
                        <form id="frm_product_replacement_request" name="frm_product_replacement_request" method="post" action="{{$module_url_path}}/proceed">
                          {{csrf_field()}}
                          <input type="hidden" name="product_id" value="{{$arr_order['product_id'] or ''}}">
                          <input type="hidden" name="order_id" value="{{$arr_order['order_id'] or ''}}">
                          <input type="hidden" name="order_product_id" value="{{$arr_order['id'] or ''}}">
                          <input type="hidden" name="product_name" value="{{$arr_order['product_name'] or ''}}">
                          <div class="row">
                              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                  <div class="title-logins-accounts">Replacement</div>
                              </div>
                               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                  <div class="box-form">
                                      <label for="orderid">Order ID</label>
                                      <input id="orderid" name="orderid" type="text" value="{{$arr_order['order_id'] or ''}}" disabled="true" />
                                     
                                  </div>
                              </div>
                               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                  <div class="box-form">
                                      <label for="itemnum">Item No</label>
                                      <input id="itemnum" name="itemnum" type="text" value="{{$arr_order['item_number'] or ''}}" disabled="true" />
                                  </div>
                              </div>
                              
                              
                               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                  <div class="box-form">
                                       <label>Reason</label>
                                       <div class="select-style select2 udated-select">
                                          <select class="frm-select" data-rule-required='true' data-msg-required='Please select the reason.' id="reason" name="reason">
                                              <option value="">Select reason</option>
                                              <option>Damaged</option>
                                              <option>Defective</option>
                                              <option>Different</option>
                                              <option>Didn’t Like</option>
                                              <option>Other</option>
                                          </select>
                                            <div class="error-smg">{{$errors->first('reason')}}</div>
                                      </div>
                                    </div>
                              </div>
                              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                  <div class="box-form">
                                       <label>Method Of Delivery</label>
                                       <div class="select-style select2 udated-select">
                                          <select class="frm-select" id="delivery_method" name="delivery_method" data-rule-required='true' data-msg-required='Please select method of delivery.'>
                                              <option value="">Select method of payment</option>
                                              <option>Self Shipment</option>
                                              <option>Amaaia Pickup</option>
                                          </select>
                                              <span class="error-smg">{{$errors->first('delivery_method')}}</span>
                                      </div>
                                    </div>
                              </div>
                               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                  <div class="box-form">
                                       <label for="mobilenums">Mobile Number</label>
                                       <div class="select-style select2 udated-select inline-inputs">
                                          <select class="frm-select" id="phonecode" name="phonecode" data-rule-required='true' data-msg-required='Please select country phone code.'>
                                             <option value="">Select Country Code</option>
                                              @if(isset($arr_phonecode) && is_array($arr_phonecode) && sizeof($arr_phonecode)>0)
                                                @foreach($arr_phonecode as $phonecode) 
                                                <option value="{{isset($phonecode['phonecode'])? base64_encode($phonecode['phonecode']):''}}">
                                                      +{{$phonecode['phonecode'] or ''}} ({{$phonecode['CountryCode'] or ''}})
                                                  </option>
                                                @endforeach
                                              @endif
                                          </select>
                                          <span class="error-smg">{{$errors->first('phonecode')}}</span>
                                      </div>
                                     <div class="user-mobile-int"> 
                                        <input id="mobile_number" name="mobile_number" placeholder="Enter your Mobile Number" type="text" data-rule-required="true" data-rule-pattern="[- +()0-9]+" data-rule-minlength="7" data-rule-maxlength="16" data-msg-minlength="Mobile no should be atleast 7 numbers" data-msg-maxlength="Mobile no should not be more than 16 numbers" />
                                        <span class="error-smg">{{$errors->first('mobile_number')}}</span>
                                      </div>
                                    </div>
                              </div>
                              
                              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                  <div class="box-form">
                                      <label for="address">Comments</label>
                                      <textarea name="comment" id="comment" placeholder="Enter your Comments" data-rule-required="true" data-rule-maxlength="500"></textarea>
                                      <span class="error-smg">{{$errors->first('comment')}}</span>
                                  </div>
                              </div>
                          </div>
                          <div class="box-form login-carts none-psace mobile-btns-shop">
                              <div class="full-button">
                                  <button type="submit" class="button-shop" id="btn_product_return_request" name="btn_product_return_request"><span>Send Request</span></button>
                              </div>
                          </div>
                          <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
              $('#frm_product_replacement_request').validate({
                  ignore: [],
                  errorClass: "error-smg",
                  errorElement: "span",
                  highlight: function(element) { },
                  rules: {
                    
                  }
              });
        });
    </script>

@endsection