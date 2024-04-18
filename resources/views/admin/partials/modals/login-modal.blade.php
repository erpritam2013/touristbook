<div class="modal fade" id="login-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Login</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <section class="login-area">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="login-box">

                {{-- <div class="login-top">
                  <h3>Login Here</h3>
                  <p>&nbsp;</p>
                </div> --}}
                <form class="ajax-login-form" action="{{ route('login-post') }}" method="post" id="ajax-login-form" >
                 
                      <input type="hidden" name="ajax" value="true">
                 
                  <div class="row form-row">
                    <div class="form-group col-md-12 email">
                      <label>Email</label>
                      <input type="text" name="email" placeholder="Enter your email here" class="form-control" />
                      @error('email')
                      <p class="text-danger">{{ $message }}</p>
                      @enderror
                    </div>
                    <div class="form-group col-md-12 password">
                      <label>Password</label>
                      <input type="password" name="password" placeholder="Enter password" class="form-control" />
                      @error('password')
                      <p class="text-danger">{{ $message }}</p>
                      @enderror
                    </div>
                    <div class="form-group col-md-6">
                      <div class="form-check">
                        <input type="checkbox" name="rememberme" id="rmme" class="form-check-input" />
                        <label for="rmme" class="form-check-label">Remember Me</label>
                      </div>
                      </div>
                      <div class="form-group col-md-6">
                      <div class="forget-btn">
                        <a href="#">Forget Password?</a>
                      </div>
                    </div>
                    
                    <div class="form-group col-md-12">
                      <button type="submit" name="button" class="btn btn-primary">Sign In</button>
                    </div>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    
  </div>
</div>
</div>