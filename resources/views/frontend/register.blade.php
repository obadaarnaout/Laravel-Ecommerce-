@extends('frontend.index')
@section('frontend')
<div class="breadcrumb">
   <div class="container">
      <div class="breadcrumb-inner">
         <ul class="list-inline list-unstyled">
            <li><a href="{{url('')}}">Home</a></li>
            <li class='active'>Register</li>
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
            <div class="col-md-6 col-sm-6 create-new-account">
               <h4 class="checkout-subtitle">Create a new account</h4>
               <p class="text title-tag-line">Create your new account.</p>
               <form class="register-form outer-top-xs" role="form" method="POST" action="{{ route('register') }}">
                  @if($errors->any())
                      <div class="alert alert-danger alert-dismissible">
                          <strong>
                              {!! implode('<br/>', $errors->all('<span>:message</span>')) !!}
                          </strong>
                      </div>
                  @endif
                  @csrf
                  <div class="form-group">
                     <label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
                     <input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail2" name="email" >
                  </div>
                  <div class="form-group">
                     <label class="info-title" for="exampleInputEmail1">Name <span>*</span></label>
                     <input type="text" class="form-control unicase-form-control text-input" id="exampleInputEmail1" name="name" >
                  </div>
                  <div class="form-group">
                     <label class="info-title" for="exampleInputEmail1">Password <span>*</span></label>
                     <input type="password" class="form-control unicase-form-control text-input" id="exampleInputEmail1" name="password" >
                  </div>
                  <div class="form-group">
                     <label class="info-title" for="exampleInputEmail1">Confirm Password <span>*</span></label>
                     <input type="password" class="form-control unicase-form-control text-input" id="exampleInputEmail1" name="password_confirmation" >
                  </div>
                  <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Sign Up</button>
               </form>
            </div>
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