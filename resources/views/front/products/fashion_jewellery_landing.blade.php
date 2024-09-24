@extends('front.layout.master')
@section('main_content')

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active" style="background: url({{url('/')}}/front/images/fashion-jewellery-banner.jpg) no-repeat ;background-position: center center; -webkit-background-size: cover;
        -moz-background-size: cover; -o-background-size: cover; background-size: cover; margin: 0px;padding: 0;">
        <div class="carousel-caption">
            <div class="banner-text-block">
                <div class="title-slider-home">Awesome </div>
                <h1>Fashion Jewellery</h1>
                <p>Beautiful, masterful design never goes out of fashion.</p>
                <div class="shop-now-btn">
                    <a class="button-shop" href="javascript:void(0)"><span>Shop Now</span></a>
                </div>
            </div>
        </div>
    </div>
    <div class="item" style="background: url({{url('/')}}/front/images/fashion-jewellery-banner2.jpg) no-repeat ;background-position: center center; -webkit-background-size: cover;
    -moz-background-size: cover; -o-background-size: cover; background-size: cover; margin: 0px;padding: 0;">
    <div class="carousel-caption">
        <div class="banner-text-block">
            <div class="title-slider-home">Awesome </div>
            <h1>Fashion Jewellery</h1>
            <p>Beautiful, masterful design never goes out of fashion.</p>
            <div class="shop-now-btn">
                <a class="button-shop" href="javascript:void(0)"><span>Shop Now</span></a>
            </div>
        </div>
    </div>
</div>
 <div class="item" style="background: url({{url('/')}}/front/images/fashion-jewellery-banner3.jpg) no-repeat ;background-position: center center; -webkit-background-size: cover;
    -moz-background-size: cover; -o-background-size: cover; background-size: cover; margin: 0px;padding: 0;">
    <div class="carousel-caption">
        <div class="banner-text-block">
            <div class="title-slider-home">Awesome </div>
            <h1>Fashion Jewellery</h1>
            <p>Beautiful, masterful design never goes out of fashion.</p>
            <div class="shop-now-btn">
                <a class="button-shop" href="javascript:void(0)"><span>Shop Now</span></a>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Controls -->
<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="slider-icon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
</a>
<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="slider-icon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
</a>
</div>
<!--Slider section start here-->

<!-- Fashion Jewellery Section Start -->
<div class="fashion-jewellery-main-bx">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="banner-text-block fashion-jewellry-txt-tlt">
                    <div class="title-slider-home">Silver Jewellery with</div>
                    <h1>American Diamond</h1>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <p class="fastion-jewellery-p">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea.</p>
                    </div>
                    <div class="col-md-6">
                        <p class="fastion-jewellery-p">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea.</p>
                    </div>
                    <div class="col-md-12">
                        <div class="shop-now-btn space-mobile-btns mobilecenterbutton">
                            <a class="button-shop" href="{{url('/about_us')}}"><span>Know About US</span></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="main-fashion-rightimg">
                    <div class="fashion-jewellery-right-side-image">
                        <img src="{{url('/')}}/front/images/fashion-jewellery-american-daimond.jpg" alt="" />
                    </div>
                    <div class="clearfix"></div>
                    <div class="fashion-jewellery-right-side-border"></div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Fashion Jewellery Section End -->

<!-- Fashion Jewellery Beauty Things Start-->
<div class="beauty-thing-section">
    <div class="container">


        <div class="title-ammaina-home">
            <div class="discover-txts-amin">Perfect</div>
            <div class="sub-title-hm">Beauty Things</div>
        </div>
@php 
$rand_images = array("fashion-jewellery-beauty-6.png", "fashion-jewellery-beauty-7.png");
@endphp
        <div class="main-beauty-box">
            <div class="beauty-leftbox">
                <div class="beauty6-col">
                    <div class="beauty6-col-right">
                        <div class="perfect-sect-txt mt-mgn-beauty">
                            <img src="{{url('front/images/'.$rand_images['0'])}}" alt="" />
                        </div>
                        <div class="perfect-sect-title">
                            <div class="title-perfect-sect">{{$arr_random_subcategory[0]['subcategory_name'] or ''}}</div>
                            <div class="sub-title-perfect">Real Jeweller Beauty</div>
                            <div class="button-perfect">
                                <div class="left-cancle-buton">
                                    <a class="button-shop" href="{{url('/fashion-jewellery/'.$arr_random_subcategory[0]['slug'])}}"><span>Shop Now</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="beauty-leftbox">
                <div class="beauty6-col right-cols">
                    <div class="beauty6-col-right">

                        <div class="perfect-sect-title">
                            <div class="title-perfect-sect">{{$arr_random_subcategory[1]['subcategory_name'] or ''}}</div>
                            <div class="sub-title-perfect">New Designs with Creativity</div>
                            <div class="button-perfect">
                                <div class="left-cancle-buton">
                                    <a class="button-shop" href="{{url('/fashion-jewellery/'.$arr_random_subcategory[1]['slug'])}}"><span>Shop Now</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="perfect-sect-txt mt-mgn-beauty-right">
                            <img src="{{url('front/images/'.$rand_images['1'])}}" alt="" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

