@extends('front.layout.master')   
@section('main_content')

<div class="inner-page-main min-hieght-class">

	<div class="container">
		<a href="javascript:history.go(-1)" class="backarrow"></a>
		<div class="row">
			
			<div class="col-sm-9 col-md-9 col-lg-9">
				<div class="blog-main-list details-margin">
					<div class="blog-img-box">
						@if(isset($arr_blog['blog_image']) && !empty($arr_blog['blog_image']) && file_exists($blog_image_base_path.$arr_blog['blog_image']))
						{{-- @php $blog_img_src = $blog_image_public_path.$arr_blog['blog_image']; @endphp --}}
						@php $blog_img_src = get_resized_image($arr_blog['blog_image'],$blog_image_base_path, 239, 768) @endphp @endphp
						@else
						@php $blog_img_src = ''; @endphp
						@endif
						<img src="{{$blog_img_src or ''}}" alt="blog" />
						<div class="blog-txt-box">
							<div class="blog-date">{{isset($arr_blog['created_at']) ? date('d',strtotime($arr_blog['created_at'])) : ''}}<span>{{isset($arr_blog['created_at']) ? date('M',strtotime($arr_blog['created_at'])) : ''}}</span></div>
						</div>
						<!-- <div class="view-blog"><span class="eye-icns-b"></span> {{isset($arr_blog['no_of_views']) ? $arr_blog['no_of_views'] : ''}} <span>|</span></div> -->
						<div class="view-blog"><span class="chat-icns-b"></span> {{ count($arr_blog_comment) }} <span>|</span></div>
						<div class="view-blog by-admin">Post <span><a href="javascript:void(0)" class="byadmins">By Admin</a></span></div>
					</div>
					<div class="blog-title">{{$arr_blog['title'] or ''}}</div>
					<div class="blog-discrip">
						@php
						echo isset($arr_blog['description']) ? html_entity_decode($arr_blog['description']) : ''; 
						@endphp
					</div>

				</div>

				@if(isset($arr_blog_comment) && !empty($arr_blog_comment))
					@foreach($arr_blog_comment as $comment)
						
						@php
							$firstname = isset($comment['user_details']['first_name']) ? $comment['user_details']['first_name'] : '';
							$lastname = isset($comment['user_details']['last_name']) ? $comment['user_details']['last_name'] : '';
							$comment_date = isset($comment['created_at']) ? date("h:i A - M d Y", strtotime($comment['created_at'])) : '';
							$message = isset($comment['comment']) ? $comment['comment'] : '';
						@endphp

						<div class="rating-white-block marg-top">
							<div class="review-profile-image">

								@if(isset($comment['user_details']['profile_image']) && !empty($comment['user_details']['profile_image']) && File::exists($user_profile_image_base_path.$comment['user_details']['profile_image']))
								<img src="{{$user_profile_image_public_path.$comment['user_details']['profile_image']}}" />
								@else
								<img src="{{url('/').'/uploads/supplier/default_image/default-profile.png' }}" />
								@endif
							</div>
							<div class="review-content-block">
								<div class="review-send-head">
									{{ $firstname.' '.$lastname }}
								</div>
								<div class="rating-review-stars">
									<!-- <span class="start-rate-count-blue">3.0</span>
									<span class="stars-block star-listing">
										<span><i class="fa fa-star star-acti"></i> <i class="fa fa-star star-acti"></i> <i class="fa fa-star star-acti"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></span>
									</span> -->
									<div class="time-text"> {{ $comment_date }} </div>
								</div>
								<div class="review-rating-message">
									{{ $message }}
								</div>
							</div>
						</div>
					@endforeach
				@endif

				<div class="rating-white-block marg-top text-box">
					<div class="comments-title">Comments</div>             
					
					@include('front.layout._operation_status')

					<form class="profile-page-form" id="CommentForm" name="CommentForm" method="POST" action="{{ url('/') }}/blog/comment/store">
                	{{csrf_field()}}
						<div class="profile-info-mian rting">
							{{-- <div class="box-form">
								<label for="reviewtitle">Review Title</label>
								<input id="reviewtitle" name="reviewtitle" placeholder="Enter your Review Title" type="text" data-rule-required="true" />
								<div class="error-smg">{{ $errors->first('reviewtitle') }}</div>
							</div> --}}
							<div class="box-form">
								<label for="reviewmsg">Message</label>
								<textarea name="reviewmsg" id="reviewmsg" placeholder="Write a message" data-rule-required="true"></textarea>
								<div class="error-smg">{{ $errors->first('reviewmsg') }}</div>
							</div>
						</div>

						<input id="blog_id" name="blog_id" type="hidden" value="{{ $arr_blog['id'] }}" />

						<div class="button-section-user-aacount">
							<div class="left-cancle-buton">
								<a class="button-shop" href="javascript:void(0)"><span>Cancel</span></a>
							</div>
							<div class="fullfil-button">
								@if($validate_login == 'true')
									<button type="submit" class="btn btn-primary button-shop">Send Review</button>
								@else
									<button type="button" id="check_login" class="btn btn-primary button-shop">Send Review</button>
								@endif
							</div>
						</div>

					</form>

				</div>
			</div>

			@include('front.blog.rightbar')
			
		</div>
	</div>


</div>

<div class="clearfix"></div>

<script type="text/javascript">
    $(document).ready(function(){

    	$("#check_login").click(function(){
    		swal("Warning!", "Please login first!", "error");
    	});

        jQuery('#CommentForm').validate({
            errorClass: "error-smg",
            highlight: function(element) { },
            errorElement: "div",
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