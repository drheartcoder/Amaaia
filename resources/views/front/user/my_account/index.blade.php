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
             <div class="tabbing_area">
                <div id="horizontalTab">
                  <ul class="resp-tabs-list">

                     <li>Account Information</li>
                     <li>Change Password</li>
                     <li>Bank Account Details</li>
                  </ul>
                  <div class="resp-tabs-container">
                       <!--tab-1 start-->

                      <div>
                        @if(Request::segment(3) != 2 && Request::segment(3) != 3)
                          @include('front.layout._operation_status')
                        @endif
                        <form id="frm_personal_details" name="frm_personal_details" enctype="multipart/form-data" method="post" action="{{$module_url_path}}/update">
                            {{csrf_field()}}
                            @php $is_profile_image_required = $prev_image_url = $profile_img_src = ""; @endphp
                            @if(isset($arr_personal_info['profile_image']) && !empty($arr_personal_info['profile_image']) && File::exists($user_profile_image_base_path.$arr_personal_info['profile_image']))
                                
                                @php
                                  $profile_img_src = $user_profile_image_public_path.$arr_personal_info['profile_image']; 
                                  $prev_image_url = $user_profile_image_public_path.$arr_personal_info['profile_image']; 
                                  
                                  $is_profile_image_required = false; 
                                @endphp
                            @else
                                @php 
                                $profile_img_src = url('/').'/front/images/user-account-profile.png';
                                $is_profile_image_required = true;
                                $prev_image_url = url('/').'/front/images/user-account-profile.png';
                                @endphp
                            @endif

                            <div class="box-form">
                                <div class="upload-image-inner">
                                    <div class="profile-img">
                                        <div class="upload-img"></div>
                                        <input type="hidden" name="oldimage" id="oldimage" value="{{ $arr_personal_info['profile_image']  or ''}}"/>
                                        <input type="hidden" name="prev_image_url" id="prev_image_url" value="{{$prev_image_url or ''}}"/>
                                        <input class="file-upload" type="file" id="profile-image" name="profile_image" {{$is_profile_image_required == true ? 'data-rule-required=true' : ''}} data-msg-required="Please select profile image.">
                                        <div class="profile-image"><img src="{{$profile_img_src or ''}}" id="upload-f" class="profile" alt="" style="height: 150px; width: 150px;"></div>
                                    </div>
                                </div>
                            </div>
                      
                            <div class="row">
                                 <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                     <div class="box-form">
                                         <label for="first_name">First Name<span>*</span></label>
                                         <input id="first_name" name="first_name" placeholder="Enter your First name" type="text" value="{{$arr_personal_info['first_name'] or ''}}"  data-rule-required="true" data-rule-maxlength="60" data-rule-pattern="^[a-zA-Z]+$" />
                                          <span class="error-smg">{{$errors->first('first_name')}}</span>
                                     </div>
                                 </div>
                                 <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                     <div class="box-form">
                                         <label for="last_name">Last Name<span>*</span></label>
                                         <input id="last_name" name="last_name" placeholder="Enter your Last name" type="text"  value="{{$arr_personal_info['last_name'] or ''}}"  data-rule-required="true" data-rule-maxlength="60" data-rule-pattern="^[a-zA-Z]+$" />
                                          <span class="error-smg">{{$errors->first('last_name')}}</span>
                                     </div>
                                 </div>

                                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                      <div class="box-form">
                                          <label for="lastname">Gender<span>*</span></label>
                                          <div class="radio-btns">
                                              <div class="radio-btn">
                                                  <input type="radio" id="f-option" name="gender" data-rule-required='true' value="1" data-msg-required="Please select your gender." {{isset($arr_personal_info['gender']) && $arr_personal_info['gender'] == '1' ? 'checked' : ''}}>
                                                  <label for="f-option">Male</label>
                                                  <div class="check"></div>
                                              </div>
                                              <div class="radio-btn">
                                                  <input type="radio" id="s-option" name="gender" data-rule-required='true' value="2"  data-msg-required="Please select your gender." {{isset($arr_personal_info['gender']) && $arr_personal_info['gender'] == '2' ? 'checked' : ''}}>
                                                  <label for="s-option">Female</label>
                                                  <div class="check"><div class="inside"></div></div>
                                              </div>
                                          </div>
                                          <div class="clearfix"></div>
                                          <span class="error-smg err_gender">{{$errors->first('gender')}}</span>
                                      </div>
                                  </div>
                              
                                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                      <div class="box-form">
                                          <label for="email">Email Address<span>*</span></label>
                                          <input id="email" name="emailaddress" placeholder="Enter your Email Address" type="email" value="{{$arr_personal_info['email'] or ''}}" disabled="disabled" />
                                      </div>
                                  </div>

                                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                     <div class="box-form">
                                         <label for="flatno">Country Phone Code<span>*</span></label>
                                         <select class="form-control" id="phonecode" name="phonecode" style="padding:  8px;" data-rule-required='true' data-msg-required='Please select country phone code.'>
                                          <option value="">Select Country Phone Code</option>
                                          @if(isset($arr_phonecode) && is_array($arr_phonecode) && sizeof($arr_phonecode)>0)
                                            @foreach($arr_phonecode as $phonecode) 
                                            <option value="{{isset($phonecode['id'])? base64_encode($phonecode['id']):''}}" @if($phonecode['id'] == $arr_personal_info['country_phone_code_id']) selected="selected" @endif>
                                                  +{{$phonecode['phonecode'] or ''}} ({{$phonecode['CountryCode'] or ''}})
                                              </option>
                                            @endforeach
                                          @endif
                                        </select>
                                        <span class="error-smg">{{$errors->first('phonecode')}}</span>
                                     </div>
                                 </div>

                                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                      <div class="box-form">
                                          <label for="mobile_number">Mobile Number<span>*</span></label>
                                          <input id="mobile_number" name="mobile_number" placeholder="Enter your Mobile Number" type="text" value="{{$arr_personal_info['mobile_number'] or ''}}" data-rule-required="true" data-rule-pattern="[- +()0-9]+" data-rule-minlength="7" data-rule-maxlength="16" data-msg-minlength="Mobile no should be atleast 7 numbers" data-msg-maxlength="Mobile no should not be more than 16 numbers" />
                                          <span class="error-smg">{{$errors->first('mobile_number')}}</span>
                                      </div>
                                  </div>

                                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                     <div class="box-form">
                                         <label for="address">Address<span>*</span></label>
                                         <input type="text" name="address" id="address" placeholder="Enter your Address" value="{{$arr_personal_info['address'] or ''}}" data-rule-required="true"  data-rule-maxlength="550">
                                         <span class="error-smg">{{$errors->first('address')}}</span>
                                     </div>
                                 </div>
                                 
                                 <div class="clearfix"></div>
                                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                      <div class="button-section-user-aacount">
                                          <div class="left-cancle-buton">
                                             <a class="button-shop" href="{{url('/')}}/user/dashboard"><span>Cancel</span></a>
                                          </div>
                                          <div class="fullfil-button">
                                              <button type="submit" name="btn_save_personal_details" id="btn_save_personal_details" class="button-shop"><span>Save</span></button>
                                          </div>
                                      </div>
                                </div>
                            </div>
                        </form>
                      </div>

                      <!--tab-2 start-->
                       <div>
                           <div class="row">
                              @if(Request::segment(3) == 2)
                                @include('front.layout._operation_status')
                              @endif
                              <form id="frm_change_password" name="frm_change_password" action="{{url($user_panel_slug.'/my_account/password/update/'.base64_encode($arr_personal_info['id']))}}" method="post">
                                  {{csrf_field()}}
                                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                     <div class="box-form">
                                         <label for="old_password">Old Password<span>*</span></label>
                                         <input id="old_password" name="old_password" placeholder="Enter your Old Password" type="password" data-rule-required="true" data-rule-minlength="6" data-rule-maxlength="16" data-rule-pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^])(?=.*\d).*" data-msg-pattern="Password must contain at least (1) lowercase, (1) uppercase, (1) special character, (1) letter."/>
                                         <span class="error-smg">{{$errors->first('old_password')}}</span>
                                     </div>
                                 </div>
                                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                     <div class="box-form">
                                         <label for="new_password">New Password<span>*</span></label>
                                         <input id="new_password" name="new_password" placeholder="Enter your New Password" type="password" data-rule-required="true" data-rule-minlength="6" data-rule-maxlength="16" data-rule-pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^])(?=.*\d).*" data-msg-pattern="Password must contain at least (1) lowercase, (1) uppercase, (1) special character, (1) letter." />
                                          <span class="error-smg">{{$errors->first('new_password')}}</span>
                                     </div>
                                 </div>
                                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                     <div class="box-form">
                                         <label for="confirm_password">Confirm Password<span>*</span></label>
                                         <input id="confirm_password" name="confirm_password" placeholder="Enter your New Password" type="password"  data-rule-required="true" data-rule-equalto="#new_password" data-rule-maxlength="16" data-rule-pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^])(?=.*\d).*" data-msg-pattern="Password must contain at least (1) lowercase, (1) uppercase, (1) special character, (1) letter." />
                                         <span class="error-smg">{{$errors->first('confirm_password')}}</span>
                                     </div>
                                 </div>
                                 <div class="clearfix"></div>
                                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                     <div class="button-section-user-aacount">
                                         <div class="fullfil-button">
                                             <button type="submit" class="button-shop"><span>Submit</span></button>
                                         </div>
                                     </div>
                                 </div>
                             </form>
                            </div>
                       </div>

                      <!--tab-3 start-->
                       <div>
                          <div class="row">
                              @if(Request::segment(3) == 3)
                                @include('front.layout._operation_status')
                              @endif
                              <form id="frm_bank_details" name="frm_bank_details"  action="{{url($user_panel_slug.'/my_account/bank_details/update/'.base64_encode($arr_personal_info['id']))}}" method="post">
                                 {{csrf_field()}}
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                     <div class="box-form">
                                         <label for="bank_name">Bank Name<span>*</span></label>
                                         <input name="bank_name" id="bank_name" placeholder="Enter your Bank Name" type="text" data-rule-required="true" data-rule-maxlength="250" value="{{$arr_bank_account_details['bank_name'] or ''}}" />
                                        <span class="error-smg">{{$errors->first('bank_name')}}</span>
                                     </div>
                                 </div>
                                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                     <div class="box-form">
                                         <label for="account_no">Account Number<span>*</span></label>
                                         <input name="account_no" id="account_no" placeholder="Enter your Account Number" type="text" data-rule-required="true" data-msg-number="Please enter valid account number." data-rule-minlength="6" data-rule-maxlength="20" data-msg-minlength="Account number should be atleast 6 digits." data-msg-maxlength="Account number should not be more than 20 digits."  value="{{$arr_bank_account_details['account_number'] or ''}}" data-rule-number='true'  />
                                         <span class="error-smg">{{$errors->first('account_no')}}</span>
                                     </div>
                                 </div>
                                   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                     <div class="box-form">
                                         <label for="account_holder_name">Account Holder Name<span>*</span></label>
                                         <input name="account_holder_name" id="account_holder_name" placeholder="Enter Account Holder Name" type="text" data-rule-required="true" data-rule-maxlength="250" value="{{$arr_bank_account_details['account_holder_name'] or ''}}" />
                                         <span class="error-smg">{{$errors->first('account_holder_name')}}</span>
                                     </div>
                                 </div>
                                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                     <div class="box-form">
                                         <label for="ifsc_code">IFSC Code<span>*</span></label>
                                         <input name="ifsc_code" id="ifsc_code" placeholder="Enter your IFSC Code" type="text" data-rule-required="true" data-rule-pattern="^[a-zA-Z\d]+$" data-rule-minlength="6" data-rule-maxlength="16" value="{{$arr_bank_account_details['ifsc_code'] or ''}}"/>
                                          <span class="error-smg">{{$errors->first('ifsc_code')}}</span>
                                     </div>
                                 </div>
                                 <div class="clearfix"></div>
                                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                     <div class="button-section-user-aacount">
                                         <div class="fullfil-button">
                                                <button type="submit" name="btn_save_bank_details" id="btn_save_bank_details" class="button-shop"><span>Submit</span></button>
                                         </div>
                                     </div>
                                 </div>
                              </form>
                          </div>
                       </div>
                       <!--tab-3 end-->
                  </div>
                </div>
             </div>
          </div>
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyCccvQtzVx4aAt05YnfzJDSWEzPiVnNVsY&libraries=places"></script>

  <script src="{{ url('/') }}/web_supplier/assets/js/pages/jquery.geocomplete.js"></script>

