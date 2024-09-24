@extends('front.layout.master')                
@section('main_content')

<div class="bradcrum-inner">
    <div class="pul-left-title">
        {{$module_title or ''}}
    </div>
    <div class="pul-right-sublink">
        <a href="{{url('/')}}">Home</a> / <span>{{$module_title or ''}}</span>
    </div>
    <div class="clearfix"></div>
</div>

<div class="min-hieght-class margin-tb">
        <div class="container">
            <div class="row">
                @include('front.layout._operation_status')
                <div class="col-md-6 left-col-space">
                    @php
                        $arr_product_images = [];
                        $arr_product_images = isset($arr_product['product_images']) ? $arr_product['product_images'] : '';
                    @endphp
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
                </div>
                <div class="col-md-6 listing-detail-right-spaces">
                    <div class="title-listing-detail-page">

                        <div class="title-detail-black pro-rating-reviw">
                            {{$arr_product['product_name'] or 'NA'}}
                        </div>
                        <div class="rating-review-stars-new bottom-mrgns">
                            <div class="stars-block-new star-listing-new">
                                <span>
                                    @php
                                        $final_rating = $total_ratings = $total_ratings_given = '';
                                        $total_ratings = isset($arr_product['review_and_rating']['total_rating']) ? $arr_product['review_and_rating']['total_rating'] : 0;

                                        $total_ratings_given = isset($arr_product['review_and_rating']['total_given_rating']) ? $arr_product['review_and_rating']['total_given_rating'] : 0;

                                        if(isset($total_ratings) && !empty($total_ratings) && isset($total_ratings_given) && !empty($total_ratings_given))
                                        {
                                            $final_rating = round($total_ratings /$total_ratings_given);
                                            
                                        }

                                    @endphp
                                    @if(isset($final_rating) && $final_rating != 0)
                                        @if($final_rating == 1)
                                            <i class="fa fa-star star-acti-new"></i> 
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i> 
                                            <i class="fa fa-star"></i> 
                                            <i class="fa fa-star"></i> 
                                        @elseif($final_rating == 2)
                                            <i class="fa fa-star star-acti-new"></i> 
                                            <i class="fa fa-star star-acti-new"></i>
                                            <i class="fa fa-star"></i> 
                                            <i class="fa fa-star"></i> 
                                            <i class="fa fa-star"></i>
                                        
                                        @elseif($final_rating == 3)
                                            <i class="fa fa-star star-acti-new"></i> 
                                            <i class="fa fa-star star-acti-new"></i>
                                            <i class="fa fa-star star-acti-new"></i> 
                                            <i class="fa fa-star"></i> 
                                            <i class="fa fa-star"></i>
                                        
                                        @elseif($final_rating == 4)
                                            <i class="fa fa-star star-acti-new"></i> 
                                            <i class="fa fa-star star-acti-new"></i>
                                            <i class="fa fa-star  star-acti-new"></i> 
                                            <i class="fa fa-star  star-acti-new"></i> 
                                            <i class="fa fa-star"></i>
                                        
                                        @elseif($final_rating == 5)
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
                    </div>

                    <div class="main-pro-txt">
                        <div class="main-pro-txt-inner">Product Code : </div>
                        <div class="main-pro-txt-right">{{$arr_product['product_code'] or 'NA'}} </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="main-pro-txt">
                        <div class="main-pro-txt-inner">Category : </div>
                        <div class="main-pro-txt-right">{{$arr_product['category']['category_name'] or 'NA'}} </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="main-pro-txt">
                        <div class="main-pro-txt-inner">Sub Category : </div>
                        <div class="main-pro-txt-right">{{$arr_product['sub_category']['subcategory_name'] or 'NA'}} </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="main-pro-txt">
                        <div class="main-pro-txt-inner">Brand Name : </div>
                        <div class="main-pro-txt-right">{{$arr_product['brand']['brand_name'] or 'NA'}} </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="main-pro-txt">
                        <div class="main-pro-txt-inner">Colour : </div>
                        <div class="main-pro-txt-right">Rose Gold </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="title-description">Description</div>
                    
                    
                    <div class="title-description-txt"> {{$arr_product['product_description'] or 'NA'}}</div>
                  
                </div>
                
                <div class="col-md-12">
                   
                    <div class="main-review-rating-cls">
                        @if(isset($arr_own_review_and_rating) && !empty($arr_own_review_and_rating))
                            <div class="box-form">
                                <label for="address"><h4>Your Review and Rating</h4></label>
                            </div>
                            <div class="rating-white-block-new  marg-top">
                                <div class="review-profile-image-new">
                                    @if(isset($arr_own_review_and_rating['user_details']['profile_image']) && !empty($arr_own_review_and_rating['user_details']['profile_image']) && file_exists($user_profile_image_base_path.$arr_own_review_and_rating['user_details']['profile_image']))
                                        <img src="{{$user_profile_image_public_path.$arr_own_review_and_rating['user_details']['profile_image']}}" alt="profile picture" />
                                    @else
                                        <img src="{{url('/')}}/uploads/front/user/default_image/default-profile.png" alt="profile picture" />
                                    @endif
                                </div>
                                <div class="review-content-block-new">
                                    <div class="review-send-head-new">
                                        {{$arr_own_review_and_rating['user_details']['first_name'] or ''}}
                                        {{$arr_own_review_and_rating['user_details']['last_name'] or ''}}
                                    </div>
                                    <div class="rating-review-stars-new">
                                        @php
                                            $own_rating = ''; 
                                            $own_rating =isset($arr_own_review_and_rating['rating']) ? $arr_own_review_and_rating['rating'] : '0';
                                        @endphp
                                        <div class="stars-block-new star-listing-new">
                                            <span class="txt-rev">{{$own_rating or '0'}} 
                                                Review
                                            </span>
                                            <span>
                                                @if(isset($own_rating) && $own_rating != 0)
                                                    @if($own_rating == 1)
                                                        <i class="fa fa-star star-acti-new"></i> 
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i> 
                                                        <i class="fa fa-star"></i> 
                                                        <i class="fa fa-star"></i> 
                                                    @elseif($own_rating == 2)
                                                        <i class="fa fa-star star-acti-new"></i> 
                                                        <i class="fa fa-star star-acti-new"></i>
                                                        <i class="fa fa-star"></i> 
                                                        <i class="fa fa-star"></i> 
                                                        <i class="fa fa-star"></i>
                                                    
                                                    @elseif($own_rating == 3)
                                                        <i class="fa fa-star star-acti-new"></i> 
                                                        <i class="fa fa-star star-acti-new"></i>
                                                        <i class="fa fa-star star-acti-new"></i> 
                                                        <i class="fa fa-star"></i> 
                                                        <i class="fa fa-star"></i>
                                                    
                                                    @elseif($own_rating == 4)
                                                        <i class="fa fa-star star-acti-new"></i> 
                                                        <i class="fa fa-star star-acti-new"></i>
                                                        <i class="fa fa-star  star-acti-new"></i> 
                                                        <i class="fa fa-star  star-acti-new"></i> 
                                                        <i class="fa fa-star"></i>
                                                    
                                                    @elseif($own_rating == 5)
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
                                    <div class="time-text"> {{isset($arr_own_review_and_rating['created_at']) ? date('h:i - M d,Y',strtotime($arr_own_review_and_rating['created_at'])) : 'NA'}} </div>
                                    <div class="review-rating-message-new">{{$arr_own_review_and_rating['review'] or 'NA'}}</div>
                                </div>
                            </div>
                        @endif
                            @php    
                                $own_review_and_rating_count = isset($arr_own_review_and_rating) && !empty($arr_own_review_and_rating) ? sizeof($arr_own_review_and_rating) : 0;

                            @endphp
                            @if(validate_login('user') != false && $own_review_and_rating_count < 1 && isset($enc_order_product_id) && !empty($enc_order_product_id) && isset($allog_user_to_review) && $allog_user_to_review == true)
                                <div class="title-sev-details">Write a Review</div>
                                <div class="give-rating-txt">Give Rating</div>
                                <form id="frm_review_and_rating" name="frm_review_and_rating" method="post" action="{{$module_url_path}}/store">
                                    {{csrf_field()}}
                                    <input type="hidden" id="enc_product_id" name="enc_product_id" value="{{$enc_product_id or ''}}">
                                    <input type="hidden" id="enc_order_product_id" name="enc_order_product_id" value="{{$enc_order_product_id or ''}}">
                                    <div class="mainstartrates box-form">
                                        <div class="stars">
                                            <input type="radio" name="rating" class="star-1" id="star-1" value="1" data-rule-required="true" data-msg-required="Please select the rating" />
                                            <label class="star-1" for="star-1">1</label>
                                            <input type="radio" name="rating" class="star-2" id="star-2" value="2" data-rule-required="true" data-msg-required="Please select the rating" />
                                            <label class="star-2" for="star-2">2</label>
                                            <input type="radio" name="rating" class="star-3" id="star-3" value="3" data-rule-required="true" data-msg-required="Please select the rating" />
                                            <label class="star-3" for="star-3">3</label>
                                            <input type="radio" name="rating" class="star-4" id="star-4" value="4" data-rule-required="true" data-msg-required="Please select the rating" />
                                            <label class="star-4" for="star-4">4</label>
                                            <input type="radio" name="rating" class="star-5" id="star-5" value="5" data-rule-required="true" data-msg-required="Please select the rating" />
                                            <label class="star-5" for="star-5">5</label>
                                            <span></span>
                                        </div>
                                        <span class="err_rating">{{$errors->first('star')}}</span>
                                    </div>
                          

                                    <div class="box-form">
                                        <label for="address">Comment</label>
                                        <textarea name="comment" id="comment" placeholder="Write a Comment" data-rule-required="true" data-msg-required="Please enter comment." >{{old('comment')}}</textarea>
                                         <div class="error-smg">{{$errors->first('comment')}}</div>
                                    </div>
                                     <div class="button-section-user-aacount">
                                        <div class="left-cancle-buton">
                                            <a class="button-shop" href="javascript:history.back(1)"><span>Cancel</span></a>
                                        </div>
                                        <div class="fullfil-button">
                                            <button type="submit" id="btn_send_review_rating" name="btn_send_review_rating" class="button-shop"><span>Send Review</span></button>
                                        </div>
                                    </div>
                                </form>
                            @endif
                            <div class="box-form">
                                <label for="address"><h4>Reviews and Ratings</h4></label>
                            </div>
                            @if(isset($arr_review_and_rating['data']) && !empty($arr_review_and_rating['data']))
                                @foreach($arr_review_and_rating['data'] as $val)
                                    <div class="rating-white-block-new  marg-top">
                                        <div class="review-profile-image-new">
                                            @if(isset($val['user_details']['profile_image']) && !empty($val['user_details']['profile_image']) && file_exists($user_profile_image_base_path.$val['user_details']['profile_image']))
                                                <img src="{{$user_profile_image_public_path.$val['user_details']['profile_image']}}" alt="profile picture" />
                                            @else
                                                <img src="{{url('/')}}/uploads/front/user/default_image/default-profile.png" alt="profile picture" />
                                            @endif
                                        </div>
                                        <div class="review-content-block-new">
                                            <div class="review-send-head-new">
                                                {{$val['user_details']['first_name'] or ''}}
                                                {{$val['user_details']['last_name'] or ''}}
                                            </div>
                                            <div class="rating-review-stars-new">
                                                <div class="stars-block-new star-listing-new">
                                                    @php
                                                    $rating = ''; 
                                                    $rating =isset($val['rating']) ? $val['rating'] : '0';
                                                    @endphp
                                                    <span class="txt-rev">{{$rating or 0}} Review</span>
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
                                            <div class="time-text"> {{isset($val['created_at']) ? date('h:i - M d,Y',strtotime($val['created_at'])) : 'NA'}} </div>
                                            <div class="review-rating-message-new">{{$val['review'] or 'NA'}}</div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center">No Reviews found...</div>
                            @endif
                            
                            @if(isset($arr_pagination) && $arr_pagination != null)
                                @include('front.common.pagination')
                            @endif
                      
                    </div>
                    
                </div>
            </div>
        </div>
    </div>



<script>
    $(document).ready(function(){


         jQuery('#frm_review_and_rating').validate({
            errorClass: "error-smg",
            highlight: function(element) { },
            errorElement: "div",
            rules: {
                
            },
            messages: {
                
            },
           errorPlacement: function(error, element) 
           { 
              var name = $(element).attr("name");
              if (name === "star") 
              {
                error.insertAfter('.err_rating');
              } 
              else
              {
                error.insertAfter(element);
              }
            
           } 
        });

    });
</script>




@endsection
