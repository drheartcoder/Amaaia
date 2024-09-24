@extends('front.layout.master')
@section('main_content')
    <div class="bradcrum-inner">
        <div class="pul-left-title">
            Collection
        </div>
        <div class="pul-right-sublink">
            <a href="{{url('/')}}">Home</a> / <span>Collection</span>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="min-hieght-class">
        <div class="ring-product-bg-pattern">
            <h1>Collection</h1>
            <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur"Lorem ipsum dolor sit amet, consectetur adipiscing elit,</p>
        </div>

        <div class="collection-listngs">
            <div class="container">
                <div class="row">
                @if(isset($arr_collection) && is_array($arr_collection) && sizeof($arr_collection))
                @foreach($arr_collection as $collection)
                {{-- {{dd($collection_image_base_path.$collection['image'])}} --}}
                    <div class="col-md-6">
                        <a href="{{url('collection/'.$collection['slug'])}}" class="list-collections"><img src="{{get_resized_image($collection['image'],$collection_image_base_path,432,570)}}" alt="" /></a>
                    </div>
                    @endforeach
                @endif
                    {{-- <div class="col-md-6">
                        <a href="javascript:void(0)" class="list-collections"><img src="{{url('/')}}/front/images/collection-landing-2.jpg" alt="" /></a>
                    </div>
                    <div class="col-md-6">
                        <a href="javascript:void(0)" class="list-collections"><img src="{{url('/')}}/front/images/collection-landing-3.jpg" alt="" /></a>
                    </div>
                    <div class="col-md-6">
                        <a href="javascript:void(0)" class="list-collections"><img src="{{url('/')}}/front/images/collection-landing-4.jpg" alt="" /></a>
                    </div>
                    <div class="col-md-6">
                        <a href="javascript:void(0)" class="list-collections"><img src="{{url('/')}}/front/images/collection-landing-5.jpg" alt="" /></a>
                    </div>
                    <div class="col-md-6">
                        <a href="javascript:void(0)" class="list-collections"><img src="{{url('/')}}/front/images/collection-landing-6.jpg" alt="" /></a>
                    </div> --}}

                </div>
            </div>
        </div>

        {{$arr_pagination->links()}}


    </div>


    <div class="clearfix"></div>
    @endsection