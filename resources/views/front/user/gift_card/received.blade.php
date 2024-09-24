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
         
         <div class="col-md-8 col-lg-9">
            <div class="tabbing_area usergoft-cart-tab">
               <div id="horizontalTab">
                  
                  <ul class="resp-tabs-list">
                     <a href="{{ $module_url_path }}/send"><li id="tab_send">Sent Gift Cards</li></a>
                     <a href="{{ $module_url_path }}/received"><li id="tab_received">Received Gift Cards</li></a>
                  </ul>

                  <div class="resp-tabs-container">

                     <div id="div_received">
                        <div class="row-gift-carts">
                           <div class="row">
                              
                              @if(isset($arr_usergiftcard['data']) && !empty($arr_usergiftcard['data']))
                            
                              @foreach($arr_usergiftcard['data'] as $giftcard)
                                
                                @php
                                  $amount = isset($giftcard['amount']) ? $giftcard['amount'] : '';

                                  if(Session::has('get_currency'))
                                  {
                                    if(Session::get('get_currency') == 'USD')
                                    {
                                      $store_usd  = $giftcard['giftcard_details']['amount_usd'];
                                      $amount     = $amount / $store_usd;
                                      $amount     = number_format($amount, 2, '.', '');
                                      $new_amount = "<i class='fa fa-usd'></i> ".number_format($amount,2);
                                    }
                                    else
                                    {
                                      $amount     = number_format($amount, 2, '.', '');
                                      $new_amount = "<i class='fa fa-inr'></i> ".number_format($amount,2);
                                    }
                                  }
                                  else
                                  {
                                    $amount     = number_format($amount, 2, '.', '');
                                    $new_amount = "<i class='fa fa-inr'></i> ".number_format($amount,2);
                                  }

                                  $created_at = isset($giftcard['created_at']) ? date('d M Y',strtotime($giftcard['created_at'])) : '';
                                  $code       = isset($giftcard['gift_card_code']) ? $giftcard['gift_card_code'] : '';
                                  $email      = isset($giftcard['user_to_email']) ? $giftcard['user_to_email'] : '';
                                  $phone      = isset($giftcard['user_to_phone']) ? $giftcard['user_to_phone'] : '';
                                  $first_name = isset($giftcard['user_details']['first_name']) ? $giftcard['user_details']['first_name'] : '';
                                  $last_name  = isset($giftcard['user_details']['last_name']) ? $giftcard['user_details']['last_name'] : '';

                                  if(isset($giftcard['giftcard_details']['image']) && !empty($giftcard['giftcard_details']['image']) && File::exists($gift_card_image_base_path.$giftcard['giftcard_details']['image']))
                                  {
                                    $image_path = $gift_card_image_public_path.$giftcard['giftcard_details']['image'];
                                  }
                                  else
                                  {
                                    $image_path = url('/').'/uploads/admin/default_image/gift_card.png';
                                  }
                                @endphp

                              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                 <div class="gift-cart-box-four">
                                    <div class="img-giftcart">
                                       <div class="gift-ids">
                                          <span></span> {{ $code }}
                                       </div>
                                       <div class="gift-price">{!! $new_amount !!}</div>
                                       <img src="{{ $image_path }}" alt="" />
                                       <div class="footer-img-section-gift usrs-g-gift">
                                          <span><i class="fa fa-calendar"></i></span> {{ $created_at }}
                                       </div>
                                       <div class="footer-img-section-gift usrs-g-gift-right">
                                          <span><i class="fa fa-mobile"></i></span> {{ $phone }}
                                       </div>
                                    </div>
                                    <div class="gift-contents-usr">
                                       <div class="usr-nms-crt"><span><i class="fa fa-user-o"></i></span> {{ $first_name.' '.$last_name }}</div>
                                       <div class="usr-nms-crt"><span><i class="fa fa-envelope-o"></i></span> {{ $email }}</div>
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
                     </div>
                  </div>
               </div>
            </div>
            
            @if(isset($arr_pagination) && $arr_pagination != null)
                @include('front.common.pagination')
            @endif

         </div>
      </div>
   </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    $("#tab_send").removeClass("resp-tab-active");
    $("#tab_received").addClass("resp-tab-active");
  });
</script>
@endsection
