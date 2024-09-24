 <div class="col-md-4 col-lg-3">
     <div class="sidebar-inners">
        <div class="left-menu-bar-inner dashboard_heading">
            <div class="leftbar-title">
                <span></span> <div class="menu-titl-user">Menu</div>
            </div>
        </div>
        <ul class="menu-dashboards">
            <li><a href="{{url('/')}}/user/dashboard" class="@if(Request::segment(2) == 'dashboard') active @endif">Dashboard</a> </li>
            <li><a href="{{url('/')}}/user/my_account" class="@if(Request::segment(2) == 'my_account') active @endif">My Account</a> </li>
            <li><a href="{{url('/')}}/user/my_orders" class="@if(Request::segment(2) == 'my_orders') active @endif">My Orders</a> </li>
            <li><a href="{{url('/')}}/user/my_addresses" class="@if(Request::segment(2) == 'my_addresses') active @endif">My Addresses</a> </li>
            <li><a href="{{url('/')}}/user/replacement" class="@if(Request::segment(2) == 'replacement') active @endif">Replacement</a> </li>
            <li><a href="{{url('/')}}/user/notifications" class="@if(Request::segment(2) == 'notifications') active @endif">Notification</a> </li>
            <li><a href="{{url('/')}}/user/wishlist" class="@if(Request::segment(2) == 'wishlist') active @endif">Wishlist</a> </li>
            <li><a href="{{ url('/') }}/user/gift_card/send" class="@if(Request::segment(2) == 'gift_card') active @endif">Gift Card</a> </li>
            <li><a href="{{url('/')}}/user/my_wallet" class="@if(Request::segment(2) == 'my_wallet') active @endif">My Wallet</a> </li>
            <li><a href="{{url('/user/transaction_history')}}" class="@if(Request::segment(2) == 'transaction_history') active @endif">Transaction History</a> </li>
            <li><a href="{{url('/')}}/user/valuation" class="@if(Request::segment(2) == 'valuation') active @endif">Valuation</a> </li>
            <li><a href="{{url('/')}}/user/logout">Logout</a> </li>
        </ul>
    </div>
</div>

<script>
    $(".dashboard_heading").on("click", function(){
        $(".menu-dashboards").slideToggle("slow");
        $(this).toggleClass("active");
    });
</script>

