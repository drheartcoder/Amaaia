@extends('front.layout.master')   
@section('main_content')

<div class="bradcrum-inner">
    <div class="pul-left-title">
        {{$module_title or ''}}
    </div>
    <div class="pul-right-sublink">
        <a href="{{$parent_module_url or ''}}">{{$parent_module_title or ''}}</a> / <a href="{{$module_url or ''}}">{{$module_title or ''}}</a> / <span>{{$sub_module_title or ''}}</span>
    </div>
    <div class="clearfix"></div>
</div>
<div class="min-hieght-class services-pagemain">
    <div class="container">
        <div class="main-products-sectn service-dtls-spc">
            @if(isset($slug) && $slug == 'load_and_finance')
            <div class="row">
                <div class="col-md-6">
                    <div class="services-images-details">
                        <img src="{{url('/')}}/front/images/service-img-1.jpg" alt="img09" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="content-services-details-ammaia">
                        <div class="services-tilte-xs">Loan and Finance</div>
                        <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam <br><br>

                            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam<br>
                        T"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut </p>


                    </div>
                </div>
            </div>
            @elseif(isset($slug) && $slug == 'gift_certificate')
            <div class="row">
                <div class="col-md-6">
                    <div class="services-images-details">
                        <img src="{{url('/')}}/front/images/service-img-2.jpg" alt="img09" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="content-services-details-ammaia">
                        <div class="services-tilte-xs">Gift Certificate</div>
                        <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam <br><br>

                            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam<br>
                        T"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut </p>


                    </div>
                </div>
            </div>
            @elseif(isset($slug) && $slug == 'payment_options')
            <div class="row">
                <div class="col-md-6">
                    <div class="services-images-details">
                        <img src="{{url('/')}}/front/images/service-img-3.jpg" alt="img09" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="content-services-details-ammaia">
                        <div class="services-tilte-xs">Payment Options</div>
                        <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam <br><br>

                            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam<br>
                        T"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut </p>


                    </div>
                </div>
            </div>

            @elseif(isset($slug) && $slug == 'insurance')
            <div class="row">
                <div class="col-md-6">
                    <div class="services-images-details">
                        <img src="{{url('/')}}/front/images/service-img-4.jpg" alt="img09" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="content-services-details-ammaia">
                        <div class="services-tilte-xs">Insurance</div>
                        <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam <br><br>

                            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam<br>
                        T"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut </p>


                    </div>
                </div>
            </div>

            @elseif(isset($slug) && $slug == 'babu_service')
            <div class="row">
                <div class="col-md-6">
                    <div class="services-images-details">
                        <img src="{{url('/')}}/front/images/service-img-5.jpg" alt="img09" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="content-services-details-ammaia">
                        <div class="services-tilte-xs">Babu Service</div>
                        <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam <br><br>

                            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam<br>
                        T"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut </p>


                    </div>
                </div>
            </div>
            @elseif(isset($slug) && $slug == 'sst')
            <div class="row">
                <div class="col-md-6">
                    <div class="services-images-details">
                        <img src="{{url('/')}}/front/images/service-img-6.jpg" alt="img09" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="content-services-details-ammaia">
                        <div class="services-tilte-xs">SST</div>
                        <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam <br><br>

                            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam<br>
                        T"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut </p>


                    </div>
                </div>
            </div>

            @elseif(isset($slug) && $slug == 'buy_back')
            <div class="row">
                <div class="col-md-6">
                    <div class="services-images-details">
                        <img src="{{url('/')}}/front/images/service-img-7.jpg" alt="img09" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="content-services-details-ammaia">
                        <div class="services-tilte-xs">Buy Back and Sell Back</div>
                        <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam <br><br>

                            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam<br>
                        T"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut </p>


                    </div>
                </div>
            </div>

            @elseif(isset($slug) && $slug == 'policy')
            <div class="row">
                <div class="col-md-6">
                    <div class="services-images-details">
                        <img src="{{url('/')}}/front/images/service-img-8.jpg" alt="img09" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="content-services-details-ammaia">
                        <div class="services-tilte-xs">Delivery & Return Policy</div>
                        <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam <br><br>

                            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam<br>
                        T"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut </p>
                    </div>
                </div>
            </div>

            @elseif(isset($slug) && $slug == 'auction_bidding')
            <div class="row">
                <div class="col-md-6">
                    <div class="services-images-details">
                        <img src="{{url('/')}}/front/images/service-img-9.jpg" alt="img09" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="content-services-details-ammaia">
                        <div class="services-tilte-xs">Auction / Bidding</div>
                        <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam <br><br>

                            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam<br>
                        T"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut </p>
                    </div>
                </div>
            </div>

            @elseif(isset($slug) && $slug == 'valuation')
            <div class="row">
                <div class="col-md-6">
                    <div class="services-images-details">
                        <img src="{{url('/')}}/front/images/service-img-10.jpg" alt="img09" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="content-services-details-ammaia">
                        <div class="services-tilte-xs">Valuation</div>
                        <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam <br><br>

                            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam<br>
                        T"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut </p>
                    </div>
                </div>
            </div>
            @elseif(isset($slug) && $slug == 'cleaning')
            <div class="row">
                <div class="col-md-6">
                    <div class="services-images-details">
                        <img src="{{url('/')}}/front/images/service-img-11.jpg" alt="img09" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="content-services-details-ammaia">
                        <div class="services-tilte-xs">Cleaning</div>
                        <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam <br><br>

                            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam<br>
                        T"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut </p>
                    </div>
                </div>
            </div>

            @elseif(isset($slug) && $slug == 'recut')
            <div class="row">
                <div class="col-md-6">
                    <div class="services-images-details">
                        <img src="{{url('/')}}/front/images/service-img-12.jpg" alt="img09" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="content-services-details-ammaia">
                        <div class="services-tilte-xs">Recut</div>
                        <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam <br><br>

                            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam<br>
                        T"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut </p>
                    </div>
                </div>
            </div>

            @elseif(isset($slug) && $slug == 'story')
            <div class="row">
                <div class="col-md-6">
                    <div class="services-images-details">
                        <img src="{{url('/')}}/front/images/service-img-13.jpg" alt="img09" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="content-services-details-ammaia">
                        <div class="services-tilte-xs">Story</div>
                        <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam <br><br>

                            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam<br>
                        T"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut </p>
                    </div>
                </div>
            </div>

            @endif
        </div>
        <div class="border-details-odr details-servc"></div>
        @include('front.layout._operation_status')
        <div class="title-sev-details">Inquiry Now</div>
            <div class="row">
                <form id="formContactForm" name="formContactForm" method="POST" action="{{ url('/') }}/services/store">
                    {{csrf_field()}}
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="box-form">
                            <label for="firstname">First Name</label>
                            <input id="firstname" name="firstname" onkeyup="chk_validation(this)" data-rule-required="true" data-rule-maxlength="100" placeholder="Enter your first name" type="text" />
                            <span class="error-smg">{{ $errors->first('firstname') }} </span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="box-form">
                            <label for="lastname">Last Name</label>
                            <input id="lastname" name="lastname" onkeyup="chk_validation(this)" data-rule-required="true" data-rule-maxlength="100" placeholder="Enter your last name" type="text" placeholder="Enter your last name" type="text" />
                            <span class="error-smg">{{ $errors->first('lastname') }} </span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="box-form">
                            <label for="emailaddress">Email</label>
                            <input id="emailaddress" name="emailaddress" data-rule-required="true" data-rule-maxlength="100" placeholder="Enter your Email" type="text" data-rule-email="true" />
                            <!-- <div class="error-smg">Enter Correct... </div>-->
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="box-form">
                            <label for="address">Message</label>
                            <textarea name="message" id="message" data-rule-required="true" data-rule-maxlength="550" placeholder="Write a Message"></textarea>
                            <span class="error-smg">{{ $errors->first('message') }} </span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="button-section-user-aacount space-bottoms-detl">
                            <div class="fullfil-button">
                                {{-- <a class="button-shop" href="javascript:void(0)"><span>Send</span></a> --}}
                                <button type="submit" class="button-shop" href="javascript:void(0)"><span>Send</span></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
    </div>
</div>

<div class="clearfix"></div>

 <script type="text/javascript">
        $(document).ready(function(){
            jQuery('#formContactForm').validate({
            errorClass: "error-smg",
            highlight: function(element) { },
            errorElement: "span",
            rules: {
                email: {
                    required: true,
                    email: true,
                    pattern: /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/
                }
            },
            messages: {
                email: {
                    pattern: "Please enter a valid email address.",

                },
            }

        });
        });

        function chk_validation(ref)
        {
            var yourInput = $(ref).val();
            re = /[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
            var isSplChar = re.test(yourInput);
            if(isSplChar)
            {
                var no_spl_char = yourInput.replace(/[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
                $(ref).val(no_spl_char);
            }
        }

    </script>

@endsection