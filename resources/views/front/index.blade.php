@extends('front.layout.master')   
@section('main_content')
    <link href="{{url('/front')}}/css/animate.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" language="javascript" src="{{url('/front')}}/js/wow.min.js"></script>
        <script type="text/javascript">
    	wow = new WOW(
{
	animateClass: 'animated',
	offset:       100,
	callback:     function(box) 
	{
		console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
	}
}
);
wow.init();
if($("#moar").length>0)
{
	document.getElementById('moar').onclick = function() {
		var section = document.createElement('section');
		section.className = 'section--purple wow fadeInDown';
		this.parentNode.insertBefore(section, this);
	};
}

    </script>
{{-- <link href="{{url('/front')}}/css/loading_animate.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript" src="{{url('/front')}}/js/wow.min.js"></script> --}}

<!--Header section end here-->

<!--Slider section start here-->
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

	<!-- Wrapper for slides -->
	<div class="carousel-inner" role="listbox">
		<div class="item active" style="background: url({{url('/front')}}/images/home-banner1.jpg) no-repeat ;background-position: center center; -webkit-background-size: cover;
		-moz-background-size: cover; -o-background-size: cover; background-size: cover; margin: 0px;padding: 0;">

		<div class="carousel-caption wow fadeIn" data-wow-delay="0.3s">
			<div class="banner-text-block">
				<div class="title-slider-home wow fadeIn" data-wow-delay="0.3s">Elegant Fashion Design</div>
				<h1 class="wow fadeIn" data-wow-delay="0.5s">Classic Jewellery</h1>
				<p class="wow fadeIn" data-wow-delay="0.6s">Lorem ipsum dolor sit amet, feugiat delicata liberavisse id cum, no quo maiorum intellegebat, liber regione eu sit. </p>
				<div class="shop-now-btn wow fadeIn" data-wow-delay="0.7s" >
					<a class="button-shop" href="{{url('/')}}/jewellery"><span>Shop Now</span></a>
				</div>
			</div>
		</div>

	</div>
	<div class="item" style="background: url({{url('/front')}}/images/home-banner3.jpg) no-repeat ;background-position: center center; -webkit-background-size: cover;
	-moz-background-size: cover; -o-background-size: cover; background-size: cover; margin: 0px;padding: 0;">
        <div class="carousel-caption wow fadeIn" data-wow-delay="0.3s">
            <div class="banner-text-block">
                <div class="title-slider-home wow fadeIn" data-wow-delay="0.3s">Elegant Fashion Design</div>
                <h1 class="wow fadeIn" data-wow-delay="0.5s">Classic Jewellery</h1>
                <p class="wow fadeIn" data-wow-delay="0.6s">Lorem ipsum dolor sit amet, feugiat delicata liberavisse id cum, no quo maiorum intellegebat, liber regione eu sit. </p>
                <div class="shop-now-btn wow fadeIn" data-wow-delay="0.7s" >
                    <a class="button-shop" href="{{url('/')}}/jewellery"><span>Shop Now</span></a>
                </div>
            </div>
        </div>
    </div>
    	<div class="item" style="background: url({{url('/front')}}/images/home-banner2.jpg) no-repeat ;background-position: center center; -webkit-background-size: cover;
	-moz-background-size: cover; -o-background-size: cover; background-size: cover; margin: 0px;padding: 0;">
        <div class="carousel-caption wow fadeIn" data-wow-delay="0.3s">
            <div class="banner-text-block">
                <div class="title-slider-home wow fadeIn" data-wow-delay="0.3s">Elegant Fashion Design</div>
                <h1 class="wow fadeIn" data-wow-delay="0.5s">Classic Jewellery</h1>
                <p class="wow fadeIn" data-wow-delay="0.6s">Lorem ipsum dolor sit amet, feugiat delicata liberavisse id cum, no quo maiorum intellegebat, liber regione eu sit. </p>
                <div class="shop-now-btn wow fadeIn" data-wow-delay="0.7s" >
                    <a class="button-shop" href="{{url('/')}}/jewellery"><span>Shop Now</span></a>
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








<!-- Discover Section Home Start -->

