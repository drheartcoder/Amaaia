@extends('front.layout.master')
@section('main_content')

<div class="bradcrum-inner">
	<div class="pul-left-title">
		{{$arr_product['product_name'] or 'Listing Detail'}}
	</div>
	<div class="pul-right-sublink">
		<a href="{{url('/')}}">Home</a> / {{$arr_product['category']['category_name'] or ''}} / 
		<a href="{{$module_url_path or ''}}">{{$arr_product['sub_category']['subcategory_name'] or ''}}</a> / 
		<span> {{$arr_product['product_name'] or ''}}</span>
	</div>
	<div class="clearfix"></div>
</div>

<form id="form-product">
	{{csrf_field()}}
	<input type="hidden" name="puid" value="{{base64_encode($arr_product['id'])}}">
	<div class="min-hieght-class margin-tb">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6 left-col-space">
					@if(isset($arr_product_images) && is_array($arr_product_images) && sizeof($arr_product_images)>0)
					<div class="product-slider-section" style=" color: #fff;">
						<div style="margin:80px auto; ">
							<div id="thumbnail-slider" style="float:left;">
								<div class="inner">
									<ul>
										@foreach($arr_product_images as $key=>$product_image)
										<li>
											<a class="thumb" href="{{$product_image_public_path.$product_image['image']}}"></a>
										</li>
										@endforeach
									</ul>
								</div>
							</div>
							<div id="ninja-slider">
								<div class="slider-inner">
									<ul>
										@foreach($arr_product_images as $key=>$product_image)
										<li><a class="ns-img" href="{{$product_image_public_path.$product_image['image']}}"></a></li>
										@endforeach
									</ul>
									<div class="fs-icon" title="Expand/Close"></div>
								</div>
							</div>                        
							<div style="clear:both;"></div>
						</div>
					</div>
					@endif
					<div class="clearfix"></div>
					<div class="full-button">
						<a class="button-shop" href="javascript:void(0)" id="btn-buy-now"><span>Buy Now</span></a>
					</div>
					<div class="lisitng-details-cmpr">
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-6 col-lg-5">
								<div class="left-cancle-buton">
									<a class="button-shop" href="javascript:void(0)" id="btn-add-cart"><span>Add To Cart</span></a>
								</div>
							</div>

							<?php
							$product_images_1  = isset($arr_product_images['0']['image']) ? $arr_product_images['0']['image'] : '';
							$images_1          = get_resized_image($product_images_1, $product_image_base_path, 176, 190 );
							?>

							<div class="col-xs-12 col-sm-4 col-md-6 col-lg-5" id="add_to_compare_block">
								<div class="left-cancle-buton">
									@if(Session::has('arr_compare') && !empty(Session::get('arr_compare')))
										@php
											$arr_compare = Session::get('arr_compare');
											$arr_compare_product_id = array_column($arr_compare, 'product_id');
										@endphp									
									@endif
									
										<a class="button-shop btn_compare_product" href="javascript:void(0)" data-compare-product-id='{{isset($arr_product['id']) ? base64_encode($arr_product['id']) : '0'}}' data-img="{{ base64_encode($images_1) }}"><span>Add To Compare</span></a>

								</div>
							</div>
							<?php
							if(isset($arr_wishlist) && !empty($arr_wishlist) && in_array($arr_product['id'], $arr_wishlist))
							{
								$wishlist_style = 'background-color:#f6929b';
							}
							else
							{
								$wishlist_style = '';
							}
							?>
							<div class="icons-ddtail-pg">
								<div class="pro-details-lnkss">
									<a href="javascript:void(0)" data-product-id="{{isset($arr_product['id']) ? base64_encode($arr_product['id']) : '0'}}" class="detail-fav af-heart btn_add_wish_list" style="{{ $wishlist_style }}"></a>
								</div>
							</div>
						</div>
					</div>
					<div class="border-detals border-jcruls"></div>
					@if(isset($arr_product['video_url']))
					<div class="video-sections">
						<iframe src="{{$arr_product['video_url']}}" allow="autoplay; encrypted-media" allowfullscreen="" frameborder="0"></iframe>
					</div>
					@endif
					
					<!-- Reviews Rating Section Start -->
					@if(isset($arr_product['reviews_and_ratings']) && !empty($arr_product['reviews_and_ratings']))



	                    <div class="main-review-rating-cls">
	                    	@php $review_count = 0; @endphp
	                    	@foreach($arr_product['reviews_and_ratings'] as $rev)
	                    		@if($review_count < 2) 
			                        <div class="rating-white-block-new  marg-top">
			                            <div class="review-profile-image-new">
			                                @if(isset($rev['user_details']['profile_image']) && !empty($rev['user_details']['profile_image']) && file_exists($user_profile_image_base_path.$rev['user_details']['profile_image']))
		                                                <img src="{{$user_profile_image_public_path.$rev['user_details']['profile_image']}}" alt="profile picture" />
		                                    @else
		                                        <img src="{{url('/')}}/uploads/front/user/default_image/default-profile.png" alt="profile picture" />
		                                    @endif
			                            </div>
			                            <div class="review-content-block-new">
			                                <div class="review-send-head-new">
			                                    {{$rev['user_details']['first_name'] or ''}}
		                                        {{$rev['user_details']['last_name'] or ''}}
			                                </div>
			                                <div class="rating-review-stars-new">
			                                    <div class="stars-block-new star-listing-new">
			                                        @php
		                                                $rating = ''; 
		                                                $rating =isset($rev['rating']) ? $rev['rating'] : '0';
		                                                @endphp
		                                                {{-- <span class="txt-rev">{{$rating or 0}} Review</span> --}}
		                                                <span>
		                                                    @if(isset($rating) && $rating != 0)
		                                                        @if($rating == 1)
		                                                            <i class="fa fa-star star-acti-new"></i> 
		                                                            <i class="fa fa-star"></i>
		                                                            <i class="fa fa-star"></i> 
		                                                            <i class="fa fa-star"></i> 
		                                                            <i class="fa fa-star"></i> 
		                                                        @elseif($rating == 2)
		                                                            <i class="fa fa-star star-acti-new"></i> 
		                                                            <i class="fa fa-star star-acti-new"></i>
		                                                            <i class="fa fa-star"></i> 
		                                                            <i class="fa fa-star"></i> 
		                                                            <i class="fa fa-star"></i>
		                                                        
		                                                        @elseif($rating == 3)
		                                                            <i class="fa fa-star star-acti-new"></i> 
		                                                            <i class="fa fa-star star-acti-new"></i>
		                                                            <i class="fa fa-star star-acti-new"></i> 
		                                                            <i class="fa fa-star"></i> 
		                                                            <i class="fa fa-star"></i>
		                                                        
		                                                        @elseif($rating == 4)
		                                                            <i class="fa fa-star star-acti-new"></i> 
		                                                            <i class="fa fa-star star-acti-new"></i>
		                                                            <i class="fa fa-star  star-acti-new"></i> 
		                                                            <i class="fa fa-star  star-acti-new"></i> 
		                                                            <i class="fa fa-star"></i>
		                                                        
		                                                        @elseif($rating == 5)
		                                                            <i class="fa fa-star star-acti-new"></i> 
		                                                            <i class="fa fa-star star-acti-new"></i>
		                                                            <i class="fa fa-star  star-acti-new"></i> 
		                                                            <i class="fa fa-star  star-acti-new"></i> 
		                                                            <i class="fa fa-star star-acti-new"></i>
		                                                        @endif
		                                                    @endif
		                                                </span>
			                                    </div>
			                                </div>
			                                <div class="time-text"> {{isset($rev['created_at']) ? date('h:i - M d,Y',strtotime($rev['created_at'])) : 'NA'}} </div>
			                                <div class="review-rating-message-new">{{$rev['review'] or 'NA'}}</div>
			                            </div>
			                        </div>
			                    @php $review_count ++; @endphp
		                        @endif
	                        @endforeach
	                      @if(sizeof($arr_product['reviews_and_ratings']) > 2)
	                      		<a href="{{url('/')}}/review_and_rating/{{isset($arr_product['id']) ? base64_encode($arr_product['id']) : ''}}">View all Reviews</a>
	                      @endif
	                    </div>
	                @endif
                    <!-- Reviews Rating Section End -->

				</div>


				<div class="col-md-6 listing-detail-right-spaces">
					<div class="title-listing-detail-page">
						<div class="subdetail-title">
							New Arrival
						</div>
						<div class="title-detail-black">
							{{$arr_product['product_name'] or ''}}
						</div>
					</div>
					<div class="price-section-details">
						{!!isset($arr_product['final_price'])? session_currency($arr_product['final_price'], 2): 0 !!}
						<span class="add-insurance"></span>
					</div>
					<p class="details-p">
						{!!$arr_product['product_description'] or ''!!}
					</p>
					<div class="qty add">
						<div class="qty-text">Quantity :</div>
						<div class="qty-add">
							<div class="product-qty">
								<div class="select-style select2">
									<select class="frm-select" name="quantity">
										@for($i=1;$i<=5;$i++)
										<option value="{{$i}}">{{$i}}</option>
										@endfor
									</select>
								</div>
							</div>
						</div>
					</div>
					@if(isset($arr_product_sizes) && is_array($arr_product_sizes) && sizeof($arr_product_sizes)>0)
					<div class="product-radio">
						<div class="radio-qty">Ring Size :</div>
						<div class="radio-sections">
							@foreach($arr_product_sizes as $key=>$product_size)
							<div class="radio-btn">

								<input type="radio" id="{{$key}}-option" name="product_size" value="{{base64_encode($product_size['id'])}}" @if($key==0) checked="checked" @endif/>
								<label for="{{$key}}-option"> {{$product_size['size_name'] or ''}} </label>

								<div class="check">
									<div class="inside"></div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
					@endif

					<div class="border-detals"></div>

					<div class="jewellery-preference-list-fn">
						<div class="jewlr-pfrc"> Choose Your Jewellery Preference</div>
						<div class="metal-button">
							<a class="mtl-btn active metal_name" href="javascript:void(0)" onclick="showmetal()">Metal</a>
							<a class="mtl-btn diamond_name" href="javascript:void(0)" onclick="showdiamond()">Diamond Quality</a>
						</div>

						@if(isset($arr_product_metals) && is_array($arr_product_metals) && sizeof($arr_product_metals)>0)

						<div class="metal-contents metal">
							<div class="row">
								<div class="faq-text">
									<div class="table-ammaia detail-radio-btns">
										<div class="table-responsive"> 
											<table class="table table-striped radio-btns">
												<thead>
													<tr>
														<th style="vertical-align: top; width: 10%"></th>
														<th>Type</th>
														<th>Color</th>
														<th>Quality</th>
													</tr>
												</thead>
												<tbody>
													@foreach($arr_product_metals as $key => $metal_details)
													<tr>
														<td>
															<div class="radio-btn">
																<input type="radio" id="c{{$key}}-option" name="metal"  value="{{base64_encode($metal_details['id'])}}" @if($key==0) checked="checked" @endif/>
																<label for="c{{$key}}-option"></label>
																<div class="check"><div class="inside"></div></div>
															</div>
														</td>
														<td class="whitenowraps">{{title_case($metal_details['metal_name']['metal_name'])}}</td>
														<td>{{title_case($metal_details['metal_color']['metal_color'])}}</td>
														<td>{{title_case($metal_details['metal_quality']['quality_name'])}}</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>

						</div>
						@endif

						@if(isset($arr_product_gemstone) && is_array($arr_product_gemstone) && sizeof($arr_product_gemstone)>0)
						<div class="metal-contents diamond" style="display: none;" >

							<div class="row">
								<div class="faq-text">
									<div class="table-ammaia detail-radio-btns">
										<div class="table-responsive"> 
											<table class="table table-striped radio-btns">
												<thead>
													<tr>
														<th style="vertical-align: top; width: 10%"></th>
														<th>Type</th>
														<th>Color</th>
														<th>Quality</th>
														<th>Shape</th>
													</tr>
												</thead>
												<tbody>
													@foreach($arr_product_gemstone as $key => $gemstone_details)
													<tr>
														<td>
															<div class="radio-btn">
																<input type="radio" id="d{{$key}}-option" name="gemstone" value="{{base64_encode($gemstone_details['id'])}}" @if($key==0) checked="checked" @endif/>
																<label for="d{{$key}}-option"></label>
																<div class="check"><div class="inside"></div></div>
															</div>
														</td>
														<td class="whitenowraps">{{title_case($gemstone_details['gemstone_type']['type'])}}</td>
														<td>{{title_case($gemstone_details['gemstone_color']['gemstone_color'])}}</td>
														<td>
															{{title_case($gemstone_details['gemstone_quality']['gemstone_quality'])}}
														</td>
														<td>{{title_case($gemstone_details['gemstone_shape']['shape_name'])}}</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						@endif
					</div>
					<div class="box-form favourite-checks space-o-detail-m">
						<div id="flipdashboard" class="check-box inline-checkboxs details-amaan-list check-nones">
							<input id="filled-in-box2" class="filled-in" type="checkbox" name="is_name" value="1"/>
							<label for="filled-in-box2">Do want your favourite name on this product?</label>

							<div class="main-hide-check">
								<div class="box-form">
									{{-- <div class="min-charactr">Min 10 Characters</div> --}}
									<label for="engraving">Engraving</label>
									<input id="engraving" placeholder="Enter name" type="text" name="name" value="" />
								</div>
								<div class="information-txts">
									<div class="information-titles-lisr">Information</div>
									<div class="engraving-tst">What is Engraving?</div>
									<p>Engraving is the practice of incising a design onto a hard, usually flat surface by cutting grooves into it. The result may be a decorated object in itself. </p>
								</div>
							</div>

						</div>
						<div class="clearfix"></div>

					</div>
					<div class="accordian-detailss">
						<div id='faq_acc'>
							<ul>
								@if(isset($arr_insurance_details) && is_array($arr_insurance_details) && sizeof($arr_insurance_details)>0)
								<li class='has-sub'>
									<a href='#'><span>Insurance</span></a>
									<ul>
										<li>
											<div class="row">
												<div class="faq-text">

													<div class="table-ammaia">
														<div class="table-responsive">
															<table class="table table-striped">
																<thead>
																	<tr>
																		<th>
																		</th>
																		<th>Company Name</th>
																		<th>Price</th>
																		<th>Terms & Conditions</th>
																	</tr>
																</thead>
																<tbody>
																	@foreach($arr_insurance_details as $key =>$insurance)
																	<tr>
																		<td>
																			<div class="check-box inline-checkboxs top-spaceup">
																				<input id="filled-in-box{{$key}}a" class="filled-in insurance" type="checkbox" name="insurance" value="{{base64_encode($insurance['id'])}}" oninput ="uncheck_others(this)" data-value="{!!session_currency($arr_product['final_price']*$insurance['price']/100)!!}"/>
																				<label for="filled-in-box{{$key}}a"></label>
																			</div>
																		</td>
																		<td class="whitenowraps">{{$insurance['company_name'] or ''}}</td>
																		<td>{!!session_currency($arr_product['final_price']*$insurance['price']/100)!!}</td>
																		<td>{!!str_limit(strip_tags($insurance['description']),30)!!}

																			<a class="popup-detailpg" data-toggle="modal" data-target="#detailspage{{$key}}">Read More</a>
																		</td>
																	</tr>
																	@endforeach
																</tbody>
															</table>
														</div>
													</div>

												</div>
											</div>
										</li>
									</ul>
								</li>
								@endif
								<li class='has-sub'>
									<a href='#'><span>Delivery</span></a>
									<ul>
										<li>
											<div class="row">
												<div class="faq-text">{{isset($arr_product['delivery_date']) ?$arr_product['delivery_date'].' Days':''}}</div>
											</div>
										</li>
									</ul>
								</li>
								<li class='has-sub'>
									<a href='#'><span>Specification</span></a>
									<ul>
										<li>
											<div class="row">
												<div class="faq-text">{!!$arr_product['product_specification'] or ''!!}</div>
											</div>
										</li>
									</ul>
								</li>

								<li class='has-sub'>
									<a href='#'><span>More Details</span></a>
									<ul>
										<li>
											<div class="row">
												<div class="faq-text">

													<div class="table-ammaia">
														<div class="table-responsive">
															<table class="table table-striped">
																<thead>
																	<tr>
																		<th>
																			Product Details
																		</th>
																		<th></th>
																	</tr>
																</thead>
																<tbody>
																	@if(isset($arr_product['uid']))
																	<tr>
																		<td> Product Id	 </td>
																		<td> {{$arr_product['uid'] or ''}} </td>
																	</tr>
																	@endif

																	@if(isset($arr_product['brand']['brand_name']))
																	<tr>
																		<td> Brand	 </td>
																		<td> {{title_case($arr_product['brand']['brand_name'])}} </td>
																	</tr>
																	@endif

																	@if(isset($arr_product['metal_weight']))
																	<tr>
																		<td> Approximate Metal Weight	 </td>
																		<td> {{$arr_product['metal_weight'].' gms'}} </td>
																	</tr>
																	@endif

																	@if(isset($arr_product['allow_product_home_trial']))
																	<tr>
																		<td> Home trial	 </td>
																		<td>
																			@if($arr_product['allow_product_home_trial']==1)Yes @else No @endif
																		</td>
																	</tr>
																	@endif

																	@if(isset($arr_product['product_height']))
																	<tr>
																		<td> Height	 </td>
																		<td>
																			{{$arr_product['product_height'].' mm'}}
																		</td>
																	</tr>
																	@endif												
																	@if(isset($arr_product['product_width']))
																	<tr>
																		<td> Width	 </td>
																		<td>
																			{{$arr_product['product_width'].' mm'}}
																		</td>
																	</tr>
																	@endif

																	@if(isset($arr_product['product_length']))
																	<tr>
																		<td> Length	 </td>
																		<td>
																			{{$arr_product['product_length'].' mm'}}
																		</td>
																	</tr>
																	@endif

																	<tr>
																		<td> Lifetime Exchange & Buy Back	 </td>
																		<td>Available</td>
																	</tr>

																	<tr>
																		<td> 30-Day Money Back		 </td>
																		<td>Available</td>
																	</tr>	
																</tbody>
															</table>
														</div>
													</div>

												</div>
											</div>
										</li>
									</ul>
								</li>

							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		@if(isset($arr_similar_product) && is_array($arr_similar_product) && sizeof($arr_similar_product)>=4)
		<div class="container-fluid">
			<div class="list-similar-list-works">
				<div class="similar-products-title">Similar Products</div>

				@php 
				$classes = array(0 => 'color-box-one', 1 => 'color-box-two', 2 => 'color-box-three', 3 => 'color-box-four');

				$curr_class = $classes[0];

				$remainder = $key % 4;

				if ($remainder==0) 
				{
					$classes = array_reverse($classes);
				}

				$curr_class = $classes[$remainder];
				@endphp
				<ul id="flexiselDemo1">
					@foreach($arr_similar_product as $similar_product)
					@php $image1 = isset($similar_product['product_images'][0]['image'])? $similar_product['product_images'][0]['image']:'';@endphp
					<li>
						<div class="listmain-box {{$curr_class}}">
							<div class="listmain-box-img">
								<img src="{{get_resized_image($image1, $product_image_base_path, 176, 190 )}}" alt="" />
								<a href="{{ url('/') }}/{{ $similar_product['category']['slug'] }}/{{ $similar_product['sub_category']['slug'] }}/{{ $similar_product['slug'] }}">
								</div>
								<div class="listmain-box-content">
									<div class="subhover-cnts">
										<div class="list-title-box">{{$similar_product['product_name'] or ''}}</div>
										<div class="list-price-box"><i class="fa fa-inr"></i> {{
											isset($similar_product['product_price'])? number_format($similar_product['product_price'], 2):0
										}}</div>
									</div>
									<div class="list-icons-box">
										<a href="" class="cirlce-llist cart-list"></a>
										<a href="" class="cirlce-llist heart-list"></a>
										<a href="" class="cirlce-llist compare-list"></a>
									</div>
								</div>
							</div>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
			@endif

		</div>
	</form>

	<div class="clearfix"></div>

	@if(isset($arr_insurance_details) && is_array($arr_insurance_details) && sizeof($arr_insurance_details)>0)
	@foreach($arr_insurance_details as $key =>$insurance)

	<div id="detailspage{{$key}}" class="gift-cartmodal modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"></button>
					<div class="title-modals">
						Terms & Conditions
					</div>
				</div>
				<div class="modal-body">
					<div class="text-popupsdetails">
						<td>{!!$insurance['description']!!}
						</div>
					</div>

				</div>
			</div>
		</div>

		@endforeach
		@endif

