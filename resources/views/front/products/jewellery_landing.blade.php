@extends('front.layout.master')   
@section('main_content')
<!--Header section end here-->

<!--Slider section start here-->
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active" style="background: url({{url('/')}}/front/images/jewellery-landings-banner1.jpg) no-repeat ;background-position: center center; -webkit-background-size: cover;
        -moz-background-size: cover; -o-background-size: cover; background-size: cover; margin: 0px;padding: 0;">

        <div class="carousel-caption wow fadeIn" data-wow-delay="0.3s">
            <div class="banner-text-block">
                <div class="title-slider-home wow fadeIn" data-wow-delay="0.3s">Elegant Fashion Design</div>
                <h1 class="wow fadeIn" data-wow-delay="0.5s">Classic Jewellery</h1>
                <p class="wow fadeIn" data-wow-delay="0.6s">Lorem ipsum dolor sit amet, feugiat delicata liberavisse id cum, no quo maiorum intellegebat, liber regione eu sit. </p>
                <div class="shop-now-btn wow fadeIn" data-wow-delay="0.7s" >
                    <a class="button-shop" href="{{url('/')}}"><span>Shop Now</span></a>
                </div>
            </div>
        </div>

    </div>
    <div class="item" style="background: url({{url('/')}}/front/images/jewellery-landings-banner2.jpg) no-repeat ;background-position: center center; -webkit-background-size: cover;
    -moz-background-size: cover; -o-background-size: cover; background-size: cover; margin: 0px;padding: 0;">
    <div class="carousel-caption wow fadeIn" data-wow-delay="0.3s">
     <div class="banner-text-block">
        <div class="title-slider-home wow fadeIn" data-wow-delay="0.3s">Elegant Fashion Design</div>
        <h1 class="wow fadeIn" data-wow-delay="0.5s">Classic Jewellery</h1>
        <p class="wow fadeIn" data-wow-delay="0.6s">Lorem ipsum dolor sit amet, feugiat delicata liberavisse id cum, no quo maiorum intellegebat, liber regione eu sit. </p>
        <div class="shop-now-btn wow fadeIn" data-wow-delay="0.7s" >
            <a class="button-shop" href="{{url('/')}}"><span>Shop Now</span></a>
        </div>
    </div>
</div>
</div>
 <div class="item" style="background: url({{url('/')}}/front/images/jewellery-landings-banner3.jpg) no-repeat ;background-position: center center; -webkit-background-size: cover;
    -moz-background-size: cover; -o-background-size: cover; background-size: cover; margin: 0px;padding: 0;">
    <div class="carousel-caption wow fadeIn" data-wow-delay="0.3s">
     <div class="banner-text-block">
        <div class="title-slider-home wow fadeIn" data-wow-delay="0.3s">Elegant Fashion Design</div>
        <h1 class="wow fadeIn" data-wow-delay="0.5s">Classic Jewellery</h1>
        <p class="wow fadeIn" data-wow-delay="0.6s">Lorem ipsum dolor sit amet, feugiat delicata liberavisse id cum, no quo maiorum intellegebat, liber regione eu sit. </p>
        <div class="shop-now-btn wow fadeIn" data-wow-delay="0.7s" >
            <a class="button-shop" href="{{url('/')}}"><span>Shop Now</span></a>
        </div>
    </div>
</div>
</div>
</div>

<!-- Controls -->
<a class="left carousel-control  wow fadeIn" data-wow-delay="0.3s" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="slider-icon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
</a>
<a class="right carousel-control  wow fadeIn" data-wow-delay="0.3s" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="slider-icon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
</a>
</div>
<!--Slider section start here-->


<!--Jewellery Landing Start-->
<div class="jewellery-landing-beauty-tngs">
    <div class="container">
     @if(isset($arr_subcategory) && is_array($arr_subcategory) && sizeof($arr_subcategory)>0)
     <div class="title-ammaina-home">
        <div class="discover-txts-amin">Perfect</div>
        <div class="sub-title-hm">Beauty Things</div>
    </div>