<div class="discover-section-whitehm">
	<div class="container">
		<div class="title-ammaina-home  wow flipInX" data-wow-delay="0.3s">
			<div class="discover-txts-amin">Discover</div>
			<div class="sub-title-hm">The Facets of Her Story</div>
			<p>Lorem ipsum dolor sit amet, feugiat delicata liberavisse id cum, no quo maiorum intellegebat, liber regione eu sit. Mea cu case ludus integre, vide viderer eleifend ex mea. His ay diceret, cum et atqui placerat. Lorem ipsum dolor sit amet, feugiat delicata liberavisse id cum, no quo maiorum intellegebatiberavisse id cum, no quo maiorum intellegebat.</p>
		</div>
		<div class="row">

			<div class="col-md-4">
				<div class="main-homediscovr wow fadeIn" data-wow-delay="0.3s">
					<div class="home-discover-bx hm-discovr-imgs">
						<div class="home-discover-bx-inner">
							<div class="commen-icn-discover icn-warranty-inner wow fadeIn" data-wow-delay="1.3s"></div>
							<div class="discover-box-innr-title">Life Time Warranty</div>
							<p>Lorem ipsum dolor sit amet, feugiat delicata liberavisse cum, quo maiorum intellegebat, liber regione eu sit. Mea cu case ludus integre, vide viderer eleifend </p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="home-discover-bx hm-guarantee-imgs wow fadeIn" data-wow-delay="0.6s">
					<div class="home-discover-bx-inner">
						<div class="commen-icn-discover icn-guarantee-inner wow fadeIn" data-wow-delay="1.6s"></div>
						<div class="discover-box-innr-title">Price Guarantee</div>
						<p>Lorem ipsum dolor sit amet, feugiat delicata liberavisse cum, quo maiorum intellegebat, liber regione eu sit. Mea cu case ludus integre, vide viderer eleifend </p>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="home-discover-bx hm-assurance-imgs wow fadeIn" data-wow-delay="0.9s">
					<div class="home-discover-bx-inner">
						<div class="commen-icn-discover icn-assurance-inner wow fadeIn" data-wow-delay="1.9s"></div>
						<div class="discover-box-innr-title">Quality Assurance</div>
						<p>Lorem ipsum dolor sit amet, feugiat delicata liberavisse cum, quo maiorum intellegebat, liber regione eu sit. Mea cu case ludus integre, vide viderer eleifend </p>
					</div>
				</div>
			</div>

		</div>

	</div>
</div>
<!-- Discover Section Home End -->

@if(isset($arr_jewellery) && !empty($arr_jewellery))

<!-- Jewellery Section Start -->
<div class="discover-section-whitehm padding-none">
	<div class="container-fluid">
		<div class="title-ammaina-home mb-space-ammaia wow fadeIn" data-wow-delay="0.3s">
			<div class="discover-txts-amin">Discover</div>
			<div class="sub-title-hm">Jewellery</div>
		</div>

		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 jewellery-ix">
		<div class="main-section-img wow fadeIn" data-wow-delay="0.2s" >
			<div class="img-jewellery-am">
				<a href="{{ url('/') }}/jewellery/rings-1"><img src="{{url('/front')}}/images/home-jewellary1.jpg" alt="home-jewellary1" width="681px" height="500px"></a>
			</div>
			<div class="text-section-hover">
				<div class="title-mens">Ring</div>
				<div class="subtitme-men">Jewellery</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 jewellery-ix">
		<div class="main-section-img wow fadeIn" data-wow-delay="0.3s">
			<div class="img-jewellery-am">
				<a href="{{ url('/') }}/jewellery/bracelets-bangles"><img src="{{url('/front')}}/images/home-jewellary2.jpg" alt="home-jewellary2" width="750px" height="500px"></a>
			</div>
			<div class="text-section-hover">
				<div class="title-mens">Bracelet</div>
				<div class="subtitme-men">Jewellery</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 jewellery-ix">
		<div class="main-section-img wow fadeIn" data-wow-delay="0.4s">
			<div class="img-jewellery-am">
				<a href="{{ url('/') }}/jewellery/earrings"><img src="{{url('/front')}}/images/home-jewellary3.jpg" alt="home-jewellary3" width="811px" height="500px"></a>
			</div>
			<div class="text-section-hover">
				<div class="title-mens">Earring</div>
				<div class="subtitme-men">Jewellery</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 jewellery-ix">
		<div class="main-section-img wow fadeIn" data-wow-delay="0.5s">
			<div class="img-jewellery-am">
				<a href="{{ url('/') }}/jewellery/necklace"><img src="{{url('/front')}}/images/home-jewellary4.jpg" alt="home-jewellary4" width="700px" height="581px"></a>
			</div>
			<div class="text-section-hover">
				<div class="title-mens">Necklace</div>
				<div class="subtitme-men">Jewellery</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 jewellery-ix">
		<div class="main-section-img wow fadeIn" data-wow-delay="0.6s">
			<div class="img-jewellery-am">
				<a href="{{ url('/') }}/jewellery/pendants"><img src="{{url('/front')}}/images/home-jewellary5.jpg" alt="home-jewellary5" width="803px" height="500px"></a>
			</div>
			<div class="text-section-hover">
				<div class="title-mens">Pendant</div>
				<div class="subtitme-men">Jewellery</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 jewellery-ix">
		<div class="main-section-img wow fadeIn" data-wow-delay="0.7s">
			<div class="img-jewellery-am">
				<a href="{{ url('/') }}/jewellery/men-jewellery"> <img src="{{url('/front')}}/images/home-jewellary6.jpg" alt="home-jewellary1" width="750px" height="500px"> </a>
			</div>
			<div class="text-section-hover">
				<div class="title-mens">Men's Jewellery</div>
				<div class="subtitme-men">Jewellery</div>
			</div>
		</div>
	</div>