<div class="clearfix"></div>

@include('front.products.compare_view')

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
			$('#horizontalTab2').easyResponsiveTabs({
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
		</script>

		<!-- custom scrollbar plugin -->
		<script type="text/javascript" src="{{url('/front')}}/js/jquery.mCustomScrollbar.concat.min.js"></script>
		<script type="text/javascript">
			/*scrollbar start*/
			(function($) {
				$(window).on("load", function() {
					$.mCustomScrollbar.defaults.scrollButtons.enable = true;
					$.mCustomScrollbar.defaults.axis = "yx";
					$(".content-d").mCustomScrollbar({
						theme: "dark"
					});
				});
			})(jQuery);
		</script>

		<script type="text/javascript">

			function showdiamond()
			{
				$('.metal').hide();
				$('.diamond').show();
				$('.metal_name').toggleClass('active');
				$('.diamond_name').toggleClass('active');
			}

			function showmetal()
			{
				$('.diamond').hide();
				$('.metal').show();
				$('.diamond_name').toggleClass('active');
				$('.metal_name').toggleClass('active');
			}

			function uncheck_others(element)
			{
				if($(element).prop('checked'))
				{
					$('.insurance').prop('checked', false);
					$(element).prop('checked', true);
					var insurance = $(element).data('value');
					$('.add-insurance').html('+ '+insurance);
				}
				else
				{
					$('.insurance').prop('checked', false);
					$(element).prop('checked', false);
					$('.add-insurance').html('');

				}

			}

			$('#btn-add-cart').click(function(){

				var values = $("#form-product").serialize();
				$.ajax({
					type: 'POST',
					url: "{{url('/shopping_cart/store')}}",
					data: values,
					success:function(data){
						if(data)
						{
							if(data.status=='error_login')
							{
								window.location.href = "{{url('/login')}}";
							}

							swal('',data.msg,data.status);

							if(data.status=='success')
							{
								$('.cart_count').html(data.count);
							}
						}
						else
						{
							swal('','Something went to wrong! Please try again later.','error');
						}
					}	

				});
			});

		</script>

		<script>
			$(document).ready(function(){

// Add product to wish list.
$('.btn_add_wish_list').click(function(){
	var enc_product_id = $(this).attr('data-product-id');

	if(enc_product_id != '')
	{
		$.ajax({
			url:'{{url('/')}}/jewellery/add_product_to_wish_list/'+enc_product_id,
			type:'get',
			success:function(data){
				if(data)
				{
// Update wishlist count at header.
get_wishlist_count();
swal('',data.msg,data.status);
}
else
{
	swal('','Something went to wrong! Please try again later.','error');
}

}
});
	}
	else
	{
		swal('','Something went to wrong! Please try again later.','error');
	}
});
});

			$('#btn-buy-now').click(function()
			{
				var values = $("#form-product").serialize();
				$.ajax({
					type: 'POST',
					url: "{{url('/shopping_cart/store')}}",
					data: values,
					success:function(data){
						if(data)
						{
							if(data.status=='error_login')
							{
								window.location.href = "{{url('/login')}}";
							}

							// swal('',data.msg,data.status);

							if(data.status=='success')
							{
								window.location.href = "{{url('/order/order_details')}}";
							}
						}
						else
						{
							swal('','Something went to wrong! Please try again later.','error');
						}
					}	

				});
			});
		</script>

		@endsection
