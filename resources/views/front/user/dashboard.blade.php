@extends('front.layout.master')   
@section('main_content')

<!-- Page breadcrumb -->  
@include('front.user.layout.breadcrumb')
<!-- /page breadcrumb -->
<style type="text/css">
  .right-count{
    color: black;
  }
</style>
<div class="inner-page-main min-hieght-class">


  <div class="container">
    <div class="row">
      <div id="left-bar">
       @include('front.user.layout.sidebar')
     </div>
     <a href="{{url('/user/my_orders')}}">
       <div class="col-md-8 col-lg-9">
        <div class="row">
          <div class="col-md-6 col-lg-6">
            <div class="my-order-dashboard my-order-box">
             <div class="icon-dashboard">
               <i class="fa fa-file-o"></i>
             </div>
             <div class="order-txt-dash">My Orders</div>
             <div class="count-dashboards-amin">
              <div class="left-count">{{get_order_count(login_user_id('user'))}}</div>
              <div class="right-count">
               Total <br> Orders
             </div>
             <div class="clearfix"></div>
           </div>
           <div class="order-small-fnt">
            (Total)
          </div>
        </div>
      </div>
    </a>

    <a href="{{url('/user/notifications')}}"> 
      <div class="col-md-6 col-lg-6">
        <div class="my-order-dashboard notifications-box">
         <div class="icon-dashboard notifications-icn">
           <i class="fa fa-bell-o"></i>
         </div>
         <div class="order-txt-dash">Notifications</div>
         <div class="count-dashboards-amin">
          <div class="left-count">{{isset($notifications_count) && !empty($notifications_count) ? sprintf("%02d", $notifications_count) : 0}}</div>
          <div class="right-count">
           New <br> Notifications
         </div>
         <div class="clearfix"></div>
       </div>
       <div class="order-small-fnt">
        (Total)
      </div>
    </div>
  </div>
</a>

<a href="{{url('/user/wishlist')}}">
  <div class="col-md-6 col-lg-4">
    <div class="my-order-dashboard my-wishlist-box">
     <div class="icon-dashboard my-wishlist-icn">
       <i class="fa fa-heart"></i>
     </div>
     <div class="order-txt-dash">My Wishlist</div>
     <div class="count-dashboards-amin">
      <div class="left-count">{{isset($wishlist_product_count) && !empty($wishlist_product_count) ? sprintf("%02d", $wishlist_product_count) : 0}}</div>
      <div class="right-count">
       Recent <br> Wishlist
     </div>
     <div class="clearfix"></div>
   </div>
   <div class="order-small-fnt">
    (Total)
  </div>
</div>
</div>

</a>

<a href="{{url('/user/gift_card/received')}}">
  <div class="col-md-6 col-lg-4">
    <div class="my-order-dashboard gift-cards-box">
     <div class="icon-dashboard gift-cards-icn">
       <i class="fa fa-gift"></i>
     </div>
     <div class="order-txt-dash">Gift Cards</div>
     <div class="count-dashboards-amin">
      <div class="left-count">{{isset($received_gift_card_count) && !empty($received_gift_card_count) ? sprintf("%02d", $received_gift_card_count) : 0}}</div>
      <div class="right-count">
       Received <br> Gift Cards
     </div>
     <div class="clearfix"></div>
   </div>
   <div class="order-small-fnt">
    (Total)
  </div>
</div>
</div>
</a>

<a href="{{url('/')}}/user/replacement">
  
  <div class="col-md-6 col-lg-4">
    <div class="my-order-dashboard replacement-box">
     <div class="icon-dashboard gift-cards-icn">
       <i class="fa fa-retweet"></i>
     </div>
     <div class="order-txt-dash">Replacement</div>
     <div class="count-dashboards-amin">
      <div class="left-count">{{replacement_order_count(login_user_id('user'))}}</div>
      <div class="right-count">
       Send  <br> Replace
     </div>
     <div class="clearfix"></div>
   </div>
   <div class="order-small-fnt">
    (Total)
  </div>
</div>
</div>
</a>


<div class="col-md-12 col-lg-12">
  @if(isset($arr_trasactions) && is_array($arr_trasactions) && sizeof($arr_trasactions)>0)
  <div class="transactions-sctino">
    Transactions
  </div>
  <div class="table-ammaia">
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>SR.NO.</th>
            <th>Order Id</th>
            <th>Date</th>
            <th>Tracking Id</th>
            <th>Type</th>
            <th>Amount</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach($arr_trasactions as $key => $transaction)
          <tr>
            <td>{{$key+1}}.</td>
            <td class="whitenowraps">
              @if(isset($transaction['order_id']) && $transaction['order_id'] !='')
              {{$transaction['order_id']}}
              @else
              --
              @endif
            </td>
            <td>{{formatted_trasaction_date($transaction['updated_at'])}}</td>
            <td>
              @if(isset($transaction['tracking_id']) && $transaction['tracking_id'] !='')
              {{$transaction['tracking_id']}}
              @else
              --
              @endif
              <td>
                @if(isset($transaction['trans_type']) && $transaction['trans_type']=='1')
                Order
                @elseif(isset($transaction['trans_type']) && $transaction['trans_type']=='2')
                Gift Card
                @elseif(isset($transaction['trans_type']) && $transaction['trans_type']=='3')
                Return
                @elseif(isset($transaction['trans_type']) && $transaction['trans_type']=='4')
                Replacement
                @endif
              </td>
              <td>
                @if($currency == 'INR')
                <i class="fa fa-inr"></i>{{$transaction['amount']}}
                @else
                <i class="fa fa-usd"></i>{{number_format($transaction['amount']/$transaction['transaction_usd_value'], 2)}}
                @endif
              </td>
              <td>
                @if($transaction['payment_status']=='0')
                <div class="completed-txt" style="color: #f84224;">Pending</div>

                @elseif($transaction['payment_status']=='1')
                <div class="completed-txt">Success</div>

                @else
                <div class="completed-txt" style="color: #c9353d;">Failed</div>

                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    @else
    <div class="transactions-sctino">
      No New Transactions
    </div>
    @endif
  </div>

</div>

</div>
</div>
</div>
</div>

@endsection