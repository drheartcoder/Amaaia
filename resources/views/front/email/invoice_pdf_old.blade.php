@php $subtotal=0; @endphp
  <div style="width:100%;margin:0 auto; max-width: 700px">
    <div style="padding:0px 15px;">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  style="border-collapse: collapse;" >
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF" style="border:1px solid #e5e5e5;">
            <table style="margin-bottom: 0;" width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="20"></td>
          </tr>
          <tr style="text-align: center;">
            <td style="color: rgb(51, 51, 51); text-align: center; font-size: 19px; line-height: 19px; padding-top:0px;padding-bottom:20px; text-align: center;" colspan="2">Amaaia Invoice </td>
          </tr>
          <tr>
            <td colspan="2">
              <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:2px solid #e1e1e1; border-collapse: collapse;" >
                <tbody>
                  <tr>
                    <td colspan="2" style="background-color: #f7f7f7;font-weight:600; font-size:15px;padding:10px 20px;color:#444444;">Order Details
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" style="background-color: #fff;font-weight:600;font-size:13px;padding:0px;">

                      <table width="100%" border="0" cellspacing="0" cellpadding="5" >
                        <tbody>
                          <tr>
                            <td width="50%" style="border-right:1px solid #ccc; padding-left:20px; font-weight: 100;"><span style="font-weight: 600;">Order ID:</span> {{$order_id or ''}}</td>
                            <td width="50%" style="padding-left:20px; font-weight: 100;"><span style="font-weight: 600;">E-mail:</span> <a href="#" style="color:#ec9691;">{{$order_email or ''}}</a></td>
                          </tr>
                          <tr>
                            <td width="50%" style="padding-left:20px; font-weight: 100;"><span style="font-weight: 600;">Payment Method:</span> 
                              @if(isset($order_payment_method) && $order_payment_method==1)
                              Online
                              @elseif(isset($order_payment_method) && $order_payment_method==2)
                              Wire Transfer
                              @else
                              NA
                              @endif
                            </td>
                          </tr>
                          
                        </tbody>
                      </table> 
                    </td>
                  </tr>
                </tbody>

              </table>
            </td>
          </tr>

          <tr>
            <td height="20px;"></td>
          </tr>
          <tr>
            <td colspan="2">
              <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:2px solid #e1e1e1;">
                <tbody>
                  <tr>
                    <td style="background-color: #f7f7f7;font-weight:600; font-size:15px;padding:10px 20px;color:#444444;">Order Address</td>
                  </tr>
                  <tr>
                    <td colspan="2" style="background-color: #fff;font-weight:600;font-size:13px;padding:0px;">
                      <table width="100%" border="0" cellspacing="0" cellpadding="5" >
                        <tbody>
                          <tr>
                            <td width="50%" style="border-right:1px solid #ccc; padding-left:20px; font-weight: 100;">Name</td>
                            <td width="50%" style="padding-left:20px; font-weight: 100;">{{$order_fname or ''}} {{$order_lname or ''}}</td>
                          </tr>
                          <tr>
                            <td width="50%" style="border-right:1px solid #ccc; padding-left:20px; font-weight: 100;">Contact Number</td>
                            <td width="50%" style="padding-left:20px; font-weight: 100;">{{$order_contact_no or 'NA'}}</td>
                          </tr>
                          <tr>
                            <td width="50%" style="border-right:1px solid #ccc; padding-left:20px; font-weight: 100;">House/Flat Number</td>
                            <td width="50%" style="padding-left:20px; font-weight: 100;">{{$order_flat_no or 'NA'}}</td>
                          </tr>
                          <tr>
                            <td width="50%" style="border-right:1px solid #ccc; padding-left:20px; font-weight: 100;">House/Building Name</td>
                            <td width="50%" style="padding-left:20px; font-weight: 100;">{{$order_building_name or 'NA'}}</td>
                          </tr>
                          <tr>
                            <td width="50%" style="border-right:1px solid #ccc; padding-left:20px; font-weight: 100;">Address</td>
                            <td width="50%" style="padding-left:20px; font-weight: 100;">{{$order_address or 'NA'}}</td>
                          </tr>
                          <tr>
                            <td width="50%" style="border-right:1px solid #ccc; padding-left:20px; font-weight: 100;">City</td>
                            <td width="50%" style="padding-left:20px; font-weight: 100;">{{$order_city or 'NA'}}</td>
                          </tr>
                          <tr>
                            <td width="50%" style="border-right:1px solid #ccc; padding-left:20px; font-weight: 100;">State</td>
                            <td width="50%" style="padding-left:20px; font-weight: 100;">{{$order_state or 'NA'}}</td>
                          </tr>
                          <tr>
                            <td width="50%" style="border-right:1px solid #ccc; padding-left:20px; font-weight: 100;">Country</td>
                            <td width="50%" style="padding-left:20px; font-weight: 100;">{{$order_country or 'NA'}}</td>
                          </tr>
                          <tr>
                            <td width="50%" style="border-right:1px solid #ccc; padding-left:20px; font-weight: 100;">Post Code</td>
                            <td width="50%" style="padding-left:20px; font-weight: 100;">{{$order_post_code or 'NA'}}</td>
                          </tr>
                          <tr>
                          </tbody>
                        </table>  
                      </td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>
            <tr>
              <td height="20px;"></td>
            </tr>
            <tr>
              <td colspan="2">
                <table width="100%" border="1" cellspacing="0" cellpadding="0" bordercolor="#ccc" style="border-collapse: collapse;">
                  <tbody>
                    @if(isset($order_products) && is_array($order_products) && sizeof($order_products)>0)


                    <tr>
                      <td style="background-color: #f7f7f7;font-weight:600; font-size:14px;padding:10px 20px;color:#444444;">Product Name</td>
                      <td style="background-color: #f7f7f7;font-weight:600; font-size:14px;padding:10px 20px;color:#444444;">Item Number</td>
                      <td style="background-color: #f7f7f7;font-weight:600; font-size:14px;padding:10px 20px;color:#444444;">Quantity</td>
                      <td width="100px" style="background-color: #f7f7f7;font-weight:600; font-size:14px;padding:10px 20px;color:#444444;">Price</td>
                      <td style="background-color: #f7f7f7;font-weight:600; font-size:14px;padding:10px 20px;color:#444444;">Insurance</td>
                      <td style="background-color: #f7f7f7;font-weight:600; font-size:14px;padding:10px 20px;color:#444444;">Total</td>
                    </tr>
                    @foreach($order_products as $key => $product)

                    <tr>
                      <td width="20%" style="background-color: #fff;font-size:13px;padding: 20px 10px 20px 10px;">{{$product['product_name'] or '' }}</td>
                      <td width="20%" style="background-color: #fff;font-size:13px;padding: 20px 10px 20px 10px;">{{$product['item_number'] or '' }}</td>
                      <td width="10%" style="background-color: #fff;font-size:13px;padding: 20px 10px 20px 10px;">{{$product['product_quantity'] or ''}}</td>
                      <td width="10%" style="background-color: #fff;font-size:13px;padding: 20px 10px 20px 10px;">
                        @if(isset($product['product_final_price']))
                        <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> 	{{number_format($product['product_final_price'], 2)}}
                        @else
                        NA
                        @endif
                      </td>
                      <td width="20%" style="background-color: #fff;font-size:13px;padding: 20px 10px 20px 10px;">
                        @if(isset($product['insurance_on_product']))
                        <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> 	{{number_format($product['insurance_on_product'],2)}}
                        @else
                        NA
                        @endif

                      </td>
                      <td width="20%" style="background-color: #fff;font-size:13px;padding: 20px 10px 20px 10px;">
                        @if(isset($product['insurance_on_product']) && isset($product['product_final_price']))
                        @php $subtotal+=$product['insurance_on_product'] + ($product['product_quantity']*$product['product_final_price']) @endphp

                        <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> 	{{number_format($product['insurance_on_product'] + ($product['product_quantity']*$product['product_final_price']),2)}}

                        @elseif(isset($product['product_final_price']))

                        @php $subtotal+=($product['product_quantity']*$product['product_final_price']) @endphp

                        <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> 	{{number_format($product['product_quantity']*$product['product_final_price'], 2)}}

                        @else
                        NA
                        @endif
                      </td>
                    </tr>

                    @endforeach

                    @endif
                    <tr>
                      <td width="20%" colspan="5" style="background-color: #fff;font-size:15px;padding: 10px; text-align:right; font-weight: bold; color:#444444;">Sub-Total:</td>
                      <td width="40%" style="background-color: #fff;font-size:15px;padding: 10px 0px 10px 20px; font-weight: bold;color:#444444;"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> 	{{number_format($subtotal, 2)}}</td>
                    </tr>
                    <tr>
                      <td width="20%" colspan="5" style="background-color: #fff;font-size:15px;padding: 10px; text-align:right; font-weight: bold;color:#444444;">Gift Card:</td>
                      <td width="40%" style="background-color: #fff;font-size:15px;padding: 10px 0px 10px 20px; font-weight: bold;color:#444444;">

                        @if(isset($order_giftcard['amount']))
                        <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> 	{{number_format($order_giftcard['amount'], 2)}}
                        @else
                        NA
                        @endif

                      </td>

                      <tr>
                      <td width="20%" colspan="5" style="background-color: #fff;font-size:15px;padding: 10px; text-align:right; font-weight: bold;color:#444444;">Wallet:</td>
                      <td width="40%" style="background-color: #fff;font-size:15px;padding: 10px 0px 10px 20px; font-weight: bold;color:#444444;">

                        @if(isset($order_wallet['used_wallet_balance']) && $order_wallet['used_wallet_balance']!='0') 
                        <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> 	{{number_format($order_wallet['used_wallet_balance'], 2)}}
                        @else
                        NA
                        @endif

                      </td>
                    </tr>
                    <tr>
                      <td width="20%" colspan="5" style="background-color: #fff;font-size:15px;padding: 10px; text-align:right; font-weight: bold;color:#444444;">Total:</td>
                      <td width="40%" style="background-color: #fff;font-size:15px;padding: 10px 0px 10px 20px; font-weight: bold;color:#444444;"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{number_format($order_cost, 2)}}</td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>

          </table>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
  </div>      
</div>       
