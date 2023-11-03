@extends('sites.layouts.main')
@section('title',$title)
@section('content')
@include('sites.partials.banner', [
        'bannerUrl' => 'https://touristbook.s3.ap-south-1.amazonaws.com/wp-content/uploads/2023/04/Screenshot-2023-04-02-210926.jpg',
        'bannerTitle' => 'Connecting Partners',
        'bannerSubTitle' => '',
    ])
<div class="section section-padding">
            <div class="container">
                <div class="row">

                    <!--About Image Start-->
                    <div class="col-lg-6 col-12 mb-lg-0 mb-3">
                        <div class="about-image"><img src="{{asset('sites/images/about-2.jpg')}}" alt=""></div>
                    </div>
                    <!--About Image End-->

                    <!--About Content Start-->
                    <div class="col-lg-6 col-12 align-self-center mt-lg-0 mt-3">
                        <div class="about-content">

                            <div class="about-heading">
                                <h4 class="sub">We are <span class="text-primary">Tourist Book</span></h4>
                                <h2 class="title h1">Complete Financial Solutions For Your Business</h2>
                            </div>

                            <div class="desc">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean condimentum, eros eu tristique dictum, neque lorem laoreet purus, sit amet egestas magna turpis non erat. Fusce lobortis urna nec hendrerit cursus. Duis sed diam semper velit porttitor cursus ac quis lectus. Phasellus feugiat ante at diam malesuada convallis.</p>
                            </div>
                        </div>
                    </div>
                    <!--About Content End-->

                </div>
            </div>
        </div>



<div class="section section-padding pt-0">
            <div class="container">

                <!--Feature Wrapper Start-->
                <div class="feature-wrap row">

                    <!--Feature Start-->
                    <div class="feature col-lg-3 col-sm-6 col-12">
                        <div class="inner">

                            <span class="icon"><i class="fas fa-rocket"></i></span>

                            <div class="content">
                                <h4 class="title">Fast Loan Approval</h4>
                                <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean condimentum, eros eu tristique dictum</p>
                            </div>

                        </div>
                    </div>
                    <!--Feature End-->

                    <!--Feature Start-->
                    <div class="feature col-lg-3 col-sm-6 col-12">
                        <div class="inner">

                            <span class="icon"><i class="fas fa-user-friends"></i></span>

                            <div class="content">
                                <h4 class="title">Dedicated Team</h4>
                                <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean condimentum, eros eu tristique dictum</p>
                            </div>

                        </div>
                    </div>
                    <!--Feature End-->

                    <!--Feature Start-->
                    <div class="feature col-lg-3 col-sm-6 col-12">
                        <div class="inner">

                            <span class="icon"><i class="fas fa-coffee"></i></span>

                            <div class="content">
                                <h4 class="title">Refinancing</h4>
                                <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean condimentum, eros eu tristique dictum</p>
                            </div>

                        </div>
                    </div>
                    <!--Feature End-->

                    <!--Feature Start-->
                    <div class="feature col-lg-3 col-sm-6 col-12">
                        <div class="inner">

                            <span class="icon"><i class="far fa-clock"></i></span>

                            <div class="content">
                                <h4 class="title">24/7 Support</h4>
                                <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean condimentum, eros eu tristique dictum</p>
                            </div>

                        </div>
                    </div>
                    <!--Feature End-->

                </div>
                <!--Feature Wrapper End-->

            </div>
        </div>



<div class="section section-padding--sm bg-black">
            <div class="container">

                <!--Funfact Wrapper Start-->
                <div class="funfact-wrap row">

                    <!--Funfact Start-->
                    <div class="funfact col-lg-3 col-6">
                        <div class="inner">

                            <div class="icon"><i class="fab fa-accessible-icon"></i></div>
                            <div class="content">
                                <h2 class="counter plus text-white">26</h2>
                                <span class="text-white">Case Complete</span>
                            </div>

                        </div>
                    </div>
                    <!--Funfact End-->

                    <!--Funfact Start-->
                    <div class="funfact col-lg-3 col-6">
                        <div class="inner">

                            <div class="icon"><i class="far fa-angry"></i></div>
                            <div class="content">
                                <h2 class="counter plus text-white">194</h2>
                                <span class="text-white">Happy Clients</span>
                            </div>

                        </div>
                    </div>
                    <!--Funfact End-->

                    <!--Funfact Start-->
                    <div class="funfact col-lg-3 col-6">
                        <div class="inner">

                            <div class="icon"><i class="fas fa-atlas"></i></div>
                            <div class="content">
                                <h2 class="counter plus text-white">78</h2>
                                <span class="text-white">Team Member</span>
                            </div>

                        </div>
                    </div>
                    <!--Funfact End-->

                    <!--Funfact Start-->
                    <div class="funfact col-lg-3 col-6">
                        <div class="inner">

                            <div class="icon"><i class="fas fa-award"></i></div>
                            <div class="content">
                                <h2 class="counter plus text-white">24</h2>
                                <span class="text-white">Awards Win</span>
                            </div>

                        </div>
                    </div>
                    <!--Funfact End-->

                </div>
                <!--Funfact Wrapper End-->

            </div>
        </div>

