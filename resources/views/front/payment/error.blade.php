@extends('front.layout.master')
@section('main_content')
<div class="login-page-main min-hieght-class">
        
    <div class="container">
       
        <div class="min-height-thankyou  four-pgmain">
      
        <div class="title-pagenotfound">Error!</div>
        <div class="tahnkyou-conts">
        Your payment was unsuccessful due to technical problems please try again!<br><br>
        {{-- Thank you for shopping with us online --}}
        </div>
        <div class="button-backhome">
            <a class="button-shop" href="{{url('/')}}"><span>go to home</span></a>
        </div>
       </div> 
        <div class="clearfix"></div>
    </div>
</div>

<div class="footer-left-right-img">
    <div class="thankyou-left"><img src="{{url('/front')}}/images/404-page-image-amaaia-left.png" alt="" /></div>
    <div class="thankyou-right"><img src="{{url('/front')}}/images/404-page-image-amaaia-right.png" alt="" /></div>
</div>
<div class="clearfix"></div>

@endsection