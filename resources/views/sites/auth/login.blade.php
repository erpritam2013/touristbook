@extends('sites.layouts.main')

@section('content')
    <section class="login-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="login-box">

                        {{-- <div class="login-top">
                            <h3>Login Here</h3>
                            <p>&nbsp;</p>
                        </div> --}}
                        <form class="login-form" action="{{ route('login-post') }}" method="post">
                            @csrf
                           @if(request()->has('redirect_to'))
                           <input type="hidden" name="redirect_to" value="{{request()->get('redirect_to')}}">
                           @endif
                            <div class="row">
                                <div class="col-md-12 email">
                                    <label>Email</label>
                                    <input type="text" name="email" placeholder="Enter your email here" />
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-12 password">
                                    <label>Password</label>
                                    <input type="password" name="password" placeholder="Enter password" />
                                    @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-12 d-flex justify-content-between">
                                    <div class="chqbox">
                                        <input type="checkbox" name="rememberme" id="rmme" />
                                        <label for="rmme">Remember Me</label>
                                    </div>
                                    <div class="forget-btn">
                                        <a href="#">Forget Password?</a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" name="button">Sign In</button>
                                </div>
                            </div>
                        </form>
                        {{-- <div class="login-btm text-center">
                            <p>or sign in with</p>
                            <ul class="list-unstyled list-inline">
                                <li class="list-inline-item">
                                    <a href="#"><i class="fab fa-google"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><i class="fab fa-facebook"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                </li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