</div>

<!-- Fashion Jewellery Beauty Things End-->


<!--New Arrivals Section Start-->
<div class="new-arrivals-section">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="row">

                    <div class="col-md-12">
                        <div class="title-ammaina-home spacebottom-titls">
                            <div class="discover-txts-amin">Discover</div>
                            <div class="sub-title-hm">New Arrivals</div>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="image-right-arrival">
                            <img src="{{url('/')}}/front/images/new-arrivals-a1.png" alt="" />
                        </div>
                        <div class="title-right-arrival">
                            <div class="title-new-arrival">Fashion Earrings</div>
                            <div class="content-new-arrival">Lorem ipsum dolor sit amet, consectetuad ipiscing elit, sed do eiusmod tempor incididunt ut ipsm..</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="image-right-arrival">
                            <img src="{{url('/')}}/front/images/new-arrivals-a2.jpg" alt="" />
                        </div>
                        <div class="title-right-arrival">
                            <div class="title-new-arrival">Fashion Rings</div>
                            <div class="content-new-arrival">Lorem ipsum dolor sit amet, consectetuad ipiscing elit, sed do eiusmod tempor incididunt ut ipsm..</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="image-right-arrival">
                            <img src="{{url('/')}}/front/images/new-arrivals-a3.png" alt="" />
                        </div>
                        <div class="title-right-arrival">
                            <div class="title-new-arrival">Men's Collection</div>
                            <div class="content-new-arrival">Lorem ipsum dolor sit amet, consectetuad ipiscing elit, sed do eiusmod tempor incididunt ut ipsm..</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="image-right-arrival">
                            <img src="{{url('/')}}/front/images/new-arrivals-a4.png" alt="" />
                        </div>
                        <div class="title-right-arrival last-spce-none">
                            <div class="title-new-arrival">Women Collections</div>
                            <div class="content-new-arrival">Lorem ipsum dolor sit amet, consectetuad ipiscing elit, sed do eiusmod tempor incididunt ut ipsm..</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!--New Arrivals Section End-->


<!--  Featured Jewellery Start -->
@if(isset($arr_subcategory) && is_array($arr_subcategory) && sizeof($arr_subcategory))
<div class="featured-jewellery-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="title-ammaina-home">
                    <div class="discover-txts-amin">Make</div>
                    <div class="sub-title-hm">Featured Jewellery</div>
                </div>
            </div>
            @foreach($arr_subcategory as $key => $subcategory)
            
            @if($key%2=='0')
            <div class="col-md-6 spacesmall-jewellery">
                @endif

                <div class="@if($key%3 == 0)featured-jewellery-imgs-one @else featured-jewellery-imgs-one secnd-features @endif ">
                    <div class="img-feturess"><img src="{{$subcategory_image_public_path.$subcategory['image']}}" alt="" /></div>
                   {{--  <div class="img-feturess"><img src="{{get_resized_image($subcategory['image'], $subcategory_image_base_path,373,783)}}" alt="" /></div> --}}
                    <div class="content-box-fasn">
                        <div class="title-featureds-sn">{{$subcategory['subcategory_name'] or ''}}</div>
                        <div class="title-featureds-text">{{str_limit($subcategory['description'], 50)}}</div>
                        <div class="shop-now-btn featured-btns">
                        <a class="button-shop" href="{{url('/fashion-jewellery/'.$subcategory['slug'])}}"><span>Read More</span></a>
                        </div>
                    </div>
                </div>

                @if($key%2!='0')
            </div>
            @endif

            @endforeach
        </div>
    </div>
</div>
@endif
<!--  Featured Jewellery End -->

@endsection