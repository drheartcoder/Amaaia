 @if(Session::has('success'))
 <div class="alert alert-success alert-dismissible">
  <a href="#" class="close close-btn1" data-dismiss="alert" aria-label="close">&times;</a>
  {{ Session::get('success') }}
</div>
@endif  

@if(Session::has('error'))
<div class="alert alert-danger alert-dismissible">
 <a href="#" class="close close-btn1" data-dismiss="alert" aria-label="close">&times;</a>
 {{ Session::get('error') }}
</div>
@endif


@if(Session::has('success_password'))
<div class="alert alert-success alert-dismissible">
 <a href="#" class="close close-btn" data-dismiss="alert" aria-label="close">&times;</a>
 {{ Session::get('success_password') }}
</div>
@endif  

@if(Session::has('error_password'))
<div class="alert alert-danger alert-dismissible">
  <a href="#" class="close close-btn" data-dismiss="alert" aria-label="close">&times;</a>
  {{ Session::get('error_password') }}
</div>
@endif
<style type="text/css">
  .close-btn
  {
    padding: 10px!important;
  }

  .close-btn1
  {
    padding-top: 2px;
    padding-right: 10px;
  }

</style>