@php
$images_array = array('jewellery-landing-beauty-things1.jpg','jewellery-landing-beauty-things2.jpg','jewellery-landing-beauty-things3.jpg','jewellery-landing-beauty-things4.jpg'); 
@endphp
    <div class="fastionjewellery-slides" id="zA7n">
        <ul class="accordion__ul">
            @foreach($arr_subcategory as $key => $subcategory)
            <li class="accordion__li"><img class="accordion__img" src="{{url('front/images').'/'.$images_array[$key]}}" alt="Image Alt" />

                 <div class="content-jewelry-lang-hover">
                    <div class="titlelandinghead">{{$subcategory['subcategory_name'] or ''}}</div>
                    <div class="textlandinghead">{{str_limit($subcategory['description'],200)}}</div>
                    <div class="shop-now-btn colr-btn">
                      <a class="button-shop" href="{{url('jewellery/'.str_slug($subcategory['subcategory_name']))}}"><span>Shop Now</span></a>
                    </div>
                </div>

            </li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- New End -->    




    </div>
</div>
<!--Jewellery Landing End-->    


<!--Slider Discover section start here-->
<div class="mainslider-jelr-land">
 <div class="add-not-slider">
     <div class="carousel-caption">
        <div class="banner-text-block">
            <div class="title-slider-home">Discover</div>
            <h1>Style with <br> New Collection</h1>
            <div class="shop-now-btn">
                <a class="button-shop" href="{{url('/collection')}}"><span>Shop Collection</span></a>
            </div>
        </div>
    </div>
</div>


 <div id="myCarousel" class="carousel slide jewellery-landing-slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active" style="background: url({{url('/')}}/front/images/jewellery-landing-discover-slider1.png) no-repeat ;background-position: center center; -webkit-background-size: cover;
    -moz-background-size: cover; -o-background-size: cover; background-size: cover; margin: 0px;padding: 0;">
            </div>
            <div class="item" style="background: url({{url('/')}}/front/images/jewellery-landing-discover-slider2.png) no-repeat ;background-position: center center; -webkit-background-size: cover;
    -moz-background-size: cover; -o-background-size: cover; background-size: cover; margin: 0px;padding: 0;">
            </div>
             <div class="item" style="background: url({{url('/')}}/front/images/jewellery-landing-discover-slider3.png) no-repeat ;background-position: center center; -webkit-background-size: cover;
    -moz-background-size: cover; -o-background-size: cover; background-size: cover; margin: 0px;padding: 0;">
            </div>
            
        </div>

    </div>

<!--<div class="add-dt-jewellrys-right" style="background: url({{url('/')}}/front/images/jewellery-landing-discover-slider1.png) no-repeat ;background-position: center center; width: 60%; height: 470px; margin: 0px;padding: 0;">
</div>-->
<div class="clearfix"></div>
</div>
<!--Slider Discover section start here-->      


<!--  By Occasion Start -->
<div class="fashion-jewellery-section by-occasion-secn">
    <div class="container">
        <div class="title-ammaina-home wow flipInX" data-wow-delay="0.1s">
            <div class="discover-txts-amin">Collection</div>
            <div class="sub-title-hm">By Occasion</div>
            <p>Lorem ipsum dolor sit amet, feugiat delicata liberavisse id cum, no quo maiorum intellegebat, liber regione eu sit. Mea cu case ludus integre, vide viderer eleifend ex mea. His ay diceret, cum et atqui placerat. Lorem ipsum dolor sit amet, feugiat delicata liberavisse id cum, no quo maiorum intellegebatiberavisse id cum, no quo maiorum intellegebat.</p>

        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 ">
                <div class="fashion-jewellery-boxs wow fadeIn" data-wow-delay="0.1s">
                    <div class="img-fashion-jwlr">
                     <div class="img-fastion-jewlrys">
                        <img src="{{url('/')}}/front/images/jewellery-landing-occastion-1.jpg" alt="jewellery-landing-occastion-1" />
                    </div>
                </div>
                <div class="content-fstion-jllry">
                    <div class="txt-tilslrm">Collection for Everyday</div>
                    <p>Lorem ipsum dolor sit amet, feugiat delicata liberavisse id cum, no quo maiorum intellegebat, liber regione eu sit.</p>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 ">
            <div class="fashion-jewellery-boxs fashion-jewellery-height wow fadeIn" data-wow-delay="0.2s">
                <div class="img-fashion-jwlr small-height">
                    <img src="{{url('/')}}/front/images/jewellery-landing-occastion-2.jpg" alt="jewellery-landing-occastion-2" />
                </div>
                <div class="content-fstion-jllry">
                    <div class="txt-tilslrm">collection for formal</div>
                    <p>Lorem ipsum dolor sit amet, feugiat delicata liberavisse id cum, no quo maiorum intellegebat, liber regione eu sit.</p>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 ">
            <div class="fashion-jewellery-boxs wow fadeIn" data-wow-delay="0.3s">
                <div class="img-fashion-jwlr">
                 <div class="img-fastion-jewlrys">
                    <img src="{{url('/')}}/front/images/jewellery-landing-occastion-3.jpg" alt="jewellery-landing-occastion-3" />
                </div>
            </div>
            <div class="content-fstion-jllry">
                <div class="txt-tilslrm">Collection for wedding</div>
                <p>Lorem ipsum dolor sit amet, feugiat delicata liberavisse id cum, no quo maiorum intellegebat, liber regione eu sit.</p>
            </div>
        </div>
    </div>

