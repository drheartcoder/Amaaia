
<div style="margin:0 auto; width:650px;">
<table width="100%" border="0" cellspacing="0" cellpadding="5" style="border:0px solid #ddd;font-family:Arial, Helvetica, sans-serif;">
    <tr>
        <td colspan="2">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td colspan="2" style="font-size:40px; text-align:center"><img src="{{url('/').config('app.project.img_path.website_logo')}}" width="200px" alt=""/></td>
                    
                </tr>
                <tr>
                    <td colspan="2" style="font-size:40px; text-align:center">Invoice</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="height:10px;" colspan="2">
            &nbsp;
        </td>
    </tr>
  

    
      <tr>
        <td style="height:10px; padding:0px;" colspan="2" >
            <table width="100%" border="0" cellspacing="0" cellpadding="5" style="border:0px solid #ddd;font-family:Arial, Helvetica, sans-serif;">
                    <tr>
                    <td colspan="2" style="background-color: #f1f1f1;font-size:13px;font-weight: bold;text-align: left;border-top:1px solid #c1c1c1; border-left:1px solid #c1c1c1;border-right:1px solid #c1c1c1; ">
                        Order Details
                    </td>
                </tr>
                 <tr>
                    <td style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1; border-right:1px solid #c1c1c1;">
                       <b> Order ID: </b> {{isset($arr_orders['order_id']) && !empty($arr_orders['order_id']) ? $arr_orders['order_id'] : 'NA' }}     
                    </td>
                    <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">
                      <b> E-mail: </b> {{isset($arr_orders['order_email']) && !empty($arr_orders['order_email']) ? $arr_orders['order_email'] : 'NA' }} 
                    </td>
                </tr>
                <tr>
                    <td style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1;border-right:1px solid #c1c1c1;border-bottom:1px solid #c1c1c1;">
                       <b>Payment Method: </b> {{isset($arr_orders['order_payment_method']) && $arr_orders['order_payment_method'] == '1' ? 'Online' : ''}} {{isset($arr_orders['order_payment_method']) && $arr_orders['order_payment_method'] == '2' ? 'Wire Transfer' : ''}}
                    </td>
                    <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1; border-bottom:1px solid #c1c1c1;">
                      <b>Date: </b> {{isset($arr_orders['created_at']) && !empty($arr_orders['created_at']) ? date('d M, Y', strtotime($arr_orders['created_at'])) : 'NA' }}
                    </td>
                </tr>
                
            </table>
        </td>
    </tr>
    
      <tr>
        <td style="height:10px;" colspan="2">
            &nbsp;
        </td>
    </tr>

   
   
   
   
   
   
   
   
   <tr>
        <td style="height:10px; padding:0px;" colspan="2" >
            <table width="100%" border="0" cellspacing="0" cellpadding="5" style="border:0px solid #ddd;font-family:Arial, Helvetica, sans-serif;">
                    <tr>
                    <td colspan="2" style="background-color: #f1f1f1;font-size:13px;font-weight: bold;text-align: left;border-top:1px solid #c1c1c1; border-left:1px solid #c1c1c1;border-right:1px solid #c1c1c1; ">
                       Order Address
                    </td>
                </tr>
                 <tr>
                    <td style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1; border-right:1px solid #c1c1c1;">
                       Name  
                    </td>
                    <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">
                      {{$arr_orders['order_fname'] or ''}} {{$arr_orders['order_lname'] or ''}}
                    </td>
                </tr>
                 <tr>
                    <td style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1; border-right:1px solid #c1c1c1;">
                        Contact Number
                    </td>
                    <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">
                      {{isset($arr_orders['order_contact_no']) && !empty($arr_orders['order_contact_no']) ? $arr_orders['order_contact_no'] : 'NA' }}
                    </td>
                </tr>
                <tr>
                    <td style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1; border-right:1px solid #c1c1c1;">
                       House/Flat Number
                    </td>
                    <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">
                      {{isset($arr_orders['order_flat_no']) && !empty($arr_orders['order_flat_no']) ? $arr_orders['order_flat_no'] : 'NA' }}
                    </td>
                </tr>
                <tr>
                    <td style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1; border-right:1px solid #c1c1c1;">
                      House/Building Name
                    </td>
                    <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">
                     {{isset($arr_orders['order_building_name']) && !empty($arr_orders['order_building_name']) ? $arr_orders['order_building_name'] : 'NA' }}
                    </td>
                </tr>
                <tr>
                    <td style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1; border-right:1px solid #c1c1c1;">
                       Address 
                    </td>
                    <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">
                     {{isset($arr_orders['order_address']) && !empty($arr_orders['order_address']) ? $arr_orders['order_address'] : 'NA' }}
                    </td>
                </tr>
                <tr>
                    <td style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1; border-right:1px solid #c1c1c1;">
                       City
                    </td>
                    <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">
                      {{isset($arr_orders['order_city']) && !empty($arr_orders['order_city']) ? $arr_orders['order_city'] : 'NA' }}
                    </td>
                </tr>
                <tr>
                    <td style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1; border-right:1px solid #c1c1c1;">
                       State
                    </td>
                    <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">
                      {{isset($arr_orders['order_state']) && !empty($arr_orders['order_state']) ? $arr_orders['order_state'] : 'NA' }}
                    </td>
                </tr>
                <tr>
                    <td style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1; border-right:1px solid #c1c1c1;">
                        Country
                    </td>
                    <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">
                      {{isset($arr_orders['order_country']) && !empty($arr_orders['order_country']) ? $arr_orders['order_country'] : 'NA' }}
                    </td>
                </tr>
                <tr>
                    <td style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1;border-right:1px solid #c1c1c1;border-bottom:1px solid #c1c1c1;">
                       Post Code
                    </td>
                    <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1; border-bottom:1px solid #c1c1c1;">
                     {{isset($arr_orders['order_post_code']) && !empty($arr_orders['order_post_code']) ? $arr_orders['order_post_code'] : 'NA' }}
                    </td>
                </tr>
                
            </table>
        </td>
    </tr>
   

    <tr>
        <td colspan="2">
            &nbsp;
        </td>
    </tr>

    <tr>
        <td colspan="2">
            <table width="100%" border="0" cellspacing="0" cellpadding="5">
            	@php $total_amt = 0 @endphp ;
            	@if(isset($arr_orders['order_products']) && !empty($arr_orders['order_products']))
            		@foreach($arr_orders['order_products'] as $val)
		                <tr>
		                    <td colspan="2" style="background-color: #f1f1f1;font-size:13px;font-weight: bold;text-align: left;border-left:1px solid #c1c1c1;border-top:1px solid #c1c1c1;border-right:1px solid #c1c1c1;">Product Name</td>
		                    <td style="background-color: #f1f1f1;font-size:13px;font-weight: bold;text-align: left;border-right:1px solid #c1c1c1;border-top:1px solid #c1c1c1;">Item Number</td>
		                    <td style="background-color: #f1f1f1;font-size:13px;font-weight: bold;text-align: left;border-right:1px solid #c1c1c1;border-top:1px solid #c1c1c1;">Quantity</td>
		                    <td style="background-color: #f1f1f1;font-size:13px;font-weight: bold;text-align: left;border-right:1px solid #c1c1c1;border-top:1px solid #c1c1c1;">Price(In Rs)</td>
		                    
		                    <td style="background-color: #f1f1f1;font-size:13px;font-weight: bold;text-align: left; border-right:1px solid #c1c1c1;border-top:1px solid #c1c1c1;">Total</td>
		                </tr>
		                <tr>
		                    <td  colspan="2" style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1;border-right:1px solid #c1c1c1;">
		                    	{{isset($val['product_name']) && !empty($val['product_name']) ? $val['product_name'] : 'NA'}}
		                    </td>
		                    <td style="font-size:12px;text-align: left; border-right:1px solid #c1c1c1;">
		                    	{{isset($val['item_number']) && !empty($val['item_number']) ? $val['item_number'] : 'NA'}}
		                    </td>
		                    <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">
		                    	{{isset($val['product_quantity']) && !empty($val['product_quantity']) ? $val['product_quantity'] : 'NA'}}
		                    </td>
		                    <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">
		                    	@php $final_price = 0; @endphp
		                    	@if(isset($val['product_price']) && !empty($val['product_price']))
		                    		@if(isset($val['product_quantity']) && !empty($val['product_quantity']))
		                    			@php	
			                    		  $final_price = number_format((float)$val['product_price']*$val['product_quantity'], 2, '.', '');
			                    		@endphp
		                    		@else
		                    			@php	
			                    			$final_price = number_format((float)$val['product_price'], 2, '.', '');
			                    		@endphp
		                    		@endif
		                    	
		                    	@endif
		                    	{{isset($val['product_price']) && !empty($val['product_price']) ? $val['product_price'] : 'NA' }}
		                    	
		                    </td>
		                   
		                    <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">
		                    	@if(isset($final_price) && $final_price != 0)
		                    		{{$final_price}}
		                    	@endif
		                    </td>
		                </tr>

		                @if(isset($final_price) && !empty($final_price))
		                	@php $total_amt += $final_price; @endphp
		                @endif
		               
		               
		            @endforeach

		             <tr>
	                    <td width="80%" colspan="5" style="font-size:12px;text-align: right;background-color: #f1f1f1;font-size:13px;font-weight: bold;border-left:1px solid #c1c1c1;border-bottom:1px solid #c1c1c1; border-right:1px solid #c1c1c1;">Total:</td>
	                    <td width="20%" style="font-size:12px;text-align: left;background-color: #f1f1f1;font-size:13px;font-weight: bold;border-right:1px solid #c1c1c1;border-bottom:1px solid #c1c1c1;">
	                    	{{isset($total_amt) && !empty($total_amt) ? number_format((float)$total_amt, 2, '.', '')  : 'NA'}}
	                    </td>
	                </tr>

		        @endif
            </table>
        </td>
    </tr>




</table>
</div>