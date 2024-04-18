@extends('sites.layouts.main')

@section('content')
<section class="registration">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="registration-box">
                    <div class="reg-top">
                        <h3>Create An Account.</h3>
                    </div>
                    <form class="reg-form" action="{{ route('register-post') }}" method="post">
                        @csrf
                          @if(request()->has('redirect_to'))
                           <input type="hidden" name="redirect_to" value="{{request()->get('redirect_to')}}">
                           @endif
                        <div class="row">
                            <div class="col-md-12 name">
                                <label>Full Name</label>
                                <input type="text" name="name" placeholder="Enter your Full Name here">
                                {!! get_form_error_msg($errors, 'name') !!}
                            </div>
                            {{--<div class="col-md-6 srname">
                                <label>Surname</label>
                                <input type="text" name="srname" placeholder="Enter Surname here">
                            </div>--}}
                            <div class="col-md-12 email">
                                <label>Email</label>
                                <input type="email" name="email" placeholder="Enter Email here">
                                {!! get_form_error_msg($errors, 'email') !!}
                            </div>
                            <div class="col-md-12 password">
                                <label>Password</label>
                                <input type="password" name="password" placeholder="Enter your password here" id="rg-password"><br>
                                {!! get_form_error_msg($errors, 'password') !!}
                            </div>
                           <div class="col-md-12 chqbox chqbox-show-hide-password">
                                <input type="checkbox" onclick="ShowHidePassword()" id="show-hide-password">
                                <label for="show-hide-password">Show Password</label>
                            </div>
                           {{--<div class="col-md-12 chqbox">
                                <input type="checkbox" name="terms" id="rc-email">
                                <label for="rc-email">Yes, I want to receive emails.</label>
                            </div>--}}
                            <div class="col-md-12 chqbox chqbox2">
                                <input type="checkbox" name="terms_condition" id="term">
                                <label for="term">I have read &amp; agree with <span><a href="{{route('term-conditions')}}">Terms &amp; Conditions</a></span>.</label>
                                {!! get_form_error_msg($errors, 'terms_condition') !!}
                            </div>
                            <div class="col-md-12">
                                <button type="submit" name="button">Create Account</button>
                            </div>
                        </div>
                    </form>
                    <div class="login-btm text-center">
                        <p>Already have an account ?<a href="{{route('login')}}">Sign in</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
