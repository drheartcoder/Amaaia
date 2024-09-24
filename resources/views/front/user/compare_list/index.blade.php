@extends('front.layout.master')   
@section('main_content')

<!-- Page breadcrumb -->  
@include('front.user.layout.breadcrumb')
<!-- /page breadcrumb -->


<div class="compare-main-wrapper">
   <div class="container">
      @include('front.layout._operation_status')
      <div class="compare-top-titel">Compare <span>({{isset($arr_products) && !empty($arr_products) ? sizeof($arr_products).' Items' : '0 Items' }})</span></div>
      <div class="table-responsive">
         <table class="table table-bordered">
            <tbody>
               @php 
                  $counter = 1;
                  $product_images = [];
                  $product_name_price_img_html  = $review_and_rating_html = $brand = $brand_name = $product_code = $product_code_html = $description = $description_html = $specification = $specification_html = $category = $category_html = $sub_category = $sub_category_html = $metal_html = $size_html = $setting = $setting_html = $shank_type = $shank_type_html = $band_setting = $band_setting_html = $metal_detailing = $metal_detailing_html = $metal_weight = $metal_weight_html = $ring_shoulder_type = $ring_shoulder_type_html = $gemstone_html =  $product_line = $product_line_html = $look = $look_html = $delivery_date = $delivery_date_html = $home_trial = $home_trial_html = $img =  $product_img =  $buy_now_and_cart_btns = $discount_percent = $discount_price = $category_slug = $sub_category_slug = $product_slug = $final_rating = $total_ratings = $total_ratings_given = $rating_html = '';
               @endphp
               @if(isset($arr_products) && !empty($arr_products))
                  @foreach($arr_products as $val)
                    
                     @php
                        $product_name   = $val['product_name'] or '-';
                        $product_slug   = $val['slug'] or '';
                        $product_price  = isset($val['final_price']) ? session_currency($val['final_price']) : '-';

                        $product_images = isset($val['product_images']) ? $val['product_images'] : '';

                        $img            = isset($product_images['0']['image']) ? $product_images['0']['image'] : '';
                        $product_img    = get_resized_image($img, $product_image_base_path, 176, 190 );

                        $discount_percent = $val['discount'] or '';
                        $discount_price   = isset($val['base_price']) && !empty($val['base_price']) ? session_currency($val['base_price']) : '';


                        $total_ratings = isset($val['review_and_rating']['total_rating']) ? $val['review_and_rating']['total_rating'] : 0;

                        $total_ratings_given = isset($val['review_and_rating']['total_given_rating']) ? $val['review_and_rating']['total_given_rating'] : 0;

                        if(isset($total_ratings) && !empty($total_ratings) && isset($total_ratings_given) && !empty($total_ratings_given))
                        {
                            $final_rating = round($total_ratings /$total_ratings_given);
                            
                        }
                        else
                        {
                          $final_rating = 0;
                        }

                        @endphp

                        @if(isset($final_rating) && $final_rating != 0)
                            @if($final_rating == 1)
                                @php 
                                  $rating_html = '<i class="fa fa-star star-acti"></i> 
                                  <i class="fa fa-star"></i>
                                  <i class="fa fa-star"></i> 
                                  <i class="fa fa-star"></i> 
                                  <i class="fa fa-star"></i>';
                                @endphp
                            @elseif($final_rating == 2)
                                 @php 
                                  $rating_html = '<i class="fa fa-star star-acti"></i> 
                                  <i class="fa fa-star star-acti"></i>
                                  <i class="fa fa-star"></i> 
                                  <i class="fa fa-star"></i> 
                                  <i class="fa fa-star"></i>';
                                  @endphp
                            
                            @elseif($final_rating == 3)
                                @php 
                                  $rating_html = '<i class="fa fa-star star-acti"></i> 
                                  <i class="fa fa-star star-acti"></i>
                                  <i class="fa fa-star star-acti"></i> 
                                  <i class="fa fa-star"></i> 
                                  <i class="fa fa-star"></i>';
                                @endphp
                            
                            @elseif($final_rating == 4)
                                @php 
                                  $rating_html = '<i class="fa fa-star star-acti"></i> 
                                  <i class="fa fa-star star-acti"></i>
                                  <i class="fa fa-star  star-acti"></i> 
                                  <i class="fa fa-star  star-acti"></i> 
                                  <i class="fa fa-star"></i>';
                                @endphp
                            
                            @elseif($final_rating == 5)
                                @php 
                                  $rating_html = '<i class="fa fa-star star-acti"></i> 
                                  <i class="fa fa-star star-acti"></i>
                                  <i class="fa fa-star  star-acti"></i> 
                                  <i class="fa fa-star  star-acti"></i> 
                                  <i class="fa fa-star star-acti"></i>';
                                @endphp
                            @endif
                        @endif
                        @php

                        $product_name_price_img_html  .= '<td class="gray-bg-table img">
                                    <table class="table compare-white-table">
                                       <tbody>
                                          <tr>
                                             <td class="text-center img"> <img src="'.$product_img.'" alt="" />
                                                <a class="icn-oder-place close-img btn_remove_product" data-product_id="'.base64_encode($val['id']).'" href="javascript:void(0)"></a> 
                                             </td>
                                          </tr>
                                          <tr>
                                             <td class="top-border-none">
                                                <p class="text-p"> '.$product_name.' </p>
                                                <div class="compare-img-price">
                                                   '. $product_price;
                                                   if(isset($discount_price) && !empty($discount_price) && isset( $discount_percent) && !empty( $discount_percent))
                                                   {
                                                      $product_name_price_img_html  .=' <span class="compare-img-old-pri">'.$discount_price.'</span>';
                                                   }
                                                   if(isset( $discount_percent) && !empty( $discount_percent))
                                                   {
                                                      $product_name_price_img_html  .= '<span class="compare-img-discount">'.$discount_percent.'% Off</span>';
                                                   }

                                               $product_name_price_img_html  .= ' </div>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>';

                                 if(isset($final_rating) && !empty($final_rating) && $final_rating != 0)
                                 {

                                    $review_and_rating_html .=  '<td class="white-bg-table">
                                    <div class="rating-review-stars compare">
                                    <span class="start-rate-count-blue">'.$final_rating.'</span>
                                    <span class="stars-block star-listing">
                                    <span>
                                    '.$rating_html.'
                                    </span>
                                    </span>
                                    </div>
                                    <div class="compa-revie-text"> '.$total_ratings_given.' Ratings &amp; '.$total_ratings_given.' Reviews</div>
                                    <div class="compa-revie-text-sub"><a href="'.url('/')."/review_and_rating/".base64_encode($val["id"]).'">All '.$total_ratings_given.' reviews</a></div>
                                    </td>';
                                  }
                                  else
                                  {

                                    $review_and_rating_html .=  '<td class="white-bg-table">
                                    <div class="rating-review-stars compare text-center">
                                    
                                    <span class="stars-block star-listing">
                                    <span>
                                    Ratings not found
                                    </span>
                                    </span>
                                    </div>
                                    ';
                                  }

                          $delivery_date = isset($val['delivery_date']) ? $val['delivery_date'].' days from order date.' : '-';
                          $delivery_date_html .= '<td class="white-bg-table"><span class="compa-table-conte">'.$delivery_date.'</span></td>';

                          $brand_name = isset($val['brand']['brand_name']) ? $val['brand']['brand_name'] : '-';
                          $brand .= '<td class="white-bg-table"><span class="compa-table-conte">'.$brand_name.'</span></td>';

                          $product_code = isset($val['product_code']) ? $val['product_code'] : '-';
                          $product_code_html .= '<td class="white-bg-table"><span class="compa-table-conte">'.$product_code.'</span></td>';

                          $description = isset($val['product_description']) ? $val['product_description'] : '-';
                          $description_html .= '<td class="white-bg-table"><span class="compa-table-conte">'.$description.'</span></td>';

                          $specification = isset($val['product_specification']) ? $val['product_specification'] : '-';
                          $specification_html .= '<td class="white-bg-table"><span class="compa-table-conte">'.$specification.'</span></td>';

                          $category = isset($val['category']['category_name']) ? $val['category']['category_name'] : '-';
                          $category_slug = isset($val['category']['slug']) ? $val['category']['slug'] : '-';
                          $category_html .= '<td class="white-bg-table"><span class="compa-table-conte">'.$category.'</span></td>';

                          $sub_category = isset($val['sub_category']['subcategory_name']) ? $val['sub_category']['subcategory_name'] :  '-';
                          $sub_category_slug = isset($val['sub_category']['slug']) ? $val['sub_category']['slug'] :  '-';
                          $sub_category_html .= '<td class="white-bg-table"><span class="compa-table-conte">'.$sub_category.'</span></td>';

                          $product_line = isset($val['product_line']['product_line_name']) ? $val['product_line']['product_line_name'] :  '-';
                          $product_line_html .= '<td class="white-bg-table"><span class="compa-table-conte">'.$product_line.'</span></td>';

                          $look = isset($val['look']['look']) ? $val['look']['look'] :  '-';
                          $look_html .= '<td class="white-bg-table"><span class="compa-table-conte">'.$look.'</span></td>';

                          $gemstone_specification ='';
                          if(isset($val['product_gemstones']) && !empty($val['product_gemstones']))
                          {
                            foreach ($val['product_gemstones'] as $gemstone) {
                              $gemstone_specification .= isset($gemstone['gemstone_type']['type']) ? $gemstone['gemstone_type']['type'].'-' : ''; 
                              $gemstone_specification .= isset($gemstone['gemstone_color']['gemstone_color']) ? $gemstone['gemstone_color']['gemstone_color'].'-' : ''; 
                              $gemstone_specification .= isset($gemstone['gemstone_quality']['gemstone_quality']) ? $gemstone['gemstone_quality']['gemstone_quality'].'-' : ''; 
                              $gemstone_specification .= isset($gemstone['gemstone_shape']['shape_name']) ? $gemstone['gemstone_shape']['shape_name'].'<br>' : '';
                            }
                          }

                          $gemstone_html .= '<td class="white-bg-table"><span class="compa-table-conte">'.$gemstone_specification.'</span></td>';

                          $metal_specification ='';
                          if(isset($val['product_metals']) && !empty($val['product_metals']))
                          {
                            foreach ($val['product_metals'] as $metal) {
                              $metal_specification .= isset($metal['metal_name']['metal_name']) ? $metal['metal_name']['metal_name'].'-' : ''; 
                              $metal_specification .= isset($metal['metal_color']['metal_color']) ? $metal['metal_color']['metal_color'].'-' : ''; 
                              $metal_specification .= isset($metal['metal_quality']['quality_name']) ? $metal['metal_quality']['quality_name'].'<br>' : '';
                            }
                          }

                          $metal_html .= '<td class="white-bg-table"><span class="compa-table-conte">'.$metal_specification.'</span></td>';

                          $product_size = [];

                          if(isset($val['product_size']) && !empty($val['product_size']))
                          {
                            foreach ($val['product_size'] as $size) {
                              $product_size[]= isset($size['size_name']) ? $size['size_name'] : ''; 
                            }
                          }

                          if($product_size)
                          {
                            $product_size = implode(',',$product_size);
                          }


                          if(isset($product_size) && !empty($product_size))
                          {

                            $size_html .= '<td class="white-bg-table"><span class="compa-table-conte">'.$product_size.'</span></td>';
                          }
                          else
                          {
                            $size_html .= '<td class="white-bg-table"><span class="compa-table-conte">-</span></td>';
                          }
                          
                          $setting = isset($val['setting']['setting']) ? $val['setting']['setting'] : '-';
                          $setting_html .= '<td class="white-bg-table"><span class="compa-table-conte">'.$setting.'</span></td>';

                          $shank_type = isset($val['shank_type']['shank_type']) ? $val['shank_type']['shank_type'] : '-';
                          $shank_type_html .= '<td class="white-bg-table"><span class="compa-table-conte">'.$shank_type.'</span></td>';

                          $band_setting = isset($val['band_setting']['band_setting']) ? $val['band_setting']['band_setting'] :  '-';
                          $band_setting_html .= '<td class="white-bg-table"><span class="compa-table-conte">'.$band_setting.'</span></td>';

                          $metal_detailing = isset($val['metal_detailing']['metal_detailing_name']) ? $val['metal_detailing']['metal_detailing_name'] : '-';
                          $metal_detailing_html .= '<td class="white-bg-table"><span class="compa-table-conte">'.$metal_detailing.'</span></td>';

                          $metal_weight = isset($val['metal_weight']) ? $val['metal_weight'] : '-';
                          $metal_weight_html .= '<td class="white-bg-table"><span class="compa-table-conte">'.$metal_weight.'</span></td>';

                          $ring_shoulder_type = isset($val['ring_shoulder']['ring_shoulder_type']) ? $val['ring_shoulder']['ring_shoulder_type'] : '-';
                          $ring_shoulder_type_html .= '<td class="white-bg-table"><span class="compa-table-conte">'.$ring_shoulder_type.'</span></td>';

                          if(isset($val['allow_product_home_trial']) && $val['allow_product_home_trial'] == '1')
                          {
                            $home_trial = 'No';
                          }
                          elseif(isset($val['allow_product_home_trial']) && $val['allow_product_home_trial'] == '2')  
                          {
                            $home_trial = 'Yes';
                          }

                          $home_trial_html .= '<td class="white-bg-table"><span class="compa-table-conte">'.$home_trial.'</span></td>';

                          $buy_now_and_cart_btns .='<td class="white-bg-table">
                            <div class="compare-full-button">
                              <div class="full-button by-now">
                                <a class="button-shop" href="'.url('/').'/'.$category_slug.'/'.$sub_category_slug.'/'.$product_slug.'"><span>Buy Now</span></a>
                              </div>
                              <div class="full-button add-to">
                                  <a class="button-shop" href="'.url('/').'/'.$category_slug.'/'.$sub_category_slug.'/'.$product_slug.'"><span>Add to Cart</span></a>
                              </div>
                            </div> 
                          </td>';

                     @endphp

                    

                     @php $counter++; @endphp
                  @endforeach
              
              @else
                <div class="col-md-12">
                    <div class="title-product-likes" style="text-align: center;">No Products Found</div>
                </div>
               @endif
               @if(isset($arr_products) && !empty($arr_products))
               <tr>
                  <td  class="white-bg-table " style="padding:20px;background-color: #fdfbfb;"><span class="compa-product-image"> Product Image</span>
                  </td>
                  @php echo htmlspecialchars_decode($product_name_price_img_html ); @endphp
               </tr>
                <tr style="background: #f8f7f7;">
                  <td class="comp-review-rating" colspan="5">Review Rating and Delivery</td>
                </tr> 
                <tr>
                   <td  class="white-bg-table " style="padding:20px;background-color: #fdfbfb;"><span class="compa-product-image">Ratings &amp; Reviews</span>
                            </td>
                             @php echo htmlspecialchars_decode($review_and_rating_html); @endphp

                </tr>
                <tr>
                   <td  class="white-bg-table " style="padding:20px;background-color: #fdfbfb;"><span class="compa-product-image">Delivery</span>
                            </td>
                             @php echo htmlspecialchars_decode($delivery_date_html); @endphp

                </tr>
                <tr style="background: #f8f7f7;">
                   <td class="comp-review-rating" colspan="5">General</td>
                </tr>
                <tr>
                    <td  class="white-bg-table " style="padding:20px;background-color: #fdfbfb;"><span class="compa-product-image">Brand </span>
                    </td>

                    @php echo htmlspecialchars_decode($brand); @endphp
                    
                </tr>
                <tr>
                    <td  class="white-bg-table " style="padding:20px;background-color: #fdfbfb;"><span class="compa-product-image">Product Code</span>
                    </td>
                    @php echo htmlspecialchars_decode($product_code_html); @endphp
                </tr>
                <tr>
                    <td  class="white-bg-table " style="padding:20px;background-color: #fdfbfb;"><span class="compa-product-image">Product Description</span>
                    </td>
                     @php echo htmlspecialchars_decode($description_html); @endphp
                </tr> 

                <tr>
                    <td  class="white-bg-table " style="padding:20px;background-color: #fdfbfb;"><span class="compa-product-image">Product Specification</span>
                    </td>
                     @php echo htmlspecialchars_decode($specification_html); @endphp
                </tr> 

                <tr>
                    <td  class="white-bg-table " style="padding:20px;background-color: #fdfbfb;"><span class="compa-product-image">Category</span>
                    </td>
                    @php echo htmlspecialchars_decode($category_html); @endphp
                </tr>

                 <tr>
                    <td  class="white-bg-table " style="padding:20px;background-color: #fdfbfb;"><span class="compa-product-image">Sub Category</span>
                    </td>
                    @php echo htmlspecialchars_decode($sub_category_html); @endphp
                 </tr>

                 <tr>
                    <td  class="white-bg-table " style="padding:20px;background-color: #fdfbfb;"><span class="compa-product-image">Product Line</span>
                    </td>
                    @php echo htmlspecialchars_decode($product_line_html); @endphp
                 </tr>

                 <tr>
                    <td  class="white-bg-table " style="padding:20px;background-color: #fdfbfb;"><span class="compa-product-image">Look</span>
                    </td>
                    @php echo htmlspecialchars_decode($look_html); @endphp
                 </tr>

                  <tr>
                    <td  class="white-bg-table " style="padding:20px;background-color: #fdfbfb;"><span class="compa-product-image">Gemstone</span>
                    </td>
                    @php echo htmlspecialchars_decode($gemstone_html); @endphp
                 </tr>

                 <tr>
                    <td  class="white-bg-table " style="padding:20px;background-color: #fdfbfb;"><span class="compa-product-image">Metal</span>
                    </td>
                    @php echo htmlspecialchars_decode($metal_html); @endphp
                 </tr>

                 <tr>
                    <td  class="white-bg-table " style="padding:20px;background-color: #fdfbfb;"><span class="compa-product-image">Size</span>
                    </td>
                    @php echo htmlspecialchars_decode($size_html); @endphp
                 </tr>

                 <tr>
                    <td  class="white-bg-table " style="padding:20px;background-color: #fdfbfb;"><span class="compa-product-image">Setting</span>
                    </td>
                    @php echo htmlspecialchars_decode($setting_html); @endphp
                 </tr>

                 <tr>
                    <td  class="white-bg-table " style="padding:20px;background-color: #fdfbfb;"><span class="compa-product-image">Shank Type</span>
                    </td>
                    @php echo htmlspecialchars_decode($shank_type_html); @endphp
                 </tr>

                  <tr>
                    <td  class="white-bg-table " style="padding:20px;background-color: #fdfbfb;"><span class="compa-product-image">Band Setting</span>
                    </td>
                    @php echo htmlspecialchars_decode($band_setting_html); @endphp
                 </tr>

                 <tr>
                    <td  class="white-bg-table " style="padding:20px;background-color: #fdfbfb;"><span class="compa-product-image">Ring Shoulder Type</span>
                    </td>
                    @php echo htmlspecialchars_decode($ring_shoulder_type_html); @endphp
                 </tr>

                 <tr>
                    <td  class="white-bg-table " style="padding:20px;background-color: #fdfbfb;"><span class="compa-product-image">Metal Detailing</span>
                    </td>
                    @php echo htmlspecialchars_decode($metal_detailing_html); @endphp
                 </tr>

                 <tr>
                    <td  class="white-bg-table " style="padding:20px;background-color: #fdfbfb;"><span class="compa-product-image">Metal Weight</span>
                    </td>
                    @php echo htmlspecialchars_decode($metal_weight_html); @endphp
                 </tr>
                 <tr>
                    <td  class="white-bg-table " style="padding:20px;background-color: #fdfbfb;"><span class="compa-product-image">Home Trial?</span>
                    </td>
                    @php echo htmlspecialchars_decode($home_trial_html); @endphp
                 </tr>
                 <tr>
                    <td  class="white-bg-table " style="padding:20px;background-color: #fdfbfb;">
                      <span class="compa-product-image"></span>
                    </td>
                    @php echo htmlspecialchars_decode($buy_now_and_cart_btns); @endphp
                 </tr>
              @endif
            </tbody>
         </table>
      </div>
   </div>
</div>


<script>
    $(document).ready(function(){
      $('.btn_remove_product').click(function(){
          enc_product_id = $(this).attr('data-product_id');

          swal({
              title: "Are you sure ?",
              text: 'Do you really want to remove this product from compare list?',
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
                window.location = '{{url('/')}}/compare_list/remove/'+enc_product_id;
              }
            });
      });
    });
</script>

@endsection