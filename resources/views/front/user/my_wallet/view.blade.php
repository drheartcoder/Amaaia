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
                    <div class="my-wallet-details-main">
                        <div class="my-wallet-nm">Wallet Details</div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="transaction-main">
                                    <div class="transaction-id">
                                        Date
                                    </div>
                                    <div class="transaction-id-right">{{ isset($arr_wallet['created_at']) ? date("d-M-Y", strtotime($arr_wallet['created_at'])) : '' }}</div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="transaction-main">
                                    <div class="transaction-id">
                                        Time
                                    </div>
                                    <div class="transaction-id-right">{{ isset($arr_wallet['created_at']) ? date("h:i a", strtotime($arr_wallet['created_at'])) : '' }}</div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="transaction-main">
                                    <div class="transaction-id">
                                        Transaction Id
                                    </div>
                                    <div class="transaction-id-right">{{ isset($arr_wallet['order_id']) ? $arr_wallet['order_id'] : '' }}</div>
                                    <div class="clearfix"></div>
                                </div>
                                <?php
                                    $type = isset($arr_wallet['type']) ? $arr_wallet['type'] : '';
                                    if($type == '1')
                                    {
                                        $type_name = 'Return';
                                    }
                                    else if($type == '2')
                                    {
                                        $type_name = 'Replacement';
                                    }
                                ?>
                                <div class="transaction-main">
                                    <div class="transaction-id">
                                        Payment For
                                    </div>
                                    <div class="transaction-id-right">{{ $type_name }}</div>
                                    <div class="clearfix"></div>
                                </div>
                                <?php
                                    $transaction_status = isset($arr_wallet['transaction_status']) ? $arr_wallet['transaction_status'] : '';
                                    if($transaction_status == '1')
                                    {
                                        $status = 'Success';
                                        $icon = '<span class="compl-img-all compl-img"></span>';
                                    }
                                    else if($transaction_status == '2')
                                    {
                                        $status = 'Failure';
                                        $icon = '<span class="compl-img-all compl-img imgnone"> <img src="'.url("/front/images/close-icn-save.png").'" alt=""></span>';
                                    }
                                    else if($transaction_status == '3')
                                    {
                                        $status = 'Pending';
                                        $icon = '<span class="compl-img-all compl-img imgnone"> <img src="'.url("/front/images/pendding-icns-replacment.png").'" alt=""></span>';
                                    }

                                    $credited = isset($arr_wallet['amount_credited']) ? $arr_wallet['amount_credited'] : '';
                                    $debited  = isset($arr_wallet['amount_debited']) ? $arr_wallet['amount_debited'] : '';
                                    
                                    if($credited != '0' && $debited == '0')
                                    {
                                        $amount           = '+ '.session_currency($credited);
                                        $transaction_type = 'Credit';
                                    }
                                    else if($credited == '0' && $debited != '0')
                                    {
                                        $amount           = '- '.session_currency($debited);
                                        $transaction_type = 'Debit';
                                    }
                                ?>
                                <div class="transaction-main">
                                    <div class="transaction-id">
                                        Transaction Type
                                    </div>
                                    <div class="transaction-id-right">{{ $transaction_type }}</div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="transaction-main">
                                    <div class="transaction-id">
                                        Status
                                    </div>
                                    <div class="transaction-id-right">
                                        <div class="compl-orders floanones">
                                            {!! $icon !!}
                                            <span class="compl-text">{{ $status }}</span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>

                        <div class="price-wallet-min">{!! $amount !!}</div>
                         
                        <div class="button-section-user-aacount back-btns-bottom">
                            <div class="left-cancle-buton">
                                <a class="button-shop" href="javascript:history.back(1)"><span>Back</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="clearfix"></div>

@endsection