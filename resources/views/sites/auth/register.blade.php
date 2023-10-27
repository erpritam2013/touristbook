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

                        <div class="row">
                            <div class="col-md-6 name">
                                <label>Name</label>
                                <input type="text" name="name" placeholder="Enter your name here">
                            </div>
                            <div class="col-md-6 srname">
                                <label>Surname</label>
                                <input type="text" name="srname" placeholder="Enter Surname here">
                            </div>
                            <div class="col-md-12 email">
                                <label>Email</label>
                                <input type="text" name="email" placeholder="Enter Email here">
                            </div>
                            <div class="col-md-12 password">
                                <label>Password</label>
                                <input type="text" name="password" placeholder="Enter your password here">
                            </div>
                            <div class="col-md-12 chqbox">
                                <input type="checkbox" name="terms" id="rc-email">
                                <label for="rc-email">Yes, I want to receive emails.</label>
                            </div>
                            <div class="col-md-12 chqbox chqbox2">
                                <input type="checkbox" name="terms" id="term">
                                <label for="term">I have read &amp; agree with <span>Terms &amp; Conditions</span>.</label>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" name="button">Create Account</button>
                            </div>
                        </div>
                    </form>
                    <div class="login-btm text-center">
                        <p>Already have an account ?<a href="#">Sign in</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
