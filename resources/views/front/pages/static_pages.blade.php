@extends('front.layout.master')                
@section('main_content')




<!--Header section end here-->
<div class="bradcrum-inner">
    <div class="pul-left-title">
        {{$arr_page['page_title'] or 'Demo Page'}}
    </div>
    <div class="pul-right-sublink">
        <a href="{{ url('/') }}">Home</a> / <span>{{$arr_page['page_title'] or 'Demo Page'}}</span>
    </div>
    <div class="clearfix"></div>
</div>
{!!$arr_page['page_description'] or ''!!}
@endsection