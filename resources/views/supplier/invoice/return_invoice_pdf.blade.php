
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
                       <b> Order ID: </b> {{isset($arr_return['order_id']) && !empty($arr_return['order_id']) ? $arr_return['order_id'] : 'NA' }}     
                    </td>
                    <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">
                      <b> Mobile No: </b> {{isset($arr_return['mobile_number']) && !empty($arr_return['mobile_number']) ? $arr_return['mobile_number'] : 'NA' }} 
                    </td>
                </tr>
                <tr>
                    <td style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1;border-right:1px solid #c1c1c1;border-bottom:1px solid #c1c1c1;">
                       <b>Refund Payment Method: </b> {{isset($arr_return['refund_payment_method']) && $arr_return['refund_payment_method'] == '1' ? 'Add In Amaaia Wallet,' : ''}} {{isset($arr_return['refund_payment_method']) && $arr_return['refund_payment_method'] == '2' ? 'Add in Bank Account' : ''}}
                    </td>
                    <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1; border-bottom:1px solid #c1c1c1;">
                      <b>Return Request Date: </b> {{isset($arr_return['created_at']) && !empty($arr_return['created_at']) ? date('d M, Y', strtotime($arr_return['created_at'])) : 'NA' }}
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
                       Product Return Details
                    </td>
                </tr>
                 <tr>
                    <td style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1; border-right:1px solid #c1c1c1;">
                       Customer Name  
                    </td>
                    <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">
                      {{$arr_return['customer_details']['first_name'] or ''}} {{$arr_return['customer_details']['last_name'] or ''}}
                    </td>
                </tr>
                <tr>
                    <td style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1; border-right:1px solid #c1c1c1;">
                       Product Name  
                    </td>
                    <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">
                      {{$arr_return['order_product_details']['product_name'] or ''}} {{$arr_return['order_product_details']['product_name'] or ''}}
                    </td>
                </tr>
                 <tr>
                    <td style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1; border-right:1px solid #c1c1c1;">
                        Product Return Reason
                    </td>
                    <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">
                      {{isset($arr_return['reason']) && !empty($arr_return['reason']) ? $arr_return['reason'] : 'NA' }}
                    </td>
                </tr>
                <tr>
                    <td style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1; border-right:1px solid #c1c1c1;">
                       Product Delivery Method
                    </td>
                    <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">
                      {{isset($arr_return['delivery_method']) && !empty($arr_return['delivery_method']) ? $arr_return['delivery_method'] : 'NA' }}
                    </td>
                </tr>
                <tr>
                    <td style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1; border-right:1px solid #c1c1c1;">
                      Comment
                    </td>
                    <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">
                     {{isset($arr_return['comment']) && !empty($arr_return['comment']) ? $arr_return['comment'] : 'NA' }}
                    </td>
                </tr>
                 @if(isset($arr_return['status']) && $arr_return['status'] == '4' && isset($arr_return['refund_payment_method']) && $arr_return['refund_payment_method'] == '1')
                 <tr>
                    <td style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1; border-right:1px solid #c1c1c1;">
                       Return Amount To Wallet(In Rs) 
                    </td>
                    <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">
                       
                            {{isset($arr_return['wallet_details']['amount_credited']) && !empty($arr_return['wallet_details']['amount_credited']) ? $arr_return['wallet_details']['amount_credited'] : 'NA' }}
                           
                       
                    </td>
                </tr>
                @endif

                @if(isset($arr_return['status']) && $arr_return['status'] == '4' && isset($arr_return['refund_payment_method']) && $arr_return['refund_payment_method'] == '2')
                 <tr>
                    <td style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1; border-right:1px solid #c1c1c1;">
                       Transferred Amout to Bank (In Rs) 
                    </td>
                    <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">
                        
                            {{isset($arr_return['bank_transferred_amt']) && !empty($arr_return['bank_transferred_amt']) ? $arr_return['bank_transferred_amt'] : 'NA' }}
                    </td>
                </tr>
                @endif
                <tr>
                    <td style="font-size:12px;text-align: left;border-left:1px solid #c1c1c1; border-right:1px solid #c1c1c1;">
                       Status 
                    </td>
                    <td style="font-size:12px;text-align: left;border-right:1px solid #c1c1c1;">
                        @if(isset($arr_return['status']) && !empty($arr_return['status']))
                            {{$arr_return['status'] == '1' ? 'Request Pending' : ''}}
                            {{$arr_return['status'] == '2' ? 'Request Accepted' : ''}}
                            {{$arr_return['status'] == '3' ? 'Request Rejected' : ''}}
                            {{$arr_return['status'] == '4' ? 'Completed' : ''}}
                            {{$arr_return['status'] == '5' ? 'Product Rejected' : ''}}
                        @endif
                    </td>
                </tr>
            </table>
        </td>
    </tr>

</table>
</div>