@extends('front.layout.master')   
@section('main_content')

    <div class="bradcrum-inner">
        <div class="pul-left-title">
             {{$sub_module_title or ''}}
        </div>
        <div class="pul-right-sublink">
            <a href="{{$parent_module_url or ''}}">{{$parent_module_title or ''}}</a> / <a href="{{$module_url or ''}}">{{$module_title or ''}}</a> / <span>{{$sub_module_title or ''}}</span>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="min-hieght-class services-pagemain">
        <div class="ring-product-bg-pattern">
            <h1>Services</h1>
            <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur"Lorem ipsum dolor sit amet, consectetur adipiscing elit,</p>
        </div>

        <div class="container">
            <div class="main-products-sectn">
                <div class="row">
                    <div class="col-md-6">
                        <div class="services-images-left">
                            <figure class="effect-ming">
                                <img src="{{url('/')}}/front/images/service-img-1.jpg" alt="img09" />
                                <div class="border-services"></div>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="content-services-ammaia">
                            <div class="services-tilte-xs">Loan &amp; Financing</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dore magna aliqua.Ut exercitation ullamco laboris nisi ut aliquip commodo consequat.Duis aute irure dolor ireprehenderit in voluptate velitcillum dolore fugiat nulla pariatur...</p>

                            <div class="button-section-user-aacount servicesreadmore">
                                <div class="left-cancle-buton">
                                    <a class="button-shop" href="{{url('services')}}/load_and_finance"><span>Read More</span></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="main-products-sectn">
                <div class="row">
                    <div class="col-md-6 right-sect-services">
                        <div class="services-images-left srv-right-pro">
                            <figure class="effect-ming">
                                <img src="{{url('/')}}/front/images/service-img-2.jpg" alt="img09" />
                                <div class="border-services"></div>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="content-services-ammaia rightcontent-service">
                            <div class="services-tilte-xs">Gift Certificate</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dore magna aliqua.Ut exercitation ullamco laboris nisi ut aliquip commodo consequat.Duis aute irure dolor ireprehenderit in voluptate velitcillum dolore fugiat nulla pariatur...</p>

                            <div class="button-section-user-aacount servicesreadmore">
                                <div class="left-cancle-buton">
                                    <a class="button-shop" href="{{url('services')}}/gift_certificate"><span>Read More</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="main-products-sectn">
                <div class="row">
                    <div class="col-md-6">
                        <div class="services-images-left">
                            <figure class="effect-ming">
                                <img src="{{url('/')}}/front/images/service-img-3.jpg" alt="img09" />
                                <div class="border-services"></div>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="content-services-ammaia">
                            <div class="services-tilte-xs">Payment Options</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dore magna aliqua.Ut exercitation ullamco laboris nisi ut aliquip commodo consequat.Duis aute irure dolor ireprehenderit in voluptate velitcillum dolore fugiat nulla pariatur...</p>

                            <div class="button-section-user-aacount servicesreadmore">
                                <div class="left-cancle-buton">
                                    <a class="button-shop" href="{{url('services')}}/payment_options"><span>Read More</span></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="main-products-sectn">
                <div class="row">
                    <div class="col-md-6 right-sect-services">
                        <div class="services-images-left srv-right-pro">
                            <figure class="effect-ming">
                                <img src="{{url('/')}}/front/images/service-img-4.jpg" alt="img09" />
                                <div class="border-services"></div>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="content-services-ammaia rightcontent-service">
                            <div class="services-tilte-xs">Insurance</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dore magna aliqua.Ut exercitation ullamco laboris nisi ut aliquip commodo consequat.Duis aute irure dolor ireprehenderit in voluptate velitcillum dolore fugiat nulla pariatur...</p>

                            <div class="button-section-user-aacount servicesreadmore">
                                <div class="left-cancle-buton">
                                    <a class="button-shop" href="{{url('services')}}/insurance"><span>Read More</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="main-products-sectn">
                <div class="row">
                    <div class="col-md-6">
                        <div class="services-images-left">
                            <figure class="effect-ming">
                                <img src="{{url('/')}}/front/images/service-img-5.jpg" alt="img09" />
                                <div class="border-services"></div>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="content-services-ammaia">
                            <div class="services-tilte-xs">Babu Service</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dore magna aliqua.Ut exercitation ullamco laboris nisi ut aliquip commodo consequat.Duis aute irure dolor ireprehenderit in voluptate velitcillum dolore fugiat nulla pariatur...</p>

                            <div class="button-section-user-aacount servicesreadmore">
                                <div class="left-cancle-buton">
                                    <a class="button-shop" href="{{url('services')}}/babu_service"><span>Read More</span></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="main-products-sectn">
                <div class="row">
                    <div class="col-md-6 right-sect-services">
                        <div class="services-images-left srv-right-pro">
                            <figure class="effect-ming">
                                <img src="{{url('/')}}/front/images/service-img-6.jpg" alt="img09" />
                                <div class="border-services"></div>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="content-services-ammaia rightcontent-service">
                            <div class="services-tilte-xs">SST</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dore magna aliqua.Ut exercitation ullamco laboris nisi ut aliquip commodo consequat.Duis aute irure dolor ireprehenderit in voluptate velitcillum dolore fugiat nulla pariatur...</p>

                            <div class="button-section-user-aacount servicesreadmore">
                                <div class="left-cancle-buton">
                                    <a class="button-shop" href="{{url('services')}}/sst"><span>Read More</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-products-sectn">
                <div class="row">
                    <div class="col-md-6">
                        <div class="services-images-left">
                            <figure class="effect-ming">
                                <img src="{{url('/')}}/front/images/service-img-7.jpg" alt="img09" />
                                <div class="border-services"></div>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="content-services-ammaia">
                            <div class="services-tilte-xs">Buy Back and Sell Back</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dore magna aliqua.Ut exercitation ullamco laboris nisi ut aliquip commodo consequat.Duis aute irure dolor ireprehenderit in voluptate velitcillum dolore fugiat nulla pariatur...</p>

                            <div class="button-section-user-aacount servicesreadmore">
                                <div class="left-cancle-buton">
                                    <a class="button-shop" href="{{url('services')}}/buy_back"><span>Read More</span></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="main-products-sectn">
                <div class="row">
                    <div class="col-md-6 right-sect-services">
                        <div class="services-images-left srv-right-pro">
                            <figure class="effect-ming">
                                <img src="{{url('/')}}/front/images/service-img-8.jpg" alt="img09" />
                                <div class="border-services"></div>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="content-services-ammaia rightcontent-service">
                            <div class="services-tilte-xs">Delivery &amp; Return Policy</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dore magna aliqua.Ut exercitation ullamco laboris nisi ut aliquip commodo consequat.Duis aute irure dolor ireprehenderit in voluptate velitcillum dolore fugiat nulla pariatur...</p>

                            <div class="button-section-user-aacount servicesreadmore">
                                <div class="left-cancle-buton">
                                    <a class="button-shop" href="{{url('services')}}/policy"><span>Read More</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-products-sectn">
                <div class="row">
                    <div class="col-md-6">
                        <div class="services-images-left">
                            <figure class="effect-ming">
                                <img src="{{url('/')}}/front/images/service-img-9.jpg" alt="img09" />
                                <div class="border-services"></div>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="content-services-ammaia">
                            <div class="services-tilte-xs">Auction / Bidding</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dore magna aliqua.Ut exercitation ullamco laboris nisi ut aliquip commodo consequat.Duis aute irure dolor ireprehenderit in voluptate velitcillum dolore fugiat nulla pariatur...</p>

                            <div class="button-section-user-aacount servicesreadmore">
                                <div class="left-cancle-buton">
                                    <a class="button-shop" href="{{url('services')}}/auction_bidding"><span>Read More</span></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="main-products-sectn">
                <div class="row">
                    <div class="col-md-6 right-sect-services">
                        <div class="services-images-left srv-right-pro">
                            <figure class="effect-ming">
                                <img src="{{url('/')}}/front/images/service-img-10.jpg" alt="img09" />
                                <div class="border-services"></div>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="content-services-ammaia rightcontent-service">
                            <div class="services-tilte-xs">Valuation</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dore magna aliqua.Ut exercitation ullamco laboris nisi ut aliquip commodo consequat.Duis aute irure dolor ireprehenderit in voluptate velitcillum dolore fugiat nulla pariatur...</p>

                            <div class="button-section-user-aacount servicesreadmore">
                                <div class="left-cancle-buton">
                                    <a class="button-shop" href="{{url('services')}}/valuation"><span>Read More</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-products-sectn">
                <div class="row">
                    <div class="col-md-6">
                        <div class="services-images-left">
                            <figure class="effect-ming">
                                <img src="{{url('/')}}/front/images/service-img-11.jpg" alt="img09" />
                                <div class="border-services"></div>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="content-services-ammaia">
                            <div class="services-tilte-xs">Cleaning</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dore magna aliqua.Ut exercitation ullamco laboris nisi ut aliquip commodo consequat.Duis aute irure dolor ireprehenderit in voluptate velitcillum dolore fugiat nulla pariatur...</p>

                            <div class="button-section-user-aacount servicesreadmore">
                                <div class="left-cancle-buton">
                                    <a class="button-shop" href="{{url('services')}}/cleaning"><span>Read More</span></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="main-products-sectn">
                <div class="row">
                    <div class="col-md-6 right-sect-services">
                        <div class="services-images-left srv-right-pro">
                            <figure class="effect-ming">
                                <img src="{{url('/')}}/front/images/service-img-12.jpg" alt="img09" />
                                <div class="border-services"></div>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="content-services-ammaia rightcontent-service">
                            <div class="services-tilte-xs">Recut</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dore magna aliqua.Ut exercitation ullamco laboris nisi ut aliquip commodo consequat.Duis aute irure dolor ireprehenderit in voluptate velitcillum dolore fugiat nulla pariatur...</p>

                            <div class="button-section-user-aacount servicesreadmore">
                                <div class="left-cancle-buton">
                                    <a class="button-shop" href="{{url('services')}}/recut"><span>Read More</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-products-sectn">
                <div class="row">
                    <div class="col-md-6">
                        <div class="services-images-left">
                            <figure class="effect-ming">
                                <img src="{{url('/')}}/front/images/service-img-13.jpg" alt="img09" />
                                <div class="border-services"></div>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="content-services-ammaia">
                            <div class="services-tilte-xs">Story</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dore magna aliqua.Ut exercitation ullamco laboris nisi ut aliquip commodo consequat.Duis aute irure dolor ireprehenderit in voluptate velitcillum dolore fugiat nulla pariatur...</p>

                            <div class="button-section-user-aacount servicesreadmore">
                                <div class="left-cancle-buton">
                                    <a class="button-shop" href="{{url('services')}}/story"><span>Read More</span></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>

    <div class="clearfix"></div>
@endsection