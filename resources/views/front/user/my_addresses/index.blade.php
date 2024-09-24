@extends('front.layout.master')   
@section('main_content')

<!-- Page breadcrumb -->  
@include('front.user.layout.breadcrumb')
<!-- /page breadcrumb -->

<div class="inner-page-main min-hieght-class usergiftmain">
  <div class="container">           

    <div class="row">
     <div id="left-bar">
      @include('front.user.layout.sidebar')
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
      <div class="cart-login">
        @include('front.layout._operation_status')
        <form id="form-add-address" method="post" action="{{$module_url_path}}/store">
          {{csrf_field()}}
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="title-logins-accounts">Address Details</div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box-form">
              <label for="flatnumber">Flat No.</label>
              <input id="flatnumber" name="flatnumber" data-rule-maxlength="10" placeholder="Enter your flat no." type="text" data-rule-required='true' />
              <div class="error-smg">{{$errors->first('flatnumber')}}</div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box-form">
              <label for="buildingname">Building Name</label>
              <input id="buildingname" name="buildingname" data-rule-maxlength="60" placeholder="Enter your Building name" type="text" data-rule-required='true' />
              <div class="error-smg">{{$errors->first('buildingname')}}</div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box-form">
              <label for="address">Address</label>
              <textarea name="address" id="autocomplete" data-rule-maxlength="250" placeholder="Enter your Address" data-rule-required='true'></textarea>
              <div class="error-smg">{{$errors->first('address')}}</div>
            </div>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
           
           <div class="box-form">
            <label for="city">City</label>
            <input id="locality" name="city" placeholder="Enter your City" data-rule-maxlength="60" type="text" data-rule-required='true'  />
            <div class="error-smg">{{$errors->first('city')}}</div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
          <div class="box-form">
            <label for="postcode">Post Code</label>
            <input id="postal_code" name="postcode" data-rule-maxlength="8" data-msg-maxlength="Post code should not be more than 8 digits." data-rule-minlength="6" data-msg-minlength="Post code should be atleast 6 or more than 6 digits." placeholder="Enter your Post code" type="text" data-rule-required='true'  />
            <div class="error-smg">{{$errors->first('postcode')}}</div>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
          <div class="box-form">
            <label for="state">State/Province</label>
            <input id="administrative_area_level_1" name="state" placeholder="Enter your State/Province" type="text" data-rule-required='true' data-rule-maxlength="60" />
            <div class="error-smg">{{$errors->first('state')}}</div>
          </div>
          
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
         <div class="box-form">
          <label for="country">Country</label>
          <input id="country" name="country" placeholder="Enter your Country" type="text" data-rule-required='true' data-rule-maxlength="60" />
          <div class="error-smg">{{$errors->first('country')}}</div>
        </div>
      </div>

      <div class="box-form login-carts none-psace mobile-btns-shop">
        <div class="full-button">
          <button type="submit" class="button-shop" name="btn_save_address" id="btn_save_address"><span>Add Address</span></a>
          </div>
        </div>
      </form>
      <div class="clearfix"></div>
      
      <div class="title-logins-accounts">
        Addresses
      </div>
      
      <div class="row">
        <form id="frm_addresses">
         @if(isset($arr_addresses) && is_array($arr_addresses) && sizeof($arr_addresses)>0)
         @foreach($arr_addresses as $key=>$address)
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
          <div class="wholsel-pro-block-bg address bookaddress">
            <div class="radio-btns mrgin">
              <div class="radio-btn  no-mar">
                <input type="radio" class="default_address" data-default-id="{{base64_encode($address['id'])}}" id="{{$key.'add'}}-option" name="selector" {{isset($address['default_address']) && $address['default_address'] == '2' ? 'checked' : ''}} />
                <label for="{{$key.'add'}}-option">{{$arr_user['first_name'] or ''}} {{$arr_user['last_name'] or ''}}</label>
                <div class="check"></div>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="address-text">{{isset($address['flat_no']) ? $address['flat_no'].', ' : ''}}{{isset($address['building_name']) ? $address['building_name'].', ' : ''}}{{isset($address['address']) ? $address['address'].', ' : ''}}{{isset($address['city']) ? $address['city'].', ' : ''}}{{isset($address['state']) ? $address['state'].', ' : ''}}{{isset($address['country']) ? $address['country'].', ' : ''}}{{isset($address['post_code']) ? $address['post_code'] : ''}}</div>
            <div class="edit-icon-blo">

              <a class="edit-addres" href="javascript:void(0)">
                <input type="hidden" class="hidden_address_id" value="{{isset($address['id']) ? base64_encode($address['id']) : '' }}">
                <input type="hidden" class="hidden_flat_no" name="hidden_flat_no" value="{{$address['flat_no'] or ''}}">
                <input type="hidden" class="hidden_building_name" name="hidden_building_name" value="{{$address['building_name'] or ''}}">
                <input type="hidden" class="hidden_address" name="hidden_address" value="{{$address['address'] or ''}}">
                <input type="hidden" class="hidden_city" name="hidden_city" value="{{$address['city'] or ''}}">
                <input type="hidden" class="hidden_state" name="hidden_state" value="{{$address['state'] or ''}}">
                <input type="hidden" class="hidden_country" name="hidden_country" value="{{$address['country'] or ''}}">
                <input type="hidden" class="hidden_post_code" name="hidden_post_code" value="{{$address['post_code'] or ''}}">
              </a>
            </div>
            <div class="closes-icon-blo"><a class="closes-addres" data-remove-id='{{isset($address['id']) ? base64_encode($address['id']) : '' }}' href="javascript:void(0)"></a> </div>
          </div>
        </div>
        @endforeach
        @else
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          No Address added yet.
        </div>
        @endif
      </form>
    </div>
  </div>
