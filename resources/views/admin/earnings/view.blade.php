  @extends('admin.layout.master') @section('main_content')
 <!-- Page header -->
 @include('admin.layout.breadcrumb')
 <!-- /page header -->

 <!-- BEGIN Main Content -->

 <!-- Content area -->
 <div class="content">

    <div class="panel panel-flat">

        {{--
        <div class="panel-heading">
            <h5 class="panel-title">{{$sub_module_title or ''}}</h5>
        </div> --}}

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <h2>{{isset($arr_orders['order_fname'])?ucfirst($arr_orders['order_fname']).' '.$arr_orders['order_lname']:""}}</h2>
                </div>
                <div class="col-md-6 invoice-info">
                    <p class="font-size-17"><strong>Order Id : </strong>{{isset($arr_orders['order_id'])?$arr_orders['order_id']:""}}</p>
                    <p><strong>Date : </strong>{{get_formated_created_date(isset($arr_orders['created_at'])?$arr_orders['created_at']:"0000-00-00 00:00:00")}}</p>
                </div>
            </div>
            <hr class="margin-0">

            <div class="row">
                <div class="col-md-6 company-info">
                    <h4>{{isset($arr_orders['order_fname'])?ucfirst($arr_orders['order_fname']).' '.$arr_orders['order_lname']:""}}</h4>
                    <p>Payment Method :
                        <b>@if(isset($arr_orders['order_payment_method']) && $arr_orders['order_payment_method']=="1")
                            Online
                            @elseif(isset($arr_orders['order_payment_method']) && $arr_orders['order_payment_method']=="2")
                            Wire Transfer
                            @endif
                        </b>
                    </p>
                    <p>
                    	Order Cost (<i class="fa fa-inr"></i>) :<b> {{isset($arr_orders['order_cost'])?$arr_orders['order_cost']:""}}</b>
                    </p>
                     @if(isset($arr_orders['order_wallet']))
                    <p>
                        Used Wallet Amount (<i class="fa fa-inr"></i>) :<b> {{$arr_orders['order_wallet']['used_wallet_balance'] or '0'}}</b>
                    </p>
                    @endif
                    @if(isset($arr_orders['order_giftcard']))

                    <p>
                        Used Giftcard Amount (<i class="fa fa-inr"></i>) :<b> {{$arr_orders['order_giftcard']['amount'] or '0'}}</b>
                    </p>

                    <p>
                        Used Giftcard Code:<b> {{$arr_orders['order_giftcard']['gift_card_code'] or ''}}</b>
                    </p>
                    @endif

                </div>
                <div class="col-md-6 company-info">
                    <h4>Shipping Details</h4>
                    {{--  <p>Nashik</p> --}}
                    <p>City : {{isset($arr_orders['order_city'])?$arr_orders['order_city']:""}}</p>
                    <p>State : {{isset($arr_orders['order_state'])?$arr_orders['order_state']:""}}</p>
                    <p>Country : {{isset($arr_orders['order_country'])?$arr_orders['order_country']:""}}</p>
                    <p>Address : {{isset($arr_orders['order_address'])?$arr_orders['order_address']:""}}</p>
                    <p>Flat No : {{isset($arr_orders['order_flat_no'])?$arr_orders['order_flat_no']:""}}</p>
                    <p>Pincode : {{isset($arr_orders['order_post_code'])?$arr_orders['order_post_code']:""}}</p>
                    <p><i class="fa fa-phone"></i>{{isset($arr_orders['order_contact_no'])?$arr_orders['order_contact_no']:""}}</p>
                    <p><i class="fa fa-envelope"></i> {{isset($arr_orders['order_email'])?$arr_orders['order_email']:""}}</p>
                </div>
            </div>
            <br>
            <br>

            <div class="table-responsive" id="PDFelement">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="center">Sr.No</th>
                            <th class="center">Product Code</th>
                            <th>Product Name</th>
                            <th>Product Type</th>
                            <th class="hidden-480">Price (<i class="fa fa-inr"></i>)</th>
                            <th class="hidden-480">Discount (%)</th>
                            <th class="hidden-480">Discounted Price (<i class="fa fa-inr"></i>)</th>
                            <th class="hidden-480">Quantity</th>
                            <th class="hidden-480">Insurance Company</th>
                            <th class="hidden-480">Insurance (<i class="fa fa-inr"></i>)</th>
                            <th>Total (<i class="fa fa-inr"></i>)</th>
                            <th class="hidden-480">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                     <?php $total = 0; ?>
                     @if(isset($arr_orders['order_products']) && sizeof($arr_orders['order_products'])>0)
                     @foreach($arr_orders['order_products'] as $key=>$product)
                     <tr>
                        <td class="center">{{++$key}}</td>

                        <td>
                           {{isset($product['product_code'])?$product['product_code']:""}}
                       </td>

                       <td>
                          {{isset($product['product_name'])?$product['product_name']:""}}
                      </td>
                      <td>
                       @if(isset($product['product_type']) && $product['product_type']=="1")
                       Classic
                       @elseif(isset($product['product_type']) && $product['product_details']['product_type']=="2")
                       Luxury
                       @endif
                   </td>
                   
                   <td>
                     {{isset($product['product_base_price'])?$product['product_base_price']:0}}
                 </td>

                 <td>
                    {{isset($product['product_discount'])?$product['product_discount']:0}}
                </td>

                <td>
                 {{isset($product['product_final_price'])?$product['product_final_price']:0}}
             </td>

             <td>
                {{isset($product['product_quantity'])?$product['product_quantity']:0}}
            </td>

            <td>{{isset($product['product_insurance_company']) && !empty($product['product_insurance_company']) ? $product['product_insurance_company'] : 'NA'}}</td>
            <td>{{isset($product['insurance_on_product'])?$product['insurance_on_product']:0}}</td>

            <td>
                @php $sub_insurance_amt = 0;  @endphp
                @if(isset($product['product_final_price']) && !empty($product['product_final_price']))
                    @if(isset($product['insurance_on_product']) && !empty($product['insurance_on_product']))
                        @php
                            $sub_insurance_amt = $product['insurance_on_product']*$product['product_quantity'];
                            $final_price = $product['product_final_price']*$product['product_quantity']+$sub_insurance_amt;
                        @endphp
                    @else
                        @php $final_price = $product['product_final_price']; @endphp
                    @endif
                @endif

                {{isset($final_price)?$final_price:0}}
            </td>
            
            <td><a class="btn btn-default btn-rounded show-tooltip" href="{{$module_url_path}}/order_product/{{base64_encode($product['id'])}}/{{base64_encode($id)}}" title="View" data-original-title="View"><i class="fa fa-eye"></i></a></td>
        </tr>
        @endforeach
        @else
        <tr><td colspan="12" style="text-align: center;">Data Not Found</td></tr>
        @endif
    </tbody>
