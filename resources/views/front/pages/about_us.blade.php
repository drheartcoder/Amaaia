@extends('front.layout.master')
@section('main_content')

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

<style type="text/css">
    .error-smg { position: sticky; }
</style>

    <div class="about-us-banner-section">
        <div class="container">
            <div class="about-us-banner-content">
                <div class="about-us-banner-head">
                    Discover Precious Diamond
                    <br/> &amp; Jewellery
                </div>
                <div class="about-us-read-more-btn">
                    <a class="button-shop" href="javascript:void(0)"><span>Read More</span></a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="about-section-block">
            <div class="about-amaaia-head">
                About Amaaia Jewellery
            </div>
            <div class="about-amaaia-description">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla venenatis mauris nec erat auctor, maximus aliquet quam interdum. Nulla auctor turpis et sem maximus venenatis. In egestas egestas dictum. Quisque suscipit tristique sem at ultricies. Duis dictum egestas mauris, sed elementum mauris iaculis at. Nam sit amet tellus vitae metus accumsan ultricies. Mauris dui dui, auctor ut efficitur vitae, molestie et neque. augue.</p>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla venenatis mauris nec erat auctor, maximus aliquet quam interdum. Nulla auctor turpis et sem maximus venenatis. In egestas egestas dictum. Quisque suscipit tristique sem at ultricies. Duis dictum egestas mauris, sed elementum mauris iaculis at. Nam sit amet tellus vitae metus accumsan ultricies. Mauris dui dui, auctor ut efficitur vitae, molestie et neque. augue.</p>
            </div>
            <div class="left-cancle-buton">
                 <a class="button-shop" href="javascript:void(0)"><span>Read More</span></a>
            </div>
        </div>
    </div>
    <div class="about-product-section">
        <div class="about-product-section-img">
            <img src="{{ url('/') }}/front/images/about-product-img-1.jpg" alt="amaaia" />
            <div class="about-product-name-section-main">
                <div class="about-name-product">
                <div class="about-product-item-name">
                    Diamond Gold Ring
                </div>
                <div class="about-product-item-category">
                    Rings
                </div>
                </div>
            </div>
        </div>
        <div class="about-product-section-img">
            <img src="{{ url('/') }}/front/images/about-product-img-2.jpg" alt="amaaia" />
            <div class="about-product-name-section-main">
                <div class="about-name-product">
                <div class="about-product-item-name">
                    Diamond Gold Ring
                </div>
                <div class="about-product-item-category">
                    Rings
                </div>
                </div>
            </div>
        </div>
        <div class="about-product-section-img">
            <img src="{{ url('/') }}/front/images/about-product-img-3.jpg" alt="amaaia" />
            <div class="about-product-name-section-main">
                <div class="about-name-product">
                <div class="about-product-item-name">
                    Diamond Gold Ring
                </div>
                <div class="about-product-item-category">
                    Rings
                </div>
                </div>
            </div>
        </div>
        <div class="about-product-section-img">
            <img src="{{ url('/') }}/front/images/about-product-img-4.jpg" alt="amaaia" />
            <div class="about-product-name-section-main">
                <div class="about-name-product">
                <div class="about-product-item-name">
                    Diamond Gold Ring
                </div>
                <div class="about-product-item-category">
                    Rings
                </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="our-members-section-main">
        <div class="container">
            <div class="our-members-head-section">
                Our Members
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="our-member-section">
                        <div class="our-memner-img-section">
                            <img src="{{ url('/') }}/front/images/about-us-our-team-mamber-1.jpg" alt="amaaia" /> 
                        </div>
                        <div class="our-members-info-section">
                            <div class="our-member-name-head">
                                John Richards
                            </div>
                            <div class="our-member-post-section">
                                Jewellery Designer
                            </div>
                            <div class="our-member-description-seciton">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla venenatis mauris nec erat auctor, maximus aliquet quam interdum. Nulla auctor turpis et sem maximus venenatis. In egestas egestas dictum. Quisque suscipit tristique sem at ultricies. Duis dictum egest...
                            </div>
                            <div class="our-member-email-id-section">
                                <div class="email-icon-section"><i class="fa fa-envelope-o"></i> </div> 
                                <div class="email-id-our-member">www.johnrichards@info.com</div>                                   
                            </div>                            
                            <div class="our-member-tweet-id-section">
                                <div class="email-icon-section"><i class="fa fa-twitter"></i> </div> 
                                <div class="email-id-our-member">www.johnr@twitter.com</div>                                                                
                            </div>                            
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="our-member-section">
                        <div class="our-memner-img-section">
                            <img src="{{ url('/') }}/front/images/about-us-our-team-mamber-2.jpg" alt="amaaia" /> 
                        </div>
                        <div class="our-members-info-section">
                            <div class="our-member-name-head">
                                Emma Thomas
                            </div>
                            <div class="our-member-post-section">
                                Sales Manager
                            </div>
                            <div class="our-member-description-seciton">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla venenatis mauris nec erat auctor, maximus aliquet quam interdum. Nulla auctor turpis et sem maximus venenatis. In egestas egestas dictum. Quisque suscipit tristique sem at ultricies. Duis dictum egest...
                            </div>
                            <div class="our-member-email-id-section">
                                <div class="email-icon-section"><i class="fa fa-envelope-o"></i> </div> 
                                <div class="email-id-our-member">www.emaathomas@info.com</div>                                   
                            </div>                            
                            <div class="our-member-tweet-id-section">
                                <div class="email-icon-section"><i class="fa fa-twitter"></i> </div> 
                                <div class="email-id-our-member">www.emmat@twitter.com</div>                                                                
                            </div>                            
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="our-management-section-main">
        <div class="our-management-inner-section">
            <div class="container">
                <div class="our-members-head-section">
                    Our Management
                </div>
                <div class="our-members-content-seciton">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla venenatis mauris nec erat auctor, maximus aliquet quam interdum. Nulla auctor turpis et sem maximus venenatis. In egestas egestas dictum. Quisque suscipit tristique sem at ultricies. Duis dictum egestas mauris, sed elementum mauris iaculis at. Nam sit amet tellus vitae metus accumsan ultricies. Mauris dui dui, auctor ut efficitur vitae, molestie et neque. augue.</p>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla venenatis mauris nec erat auctor, maximus aliquet quam interdum. Nulla auctor turpis et sem maximus venenatis. uat</p>
                </div>
                <div class="about-us-read-more-btn">
                    <a class="button-shop" href="javascript:void(0)"><span>Read More</span></a>
                </div>
            </div>
        </div>
    </div>
    <div class="about-contact-section-main">
        <div class="container">
            <div class="about-contact-us-head-section">
                Contact Us
            </div>
            <div class="row">
                <div class="col-sm-5 col-md-4 col-lg-4">
                    <div class="about-us-contact-left-section">
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
                <div class="col-sm-7 col-md-8 col-lg-8 contact_form_section">
                    <div class="about-contact-us-form">
                        <div class="send-me-message-head">
                            Send us a Message
                        </div>
                        
                        @include('front.layout._operation_status')

                        <form class="about-contact-form" id="formContactForm" name="formContactForm" method="POST" action="{{ url('/') }}/contact_us/store">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-field-label">
                                        First Name
                                    </div>
                                    <div class="form-group">
                                        <input id="firstname" name="firstname" onkeyup="chk_validation(this)" data-rule-required="true" data-rule-maxlength="100" placeholder="Enter your first name" type="text" />
                                        <span class="error-smg">{{ $errors->first('firstname') }} </span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-field-label">
                                        Last Name
                                    </div>
                                    <div class="form-group">
                                        <input id="lastname" name="lastname" onkeyup="chk_validation(this)" data-rule-required="true" data-rule-maxlength="100" placeholder="Enter your last name" type="text" />
                                        <span class="error-smg">{{ $errors->first('lastname') }} </span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-field-label">
                                        Email
                                    </div>
                                    <div class="form-group">
                                        <input id="emailaddress" name="emailaddress" data-rule-required="true" data-rule-maxlength="100" placeholder="Enter your Email Address" type="text" data-rule-email="true" />
                                        <span class="error-smg">{{ $errors->first('emailaddress') }} </span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-field-label">
                                        Contact Number
                                    </div>
                                    <div class="form-group">
                                        <input id="mobilenumber" name="mobilenumber" data-rule-required="true" data-rule-number="true" data-rule-minlength="8" data-rule-maxlength="12" placeholder="Enter your Contact Number" type="text" />
                                        <span class="error-smg">{{ $errors->first('mobilenumber') }} </span>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-field-label">
                                        Message
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" id="message" data-rule-required="true" data-rule-maxlength="550" placeholder="Enter your Message"></textarea>
                                        <span class="error-smg">{{ $errors->first('message') }} </span>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="about-contact-us-send-btn">
                                        <button type="submit" class="subscribe-white">Send</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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

            if ($('.session_value').length > 0)
            {
                $('html, body').animate({
                    scrollTop: $(".contact_form_section").offset().top - 150
                }, 2000);
            }
        });
    </script>

@endsection
  