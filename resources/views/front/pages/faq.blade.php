@extends('front.layout.master')
@section('main_content')


    <div class="bradcrum-inner">
        <div class="pul-left-title">
            FAQ
        </div>
        <div class="pul-right-sublink">
            <a href="{{ url('/') }}">Home</a> / <span>FAQ</span>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="min-hieght-class margin-tb faq-spaces">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="faq-titles"> Frequently Asked <span>Questions?</span></div>
                </div>
            </div>
            
            <div class="accordian-detailss faq-acconts">
                <div id='faq_acc'>
                    <ul>
                        @if(isset($arr_faq['data']) && count($arr_faq['data']) > 0)
                        
                            @foreach($arr_faq['data'] as $faq)

                                <?php
                                    if($faq["id"] == '1')
                                    {
                                        $active = 'active';
                                        $style = 'display:block';
                                    }
                                    else
                                    {
                                        $active = '';
                                        $style = 'display:none';
                                    }

                                    $question = isset($faq['question']) ? $faq['question'] : '';
                                    $answer = isset($faq['answer']) ? $faq['answer'] : '';
                                ?>

                                <li class='has-sub {{ $active }}'>
                                    <a href='#'> <span>{{ $question }}</span> </a>
                                    <ul style="{{ $style }}">
                                        <li>
                                            <div class="tabsection-listing-detls">
                                                <div class="faq-text">
                                                    {{ $answer }}
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            @endforeach
                            <div class="clearfix"></div>

                        @else
                            <li class='has-sub active'>
                                <a class="data-found-txt" href='#'> <span>Sorry! No Data Found.</span> </a>
                                <ul style="display:block">
                                    <li>
                                        <div class="tabsection-listing-detls">
                                            <div class="faq-text">
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>

                    @if(isset($arr_pagination) && $arr_pagination != null)
                        @include('front.common.pagination')
                    @endif

                </div>
            </div>

            <div class="border-details-odr"></div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="faq-titles space-title"> Ask Your <span>Question</span></div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
                
                @include('front.layout._operation_status')

                <form id="formContactForm" name="formContactForm" method="POST" action="{{ url('/') }}/faq/store">
                {{csrf_field()}}
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="box-form">
                        <label for="username">Name</label>
                        <input id="username" name="username" placeholder="Enter your name" type="text" onkeyup="chk_validation(this)" data-rule-required="true" data-rule-maxlength="100"  />
                        <span class="error-smg">{{ $errors->first('username') }} </span>
                    </div>
                    <div class="box-form">
                        <label for="email">Email</label>
                        <input id="email" name="email" placeholder="Enter your Email" type="text" data-rule-required="true" data-rule-maxlength="100" data-rule-email="true" />
                        <span class="error-smg">{{ $errors->first('email') }} </span>
                    </div>
                    <div class="box-form">
                        <label for="mobilenumber">Mobile Number</label>
                        <input id="mobilenumber" name="mobilenumber" placeholder="Enter your Mobile Number" type="text" data-rule-required="true" data-rule-number="true" data-rule-minlength="8" data-rule-maxlength="12" />
                        <span class="error-smg">{{ $errors->first('mobilenumber') }} </span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="box-form faqmessage">
                        <label for="message">Question</label>
                        <textarea name="message" id="message" placeholder="Write your Question" data-rule-required="true" data-rule-maxlength="550"></textarea>
                        <span class="error-smg">{{ $errors->first('message') }} </span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="button-section-user-aacount">
                        <div class="fullfil-button">
                            <button type="submit" class="btn btn-primary button-shop">Submit</button>
                        </div>
                    </div>
                </div>
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
    </script>
@endsection