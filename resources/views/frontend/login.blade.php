@extends('frontend.index')
@section('frontend')
<div class="breadcrumb">
   <div class="container">
      <div class="breadcrumb-inner">
         <ul class="list-inline list-unstyled">
            <li><a href="{{url('')}}">Home</a></li>
            <li class='active'>Login</li>
         </ul>
      </div>
      <!-- /.breadcrumb-inner -->
   </div>
   <!-- /.container -->
</div>
<!-- /.breadcrumb -->
<div class="body-content">
   <div class="container">
      <div class="sign-in-page">
         <div class="row">
            <!-- Sign-in -->   
            <div class="col-md-3 col-sm-3"></div>
            <div class="col-md-6 col-sm-6 sign-in">
               <h4 class="">Sign in</h4>
               <p class="">Hello, Welcome to your account.</p>
               <div class="social-sign-in outer-top-xs">
                  <a href="#" class="facebook-sign-in"><i class="fa fa-facebook"></i> Sign In with Facebook</a>
                  <a href="#" class="twitter-sign-in"><i class="fa fa-twitter"></i> Sign In with Twitter</a>
               </div>
               <form class="register-form outer-top-xs" role="form" method="POST" action="{{ route('login') }}">
                  @csrf
                  <div class="form-group">
                     <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                     <input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" name="email" required>
                  </div>
                  <div class="form-group">
                     <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
                     <input type="password" class="form-control unicase-form-control text-input" id="exampleInputPassword1" name="password" required >
                  </div>
                  <div class="radio outer-xs">
                     <label>
                     <input type="checkbox" id="optionsRadios2" value="option2" name="remember">Remember me!
                     </label>
                     <a href="{{ route('password.request') }}" class="forgot-password pull-right">Forgot your Password?</a>
                  </div>
                  <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
               </form>
            </div>
            <!-- Sign-in --> 
         </div>
         <!-- /.row -->
      </div>
      <!-- /.sigin-in-->
      <!-- ============================================== BRANDS CAROUSEL ============================================== -->
      <br>
      <!-- /.logo-slider -->
      <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->  
   </div>
   <!-- /.container -->
</div>
<!-- /.body-content -->
@endsection