</div>
</div>

</div>
</div>

<div id="myModal" class="gift-cartmodal modal fade" role="dialog">
  <div class="modal-dialog modal-address">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"></button>
        <div class="title-modals">
          Edit Address
        </div>
      </div>
      <div class="modal-body">
        <form id="form-edit-address" method="post" action="{{$module_url_path}}/update">
          {{csrf_field()}}
          <input type="hidden" name="edit_address_id" id="edit_address_id">
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="box-form">
              <label for="edit_flatnumber">Flat No.</label>
              <input id="edit_flatnumber" name="edit_flatnumber" placeholder="Enter your flat no." type="text" data-rule-required='true' data-rule-maxlength="10" />
            </div>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="box-form">
              <label for="edit_buildingname">Building Name</label>
              <input id="edit_buildingname" name="edit_buildingname" placeholder="Enter your Building name" type="text" data-rule-required='true' data-rule-maxlength="60" />
            </div>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box-form">
              <label for="edit_address">Address</label>
              <textarea name="edit_address" id="edit_address" placeholder="Enter your Address" data-rule-required='true' data-rule-maxlength="250"></textarea>
            </div>
          </div>


          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="box-form">
              <label for="edit_city">City</label>
              <input id="edit_city" name="edit_city" placeholder="Enter your city" type="text" data-rule-required='true' data-rule-maxlength="60" />
            </div>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="box-form">
              <label for="edit_state">State</label>
              <input id="edit_state" name="edit_state" placeholder="Enter your state" type="text" data-rule-required='true' data-rule-maxlength="60" />
            </div>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="box-form">
              <label for="edit_country">Country</label>
              <input id="edit_country" id="setting_country" name="edit_country" placeholder="Enter your country" type="text" data-rule-required='true' data-rule-maxlength="60" />
            </div>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="box-form">
              <label for="edit_postcode">Post Code</label>
              <input id="edit_postcode" name="edit_postcode" placeholder="Enter your Post code" type="text" data-rule-required='true' data-rule-maxlength="8" data-msg-maxlength="Post code should not be more than 8 digits." data-rule-minlength="6" data-msg-minlength="Post code should be atleast 6 or more than 6 digits." />
            </div>
          </div>
          <div class="full-button">
            <button type="submit" id="btn_update_address" name="btn_update_address" class="button-shop btn-update"><span>Update</span></button>
          </div>
        </form>
      </div>

    </div>

  </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyCccvQtzVx4aAt05YnfzJDSWEzPiVnNVsY&libraries=places&callback=initAutocomplete"
async defer>
</script>

<script src="{{ url('/') }}/front//js/autocomplete.js"></script>
<script>
  $(document).ready(function(){


    $('#form-add-address').validate({
      errorClass: "error-smg",
      highlight: function(element) { },
      errorElement: "span"
    });

    $('#form-edit-address').validate({
      errorClass: "error-smg",
      highlight: function(element) { },
      errorElement: "span"
    });

    $('.edit-addres').click(function(){

     $($('#edit_address_id')).val($(this).find('.hidden_address_id').val());
     $($('#edit_flatnumber')).val($(this).find('.hidden_flat_no').val());
     $($('#edit_buildingname')).val($(this).find('.hidden_building_name').val());
     $($('#edit_address')).val($(this).find('.hidden_address').val());
     $($('#edit_city')).val($(this).find('.hidden_city').val());
     $($('#edit_state')).val($(this).find('.hidden_state').val());
     $($('#edit_country')).val($(this).find('.hidden_country').val());
     $($('#edit_postcode')).val($(this).find('.hidden_post_code').val());

     $("#myModal").modal({
      show: true,
      backdrop: 'static'
    });   
   });

    $('.default_address').change(function(){
      if($(this).is(':checked') == true)
      {
        $(this).attr('checked',false);
        address_id = $(this).attr('data-default-id');
        $('#frm_addresses')[0].reset();
        swal({
          title: "Are you sure ?",
          text: 'Do you really want to make it default address?',
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Proceed",
          cancelButtonText: "No",
          closeOnConfirm: false,
          closeOnCancel: true
        },
        function(isConfirm)
        {
          if(isConfirm==true)
          {
            
            window.location.href = '{{$module_url_path}}/make_default_address/'+address_id;
          }
        });
      }
    });

    $('.closes-addres').click(function(){

      address_id = $(this).attr('data-remove-id');
      swal({
        title: "Are you sure ?",
        text: 'Do you really want remove this address?',
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Proceed",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true
      },
      function(isConfirm)
      {
        if(isConfirm==true)
        {
          
          window.location.href = '{{$module_url_path}}/delete/'+address_id;
        }
      });
    });

  });

</script>

@endsection
