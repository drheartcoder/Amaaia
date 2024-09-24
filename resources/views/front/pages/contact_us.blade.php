@extends('front.layout.master')                
@section('main_content')


    <div class="bradcrum-inner">
        <div class="pul-left-title">
            Contact Us
        </div>
        <div class="pul-right-sublink">
            <a href="{{ url('/') }}">Home</a> / <span>Contact Us</span>
        </div>
        <div class="clearfix"></div>
    </div>

    @php
        $site_email          = isset($site_data['site_email_address']) ? $site_data['site_email_address'] : '';
        $site_contact_number = isset($site_data['site_contact_number']) ? $site_data['site_contact_number'] : '';
        $site_address        = isset($site_data['site_address']) ? $site_data['site_address'] : '';

        $lat                 = isset($site_data['lat']) ? $site_data['lat'] : '';
        $lon                 = isset($site_data['lon']) ? $site_data['lon'] : '';

        $fb_url              = isset($site_data['fb_url']) ? $site_data['fb_url'] : '';
        $twitter_url         = isset($site_data['twitter_url']) ? $site_data['twitter_url'] : '';
        $google_plus_url     = isset($site_data['google_plus_url']) ? $site_data['google_plus_url'] : '';
        $linkedin_url        = isset($site_data['linkedin_url']) ? $site_data['linkedin_url'] : '';
    @endphp

    <div class="min-hieght-class">

        <div class="map-sectionmain">
            <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCccvQtzVx4aAt05YnfzJDSWEzPiVnNVsY&q={{ $site_address }}&q={{ $lat }},{{ $lon }}" display="block" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
       
        <div class="container">
            <div class="send-message-sections">
                <div class="row">
                    <div class="col-md-7 col-lg-7 paddingright-col">
                        <div class="white-inner-contact">
                            <div class="message-title-page">Send us a Message <span></span>
                                <div class="clearfix"></div>
                            </div>

                            @include('front.layout._operation_status')
                            
                            <form id="formContactForm" name="formContactForm" method="POST" action="{{ url('/') }}/contact_us/store">
                            {{csrf_field()}}
                            <div class="row">
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
                                        <input id="lastname" name="lastname" onkeyup="chk_validation(this)" data-rule-required="true" data-rule-maxlength="100" placeholder="Enter your last name" type="text" />
                                        <span class="error-smg">{{ $errors->first('lastname') }} </span>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="box-form">
                                        <label for="emailaddress">Email</label>
                                        <input id="emailaddress" name="emailaddress" data-rule-required="true" data-rule-maxlength="100" placeholder="Enter your Email Address" type="text" data-rule-email="true" />
                                        <span class="error-smg">{{ $errors->first('emailaddress') }} </span>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="box-form">
                                        <label for="mobilenumber">Contact Number</label>
                                        <input id="mobilenumber" name="mobilenumber" data-rule-required="true" data-rule-number="true" data-rule-minlength="8" data-rule-maxlength="12" placeholder="Enter your Contact Number" type="text" />
                                        <span class="error-smg">{{ $errors->first('mobilenumber') }} </span>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="box-form">
                                        <label for="message">Message</label>
                                        <textarea name="message" id="message" data-rule-required="true" data-rule-maxlength="550" placeholder="Enter your Message"></textarea>
                                        <span class="error-smg">{{ $errors->first('message') }} </span>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="button-section-user-aacount">
                                        <div class="fullfil-button">
                                            <button type="submit" class="btn btn-primary button-shop">Send</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                    <div class="col-md-5 col-lg-5 paddingleft-col">
                        <div class="black-section-contact">
                            <div class="contact-title-black">
                                Contact Information
                            </div>
                            <div class="info-contact-list">
                                <div class="info-contact-list-left messages-icons"></div>
                                <div class="info-contact-list-right">{{ $site_email }}</div>
                                <div class="clearfix"></div>
                            </div>
                             <div class="info-contact-list">
                                <div class="info-contact-list-left phones-icons"></div>
                                <div class="info-contact-list-right">{{ $site_contact_number }}</div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="info-contact-list last-class-border">
                                <div class="info-contact-list-left aadress-icons"></div>
                                <div class="info-contact-list-right">{{ $site_address }}</div>
                                <div class="clearfix"></div>
                            </div>
                            
                            <div class="socail-contact-page">
                                <ul>
                                    <li><a class="socail-icnsd fb-contact" href="{{ $fb_url }}" target="_blank"></a></li>
                                    <li><a class="socail-icnsd twitter-contact" href="{{ $twitter_url }}" target="_blank"></a></li>
                                    <li><a class="socail-icnsd google-contact" href="{{ $google_plus_url }}" target="_blank"></a></li>
                                    <li><a class="socail-icnsd linked-contact" href="{{ $linkedin_url }}" target="_blank"></a></li>
                                </ul>
                            </div>
                            <div class="get-touch-classs">
                            Get In Touch
                            </div>
                            <div class="touch-details-cls">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            </div>
                            
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
  