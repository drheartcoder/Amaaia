@extends('front.layout.master')   
@section('main_content')

<!-- Page breadcrumb -->  
@include('front.user.layout.breadcrumb')
<!-- /page breadcrumb -->

    <div class="inner-page-main min-hieght-class usergiftmain">
        <div class="container">           

            <div class="row">
                <div id="left-bar"> @include('front.user.layout.sidebar') </div>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="cart-login my-wallet-main-section">
                        <div class="wallet-ballance-section">
                            <span class="img-icon-wallate"> 
                                <img src="{{ url('/') }}/front/images/wallate-icon-img.png" alt="" /> 
                            </span>
                            <span class="balance-amount-section"> {!! session_currency($wallet_total) !!} </span>
                        </div>

                        @if(isset($arr_wallet['data']) && !empty($arr_wallet['data']))

                        <div class="table-ammaia transection-details-table">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>                                            
                                            <th>Order ID</th>
                                            <th>Amount</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    @foreach($arr_wallet['data'] as $wallet)

                                        @php
                                            $id                 = isset($wallet['id']) ? $wallet['id'] : '';
                                            $order_id           = isset($wallet['order_id']) ? $wallet['order_id'] : '';
                                            $amount_credited    = isset($wallet['amount_credited']) ? $wallet['amount_credited'] : '';
                                            $amount_debited     = isset($wallet['amount_debited']) ? $wallet['amount_debited'] : '';
                                            $transaction_status = isset($wallet['transaction_status']) ? $wallet['transaction_status'] : '';

                                            $created_at         = isset($wallet['created_at']) ? formatted_trasaction_date($wallet['created_at']) : '';

                                            if($transaction_status == '1')
                                            {
                                                $transaction_status     = 'Success';
                                            }
                                            else if($transaction_status == '2')
                                            {
                                                $transaction_status     = 'Failure';
                                            }
                                            else if($transaction_status == '3')
                                            {
                                                $transaction_status     = 'Pending';
                                            }

                                            if($amount_credited != '0' && $amount_debited == '0')
                                            {
                                                $type                   = 'Credit';
                                                $amount                 = session_currency($amount_credited);
                                            }
                                            if($amount_credited == '0' && $amount_debited != '0')
                                            {
                                                $type                   = 'Debit';
                                                $amount                 = session_currency($amount_debited);
                                            }
                                        @endphp

                                        <tr>
                                            <td class="whitenowraps">{{ $order_id }}</td>
                                            <td>{!! $amount !!}</td>
                                            <td>{{ $type }}</td>
                                            <td>{{ $transaction_status }}</td>
                                            <td>{{ $created_at }}</td>
                                            <td style="text-align: center;"><a href="{{ $module_url_path }}/view/{{ base64_encode($id) }}" class="icon-eyes"> <i class="fa fa-eye"></i></a></td>
                                        </tr>

                                    @endforeach

                                     

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @else 
	                        <div class="col-lg-12 text-center">
	                          <h4>No wallet transactions found.</h4>
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
    <div class="clearfix"></div>

@endsection