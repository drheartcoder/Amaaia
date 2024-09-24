@extends('front.layout.master')                
@section('main_content')

<div class="bradcrum-inner">
    <div class="pul-left-title">
        Gift Card
    </div>
    <div class="pul-right-sublink">
        <a href="{{url('/')}}">Home</a> / <span>Gift Card</span>
    </div>
    <div class="clearfix"></div>
</div>

<div class="inner-page-main min-hieght-class usergiftmain">
    <div class="container">
        <div class="row-gift-carts newrow-gift-carts">
            <div class="row">
                @include('front.layout._operation_status')
                    @if($errors->all() && !empty(sizeof($errors->all())) )
                        <div style="color:red" class="text-center"> 
                            Please insert valid data. Open Send gift card form for more details<br><br>      
                        </div>
                    @endif
                    
                @if(isset($arr_gift_cards['data']) && !empty($arr_gift_cards['data']))
                    @foreach($arr_gift_cards['data'] as $giftcard)                                    
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="gift-cart-box-four send_gift_card" data-gift-card-id="{{isset($giftcard['id']) ? base64_encode($giftcard['id']) : 0 }}" data-gift-card-amt="{{isset($giftcard['amount']) ? session_currency($giftcard['amount'])  : 0 }}" data-gift-card-amt-rs="{{isset($giftcard['amount']) ? $giftcard['amount']  : 0 }}" data-toggle="modal" @if(validate_login('user') == 'true') data-target="#send-gift-card" @endif>
                            <div class="img-giftcart">

                                <div class="gift-price">{!! isset($giftcard['amount']) ? session_currency($giftcard['amount']) : '' !!}</div>

                                @php

                                if(isset($giftcard['image']) && !empty($giftcard['image']) && File::exists($gift_card_image_base_path.$giftcard['image']))
                                {
                                    $image_path = $gift_card_image_public_path.$giftcard['image'];
                                }
                                else
                                {
                                    $image_path = url('/').'/uploads/admin/default_image/gift_card.png';
                                }
                                @endphp

                                <img src="{{$image_path or ''}}" alt="" />
                               

                            </div>
                            <div class="gift-contents-usr">
                                <div class="usr-nms-crt"><span><i class="fa fa-gift"></i></span> {{$giftcard['title'] or 'NA'}}</div>
                                 <div class="footer-img-section-gift usrs-g-gift">
                                    <span><i class="fa fa-calendar"></i></span>&nbsp; {{isset($giftcard['created_at']) ?  date('d M Y', strtotime($giftcard['created_at'])) : '' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                   <div class="col-lg-12 text-center">
                            <h4>No gift card found.</h4>
                   </div>
                @endif

            </div>
        </div>

        @if(isset($arr_pagination) && $arr_pagination != null)
        @include('front.common.pagination')
        @endif

    </div>
</div>


<div id="send-gift-card" class="gift-cartmodal modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"></button>
                <div class="title-modals">
                    Send Gift Card
                </div>
            </div>
            <div class="modal-body">
               
                <form id="frm_send_gift_card" name="frm_send_gift_card" method="post" action="{{$module_url_path}}/send">

                    {{csrf_field()}}
                    <input type="hidden" id="gift_card_id" name="gift_card_id">
                    <div class="box-form">
                        <label for="email">Email</label>
                        <input id="email" name="email" placeholder="Enter receiver Email Address" type="text" data-rule-required="true" />
                        <div class="error-smg">{{$errors->first('email')}}</div>
                    </div>
                    <div class="box-form">
                        <label for="confirm_email">Confirm Email</label>
                        <input id="confirm_email" name="confirm_email" placeholder="Confirm Email Address" type="text" data-rule-required="true" data-rule-equalto="#email" />
                       <div class="error-smg">{{$errors->first('confirm_email')}}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="box-form">
                                <label>Country Code</label>
                                <div class="select-style select2 udated-select">
                                    <select class="frm-select" id="country_code" name="country_code" data-rule-required="true">
                                        <option value="" selected="">--Select Country Code--</option>
                                        @if(isset($arr_phonecode) && is_array($arr_phonecode) && sizeof($arr_phonecode)>0)
                                            @foreach($arr_phonecode as $phonecode)
                                            <option value="{{isset($phonecode['phonecode'])? base64_encode($phonecode['phonecode']):''}}" {{!empty(old('phonecode')) && isset($phonecode['id']) && base64_decode(old('phonecode')) == $phonecode['id'] ? 'selected' : '' }}>
                                                +{{$phonecode['phonecode'] or ''}} ({{$phonecode['CountryCode'] or ''}})
                                            </option>
                                            @endforeach
                                        @endif                                
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="box-form">
                                <label for="mobile_no">Mobile Number</label>
                                <input id="mobile_no" name="mobile_no" placeholder="Enter receiver Mobile Number" type="text"  data-rule-required="true" data-rule-pattern="[- +()0-9]+" data-rule-minlength="7" data-rule-maxlength="16" data-msg-minlength="Mobile number should be at least 7 numbers." data-msg-maxlength="Mobile number should not be more than 16 numbers." />
                                <div class="error-smg">{{$errors->first('mobile_no')}}</div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="box-form">
                                <label for="confirm_mobile_no">Confirm Mobile Number</label>
                                <input id="confirm_mobile_no" name="confirm_mobile_no" placeholder="Confirm Mobile Number" type="text"  data-rule-required="true" data-rule-equalto="#mobile_no"  data-rule-pattern="[- +()0-9]+" data-rule-minlength="7" data-rule-maxlength="16" data-msg-equalto="Please enter same mobile number again" />
                                <div class="error-smg">{{$errors->first('confirm_mobile_no')}}</div>
                            </div>
                        </div>
                    </div>                                        
                    <div class="box-form">
                        <label for="amount">Amount</label>
                        <input id="amount" name="amount" placeholder="Enter Amount" type="text" disabled="true" />
                        <div class="error-smg">{{$errors->first('amount')}}</div>
                    </div>                   
                    <div class="full-button">
                        <input type="hidden" id="amt_in_rs" name="amt_in_rs">
                        <button type="submit" id="btn_send_gift_card" name="btn_send_gift_card" class="button-shop"><span>Proceed to Payment</span></button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>


<script>
    $('#horizontalTab').easyResponsiveTabs({
        type: 'default',
        width: 'auto',
        fit: true,
        closed: 'accordion',
        activate: function(event) {
            var $tab = $(this);
            var $info = $('#tabInfo');
            var $name = $('span', $info);

            $name.text($tab.text());

            $info.show();
        }
    });

    $(document).ready(function(){

        $('#frm_send_gift_card').validate({
            ignore: [],
            errorClass:'error-smg',
            errorElement: "span",
            rules: {
                email: {
                    required: true,
                    email: true,
                    pattern: /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/
                }
            },
            highlight: function(element) { },
               errorPlacement: function(error, element) 
               { 
                    error.insertAfter(element);
               } 
        });

        $('.send_gift_card').click(function(){

            @if(validate_login('user') == false)
                /*swal('','Please login to your account to send gift card.','error');*/
                @php 
                Session::put('return_url',\Request::segment(1));
                @endphp
                window.location = '{{url('/login')}}';
                /*return false;*/
            @endif

            $('#gift_card_id').val($(this).attr('data-gift-card-id'));
            

            $('#amt_in_rs').val($(this).attr('data-gift-card-amt-rs'));

            var amt = $("<div/>").html($(this).attr('data-gift-card-amt')).text();



            $('#amount').val(amt);
        });
    });

</script>

@endsection
