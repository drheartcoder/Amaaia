<div style="margin:0 auto; width:650px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="5" style="border:0px solid #ddd;font-family:Arial, Helvetica, sans-serif;">
        <tr>
            <td colspan="2">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="2" style="font-size:40px; text-align:center"><img src="{{url('/')}}/front/images/ammaia-logo.png" width="200px" alt=""/></td>

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

        @php $subtotal=0; @endphp

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
                           <b> Order ID: </b> {{$order_id or ''}}     
                       </td>
                       <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">
                          <b> E-mail: </b> {{$order_email or ''}}
                      </td>
                  </tr>
                  <tr>
                    <td style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1;border-right:1px solid #c1c1c1;border-bottom:1px solid #c1c1c1;">
                       <b>Payment Method: </b> 
                       @if(isset($order_payment_method) && $order_payment_method==1)
                       Online
                       @elseif(isset($order_payment_method) && $order_payment_method==2)
                       Wire Transfer
                       @else
                       NA
                       @endif  
                   </td>
                   <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1; border-bottom:1px solid #c1c1c1;">
                      {{-- <b>lorem </b> Lorem ipsum dolor sit amet. --}}
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
              {{$order_fname or ''}} {{$order_lname or ''}}
          </td>
      </tr>
      <tr>
        <td style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1; border-right:1px solid #c1c1c1;">
            Contact Number
        </td>
        <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">
          {{$order_contact_no or 'NA'}}
      </td>
  </tr>
  <tr>
    <td style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1; border-right:1px solid #c1c1c1;">
       House/Flat Number
   </td>
   <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">
      {{$order_flat_no or 'NA'}}
  </td>
</tr>
<tr>
    <td style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1; border-right:1px solid #c1c1c1;">
      House/Building Name
  </td>
  <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">
     {{$order_building_name or 'NA'}}
 </td>
</tr>
<tr>
    <td style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1; border-right:1px solid #c1c1c1;">
       Address 
   </td>
   <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">
     {{$order_address or 'NA'}}
 </td>
</tr>
<tr>
    <td style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1; border-right:1px solid #c1c1c1;">
       City
   </td>
   <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">
      {{$order_city or 'NA'}}
  </td>
</tr>
<tr>
    <td style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1; border-right:1px solid #c1c1c1;">
       State
   </td>
   <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">
      {{$order_state or 'NA'}}
  </td>
</tr>
<tr>
    <td style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1; border-right:1px solid #c1c1c1;">
        Country
    </td>
    <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">
      {{$order_country or 'NA'}}
  </td>
