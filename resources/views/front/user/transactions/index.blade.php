@extends('front.layout.master')   
@section('main_content')

<!-- Page breadcrumb -->  
@include('front.user.layout.breadcrumb')
<!-- /page breadcrumb -->

<div class="inner-page-main min-hieght-class">
  <div class="container">
    <div class="row">
      <div id="left-bar">
       @include('front.user.layout.sidebar')
     </div>

     <div class="col-md-8 col-lg-9">
      
                       @if(isset($arr_trasactions) && !empty($arr_trasactions))
                          <div class="table-ammaia">
                            <div class="table-responsive">
                              <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th>SR.NO.</th>
                                    <th>Order Id</th>
                                    <th>Date</th>
                                    <th>Tracking Id</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                  </tr>
                                </thead>
                                <tbody>
                                 
                                  @foreach($arr_trasactions as $key => $transaction)
                                  <tr>
                                    <td>{{$from+$key}}.</td>
                                    <td class="whitenowraps">
                                    @if(isset($transaction['order_id'])&& $transaction['order_id']!='')
                                    {{$transaction['order_id']}}
                                    @else
                                    --
                                    @endif
                                    </td>
                                    <td>{{formatted_trasaction_date($transaction['updated_at'])}}</td>
                                    <td>
                                    @if(isset($transaction['tracking_id'])&& $transaction['tracking_id']!='')
                                    {{$transaction['tracking_id']}}
                                    @else
                                    --
                                    @endif
                                    </td>
                                    <td>
                                      @if($transaction['trans_type']=='1')
                                      Order
                                      @elseif($transaction['trans_type']=='2')
                                      Gift Card
                                      @elseif($transaction['trans_type']=='3')
                                        Return
                                      @elseif($transaction['trans_type']=='4')
                                        Replacement
                                      @endif
                                    </td>
                                    <td>
                                      @if($currency == 'INR')
                                      <i class="fa fa-inr"></i>{{$transaction['amount']}}
                                      @else
                                      <i class="fa fa-usd"></i>{{number_format($transaction['amount']/$transaction['transaction_usd_value'], 2)}}
                                      @endif
                                    </td>
                                    <td>
                                      @if($transaction['payment_status']=='5')
                                      <div class="completed-txt" style="color: #f84224;">Pending</div>

                                      @elseif($transaction['payment_status']=='1')
                                      <div class="completed-txt">Success</div>

                                      @else
                                      <div class="completed-txt" style="color: #c9353d;">Failed</div>

                                      @endif
                                    </td>
                                  </tr>
                                  @endforeach
                                 
                                </tbody>
                              </table>
                            </div>
                          </div>
                       @else
                        <div class="col-lg-12 text-center">
                          <h4>No transactions found.</h4>
                        </div>
                      @endif
                      {{-- <div class="paginations space-top-bottm"> --}}
                       {{$pagination->links()}}
                     {{-- </div> --}}
                   </div>
                 </div>
               </div>
             </div>



             @endsection