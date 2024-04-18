@extends('admin.layouts.main')
@section('title','Profile')
@section('admin_head_css')
@parent
@endsection
@section('content')

<div class="container-fluid">

	@include('admin.layout-parts.breadcrumbs')
	<!-- row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="profile">
				<div class="profile-head">
					<div class="photo-content">
						<div class="cover-photo"></div>
						<div class="profile-photo">
							@php 
							if(isJson($user->image)){
								$user->image = json_decode($user->image,true);
							}
							$profile_image = (!empty($user->image) && isset($user->image[0]['id']))?getConversionUrl($user->image[0]['id']):null;@endphp
							<img src="{{$profile_image ?? asset('admin-part/images/profile/dummy-user.jpeg')}}" class="img-fluid rounded-circle" alt="">
						</div>
					</div>
					<div class="profile-info">
						<div class="row justify-content-center">
							<div class="col-xl-8">
								<div class="row">
									<div class="col-xl-4 col-sm-4 border-right-1 prf-col">
										<div class="profile-name">
											<h4 class="text-primary">{{ucwords($user->name)}}</h4>
										</div>
									</div>
									<div class="col-xl-4 col-sm-4 border-right-1 prf-col">
										<div class="profile-email">
											<h4 class="text-muted">{{$user->email}}</h4>
											<p><a href="{{route('admin.users.edit',$user->id)}}" class="btn btn-info"><i class="fa fa-file"></i> Edit</a></p>
										</div>
                                        
									</div>
                                                <!-- <div class="col-xl-4 col-sm-4 prf-col">
                                                    <div class="profile-call">
                                                        <h4 class="text-muted">(+1) 321-837-1030</h4>
                                                        <p>Phone No.</p>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endsection