</tr>
<tr>
    <td style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1;border-right:1px solid #c1c1c1;border-bottom:1px solid #c1c1c1;">
       Post Code
   </td>
   <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1; border-bottom:1px solid #c1c1c1;">
     {{$order_post_code or 'NA'}}
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
        @if(isset($order_products) && is_array($order_products) && sizeof($order_products)>0)
        <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
                <td style="background-color: #f1f1f1;font-size:13px;font-weight: bold;text-align: left;border-left:1px solid #c1c1c1;border-top:1px solid #c1c1c1;border-right:1px solid #c1c1c1;">Product Name</td>
                <td style="background-color: #f1f1f1;font-size:13px;font-weight: bold;text-align: left;border-right:1px solid #c1c1c1;border-top:1px solid #c1c1c1;">Item Number</td>
                <td style="background-color: #f1f1f1;font-size:13px;font-weight: bold;text-align: left;border-right:1px solid #c1c1c1;border-top:1px solid #c1c1c1;">Quantity</td>
                <td style="background-color: #f1f1f1;font-size:13px;font-weight: bold;text-align: left;border-right:1px solid #c1c1c1;border-top:1px solid #c1c1c1;">Price</td>
                <td style="background-color: #f1f1f1;font-size:13px;font-weight: bold;text-align: left;border-right:1px solid #c1c1c1;border-top:1px solid #c1c1c1;">Insurance</td>
                <td style="background-color: #f1f1f1;font-size:13px;font-weight: bold;text-align: left; border-right:1px solid #c1c1c1;border-top:1px solid #c1c1c1;">Total</td>
            </tr>

            @foreach($order_products as $key => $product)
            <tr>
                <td style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1;border-right:1px solid #c1c1c1;">{{$product['product_name'] or '' }}</td>

                <td style="font-size:12px;text-align: left; border-right:1px solid #c1c1c1;">{{$product['item_number'] or '' }}</td>

                <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">{{$product['product_quantity'] or ''}}</td>
                <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">                        @if(isset($product['product_final_price']))
                    ₹{{number_format($product['product_final_price'], 2)}}
                    @else
                    NA
                    @endif</td>
                    <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">@if(isset($product['insurance_on_product']))
                        ₹{{number_format($product['insurance_on_product'], 2)}}
                        @else
                        NA
                        @endif</td>
                        <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">
                            @if(isset($product['insurance_on_product']) && isset($product['product_final_price']))
                            @php $subtotal+=($product['product_quantity']*$product['insurance_on_product']) + ($product['product_quantity']*$product['product_final_price']) @endphp

                            ₹{{number_format(($product['product_quantity']*$product['insurance_on_product']) + ($product['product_quantity']*$product['product_final_price']), 2)}}

                            @elseif(isset($product['product_final_price']))

                            @php $subtotal+=($product['product_quantity']*$product['product_final_price']) @endphp

                            ₹{{number_format($product['product_quantity']*$product['product_final_price'], 2)}}

                            @else
                            NA
                            @endif

                        </td>
                    </tr>
                    @endforeach


                    <tr>
                        <td width="80%" colspan="5" style="font-size:12px;text-align: right;background-color: #fff;font-size:13px;font-weight: bold;border-left:1px solid #c1c1c1;border-bottom:1px solid #c1c1c1; border-right:1px solid #c1c1c1; border-top:1px solid #c1c1c1;">Sub-Total:</td>
                        <td width="20%" style="font-size:12px;text-align: left;background-color: #fff;font-size:13px;font-weight: bold;border-top:1px solid #c1c1c1; border-right:1px solid #c1c1c1;border-bottom:1px solid #c1c1c1;">₹{{number_format($subtotal, 2)}}</td>
                    </tr>
                    <tr>
                        <td width="80%" colspan="5" style="font-size:12px;text-align: right;background-color: #fff;font-size:13px;font-weight: bold;border-left:1px solid #c1c1c1;border-bottom:1px solid #c1c1c1; border-right:1px solid #c1c1c1;">Gift Card:</td>
                        <td width="20%" style="font-size:12px;text-align: left;background-color: #fff;font-size:13px;font-weight: bold;border-right:1px solid #c1c1c1;border-bottom:1px solid #c1c1c1;">@if(isset($order_giftcard['amount']))
                            ₹{{number_format($order_giftcard['amount'], 2)}}
                            @php $giftcard_amount = $order_giftcard['amount']; @endphp
                            @else
                            NA
                            @php $giftcard_amount = '0'; @endphp
                            @endif</td>
                        </tr>
                        <tr>
                            <td width="80%" colspan="5" style="font-size:12px;text-align: right;background-color: #fff;font-size:13px;font-weight: bold;border-left:1px solid #c1c1c1;border-bottom:1px solid #c1c1c1; border-right:1px solid #c1c1c1;">Wallet:</td>
                            <td width="20%" style="font-size:12px;text-align: left;background-color: #fff;font-size:13px;font-weight: bold;border-right:1px solid #c1c1c1;border-bottom:1px solid #c1c1c1;">    @if(isset($order_wallet['used_wallet_balance']) && $order_wallet['used_wallet_balance']!='0') 
                                ₹{{number_format($order_wallet['used_wallet_balance'], 2)}}
                                @php $wallet_amount = $order_wallet['used_wallet_balance']; @endphp

                                @else
                                NA
                                @php $wallet_amount = '0'; @endphp
                                @endif</td>
                            </tr>
                            <tr>
                                <td width="80%" colspan="5" style="font-size:12px;text-align: right;background-color: #f1f1f1;font-size:13px;font-weight: bold;border-left:1px solid #c1c1c1;border-bottom:1px solid #c1c1c1; border-right:1px solid #c1c1c1;">Total:</td>
                                <td width="20%" style="font-size:12px;text-align: left;background-color: #f1f1f1;font-size:13px;font-weight: bold;border-right:1px solid #c1c1c1;border-bottom:1px solid #c1c1c1;">₹{{number_format(($order_cost-$giftcard_amount-$wallet_amount), 2)}}</td>
                            </tr>
                        </table>
                        @endif
                    </td>
                </tr>
                <tr>
                  <td style="color: #333333; font-size: 16px; padding: 20px 30px 0;">
                    Thanks &amp; Regards,
                </td>
            </tr>
            <tr>
              <td style="color: #f6929b; font-size: 15px; padding: 0 30px;">
                Amaaia
            </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
      </tr>                                    
      <tr>
          <td>
            <table style="margin-bottom: 0;" width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="font-size:13px;background:#f6929b; text-align: center; color: rgb(255, 255, 255); padding: 12px;">
                  Copyright &copy; {{date('Y')}} <a href="{{url('/')}}" style="color:#fff;">Amaaia</a>. All Right Reserved.  <a href="{{url('/info/terms-of-use')}}" style="color:#fff;">Terms &amp; Conditions</a>
              </td>
          </tr>
      </table>
  </td>                      
</tr>
</table>
</div>