@php
if(1==2){
		foreach($arr_jewellery as $jewellery)
			{@endphp
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 jewellery-ix">
				<div class="main-section-img wow zoomIn" data-wow-delay="0.3s">
					<div class="img-jewellery-am">
						<a href="{{ url('/') }}/jewellery/{{ $jewellery['slug'] }}">

							<?php
							if(isset($jewellery['image']) && !empty($jewellery['image']) && file_exists($sub_category_image_base_path.$jewellery['image']))
							{
								$image_img_src = $sub_category_image_public_path.$jewellery['image'];
							}
							else
							{
								$image_img_src = '';
							}
							?>
							<img src="{{ $image_img_src }}" alt="{{ $jewellery['subcategory_name'] }}" />
						</a>
					</div>
					<div class="text-section-hover">
						<div class="title-mens">{{ $jewellery['subcategory_name'] }}</div>
						<div class="subtitme-men">Jewellery</div>
					</div>
				</div>
			</div>
	@php	}
		}
		@endphp
		
		<div class="clearfix"></div>


	</div> 
</div>
<!-- Jewellery Section End -->

@endif



<!--   Discover Diamonds Start -->
<div class="discover-diamonds-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-7">
				<div class="title-ammaina-home mt-margin">
					<div class="discover-txts-amin wow zoomIn" data-wow-delay="0.1s">Discover</div>
					<div class="sub-title-hm wow zoomIn" data-wow-delay="0.2s">Diamonds</div>
					<p class="wow zoomIn" data-wow-delay="0.3s">Lorem ipsum dolor sit amet, feugiat delicata liberavisse id cum, no quo maiorumintellegebat, liber regione eu sit. Mea cu case ludus integre, vide viderer eleifendex mea. His ay diceret, cum et atqui placerat. Lorem ipsum dolorsitamet, feugiat delicata liberavisse id cum, no quo maiorum intellegebatiberavisse </p>
					<div class="shop-now-btn colr-btn wow zoomIn" data-wow-delay="0.4s">
						<a class="button-shop" href="{{ url('/') }}/diamond"><span>Read More</span></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--   Discover Diamonds End -->

<!--  Fashion Jewellery Start -->
<div class="fashion-jewellery-section">
	<div class="container">
		<div class="title-ammaina-home wow flipInX" data-wow-delay="0.3s">
			<div class="discover-txts-amin">Discover</div>
			<div class="sub-title-hm">Fashion Jewellery</div>
			<p>Lorem ipsum dolor sit amet, feugiat delicata liberavisse id cum, no quo maiorum intellegebat, liber regione eu sit. Mea cu case ludus integre, vide viderer eleifend ex mea. His ay diceret, cum et atqui placerat. Lorem ipsum dolor sit amet, feugiat delicata liberavisse id cum, no quo maiorum intellegebatiberavisse id cum, no quo maiorum intellegebat.</p>

		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 ">
				<div class="fashion-jewellery-boxs wow fadeIn" data-wow-delay="0.3s">
					<div class="img-fashion-jwlr">
						<div class="img-fastion-jewlrys">
							<img src="{{url('/front')}}/images/home-fashion-jewellery1.jpg" alt="" />
						</div>
					</div>
					<div class="content-fstion-jllry">
						<div class="txt-tilslrm">Jadau Jewellery </div>
						<p>Lorem ipsum dolor sit amet, delicataliberavis cum, noquomaiorumintellegebat, regione eu sit. Mea cu case ludus integre,</p>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 ">
				<div class="fashion-jewellery-boxs fashion-jewellery-height wow zoomIn" data-wow-delay="0.6s">
					<div class="img-fashion-jwlr small-height">
						<img src="{{url('/front')}}/images/home-fashion-jewellery2.jpg" alt="" />
					</div>
					<div class="content-fstion-jllry">
						<div class="txt-tilslrm">Silver Jewellery</div>
						<p>Lorem ipsum dolor sit amet, delicataliberavis cum, noquomaiorumintellegebat, regione eu sit. Mea cu case ludus integre,</p>
					</div>
				</div>
			</div>
			
			

			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 ">
				<div class="fashion-jewellery-boxs wow zoomIn" data-wow-delay="0.9s">
					<div class="img-fashion-jwlr">
						<div class="img-fastion-jewlrys">
							<img src="{{url('/front')}}/images/home-fashion-jewellery3.jpg" alt="" />
						</div>
					</div>
					<div class="content-fstion-jllry">
						<div class="txt-tilslrm">Treated Diamond Jewellery</div>
						<p>Lorem ipsum dolor sit amet, delicataliberavis cum, noquomaiorumintellegebat, regione eu sit. Mea cu case ludus integre,</p>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
