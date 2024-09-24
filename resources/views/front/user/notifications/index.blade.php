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
          @include('front.layout._operation_status')
          @php 
          $notification_class = '';@endphp
          @if(isset($arr_notification['data']) && !empty($arr_notification['data']) && is_array($arr_notification['data']))
            @foreach($arr_notification['data'] as $val)
            @if(isset($val['type']))
              @if($val['type'] == '1')
                @php $notification_class = 'colorpendding' @endphp
              @elseif($val['type'] == '2')
                @php $notification_class = 'colorsuccess' @endphp
              @elseif($val['type'] == '3')                
                @php $notification_class = 'colorsuccess'@endphp
              @elseif($val['type'] == '4')                
                @php $notification_class = 'colorclose'@endphp
              @else
                @php $notification_class = ''@endphp
              @endif
            @else
                @php $notification_class = ''@endphp
            @endif
            
            <div class="notification-box">
             <div class="notification-box-left {{$notification_class or ''}}"></div>
             <div class="notification-box-right">
                 <a href="{{$val['notification_url'] or ''}}">{!!$val['notification_message'] or 'NA'!!}</a>
             </div>
             <div class="closes-icon-blo"><a class="closes-addres remove_notification" id="{{base64_encode($val['id']) }}" href="{{$module_url_path.'/delete/'.base64_encode($val['id'])}}" onclick='return confirm_action(this,event,"Do you really want to delete this notification?")'></a> </div>
             <div class="clearfix"></div>
           </div>
           @endforeach
         @else 
            <div class="col-lg-12 text-center">
              <h4>No notification found.</h4>
            </div>
         @endif

         @include('front.common.pagination')
         
       </div>
     </div>
   </div>
 </div>

 <script>

  function confirm_action(ref,evt,msg)
  {
   var msg = msg || false;

   evt.preventDefault();  
   swal({
    title: "Are you sure ?",
    text: msg,
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Yes",
    cancelButtonText: "No",
    closeOnConfirm: false,
    closeOnCancel: true
  },
  function(isConfirm)
  {
    if(isConfirm==true)
    {
        window.location = $(ref).attr('href');
    }
  });
 }

</script>

@endsection