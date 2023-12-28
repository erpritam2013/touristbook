@extends('sites.layouts.main')
@section('title',$title)
@section('content')


<section class="Blog-list pt80 pb80 blog-single-section">
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
							<li><a href="#"><i class="fas fa-comments"></i>3</a></li>
						</ul>
						<h2>{{purify_string($post->name)}}</h2>{{purify_string($post->description)}}
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

					<div class="comments-area">
						<div class="comments-section">
							<h3 class="comments-title">Comments</h3>
							<ol class="comments">
								<li class="comment even thread-even depth-1" id="comment-1">
									<div id="div-comment-1">
										<div class="comment-theme">
											<div class="comment-image"><img src="images/img-11.jpg" alt=""></div>
										</div>
										<div class="comment-main-area">
											<div class="comment-wrapper">
												<div class="comments-meta">
													<h4>Jhon <span class="comments-date">says Oct 15, 2018 at 11:00</span></h4>
												</div>
												<div class="comment-area">
													<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
													<div class="comments-reply"> <a class="comment-reply-link" href="#"><span>Reply</span></a> </div>
												</div>
											</div>
										</div>
									</div>
									<ul class="children">
										<li class="comment">
											<div>
												<div class="comment-theme">
													<div class="comment-image"><img src="images/img-22.jpg" alt=""></div>
												</div>
												<div class="comment-main-area">
													<div class="comment-wrapper">
														<div class="comments-meta">
															<h4>Jhon <span class="comments-date">says Oct 15, 2018 at 11:00</span></h4>
														</div>
														<div class="comment-area">
															<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
															<div class="comments-reply"> <a class="comment-reply-link" href="#"><span>Reply</span></a> </div>
														</div>
													</div>
												</div>
											</div>
											<ul>
												<li class="comment">
													<div>
														<div class="comment-theme">
															<div class="comment-image"><img src="images/img-33.jpg" alt=""></div>
														</div>
														<div class="comment-main-area">
															<div class="comment-wrapper">
																<div class="comments-meta">
																	<h4>Jhon <span class="comments-date">says Oct 15, 2018 at 11:00</span></h4>
																</div>
																<div class="comment-area">
																	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
																	<div class="comments-reply"> <a class="comment-reply-link" href="#"><span>Reply</span></a> </div>
																</div>
															</div>
														</div>
													</div>
												</li>
											</ul>
										</li>
									</ul>
								</li>
								<li class="comment">
									<div>
										<div class="comment-theme">
											<div class="comment-image"><img src="images/img-11.jpg" alt=""></div>
										</div>
										<div class="comment-main-area">
											<div class="comment-wrapper">
												<div class="comments-meta">
													<h4>Jhon <span class="comments-date">says Oct 15, 2018 at 11:00</span></h4>
												</div>
												<div class="comment-area">
													<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
													<div class="comments-reply"> <a class="comment-reply-link" href="#"><span>Reply</span></a> </div>
												</div>
											</div>
										</div>
									</div>
								</li>
							</ol>
						</div>
						<!-- end comments-section -->

						<div class="comment-respond">
							<h3 class="comment-reply-title">Post Comments</h3>
							<form method="post" id="commentform" class="comment-form">
								<div class="form-textarea">
									<textarea id="comment" placeholder="Write Your Comments..."></textarea>
								</div>
								<div class="form-inputs">
									<input placeholder="Website" type="url">
									<input placeholder="Name" type="text">
									<input placeholder="Email" type="email">
								</div>
								<div class="form-submit">
									<input id="submit" value="Post Comment" type="submit">
								</div>
							</form>
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