</table>
</div>
<br>
<div class="row">
    <div class="col-md-12" style="text-align: right;">
        <p>
            <strong>Subtotal:</strong>
            <span><i class="fa fa-inr"></i> {{isset($arr_orders['order_subtotal'])?$arr_orders['order_subtotal']:0}}</span>
        </p>
        <p>
            <strong>Insurance:</strong>
            <span> + <i class="fa fa-inr"></i>{{isset($arr_price['insurance_product'])?number_format($arr_price['insurance_product'],2):0}}</span>
        </p>
        <p>
            <strong>Total:</strong> <span class="green font-size-17"><strong><i class="fa fa-inr"></i> {{isset($arr_orders['order_cost'])?$arr_orders['order_cost']:0}}</strong></span>
        </p>
        <p>
            <strong>Total Supplier Earning:</strong> <span class="green font-size-17"><strong><i class="fa fa-inr"></i> {{ number_format(get_supplier_earning($arr_orders['order_id']),2) }}</strong></span>
        </p>
        <p>
            <strong>Total Earning :</strong> <span class="green font-size-17"><strong><i class="fa fa-inr"></i> {{number_format(get_admin_earning($arr_orders['order_id']),2)}}</strong></span>
        </p>
        <p>
            <br>
            <a class="btn btn-default" href="{{ Session::get('back_url') }}">Back</a>
        </p>

    </div>
</div>

</div>
</div>
</div>

<script>
    $(document).ready(function() {
        $('#frm_add_categogry').validate({
            ignore: [],
            highlight: function(element) {},
            errorPlacement: function(error, element) {
                var name = $(element).attr("name");
                if (name === "product_type") {
                    error.insertAfter('.error_product_type');
                } else {
                    error.insertAfter(element);
                }
            }
        });
    });
</script>

@endsection