<!--  Fashion Jewellery End -->


<!--  Logo Section Start Here -->
<div class="logo-section-footerhome">
	<div class="container">
		<ul class="flex-inline-class">
			<li class="wow zoomIn" data-wow-delay="0.2s"> <img src="{{url('/front')}}/images/home-logo2.png" alt="" /> </li>
			<li class="wow zoomIn" data-wow-delay="0.4s"> <img src="{{url('/front')}}/images/home-logo1.png" alt="" /> </li>
			<li class="wow zoomIn" data-wow-delay="0.6s"> <img src="{{url('/front')}}/images/home-logo3.png" alt="" /> </li>
			<li class="wow zoomIn" data-wow-delay="0.8s"> <img src="{{url('/front')}}/images/home-logo4.png" alt="" /> </li>
			<li class="wow zoomIn" data-wow-delay="1.0s"><img src="{{url('/front')}}/images/home-logo5.png" alt="" /> </li>
		</ul>
	</div>
</div>
<!--  Logo Section End Here -->

<!--   Our Services Section Start -->
<div class="our-services-section">
	<div class="title-ammaina-home">
		<div class="discover-txts-amin">Discover</div>
		<div class="sub-title-hm">Our Services</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
				<div class="services-box-immer">
					<div class="services-icon-image free-shipping-icn"></div>
					<div class="services-box-tilte">
						Free Shipping
					</div>
					<p>Lorem ipsum dolor sit  elicat aliberavi sseidn oquomaior ravi sseidn oquomaior</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
				<div class="services-box-immer">
					<div class="services-icon-image returns-icn"></div>
					<div class="services-box-tilte">
						30 Days returns
					</div>
					<p>Lorem ipsum dolor sit  elicat aliberavi sseidn oquomaior ravi sseidn oquomaior</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
				<div class="services-box-immer">
					<div class="services-icon-image emi-option-icn"></div>
					<div class="services-box-tilte">
						EMI option
					</div>
					<p>Lorem ipsum dolor sit  elicat aliberavi sseidn oquomaior ravi sseidn oquomaior</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
				<div class="services-box-immer">
					<div class="services-icon-image insured-icn"></div>
					<div class="services-box-tilte">
						Insured
					</div>
					<p>Lorem ipsum dolor sit  elicat aliberavi sseidn oquomaior ravi sseidn oquomaior</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
				<div class="services-box-immer">
					<div class="services-icon-image buy-back-icn"></div>
					<div class="services-box-tilte">
						Buy Back
					</div>
					<p>Lorem ipsum dolor sit  elicat aliberavi sseidn oquomaior ravi sseidn oquomaior</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
				<div class="services-box-immer">
					<div class="services-icon-image dedicated-customer-icn"></div>
					<div class="services-box-tilte">
						Dedicated Customer
					</div>
					<p>Lorem ipsum dolor sit  elicat aliberavi sseidn oquomaior ravi sseidn oquomaior</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
				<div class="services-box-immer">
					<div class="services-icon-image re-engineering-icn"></div>
					<div class="services-box-tilte">
						Re-Engineering
					</div>
					<p>Lorem ipsum dolor sit  elicat aliberavi sseidn oquomaior ravi sseidn oquomaior</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
				<div class="services-box-immer">
					<div class="services-icon-image gift-certificate-icn"></div>
					<div class="services-box-tilte">
						Gift Certificate
					</div>
					<p>Lorem ipsum dolor sit  elicat aliberavi sseidn oquomaior ravi sseidn oquomaior</p>
				</div>
			</div>
		</div>

	</div>
</div>
<!--   Our Services Section End -->


<!-- Subscribe Section Start -->


@endsection