</div>
</div>
</div>
<!--  By Occasion End -->      

<!--  Amaaia Jewelery Why Buy Start-->
<div class="why-buy-amaaia-section">
    
   <div class="container">
    <div class="title-ammaina-home">
        <div class="discover-txts-amin">Why Buy</div>
        <div class="sub-title-hm">Ammaia Jewelery</div>
        <p>Lorem ipsum dolor sit amet, feugiat delicata liberavisse id cum, no quo maiorum intellegebat, liber regione eu sit. Mea cu case ludus integre, vide viderer eleifend ex mea. His ay diceret, cum et atqui placerat. Lorem ipsum dolor sit amet, feugiat delicata liberavisse id cum, no quo maiorum intellegebatiberavisse id cum, no quo maiorum intellegebat.</p>

    </div>
    <div class="row">
       <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
           <div class="why-buy-amaaia-section-box">
               <div class="why-buy-amaaia-section-img">
                   <img src="{{url('/')}}/front/images/jewellery-landing-beyond-conflict.png" alt="" />
               </div>
               <div class="why-buy-amaaia-section-text">
                   Beyond<br> Conflict Free
               </div>
           </div>
       </div>
       <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
           <div class="why-buy-amaaia-section-box">
               <div class="why-buy-amaaia-section-img">
                   <img src="{{url('/')}}/front/images/jewellery-landing-handcrafted.png" alt="" />
               </div>
               <div class="why-buy-amaaia-section-text">
                Unique &amp; <br> Handcrafted
            </div>
        </div>
    </div>
    <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
       <div class="why-buy-amaaia-section-box">
           <div class="why-buy-amaaia-section-img">
               <img src="{{url('/')}}/front/images/jewellery-landing-recycled.png" alt="" />
           </div>
           <div class="why-buy-amaaia-section-text">
            Recycled <br>Precious Metals
        </div>
    </div>
</div>
<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
   <div class="why-buy-amaaia-section-box">
       <div class="why-buy-amaaia-section-img">
           <img src="{{url('/')}}/front/images/jewellery-landing-giving.png" alt="" />
       </div>
       <div class="why-buy-amaaia-section-text">
        Giving <br> Back
    </div>
</div>
</div>
</div>
</div>
</div> 
<!--  Amaaia Jewelery Why Buy End-->



<!-- testimonial section start here-->

