@extends('front.layout.master')
@section('main_content')

<div class="min-hieght-class">
	<div class="container">
		<div class="row">
			
			<div class="col-sm-9 col-md-9 col-lg-9">
				

				@if(isset($arr_blog['data']) && !empty($arr_blog['data']) && is_array($arr_blog['data']))
					
					@foreach($arr_blog['data'] as $blog)

					@php
						$comment_data = isset($blog['comment_details']) ? $blog['comment_details'] : '';
					@endphp

					<div class="blog-main-list">
						<div class="blog-img-box">
							@if(isset($blog['blog_image']) && !empty($blog['blog_image']) && 	file_exists($blog_image_base_path.$blog['blog_image']))
							
							@php $blog_img_src = get_resized_image($blog['blog_image'],$blog_image_base_path, 246, 790) @endphp
							
							@else
								@php $blog_img_src = ''; @endphp
							@endif
							<img src="{{$blog_img_src or ''}}" alt="blog" />
							
							<div class="blog-txt-box">
								<div class="blog-date">
									{{isset($blog['created_at']) ? date('d',strtotime($blog['created_at'])) : ''}}
									<span>
										{{isset($blog['created_at']) ? date('M',strtotime($blog['created_at'])) : ''}}
									</span>
								</div>
							</div>
							<!-- <div class="view-blog"><span class="eye-icns-b"></span> {{isset($blog['no_of_views']) ? $blog['no_of_views'] : ''}} <span>|</span></div> -->
							<div class="view-blog"><span class="chat-icns-b"></span> {{ count($comment_data) }} <span>|</span></div>
							<div class="view-blog by-admin">Post <span><a href="javascript:void(0)" class="byadmins">By Admin</a></span></div>
						</div>
						<div class="blog-title"><a href="{{$module_url_path.'/'.$blog['slug']}}">{{$blog['title'] or ''}}</a></div>
						<div class="blog-discrip">
							@if(isset($blog['description']) && !empty($blog['description']))

							@php
								$desc = strip_tags($blog['description']); 

								$desc = trim(preg_replace('/\s\s+/', ' ', $desc));

								$short_desc = mb_strimwidth($desc, 0, 200); 
							@endphp

							{!! html_entity_decode($short_desc, ENT_QUOTES, 'UTF-8') !!}
							
							@php
								echo mb_strlen($blog['description']) > 200 ? '...<a href="'.$module_url_path.'/'.$blog['slug'].'">read more</a>' : '';
							@endphp 

							@endif
						</div>
					</div>
					@endforeach

					@if(isset($arr_pagination) && $arr_pagination != null)
                        @include('front.common.pagination')
                    @endif
                            
				@else
					<div class="blog-main-list">
						<div class="blog-img-box">
							<div class="blog-title"><a href="{{$module_url_path}}">Sorry! No result found</a></div>
						</div>
					</div>

				@endif

			</div>

			@include('front.blog.rightbar')

		</div>
	</div>
</div>

<div class="clearfix"></div>

@endsection