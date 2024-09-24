	
	@php
		$search_keyword = isset($search_keyword) ? $search_keyword : '';
	@endphp

	<div class="col-sm-3 col-md-3 col-lg-3">
		<form method="get" action="{{ url('/') }}/blog">
			<div class="search-bar">
				<input placeholder="Search" type="search" id="search" name="search" value="{{ $search_keyword }}" />
				<button class="search-arrow" id="btn_search" type="submit"></button>
			</div>
		</form>

		<div class="categories-box">
			<div class="categories-title">Categories</div>
			<div class="categories-ul-box">
				<ul>
					@if(isset($arr_blog_categories) && !empty($arr_blog_categories) && is_array($arr_blog_categories))
						@foreach($arr_blog_categories as $cat)
						<li>
							<a href="{{ url('/') }}/blog/category/{{ $cat['slug'] }}">
								<i class="fa fa-circle-o" ></i> <span>{{$cat['category_name'] or 'NA'}} ({{$cat['blogs_count'] or ''}})</span>
							</a>
						</li>
						@endforeach
					@endif
				</ul>
			</div>
		</div>
		<hr>


		@if(isset($arr_blog_recent_posts) && !empty($arr_blog_recent_posts))
			<div class="categories-title">Recent Posts</div>
			@foreach($arr_blog_recent_posts as $recent)

			@php
				$title 		= isset($recent['title']) ? $recent['title'] : '';
				$slug 		= isset($recent['slug']) ? $recent['slug'] : '';
				$blog_date  = isset($recent['created_at']) ? date('d M, Y',strtotime($recent['created_at'])) : '';

				if(isset($recent['blog_image']) && !empty($recent['blog_image']) && file_exists($blog_image_base_path.$recent['blog_image']))
				{
					$recent_blog_img_src = get_resized_image($recent['blog_image'],$blog_image_base_path, 71, 110);
					// $recent_blog_img_src = $blog_image_public_path.$recent['blog_image'];
				}
				else
				{
					$recent_blog_img_src = '';
				}
			@endphp
			<div class="recent-post-box">
				<div class="post-img">
					<img src="{{ $recent_blog_img_src }}" alt="post" />
				</div>
				<div class="post-txt-bx">
					<div class="post-name"><a href="{{ url('/') }}/blog/{{ $slug }}">{{ $title }}</a></div>
					<div class="post-date">{{ $blog_date }}</div>
				</div>
				<div class="clr"></div>
			</div>
		@endforeach
	@endif