<script>
  $(document).ready(function(){

      $(document).ready(function(){
      $("#address").geocomplete();
    });

      tab_index = "{{$tab_id or ''}}";
      if(tab_index != '')
      {
        tab_index = tab_index - 1;
        
        $("ul.resp-tabs-list > li").removeClass("resp-tab-active"); 
        $("div.resp-tabs-container > h2").removeClass("resp-tab-active");
        $("div.resp-tabs-container > div").removeClass("resp-tab-content-active");
        $("div.resp-tabs-container > div").hide(); 

        $('ul.resp-tabs-list > li[aria-controls="tab_item-'+tab_index+'"]').addClass("resp-tab-active"); 
        $('div.resp-tabs-container > h2[aria-controls="tab_item-'+tab_index+'"]').addClass("resp-tab-active"); 
        $('div.resp-tabs-container > div[aria-labelledby="tab_item-'+tab_index+'"]').addClass("resp-tab-content-active");
        $('div.resp-tabs-container > div[aria-labelledby="tab_item-'+tab_index+'"]').show();
      }

      $('#frm_personal_details').validate({
        ignore: [],
        errorClass: "error-smg",
        errorElement: "span",
        highlight: function(element) { },
        rules: {
          
        },
        errorPlacement: function(error, element) 
        { 
          var name = $(element).attr("name");
          if(name ==="gender")
          {
            error.insertAfter('.err_gender');
          }
          else
          {
            error.insertAfter(element);
          }

        } 
      });

      $('#frm_change_password').validate({
        ignore: [],
        errorClass: "error-smg",
        errorElement: "span",
        highlight: function(element) { },
        rules: {
          
        }
      });

      $('#frm_bank_details').validate({
        ignore: [],
        errorClass: "error-smg",
        errorElement: "span",
        highlight: function(element) { },
      });

  });

$(function() {
    setTimeout(function() {
        $(".alert").fadeOut();
    }, 3000);
});

$(document).on("change",".file-upload", function()
  {        
    var file=this.files;
    validateImage(this.files, 250,250,'profile-image');
});

$('#frm_bank_details').on('submit',function()
  { 
      var form = $('#frm_bank_details');
      if(form.valid())
      {
          showProcessingOverlay();
          return true;
      }
  });

$('#frm_change_password').on('submit',function()
  { 
      var form = $('#frm_change_password');
      if(form.valid())
      {
          showProcessingOverlay();
          return true;
      }
  });

</script>

@endsection