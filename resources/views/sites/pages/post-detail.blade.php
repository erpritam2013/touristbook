@extends('sites.layouts.main')
@section('title',$title)
@section('content')
@if(auth()->check())
@if(auth()->user()->isAdmin() || auth()->user()->isEditor())
@section('get_a_link')
@if(!isMobileDevice())
@php 
$top = 'top:32px;position:relative;';
@endphp
@endif
{!!get_a_link($title,route('admin.posts.edit',$post->id ?? ''))!!}
@endsection
@endif 
@endif

<section class="Blog-list pt80 pb80 blog-single-section listingDetails" style="{{$top ??''}}">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-12 col-xs-12">
				<div class="blog-content">
					<div class="post format-standard-image">
						@php $featured_image = (!empty($post->featured_image) && isset($post->featured_image[0]['id']))?getConversionUrl($post->featured_image[0]['id']):null;@endphp              
						<div class="entry-media"> <img src="{{$featured_image ?? asset('sites/images/dummy/1350x500.jpg')}}"></div>
						<ul class="entry-meta">
							<li><a href="#"><i class="far fa-clock"></i>{{date('M d,Y',strtotime($post->created_at))}}</a></li>
							{{--<li><a href="#"><i class="fas fa-funnel-dollar"></i>Consulting</a></li>--}}
							<li><a class="nav-link-review" href="#reviews-tab"><i class="fas fa-comments"></i>{{count($comments) ?? 0}}</a></li>
						</ul>
						<h2 class="post-title">{{purify_string($post->name)}}</h2>
						<div class="post-content">
							{!!$post->description!!}
						</div>
					</div>

					<div class="tag-share">
						<div class="tag"> Tags: &nbsp;
							<ul>

								@if($post->tags->isNotEmpty())
								@foreach($post->tags as $tag)

								<li><a href="{{ URL::route('tag-blogs', ['term' => 'tag','tag'=>$tag->slug])}}">{{$tag->name}},</a></li>

								@endforeach
								@endif
							</ul>
						</div>
						<div class="share"> Share: &nbsp;
							<ul>
								<li><a target="_Blank" href="https://www.facebook.com/sharer/sharer.php?u={{route('blog',$post->slug)}}&title={{$post->name}}"><i class="fab fa-facebook-f"></i></a></li>
								<li><a target="_Blank" href="https://twitter.com/share?url={{route('blog',$post->slug)}}&title={{$post->name}}"><i class="fab fa-twitter"></i></a></li>
								<li><a target="_Blank" href="https://plus.google.com/share?url={{route('blog',$post->slug)}}&title={{$post->name}}"><i class="fab fa-google-plus-g"></i></a></li>

								<li><a target="_Blank" href="https://www.linkedin.com/shareArticle?mini=true&url={{route('blog',$post->slug)}}&title={{$post->name}}"><i class="fab fa-linkedin-in"></i></a></li>
								{{--<li><a target="_Blank" href="http://www.instagram.com/"><i class="fab fa-instagram"></i></a></li>--}}
							</ul>
						</div>
					</div>
					<!-- end tag-share -->
					{{--@if($post->auther()->exists())

					<div class="author-box">
						<div class="author-avatar"> <a href="#" target="_blank"><img src="{{asset('/sites/images/dummy-user.jpeg')}}" alt="" width="50"></a> </div>
						<div class="author-content"> <a href="#" class="author-name">{{$post->auther->name}}</a>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
							<div class="socials">
								<ul class="social-link">
									<li><a href="#"><i class="ti-facebook"></i></a></li>
									<li><a href="#"><i class="ti-twitter-alt"></i></a></li>
									<li><a href="#"><i class="ti-linkedin"></i></a></li>
									<li><a href="#"><i class="ti-instagram"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
					@endif--}}
					<!-- end author-box -->


					<div class="more-posts">
						<div class="previous-post"> 
							<a href="{{route('blog',$previous ?? '#')}}" class="{{(empty($previous))?'disabled-link':''}}"> <span class="post-control-link"><i class="ti-arrow-circle-left"> </i>Previous post</span> </a> 
						</div>
						<div class="next-post">
							<a href="{{route('blog',$next ?? '#')}}" class="{{(empty($next))?'disabled-link':''}}"> <span class="post-control-link">Next post <i class="ti-arrow-circle-right"></i></span> </a>
						</div>
					</div>
					<!-- end more-posts -->
					<div class="tab-pane" id="reviews-tab">
						<div class="map-content-loading">
							<div class="st-loader"></div>
						</div>
						<div class="text-block">
							<p class="st-heading-section">Comments </p>
							<h5 class="mb-4 st-heading-section-short">Listing Comments </h5>
							<div id="reviews-list">
								@php 
								$comment_count = 0;
								@endphp
								@if($comments->isNotEmpty())
								@foreach($comments as $comment)
								<div class="media d-block d-sm-flex review">

									<div class="media-body">
										<h6 class="mt-2 mb-1 comment-author">{{ucwords($comment->name ?? $comment->user->name)}}</h6>
										<div class="mb-2">
											@if(!empty($comment->star_rating))
											@endif
										</div>

										<p class="text-muted text-sm">{!!$comment->comments!!}</p>
									</div>
								</div>
								@endforeach
								@php 
								$comment_count = count($comments);
								@endphp
								@endif

							</div>
							@if($comment_count > 5)
							<div class="load-more-btn mt-3 mb-3">

								<button id="load_more_button" data-page="{{ $comments->currentPage() + 1 }}"
									class="btn btn-grad" data-model_id="{{$post->id}}" data-model_type="Post">Load More</button>
								</div>
								@endif
								<div class="review_section">
									<div id="leaveReview" class="mt-4 collapse show" style="">
										<h5 class="mb-4">Leave a comment</h5>
										@if(auth()->check())
										<form id="comment-form" method="post" action="{{route('review-store')}}" class="form">
											<input type="hidden" name="model_id" value="{{$post->id}}">
											<input type="hidden" name="model_type" value="Post">
											<input type="hidden" name="comment_ip" value="{{$_SERVER['REMOTE_ADDR']}}">
											<input type="hidden" name="comment_agent" value="{{$_SERVER['HTTP_USER_AGENT']}}">
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<input type="text" name="name" id="name" placeholder="Enter your name" required class="form-control">
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<select name="rating" id="rating" class="custom-select focus-shadow-0">
															<option value="5">★★★★★ (5/5)</option>
															<option value="4">★★★★☆ (4/5)</option>
															<option value="3">★★★☆☆ (3/5)</option>
															<option value="2">★★☆☆☆ (2/5)</option>
															<option value="1">★☆☆☆☆ (1/5)</option>
														</select>
													</div>
												</div>
											</div>
											<div class="form-group">
												<input type="email" name="email" id="email" placeholder="Enter your  email" required class="form-control">
											</div>
											<div class="form-group">
												<textarea rows="4" name="review" id="review" placeholder="Enter your comment" required class="form-control"></textarea>
											</div>
											<button type="submit" class="btn btn-grad review-btn">Submit Comment</button>
										</form>
										@else

										<div class="login-btn">

											<div class="row">
												<div class="col-lg-6"><a href="{{route('login')}}?redirect_to={{route('blog',$post->slug)}}" class="btn btn-grad w-50">LogIn</a></div>
												<div class="col-lg-6"><a href="{{route('register')}}?redirect_to={{route('blog',$post->slug)}}" class="btn btn-grad w-50 ">Sign Up</a></div>
											</div>
										</div>

										@endif
									</div>
								</div>
							</div>
						</div>
						<!-- end comments-area --> 
					</div>
				</div>
				<div class="col-lg-4 col-md-12 col-xs-12">
					<div class="blog-sidebar">
						<div class="widget search-widget">
							<h3>Search</h3>
							<form action="{{route('blogs')}}" method="get">
								<div class="border">
									@php
									$sourceType = "";
									if(isset($_GET['source_type'])){
										$sourceType = $_GET['source_type'];
									}
									@endphp
									<input type="text" class="form-control" name="source_type" value="{{$sourceType}}" placeholder="Search Post..">
									<button type="submit"><i class="fa fa-search"></i></button>
								</div>
							</form>
						</div>
						<div class="widget category-widget">
							<h3>Categories</h3>

							<ul>
								@if($post->categories->isNotEmpty())
								@foreach($post->categories as $p_category)

								<li><a href="{{URL::route('category-blogs', ['term' => 'category','category'=>$p_category->slug])}}">{{$p_category->name}} <span>({{$p_category->posts()->count()}})</span></a></li>
								@endforeach
								@endif
							</ul>
						</div>
						<div class="widget recent-post-widget">
							<h3>Recent post</h3>
							<div class="posts">
								@if($related_posts->isNotEmpty())
								@foreach($related_posts as $r_post)
								<div class="post">

									@php $r_post_featured_image = (!empty($r_post->featured_image) && isset($r_post->featured_image[0]['id']))?getConversionUrl($r_post->featured_image[0]['id'],'thumbnail'):null;@endphp 
									<div class="img-holder"> <img src="{{$r_post_featured_image ?? asset('sites/images/dummy/100x100.jpg')}}" alt=""> </div>
									<div class="details">
										<h4><a href="{{route('blog',$r_post->slug)}}">{{$r_post->name}}</a></h4>
										<span class="date">{{date('M d Y',strtotime($r_post->created_at))}}</span> </div>
									</div>
									@endforeach
									@endif
								</div>
							</div>
							<div class="widget tag-widget">
								<h3>Tags</h3>
								<ul>
									@if($related_tags->isNotEmpty())
									@foreach($related_tags as $r_tag)
									<li><a href="{{ URL::route('tag-blogs', ['term' => 'tag','tag'=>$r_tag->slug])}}">{{$r_tag->name}}</a></li>
									@endforeach
									@endif

								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		@endsection