<div class="testimonial-section">
    <div class="container">
        <div class="row">
         
            <div class="col-md-12">
                <div class="title-ammaina-home">
                    <div class="discover-txts-amin">They Says</div>
                    <div class="sub-title-hm">Happy Client</div>
                </div>
                
                
            </div>
            @if(isset($arr_reviews) && !empty($arr_reviews))
              <div class="col-md-12">
                  <div class="carousel slide" data-ride="carousel" id="quote-carousel">
                    
                      <!-- Bottom Carousel Indicators -->
                      <ol class="carousel-indicators">
                        @php $counter  = 0; @endphp
                        @foreach($arr_reviews as $review)

                          <li data-target="#quote-carousel" data-slide-to="{{$counter}}"  @if($counter == '0')  class="active" @endif>

                             @if(isset($review['user_details']['profile_image']) && !empty($review['user_details']['profile_image']) && file_exists($user_profile_image_base_path.$review['user_details']['profile_image']))
                                        <img class="img-responsive " src="{{$user_profile_image_public_path.$review['user_details']['profile_image']}}"  alt="profile picture" />
                                    @else
                                      
                                        <img class="img-responsive " src="{{url('/')}}/uploads/front/user/default_image/default-profile.png"  alt="profile picture" />
                                    @endif

                           
                            <span class="quote-mark"><img src="{{url('/')}}/front/images/quote-mark.png" alt="" /></span>
                          </li>
                          @php $counter+=1; @endphp
                        @endforeach
                        
                      </ol>

                      <!-- Carousel Slides / Quotes -->
                      <div class="carousel-inner text-center">
                          <!-- Quote 1 -->
                          @php $counter  = 0; @endphp
                          @foreach($arr_reviews as $review)
                            <div class="item {{$counter == '0' ? 'active' : ''}}">
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <p>{{$review['review'] or 'NA'}}</p>
                                        <small><span>- by</span> {{$review['user_details']['first_name'] or ''}} {{$review['user_details']['last_name'] or ''}}</small>
                                    </div>
                                </div>
                            </div>
                            @php $counter+=1; @endphp
                          @endforeach
                         
                      </div>
                      <!-- Carousel Buttons Next/Prev -->
                      <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><span class="fast-sml-img buttons-arrow   "></span> </a>
                      <a data-slide="next" href="#quote-carousel" class="right carousel-control"><span class="fast-sml-img buttons-arrow left-btn "></span></a>
                  </div>
              </div>
            @endif

        </div>
    </div>
</div>
<!-- testimonial section end here-->   



<!-- Content Footer Jewellery Landing Page Start -->
  
{{-- @php
            $arr_sub_categories = [];
            $arr_sub_categories = get_subcategories_by_most_products(4,2);
          @endphp
@if(isset($arr_sub_categories) && !empty($arr_sub_categories))
  <div class="jewellery-landing-ftrs">
    <div class="container">
        <div class="row">
          @foreach($arr_sub_categories as $sub_cat)   
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <div class="jewellery-landing-ftrs-inr-bx">
                    <div class="icon-jewelry">
                        <img src="{{url('/')}}/front/images/jewellery-landing-icn1.png" alt="" />
                    </div>
                    <div class="count-circles">{{isset($sub_cat['products']['total_products']) && !empty($sub_cat['products']['total_products']) ? $sub_cat['products']['total_products'] : 0}}</div>
                    <div class="text-cicle">{{$sub_cat['subcategory_name'] or 'NA'}}</div>
                </div>
            </div>
          @endforeach
        </div>
    </div>
  </div>
@endif --}}

<div class="jewellery-landing-ftrs">
      <div class="container">
          <div class="row">
              <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                  <div class="jewellery-landing-ftrs-inr-bx">
                      <div class="icon-jewelry">
                          <img src="{{url('/front')}}/images/jewellery-landing-icn1.png" alt="">
                      </div>
                      <div class="count-circles">4000</div>
                      <div class="text-cicle">Diamonds</div>
                  </div>
              </div>
               <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                  <div class="jewellery-landing-ftrs-inr-bx">
                      <div class="icon-jewelry">
                          <img src="{{url('/front')}}/images/jewellery-landing-icn2.png" alt="">
                      </div>
                      <div class="count-circles">1250</div>
                      <div class="text-cicle">Rings</div>
                  </div>
              </div>
             <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                  <div class="jewellery-landing-ftrs-inr-bx">
                      <div class="icon-jewelry">
                          <img src="{{url('/front')}}/images/jewellery-landing-icn3.png" alt="">
                      </div>
                      <div class="count-circles">890</div>
                      <div class="text-cicle">Earrings</div>
                  </div>
              </div>
             <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                  <div class="jewellery-landing-ftrs-inr-bx">
                      <div class="icon-jewelry">
                          <img src="{{url('/front')}}/images/jewellery-landing-icn4.png" alt="">
                      </div>
                      <div class="count-circles">910</div>
                      <div class="text-cicle">Pendants</div>
                  </div>
              </div>
          </div>
      </div>
  </div>
<!-- Content Footer Jewellery Landing Page End -->  
<script>
    $(window).load(function () {
        $('#zA7n').zA7n({});
    });
</script> 
@endsection