<div class="section section-padding">
            <div class="container">

                <!--Section Title Start-->
                <div class="section-title text-center w-100">
                    <h2 class="title h1">Our History</h2>
                    <p class="sub mb-5">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>
                </div>
                <!--Section Title End-->

                <!--Timeline Wrapper Start-->
                <div class="timeline-wrap">

                    <!--Timeline Start-->
                    <div class="timeline row">

                        <div class="timeline-date col-lg-6 col-md-3 col-12">
                            <div class="date"><span class="h2">2019</span></div>
                        </div>

                        <div class="timeline-content col-lg-6 col-md-9 col-12">
                            <div class="content">

                                <div class="images row">
                                    <div class="col-sm-6 col-12"><img src="images/about-1.jpg" alt=""></div>
                                    <div class="col-sm-6 col-12"><img src="images/why-us.jpg" alt=""></div>
                                </div>
                                <h3 class="title">Duis aliquam hendrerit</h3>
                                <div class="desc">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis ipsam, pariatur numquam dolores, nobis quae ea, voluptatum rem aspernatur debitis ab! Quo, ex voluptas a!</p>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!--Timeline End-->

                    <!--Timeline Start-->
                    <div class="timeline row">

                        <div class="timeline-date col-lg-6 col-md-3 col-12">
                            <div class="date"><span class="h2">2015</span></div>
                        </div>

                        <div class="timeline-content col-lg-6 col-md-9 col-12">
                            <div class="content">

                                <h3 class="title">Duis aliquam hendrerit</h3>
                                <div class="desc">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis ipsam, pariatur numquam dolores, nobis quae ea, voluptatum rem aspernatur debitis ab! Quo, ex voluptas a!</p>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!--Timeline End-->

                    <!--Timeline Start-->
                    <div class="timeline row">

                        <div class="timeline-date col-lg-6 col-md-3 col-12">
                            <div class="date"><span class="h2">2012</span></div>
                        </div>

                        <div class="timeline-content col-lg-6 col-md-9 col-12">
                            <div class="content">

                                <h3 class="title">Duis aliquam hendrerit</h3>
                                <div class="desc">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis ipsam, pariatur numquam dolores, nobis quae ea, voluptatum rem aspernatur debitis ab! Quo, ex voluptas a!</p>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!--Timeline End-->

                    <!--Timeline Start-->
                    <div class="timeline row">

                        <div class="timeline-date col-lg-6 col-md-3 col-12">
                            <div class="date"><span class="h2">2011</span></div>
                        </div>

                        <div class="timeline-content col-lg-6 col-md-9 col-12">
                            <div class="content">

                                <div class="image"><img src="images/about-1.jpg" alt=""></div>
                                <h3 class="title">Duis aliquam hendrerit</h3>
                                <div class="desc">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis ipsam, pariatur numquam dolores, nobis quae ea, voluptatum rem aspernatur debitis ab! Quo, ex voluptas a!</p>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!--Timeline End-->

                </div>
                <!--Timeline Wrapper End-->

            </div>
        </div>
        
        
        
        
        
   <div class="section section-padding--sm bg-black">
            <div class="container">

                <!--CTA Content Start-->
                <div class="cta-content">
                    <h2 class="title h1 text-white">Innovative solutions to move your</h2>
                    <a href="#" class="btn btn-light-outline btn-hover-primary">Contact Us</a>
                </div>
                <!--CTA Content End-->

            </div>
        </div>  
@endsection
