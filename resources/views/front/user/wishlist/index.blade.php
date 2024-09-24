@extends('front.layout.master')   
@section('main_content')

<!-- Page breadcrumb -->  
@include('front.user.layout.breadcrumb')
<!-- /page breadcrumb -->

<div class="inner-page-main min-hieght-class wishlist-page">
  <div class="container">
    <div class="row">
      <div id="left-bar">
        @include('front.user.layout.sidebar')
      </div>
      <div class="col-md-8 col-lg-9">
          @include('front.layout._operation_status')
        <div class="row">
          @php
          $product_images =[];
          $images_1 = $images_2 = $product_images_1 = $product_images_2 = $cat_slug = $sub_cat_slug = $product_slug = '';
          @endphp 
          @if(isset($arr_wishlist['data']) && !empty($arr_wishlist['data']) && is_array($arr_wishlist['data']))
          @foreach($arr_wishlist['data'] as $val)

          @php
          $product_images = isset($val['product']['product_images']) ? $val['product']['product_images'] : '';

          $product_images_1 = isset($product_images['0']['image']) ? $product_images['0']['image'] : '';
          $product_images_2 = isset($product_images['1']['image']) ? $product_images['1']['image'] : '';

          $images_1 = get_resized_image($product_images_1, $product_image_base_path, 176, 190 );
          $images_2 = get_resized_image($product_images_2, $product_image_base_path, 176, 190 );

          $cat_slug = isset($val['product']['category']['slug']) ? $val['product']['category']['slug'] : '';
          $sub_cat_slug = isset($val['product']['sub_category']['slug']) ? $val['product']['sub_category']['slug'] : '';

          $product_slug = isset($val['product']['slug']) ? $val['product']['slug'] : '';
         
          @endphp
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
            <div class="listmain-box color-box-one">
              <div class="listmain-box-img">
                <img class="listmain-box-img-defualt" src="{{$images_1 or ''}}" alt="" />
                <img class="listmain-box-img-hover" src="{{$images_2 or ''}}" alt="" />
              </div>
              <div class="listmain-box-content">
                <div class="subhover-cnts">
                  <div class="list-title-box">{{$val['product']['product_name'] or 'NA'}}</div>
                  <div class="list-price-box"> {!! isset($val['product']['final_price']) ? session_currency($val['product']['final_price']) : 'NA' !!}</div>
                  <div class="rating-review-stars compare usr-strs">
                    <span class="stars-block star-listing">
                      <span>
                        @php
                            $final_rating = $total_ratings = $total_ratings_given = '';
                            $total_ratings = isset($val['product']['review_and_rating']['total_rating']) ? $val['product']['review_and_rating']['total_rating'] : 0;

                            $total_ratings_given = isset($val['product']['review_and_rating']['total_given_rating']) ? $val['product']['review_and_rating']['total_given_rating'] : 0;

                            if(isset($total_ratings) && !empty($total_ratings) && isset($total_ratings_given) && !empty($total_ratings_given))
                            {
                                $final_rating = round($total_ratings /$total_ratings_given);
                            }



                        @endphp
                        @if(isset($final_rating) && $final_rating != 0)
                            @if($final_rating == 1)
                                <i class="fa fa-star star-acti"></i> 
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i> 
                            @elseif($final_rating == 2)
                                <i class="fa fa-star star-acti"></i> 
                                <i class="fa fa-star star-acti"></i>
                                <i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i>
                            
                            @elseif($final_rating == 3)
                                <i class="fa fa-star star-acti"></i> 
                                <i class="fa fa-star star-acti"></i>
                                <i class="fa fa-star star-acti"></i> 
                                <i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i>
                            
                            @elseif($final_rating == 4)
                                <i class="fa fa-star star-acti"></i> 
                                <i class="fa fa-star star-acti"></i>
                                <i class="fa fa-star  star-acti"></i> 
                                <i class="fa fa-star  star-acti"></i> 
                                <i class="fa fa-star"></i>
                            
                            @elseif($final_rating == 5)
                                <i class="fa fa-star star-acti"></i> 
                                <i class="fa fa-star star-acti"></i>
                                <i class="fa fa-star  star-acti"></i> 
                                <i class="fa fa-star  star-acti"></i> 
                                <i class="fa fa-star star-acti"></i>
                            @endif
                          @endif
                      </span>
                    </span>
                  </div>
                </div>
                <div class="list-icons-box">
                  <a href="{{url('/')}}/{{$cat_slug}}/{{$sub_cat_slug}}/{{$product_slug}}" class="cirlce-llist cart-list"></a>
                  <a href="{{url('/')}}/{{$cat_slug}}/{{$sub_cat_slug}}/{{$product_slug}}" class="cirlce-llist eye-list "></a>
                  <a href="javascript:void(0)" class="cirlce-llist remove-list" data-product-id="{{isset($val['product']['id']) ? base64_encode($val['product']['id']) : ''}}"></a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          @else
            <div class="col-lg-12 text-center">
              <h4>Wishlist is empty</h4>
            </div>
          @endif
        </div>

        @if(isset($arr_pagination) && $arr_pagination != null)
        @include('front.common.pagination')
        @endif

      </div>
    </div>
  </div>
</div>


<script>
    $(document).ready(function(){
        $('.remove-list').click(function(e){
          
            $('#remove_product_id').val();
            var enc_product_id = $(this).attr('data-product-id');
             e.preventDefault();  
              swal({
                    title: "Are you sure ?",
                    text: "Do you really want to remove this product from wishlist?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: false,
                    closeOnCancel: true
                  },
                  function(isConfirm)
                  {
                    if(isConfirm==true)
                    {
                      window.location = '{{$module_url_path}}/remove/'+enc_product_id;
                    }
                  });

        });
    });
</script>

@endsection