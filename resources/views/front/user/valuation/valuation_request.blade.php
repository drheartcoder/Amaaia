@extends('front.layout.master')   
@section('main_content')

<!-- Page breadcrumb -->  
@include('front.user.layout.breadcrumb')
<!-- /page breadcrumb -->
<style type="text/css">
  .upload-image-inner .error-smg{left: 0; right: 0px; text-align: center;}
</style>
<div class="inner-page-main min-hieght-class usergiftmain">
  <div class="container">           

    <div class="row">
      <div id="left-bar">
        
        @include('front.user.layout.sidebar')
      </div>
      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
        <form id="frm_valuation_request" name="frm_valuation_request" method="post" action="{{$module_url_path}}/proceed_request" enctype="multipart/form-data">
          {{csrf_field()}}
        <div class="cart-login">
            @include('front.layout._operation_status')
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <div class="title-logins-accounts">Valuation</div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <div class="box-form">
               <div class="upload-image-inner">
                 <div class="profile-img">
                  <div class="upload-img"></div>
                  <input type="hidden" name="prev_image_url" id="prev_image_url" value="{{url('/').'/front/images/user-account-profile.png'}}"/>
                  <input class="file-upload" type="file" onchange="readURL(this);" id="profile-image" name="product_img" data-rule-required='true' data-msg-required='Please select product image.' />
                  <div class="profile-image"><img src="{{url('/')}}/front/images/user-account-profile.png" id="upload-f" class="profile" alt=""></div>
                </div>
                   <div class="error-smg err_product_img text-center">{{$errors->first('product_img')}}</div>
              </div>
              <div class="error-smg">Note:Upload Only JPG,PNG,JPEG Images</div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="box-form datepickericon">
              <label for="datepicker">Select Appointment Date</label>
              <input id="appointment_date" name="appointment_date"  placeholder="Enter your select appointment date" type="text"  data-rule-required='true' data-msg-required='Please select appointment date.' value="{{old('appointment_date')}}" />
              <div class="datepicker-cin"><i class="fa fa-calendar"></i></div>
               <div class="error-smg">{{$errors->first('appointment_date')}}</div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="box-form">
              <label for="appointment_time">Select Appointment Time</label>
              <input id="appointment_time" class="timepicker-default" name="appointment_time"  placeholder="Enter your select appointment time" type="text" data-rule-required='true' data-msg-required='Please select appointment time.'/>
              <div class="datepicker-cin"><i class="fa fa-clock-o"></i></div>
               <div class="error-smg">{{$errors->first('appointment_time')}}</div>
            </div>
          </div>


          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box-form">
              <label for="product_description">Product Description</label>
              <textarea name="product_description" id="product_description" placeholder="Product description" data-rule-required='true' data-rule-maxlength='500' value="{{old('product_description')}}"></textarea>
               <div class="error-smg">{{$errors->first('product_description')}}</div>
            </div>
          </div>


          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box-form">
             <label for="mobilenums">Contact Number</label>
             <div class="select-style select2 udated-select inline-inputs">
              <select class="frm-select" id="phonecode" name="phonecode" data-rule-required='true' data-msg-required='Please select country code.'>
                <option value="">Select Country Code</option>
                @if(isset($arr_phonecode) && is_array($arr_phonecode) && sizeof($arr_phonecode)>0)
                @foreach($arr_phonecode as $phonecode) 
                <option value="{{$phonecode['phonecode'] or ''}}">
                  +{{$phonecode['phonecode'] or ''}} ({{$phonecode['CountryCode'] or ''}})
                </option>
                @endforeach
                @endif
              </select>
              <span class="error-smg">{{$errors->first('phonecode')}}</span>
            </div>
            <div class="user-mobile-int"> 
              <input id="mobile_number" name="mobile_number" placeholder="Enter your contact number" type="text" data-rule-required="true" data-rule-pattern="[- +()0-9]+" data-rule-minlength="7" data-rule-maxlength="16" data-msg-minlength="Mobile no should be atleast 7 numbers" data-msg-maxlength="Mobile no should not be more than 16 numbers"  />
              <span class="error-smg">{{$errors->first('mobile_number')}}</span>
            </div>
          </div>
        </div>
          </div>
          <div class="box-form login-carts none-psace mobile-btns-shop">
            <div class="left-cancle-buton">
                 <a class="button-shop" href="{{$module_url_path}}"><span>Cancel</span></a>
            </div>
            <div class="fullfil-button">
              <button type="submit" class="button-shop" href="javascript:void(0)"><span>Send Request</span></button>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      
      </form>
      </div>
</div>

</div>
</div>


<script>
    //<!--date and time picker js script-->  
     $(function() {
      $("#appointment_date").datepicker({
                changeMonth: true,
                changeYear: true,
                minDate: 1
            });
     });
</script>
 
   

 <script>  
    
//Timepicker
$( function() {    
    $('.timepicker-default').timepicker(); 
});
</script>


<script>
  $(document).ready(function(){
    $('#frm_valuation_request').validate({
      ignore: [],
      errorClass: "error-smg",
      errorElement: "span",
      highlight: function(element) { },
      rules: {

      },
       errorPlacement: function(error, element) 
        { 
          var name = $(element).attr("name");
          if(name ==="product_img")
          {
            error.insertAfter('.err_product_img');
          }
          else
          {
            error.insertAfter(element);
          }

        } 
    });
  });

  $(document).on("change",".file-upload", function()
  {        
    var file=this.files;
    validateImage(this.files, 250,250,'profile-image');
});

</script>


@endsection