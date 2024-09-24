
<!--Support chat -->
<!--Start of Tawk.to Script -->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5afbfc33227d3d7edc255e2c/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->


<style type="text/css">

    .error.error-subscibe{position: absolute; left: 0px; bottom: -20px;color: red;}
    /*.msg.msg-subscibe{position: absolute; left: 0px; bottom: -73px;color: red;}*/
    .subscribe-receive-input{position: relative;}
</style>
<div class="subscribe-sectin-txt wow slideInDown" data-wow-delay="0.3s">
    <div class="container">
        <div class="subscribe-receive-txt"> Subscribe To Receive Hot Deals  </div>
        <div class="subscribe-receive-input"> 
            <input type="text" oninput="chk_email()" placeholder="Enter your email address" class="form-inputs" id="email_subscribe" />

        </form>
        <div class="error error-subscibe" id="error"></div>
        {{-- <div class="msg msg-subscibe"></div> --}}


    </div>

    <div class="subscribe-receive-button"> 
        <a class="subscribe-white btn-subscribe" href="javascript:void(0)">
            <span>Subscribe</span>
        </a> 
    </div>

</div>
</div>
<!-- Subscribe Section End -->   


<!--footer section start here-->
<footer>
    <div id="footer">

        <div class="footer-main-block">
            <div class="container">
                <div class="row">
                    <div class="footer-col-block">
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <div class=" footer-col-head wow fadeIn" data-wow-delay=0.2s>
                                <a href="{{ url('/') }}"><img class="footerlogos" src="{{url('/front')}}/images/ammaia-logo.png" alt="Logo" /></a>
                            </div>
                            <div class=" wow fadeIn" data-wow-delay=0.4s>
                                <div class="footer-content-block">
                                    {{-- <p class="p-txt-footer"> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna..</p>
                                    <a class="more-txt-block" href="javascript:void(0)">More...</a> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <div class="footer_heading footer-col-head">Quick Links</div>
                            <div class="menu_name points-footer wow bounceIn" data-wow-delay=0.2s>
                                <ul>
                                    <li><a href="{{url('/')}}/supplier"> <span class="circle-footer-points"><i class="fa fa-circle-o"></i></span> Seller Login</a></li>
                                    <li><a href="{{url('info/career')}}"> <span class="circle-footer-points"><i class="fa fa-circle-o"></i></span> Careers</a></li>
                                    <li><a href="{{url('/')}}/gift_cards"> <span class="circle-footer-points"><i class="fa fa-circle-o"></i></span> Gift Cards</a></li>
                                    <li><a href="{{url('/')}}/blog"> <span class="circle-footer-points"><i class="fa fa-circle-o"></i></span> Blog</a></li>
                                    <li><a href="{{ url('/') }}/contact_us"> <span class="circle-footer-points"><i class="fa fa-circle-o"></i></span> Contact Us</a></li>
                                    <li><a href="{{ url('/') }}/about_us"> <span class="circle-footer-points"><i class="fa fa-circle-o"></i></span> About Us</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <div class="footer_heading footer-col-head">Information</div>
                            <div class="menu_name points-footer wow bounceIn" data-wow-delay=0.3s>
                                <ul>
                                    <li><a href="{{ url('/') }}/faq"> <span class="circle-footer-points"><i class="fa fa-circle-o"></i></span> Faq's</a></li>

                                    <li><a href="{{url('/info/'.'privacy-policy')}}"> <span class="circle-footer-points"><i class="fa fa-circle-o"></i></span> Privacy Policy</a></li>                            
                                    <li><a href="{{url('/info/'.'terms-of-use')}}"> <span class="circle-footer-points"><i class="fa fa-circle-o"></i></span> Terms of Use</a></li>

                                    <li><a href="{{url('info/engagement-moments')}}"> <span class="circle-footer-points"><i class="fa fa-circle-o"></i></span> Engagement Moments</a></li>
                                    
                                    <li><a href="{{url('/info/education')}}"> <span class="circle-footer-points"><i class="fa fa-circle-o"></i></span> Education</a></li>

                                    <li><a href="{{url('/info/why-buy-amaaia')}}"> <span class="circle-footer-points"><i class="fa fa-circle-o"></i></span> Why Buy Amaaia?</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <div class="footer_heading footer-col-head last-subscribe">
                                <span>Social Links</span>
                            </div>
                            <div class="menu_name points-footer wow bounceIn" data-wow-delay=0.3s>

                                <div class="footer-col-head  tile-joints">
                                    <ul class="social-footer">
                                        <li><a href="{{$arr_global_site_setting['fb_url'] or ''}}"><span class="defualt-in fb-cin"></span> Facebook</a></li>
                                        <li><a href="{{$arr_global_site_setting['google_plus_url'] or ''}}"><span class="defualt-in googleplus-cin"></span> Google plus</a></li>
                                        <li><a href="{{$arr_global_site_setting['instagram_url'] or ''}}"><span class="defualt-in instagram-cin"></span> Instagram</a></li>
                                        <li><a href="{{$arr_global_site_setting['pintrest_url'] or ''}}"><span class="defualt-in pinterest-cin"></span> Pintrest</a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="copyright-block">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="copy-tct">
                                {{date('Y')}} <i class="fa fa-copyright"></i> <a href="{{url('/')}}">{{config('app.project.name')}}</a>. All rights reserved.
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="copyright-icns"> </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </div>
        </div>

        <a class="cd-top hidden-xs hidden-sm" href="javascript::void(0)">Top</a>
        {{-- <div class="more-services-link">
            <a href="javascript:void(0)" class="serc-morelink"></a>
        </div> --}}

    </div>
</footer>

<script type="text/javascript" src="{{url('/front')}}/js/accordion-limit.js"></script>
<script type="text/javascript" src="{{url('/front')}}/js/accordion-zan.js"></script>
<script src="{{url('/front')}}/js/common.js" type="text/javascript"></script>
<script src="{{url('/front')}}/js/jquery.flexisel.js" type="text/javascript"></script>
<script src="{{url('/front')}}/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="{{url('/front')}}/js/additional-methods.min.js" type="text/javascript"></script>
<script src="{{url('/front')}}/js/sweetalert.min.js" type="text/javascript"></script>
<script src="{{url('/front')}}/js/loader.js" type="text/javascript"></script>
<script src="{{url('/front')}}/js/easyResponsiveTabs.js" type="text/javascript"></script>
<script src="{{url('/front')}}/js/image_validation.js" type="text/javascript"></script>
<script src="{{url('/front')}}/js/accordian.js" type="text/javascript"></script>
<script src="{{url('/front')}}/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="{{url('/front')}}/js/bootstrap-timepicker.js" type="text/javascript"></script>
<script src="{{url('/front')}}/js/jquery-ui.js" type="text/javascript"></script>
<script src="{{url('/front')}}/js/jquery.flexisel.js" type="text/javascript"></script>


<script>  
    $('#horizontalTab').easyResponsiveTabs({
        type: 'default',       
        width: 'auto', 
        fit: true, 
        closed: 'accordion', 
        activate: function(event) { 
            var $tab = $(this);
            var $info = $('#tabInfo');
            var $name = $('span', $info);

            $name.text($tab.text());

            $info.show();
        }
    });
    
    function readImageURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#upload-f')
                .attr('src', e.target.result)
                .width(150)
                .height(150);
            };
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
</script>

<script type="text/javascript">
    var status = '0';
    function chk_email(){

        var email = $('#email_subscribe').val();
        var patt = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;

        if(email == '')
        {
            $('.error').html('Please Enter Email-Id');
            status = '0';
        }
        else if(email.match(patt))
        {
            $('.error').html('');
            status = '1';
        }else{

            $('.error').html('Enter Correct Email Address');
            status = '0';
        }
    }

    $('.btn-subscribe').click(function()
    {
        chk_email();

        if(status == '1'){
            var email = $('#email_subscribe').val();

            $.ajax({
                url:'{{url('/')}}/subscribe',
                type:'get',
                data:{email:email},
                success:function(data)
                {
                    if(data.error)
                    {
                        swal('Error', data.error, 'warning');
                        // $('.msg-subscibe').html("<div class='alert alert-danger'> <strong>"+data.error+"</div>")
                        
                    }
                    if(data.success)
                    {
                        /*$('.msg-subscibe').html("<div class='alert alert-success'> <strong>"+data.success+"</div>")*/
                        swal('Success', data.success,'success');
                        $('#email_subscribe').val('');
                    }
                }
            });
        }

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
</html>
